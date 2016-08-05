define(['app', 'angular'], function(app, angular)
{
    app.controller('UserController',
    [
        '$scope',
        '$timeout',
        '$stateParams',
        '$templateCache',
        'userFactory',
        'commonService',
        'modalService',
        'gritterService',
        'focusService',
        'gridService',
        'userModel',
        'GLOBAL',
        
        function($scope, $timeout, $stateParams, $templateCache, User, Common, Modal, Gritter, Focus, Grid, userModel, GLOBAL) {
            
            var init = function() {
                var modalTemplatePath = 'user/modal/user-modal.html?version=' + GLOBAL.version;

                $scope.grid = angular.copy(User.grid);

                $scope.templates = {
                    office: GLOBAL.baseModulePath + modalTemplatePath
                };

                var t = $timeout(function() {
                    Grid.setModalController('UserModalController').setModalTemplate('user-modal.html').setModalTemplatePath(modalTemplatePath).setModalData({change_password: "1"}).setModalName('user');
                    Grid.setJqGrid($scope.jqGrid).setGrid($scope.grid).setModel(userModel);

                    $scope.refresh = Grid.refresh;

                    /* Load the Grid with Data */
                    $scope.refresh();

                    /* Attempt to Add Record to Grid, opens a Modal */
                    $scope.add = Grid.add;

                    /* Edit Record in Grid and update the database */
                    $scope.edit = Grid.edit;

                    /* Delete Record in Grid and delete it in the database */
                    $scope.delete = Grid.delete;

                    $timeout.cancel(t);
                });
                
                var destroy = function() {};
                        
                Common.destroy($scope, destroy);

                $scope.$on('$stateChangeStart', 
                    function(event, toState, toParams, fromState, fromParams) {}
                );
            } // end of init
            // Start the Controller
            Common.init($scope, init);

            Focus.on('#gbox_user-grid input[name=grid_search]');
        }
    ]);
}); 