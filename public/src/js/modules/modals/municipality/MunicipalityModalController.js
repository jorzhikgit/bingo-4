define(['app', 'angular', 'underscore'], function(app, angular, _)
{
	app.controller('MunicipalityModalController',
	[
			'$scope',
			'$document',
			'$timeout',
			'$modalInstance',
			'modalService',
			'focusService',
			'gritterService',
			'formService',
			'fromParent',
			'municipalityModel',

			function($scope, $document, $timeout, $modalInstance, Modal, Focus, Gritter, Form, fromParent, municipalityModel)
			{
				$scope.state = { "saving": false };

				Focus.chosen('#region');

				angular.extend($scope, fromParent);

            	$scope.save = function() {
            		Form.setModelToSave($scope.municipality).setModelRest(municipalityModel).setState($scope.state).setForm($scope.municipalityForm);

	            	Form.save().then(
	                    function(res) {
	                        $scope.$close(res); 
	                    }
	                );
            	};
				
				/* Close the this modal */
				$scope.cancel = function() {
					if ( ! $scope.state.saving) $scope.$dismiss();
				};

				Modal.destroy($scope);

				/* Destroy non-angular objects */
				$scope.$on('$destroy', function (event) {});

			}
	]);
});