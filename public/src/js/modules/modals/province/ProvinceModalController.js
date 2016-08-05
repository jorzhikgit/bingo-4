define(['app', 'angular', 'underscore'], function(app, angular, _)
{
	app.controller('ProvinceModalController',
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
			'provinceModel',

			function($scope, $document, $timeout, $modalInstance, Modal, Focus, Gritter, Form, fromParent, provinceModel)
			{
				$scope.state = { "saving": false };

				Focus.chosen('#region');

				angular.extend($scope, fromParent);

            	$scope.save = function() {
            		Form.setModelToSave($scope.province).setModelRest(provinceModel).setState($scope.state).setForm($scope.provinceForm);

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