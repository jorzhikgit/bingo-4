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
            'Restangular',

            function($scope, $document, $timeout, $modalInstance, Modal, Focus, Gritter, Form, fromParent, Restangular)
            {

                angular.extend($scope, fromParent);

                Restangular.one('patterns').one($scope.pattern.id.toString()).one('compare').one($scope.cardId.toString()).get().then(
                    function (res) {
                        $scope.compare = res;

                        if (res.status === 'Match') {
                            $scope.validate = true;
                            return;
                        }

                        $scope.validate = false;
                    },

                    function () {

                    }
                );


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