define(['app', 'angular'], function(app, angular)
{
    app.controller('DashboardController',
    [
        '$scope',
        '$timeout',
        '$stateParams',
        'commonService',
        'dashboardModel',
        'GLOBAL',
        
        function($scope, $timeout, $stateParams, Common, dashboardModel, GLOBAL) {
            var init = function() {

                dashboardModel.one().get().then(
                    function(res) {
                        console.log(res);
                    },

                    function() {
                        
                    }

                );
                
            } // end of init

            // Start the Controller
            Common.init($scope, init);
        }
    ]);
});