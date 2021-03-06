require.config({
	paths: {
		domReady: 		'../../vendor/domReady/domReady.min',
		jquery: 		'../../vendor/jquery/jquery-2.0.3.min',
		angular: 		'../../vendor/angular/angular.min',
		underscore: 	'../../vendor/underscore/underscore.min',
		restangular: 	'../../vendor/restangular/restangular.min',
		uiRouter: 		'../../vendor/angular-ui-route/angular-ui-router.min',
		pace: 			'../../vendor/pace/pace.min',
		bootstrap: 		'../../vendor/bootstrap/bootstrap.min',
		lteApp: 		'../../vendor/lte/app.min',
		lteAppExtend: 	'../../vendor/lte/app.extend.min',
		chosen: 		'../../vendor/chosen/chosen.jquery.min',
		jqGrid: 		'../../vendor/jqgrid/jquery.jqgrid.min',
		jqGridLocaleEn: '../../vendor/jqgrid/i18n/grid.locale-en.min',
		uiBootstrap: 	'../../vendor/ui-bootstrap/ui-bootstrap.min',
		jqueryUi: 		'../../vendor/jquery-ui/jquery-ui.min',
		ngAnimate: 		'../../vendor/angular-animate/angular-animate.min',
		gritter: 		'../../vendor/gritter/jquery.gritter.min',
		blockUi: 		'../../vendor/blockui/blockUI.min',
		jwerty: 		'../../vendor/jwerty/jwerty.min',
		datepicker: 	'../../vendor/datepicker/js/bootstrap-datepicker.min',
		maskedinput: 	'../../vendor/maskedinput/jquery.maskedinput.min',
		select2: 		'../../vendor/select2/select2.min',
		highlight: 		'../../vendor/highlight/jquery.highlight.min',
		debounce: 		'../../vendor/angular-debounce/angular-debounce.min',
		papa: 			'../../vendor/papaparse/papaparse',
		socketIO: 		'../../vendor/angular-socket-io/socket.min',
		moment: 		'../../vendor/moment/moment.min',

		// Uploader
		loadImage: 		'../../vendor/jquery-fileupload/load-image.min',
		loadImageMeta: 	'../../vendor/jquery-fileupload/load-image-meta.min',
		loadImageExif: 	'../../vendor/jquery-fileupload/load-image-exif.min',
		loadImageIos: 	'../../vendor/jquery-fileupload/load-image-ios.min',
		upload: 		'../../vendor/jquery-fileupload/jquery.fileupload.min',
		uploadAngular: 	'../../vendor/jquery-fileupload/jquery.fileupload-angular.min',
		uploadAudio: 	'../../vendor/jquery-fileupload/jquery.fileupload-audio.min',
		uploadProcess:	'../../vendor/jquery-fileupload/jquery.fileupload-process.min',
		uploadImage: 	'../../vendor/jquery-fileupload/jquery.fileupload-image.min',
		uploadValidate:	'../../vendor/jquery-fileupload/jquery.fileupload-validate.min',
		uploadVideo: 	'../../vendor/jquery-fileupload/jquery.fileupload-video.min',
		uploadWidget:   '../../vendor/jquery-fileupload/vendor/jquery.ui.widget.min',
		
		html2canvas:    '../../vendor/html2canvas/html2canvas',
		canvas2image:   '../../vendor/canvas2image/canvas2image',
		text:           '../../vendor/requirejs/require-text',

	},
	shim: {
		'angular' 		: {exports : 'angular', deps: ['jquery']},
		'jquery'		: {exports : '$'},
		'Papa'			: {exports : 'Papa'},
		'uiRouter' 		: {deps: ['angular']},
		'restangular'	: {deps: ['angular', 'underscore']},
		'uiBootstrap'	: {deps: ['angular', 'jquery']},
		'ngAnimate'		: {deps: ['angular']},
		'chosen'		: {deps: ['jquery']},
		'jqGrid'		: {deps: ['jquery', 'jqGridLocaleEn'] },
		'gritter'		: {deps: ['jquery']},
		'jqueryUi'		: {deps: ['jquery']},
		'bootstrap'		: {deps: ['jquery']},
		'blockUi'		: {deps: ['jquery']},
		'jwerty'		: {deps: ['jquery']},
		'lteApp'		: {deps: ['bootstrap', 'lteAppExtend']},
		'lteAppExtend'	: {deps: ['jquery']},
		'datepicker'	: {deps: ['jquery']},
		'maskedinput'	: {deps: ['jquery']},
		'select2'		: {deps: ['jquery']},
		'highlight'		: {deps: ['jquery']},
		'debounce' 		: {deps: ['angular']},
		'socketIO' 		: {deps: ['angular']},
		'moment' 		: {deps: ['jquery']},

		'loadImageMeta'     : {deps: ['jquery', 'loadImage']},
		'uploadImage' 	: {deps: ['jquery', 'uploadWidget']},
		'uploadAngular' : {deps: ['jquery', 'angular', 'uploadImage', 'uploadAudio', 'uploadVideo', 'uploadValidate']},

		'html2canvas': {
            exports: 'html2canvas',
            deps: ['jquery']
        },
        'canvas2image': {
        	exports: 'Canvas2Image',
        	deps: ['html2canvas']
        },

	},
	
	priority: [
		"pace",
		"angular",
		"jquery"
	],

	urlArgs: "paqs=" + Bingo.version,
	
	deps: ['start']
});

requirejs.onError = function (err) {
    /*if (err.requireType === 'timeout') {
    	alert('Loading Error, the window will be reloaded.');
        //window.location.reload();
    } else {
        throw err;
    }*/
};