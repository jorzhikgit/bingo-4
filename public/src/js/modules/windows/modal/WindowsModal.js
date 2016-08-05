define(['app', 'angular', 'underscore'], function(app, angular, _)
{
	app.controller('WindowsModalController',
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
			'windowsModel',
			'userModel',

			function($scope, $document, $timeout, $modalInstance, Modal, Focus, Gritter, Form, fromParent, windowsModel, userModel)
			{
				$scope.users = {};

				userModel.getList().then(
					function (res) {
						$scope.users = res;
						console.log($scope.users);
					}
				);

				$scope.state = { "saving": false };

				Focus.on('#name');

				angular.extend($scope, fromParent);

				$scope.windows.user_id = parseInt($scope.windows.user_id);

            	$scope.save = function() {
            		Form.setModelToSave($scope.windows).setModelRest(windowsModel).setState($scope.state).setForm($scope.windowsForm);

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