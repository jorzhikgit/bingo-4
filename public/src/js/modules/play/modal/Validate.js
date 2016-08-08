define(['app', 'angular', 'underscore'], function(app, angular, _)
{
    app.controller('ValidateController',
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

            function($scope, $document, $timeout, $modalInstance, Modal, Focus, Gritter, Form, fromParent)
            {

                angular.extend($scope, fromParent);

                // Needs url for this..........


                /* Close the this modal */
                $scope.cancel = function() {
                    $scope.$dismiss();
                };

                Modal.destroy($scope);

                /* Destroy non-angular objectst */
                $scope.$on('$destroy', function (event) {});


            }
    ]);
});