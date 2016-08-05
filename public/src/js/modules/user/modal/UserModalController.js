define(['app', 'angular', 'underscore'], function(app, angular, _)
{
	app.controller('UserModalController',
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
			'userModel',

			function($scope, $document, $timeout, $modalInstance, Modal, Focus, Gritter, Form, fromParent, userModel)
			{
				$scope.state = { "saving": false };

				Focus.on('#user_name');

				angular.extend($scope, fromParent);

				$scope.save = function() {
            		Form.setModelToSave($scope.user).setModelRest(userModel).setState($scope.state).setForm($scope.userForm);

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

				/* Destroy non-angular objectst */
				$scope.$on('$destroy', function (event) {});

				Focus.on("#username");

			}
	]);
});