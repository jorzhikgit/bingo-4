define(['app', 'angular'], function(app, angular)
{
    app.service('playService',
        [
            function () {
                var _this = this;

            } // end function
        ]
    );

    app.controller('PlayController',
    [
        '$scope',
        '$timeout',
        '$stateParams',
        '$templateCache',
        'commonService',
        'modalService',
        'gritterService',
        'focusService',
        'blockerService',
        'playService',
        'GLOBAL',
        
        function($scope, $timeout, $stateParams, $templateCache, Common, Modal, Gritter, Focus, Blocker, playService, GLOBAL) {

            var init = function() {

                $scope.state = {};

                // variable to holds the drawed numbers
                $scope.drawedNumbers = [];

                $scope.drawNumber = function () {
                    $scope.latestDraw = {column: 'S', number: Math.floor((Math.random()*75)+1)};
                    $scope.drawedNumbers.unshift($scope.latestDraw);

                    console.log($scope.drawedNumbers);
                }

                $scope.fullScreen = function () {
                    console.log(10000)
                    $scope.state.fullscreen = true;
                };

                $scope.closeFullScreen = function () {
                    $scope.state.fullscreen = false;
                };

            } // end of init

            // Start the Controller
            Common.init($scope, init);

            // Focus.on('#gbox_office input[name=grid_search]');
        }
    ]);
}); 