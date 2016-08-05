define(['app', 'angular'], function(app, angular)
{
    app.service('playService',
        [
            function () {
                var _this = this;

                _this.toggleMenuSidebar = function () {
                    // hide sidebar
                    $(".navbar-btn").trigger("click");
                };

                // hide header
                _this.toggleHeader = function () {
                    $el = $("header");
                    if ($el.is(":visible")) {
                        $el.css("display", "none");
                    } else {
                        $el.show();
                    }
                };

                

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
                
                playService.toggleMenuSidebar();
                playService.toggleHeader();

                // variable to holds the drawed numbers
                $scope.drawedNumbers = [];


                $scope.drawNumber = function () {
                    $scope.latestDraw = {column: 'S', number: Math.floor((Math.random()*75)+1)};
                    $scope.drawedNumbers.unshift($scope.latestDraw);

                    console.log($scope.drawedNumbers);
                }

            } // end of init

            // Start the Controller
            Common.init($scope, init);

            // Focus.on('#gbox_office input[name=grid_search]');
        }
    ]);
}); 