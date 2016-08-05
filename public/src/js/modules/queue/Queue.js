define(['app', 'angular'], function(app, angular)
{
    app.factory('queueFactory',
    [
        'Restangular',

        function(Restangular) {
            var Factory = {};

            return Factory;
        }
    ]);

    app.controller('QueueController',
    [
        '$scope',
        '$timeout',
        '$stateParams',
        '$templateCache',
        'queueFactory',
        'commonService',
        'modalService',
        'gritterService',
        'focusService',
        'gridService',
        'formService',
        'queueModel',
        'GLOBAL',
        
        function($scope, $timeout, $stateParams, $templateCache, Win, Common, Modal, Gritter, Focus, Grid, Form, queueModel, GLOBAL) {
            var init = function() {
                var getMaxNumber = function () {
                    $scope.info.loading = true;

                    queueModel.one().get().then(
                        function (res) {
                            var max = parseInt(res.max);
                            $scope.current = max;
                            $scope.queue.number = max;
                            $scope.info.loading = false;

                            Focus.on('#btn-assign');    
                        }
                    );
                };

                $scope.info = {
                    loading: false
                };

                $scope.templates = {};

                $scope.state = {};

                $scope.queue = {
                    number: 1
                };

                $scope.up = function () {
                    $scope.queue.number++;
                };

                $scope.down = function () {
                    if ($scope.current === $scope.queue.number) return;

                    $scope.queue.number--   ;
                };

                $scope.assign = function() {
                    if ($scope.state.saving || $scope.info.loading) return;

                    $scope.queueForm.$dirty = true;

                    Form.setModelToSave($scope.queue).setModelRest(queueModel).setState($scope.state).setForm($scope.queueForm);
                    
                    Form.setSaveMessage({
                        ask: 'Assign Number?',
                        confirm: 'Number Successfully Assigned!',
                        notify: 'Assigning Number.'
                    });

                    Form.save().then(
                        function(res) {
                            $scope.queue.id = null;
                            $scope.queue.number++;
                            $scope.current++;

                            Focus.on('#btn-assign');
                        }
                    );
                };

                var destroy = function() {};
                        
                Common.destroy($scope, destroy);


                $scope.$on('$stateChangeStart', 
                    function(event, toState, toParams, fromState, fromParams) {}
                );

                getMaxNumber();

            } // end of init
            // Start the Controller
            Common.init($scope, init);
        }
    ]);
});
