define([
	'angular', 
	'routes', 
	'services/dependencyResolverFor', 
	'pace', 
	'services/notifyService',
	'uiRouter',
	'restangular',
	'jquery',
	'uiBootstrap',
	'ngAnimate',
	'debounce',
	'uploadAngular',
	'socketIO'
	], 
	function (angular, config, dependencyResolverFor, pace) {
		'use strict';

		pace.start({
			document: false
		});

		var myApp = angular.module('myApp', [
			'ui.router',
			'restangular',
			'ui.bootstrap',
			'ngAnimate', 
			'notify',
			'debounce',
			'blueimp.fileupload',
			'btford.socket-io'
		]);

		myApp.constant('GLOBAL', {
			// Formats
			default: {
				dateFormat: '99/99/9999'
			},

			baseUrl: Bingo.baseUrl,
			csrfToken: Bingo.token,
			currentDate: Bingo.currentDate,
			baseSourcePath: Bingo.baseSourcePath,
			baseModulePath: Bingo.baseSourcePath + 'js/modules/',
			accessLevel: Bingo.accessLevel,
			version: Bingo.version
		});

		myApp.config(
		[
			'$urlRouterProvider', 
	        '$locationProvider',
	        '$controllerProvider',
	        '$compileProvider',
	        '$filterProvider',
	        '$provide',
	        '$stateProvider',
	        'RestangularProvider',

	        '$httpProvider',
	        'fileUploadProvider',
	        '$tooltipProvider',


			function($routeProvider, $locationProvider, $controllerProvider, $compileProvider, $filterProvider, $provide, $stateProvider, RestangularProvider, $httpProvider, fileUploadProvider, $tooltipProvider, GLOBAL)
	        {
	        	if (Bingo.environment === 'production') $compileProvider.debugInfoEnabled(false);
	        	
		        // Restangular Settings
		        RestangularProvider.setBaseUrl(Bingo.baseUrl + "/");
		        RestangularProvider.setDefaultHeaders({'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-Token': Bingo.token});
		        //RestangularProvider.setDefaultRequestParams({'_token': Bingo.token});

		        myApp.controller = $controllerProvider.register;
		        myApp.directive  = $compileProvider.directive;
		        myApp.filter     = $filterProvider.register;
		        myApp.factory    = $provide.factory;
		        myApp.service    = $provide.service;


		        // Check out this link
		        // https://github.com/angular-ui/ui-router/wiki/Frequently-Asked-Questions#how-to-configure-your-server-to-work-with-html5mode
	            //$locationProvider.html5Mode(true);
	            
	            if(config.routes !== undefined)
	            {
	            	var restricted = [];

	            	if (Bingo.accessLevel === 1 || Bingo.accessLevel === 0) {
	            		restricted = ['settings', 'queue', 'user', 'windows'];

	            		if (Bingo.accessLevel === 0) {
	            			restricted.push('process');
	            		}

	            		if (Bingo.accessLevel === 1) {
	            			restricted.push('preview');
	            		}
	            	}

	            	angular.forEach(restricted, function(value){
            			delete config.routes[value];
            		});

	                angular.forEach(config.routes, function(route, path)
	                {
					    $stateProvider
					      .state(route.name, {
					        url: path,
					        views: route.views,
					        resolve: dependencyResolverFor(route.dependencies),
					        onEnter: function () {
					        }
					      });
	                });
	            }

	            if(config.defaultRoutePaths !== undefined)
	            {
	                $routeProvider.otherwise("/#/");
	            }

	            // Uploader
	            delete $httpProvider.defaults.headers.common['X-Requested-With'];
                fileUploadProvider.defaults.redirect = window.location.href.replace(
                    /\/[^\/]*$/,
                    '/cors/result.html?%s'
                );
	        }
		]);
	
	myApp.run(
		['$rootScope', '$q', '$state', 'notifyService', function($rootScope, $q, $state, Notify) {
			
			$rootScope.$on('$stateChangeStart', 
				function(event, toState, toParams, fromState, fromParams) {
					Notify.loading.show = true;
				}
			);

			$state.transitionTo('app');
		}]);

	
	return myApp;
});