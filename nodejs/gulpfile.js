var gulp        = require('gulp'),
    watch       = require('gulp-watch'),
    concat      = require('gulp-concat'),
    ngAnnotate  = require('gulp-ng-annotate'),
    uglify      = require('gulp-uglify'),
    rename      = require('gulp-rename'),
    notify      = require('gulp-notify');
    less        = require('gulp-less');
    cssmin      = require('gulp-cssmin');
    minifyHTML  = require('gulp-minify-html')

    require('gulp-help')(gulp, {
        description: 'Help listing.'
    });

gulp.task('uglify-js', 'Concat, Ng-Annotate, Uglify JavaScript into a single app.min.js.', function() {
    gulp.src(['../public/src/js/**/*.js'])
        .on('error', notify.onError("Error: <%= error.message %>"))
        .pipe(uglify())
        .on('error', notify.onError("Error: <%= error.message %>"))
        .pipe(gulp.dest('../public/dist/js'));

        gulp.src(['../public/src/js/modules/**/*.js'])
        //.pipe(ngAnnotate())
        .on('error', notify.onError("Error: <%= error.message %>"))
        .pipe(uglify())
        .on('error', notify.onError("Error: <%= error.message %>"))
        .pipe(gulp.dest('../public/dist/js/modules'));

        gulp.src(['../public/src/js/modules/**/modal/*.js'])
        //.pipe(ngAnnotate())
        .on('error', notify.onError("Error: <%= error.message %>"))
        .pipe(uglify())
        .on('error', notify.onError("Error: <%= error.message %>"))
        .pipe(gulp.dest('../public/dist/js/modules/**/modal'));

        gulp.src(['../public/src/js/modules/main/**/*.js'])
        //.pipe(ngAnnotate())
        .on('error', notify.onError("Error: <%= error.message %>"))
        .pipe(uglify())
        .on('error', notify.onError("Error: <%= error.message %>"))
        .pipe(gulp.dest('../public/dist/js/modules/main'))
        .pipe(notify({
            message: "Uglified JavaScript",
            onLast: true
        }));
});

gulp.task('less', 'Compile less into a single app.css.', function() {
    gulp.src(['../public/src/less/main.less'])
        .pipe(less())
        .on('error', notify.onError("Error: <%= error.message %>"))
        .pipe(cssmin())
        .pipe(rename('bingo.css'))
        .pipe(gulp.dest('../public/dist/css/'))
        .pipe(notify('Compiled less'));
});

gulp.task('less-local', 'Compile less into a single app.css.', function() {
    gulp.src(['../public/src/less/main.less'])
        .pipe(less())
        .on('error', notify.onError("Error: <%= error.message %>"))
        .pipe(cssmin())
        .pipe(rename('bingo.css'))
        .pipe(gulp.dest('../public/src/css/'))
        .pipe(notify('Compiled less'));
});

/**
 * Combine all vendors files to vendor.css
 */
gulp.task('cssmin', 'Minify and Concat vendor css.', function() {
    gulp.src([
            '../public/vendor/jqgrid/css/ui.jqgrid.css',
            //'../public/vendor/jqgrid/css/custom-theme/css/jquery-ui-1.10.0.custom.css',
            '../public/vendor/bootstrap/bootstrap.min.css',
            '../public/vendor/font-awesome/css/font-awesome.min.css',
            '../public/vendor/datepicker/css/datepicker3.css',
            '../public/vendor/chosen/chosen.css',
            '../public/vendor/jquery-fileupload/css/jquery.fileupload.css',
            '../public/vendor/gritter/css/jquery.gritter.mod.css',
            '../public/vendor/lte/AdminLTE.css',
            '../public/vendor/pace/pace.flash.css'
        ])
        .pipe(concat('vendor.css'))
        .pipe(cssmin({keepSpecialComments: 0}))
        .pipe(gulp.dest('../public/dist/css/'))
        .pipe(notify('Vendors CSS combined!'));
});

/**
 * Copy Font Awesome fonts to dist
 */
gulp.task('copy', 'Copy Font Awesome font files.', function() {
    
    gulp.src('../public/vendor/font-awesome/fonts/**.*')
        .pipe(gulp.dest('../public/dist/fonts/'));

    gulp.src('../public/vendor/chosen/*.png')
        .pipe(gulp.dest('../public/dist/css/'));

    gulp.src('../public/src/js/services/modalService.js')
        .pipe(gulp.dest('../public/dist/js/services/'));

});

/**
 * Watch for changes and run some task
 * @type {String}
 */
gulp.task('watch', 'Watch for changes and live reloads Chrome. Requires the Chrome extension \'LiveReload\'.', function() {
    
    watch({
        glob: '../public/src/js/**/*.js'
    }, function() {
        gulp.start('uglify-js');
    });

    watch({
        glob: '../public/src/less/*.less',
    }, function() {
        gulp.start('less');
    });

    watch({
        glob: '../public/src/js/**/*.html',
    }, function() {
        gulp.start('minify-html');
    });
});

/**
 * Minify Angular Templates
 */
gulp.task('minify-html', function() {
	var opts = { spare:true, empty: true };

	gulp.src('../public/src/js/**/*.html')
		.pipe(minifyHTML(opts))
		.pipe(gulp.dest('../public/dist/js'));

	gulp.src('../public/src/templates/*.html')
		.pipe(minifyHTML(opts))
		.pipe(gulp.dest('../public/dist/templates'));
});

gulp.task('default', ['uglify-js', 'less', 'minify-html', 'cssmin', 'copy']);