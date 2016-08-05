<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bingo System</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        
        @if($paths['base_source'] === 'src/')
            <!-- jqGrid -->
            {{ HTML::style('vendor/jqgrid/css/ui.jqgrid.css') }}
            
            {{ HTML::style('vendor/jqgrid/css/custom-theme/css/jquery-ui-1.10.0.custom.css') }}

            <!-- bootstrap 3.0.2 -->
            {{ HTML::style('vendor/bootstrap/bootstrap.min.css') }}

            <!-- font Awesome -->
            {{ HTML::style('vendor/font-awesome/css/font-awesome.min.css') }}
            
            <!-- Date Picker -->
            {{ HTML::style('vendor/datepicker/css/datepicker3.css') }}

            <!-- Chosen -->
            {{ HTML::style('vendor/chosen/chosen.css') }}

            <!-- jQuery File Upload -->
            {{ HTML::style('vendor/jquery-fileupload/css/jquery.fileupload.css') }}
            
            <!-- Gritter -->
            {{ HTML::style('vendor/gritter/css/jquery.gritter.mod.css') }}
            
            <!-- Pace -->
            {{ HTML::style('vendor/pace/pace.flash.css') }}

            <!-- Theme style -->
            {{ HTML::style('vendor/lte/AdminLTE.css') }}
        @else
            {{ HTML::style('vendor/jqgrid/css/custom-theme/css/jquery-ui-1.10.0.custom.css') }}

            {{ HTML::style($paths['base_source'] . 'css/vendor.css') }}

            <!-- Theme style -->
            {{ HTML::style('vendor/lte/AdminLTE.css') }}
        @endif
        
        <!-- Passport Styles and Overrides -->
        {{ HTML::style($paths['base_source'] . 'css/bingo.css') }}
    </head>
    <body class="skin-blue">
        <div id="main-loading">
            <div class="loading-overlay"></div>
            <div class="loading-element">
                <i class="blue fa fa-spinner fa-spin fa-4x"></i>
                <p class="text-yellow">LOADING</p>
            </div>
        </div>

        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a ui-sref="app" class="logo" title="Passport Queuing System">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Bingo
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            @include('layout.nav')
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            @include('layout.left')

            <!-- Right side column. Contains the navbar and content of the page -->
           @include('layout.right')
    
           <!-- <small class="badge pull-right bg-green" style="bottom:0">1</small> -->
        </div><!-- ./wrapper -->
        
        <!-- Scroll to Top -->
        <div class="scroll-top-wrapper">
            <span class="scroll-top-inner">
            <i class="fa fa-arrow-circle-up"></i>
            </span>
        </div>

        {{ HTML::script('vendor/socket.io/socket.io.js') }}
        {{ HTML::script('vendor/requirejs/require.min.js', ['data-main' => $paths['base_source'] . 'js/main'] ) }}
        
    </body>
</html>