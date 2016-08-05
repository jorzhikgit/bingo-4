define(['app', 'angular'], function(app, angular)
{
    app.controller('ProfileController',
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
        'userModel',
        'GLOBAL',
        
        function($scope, $timeout, $stateParams, $templateCache, Common, Modal, Gritter, Focus, Blocker, userModel, GLOBAL) {
            
            var init = function() {
                /**
                * Configurations
                */

                var getModalDefaultUpload = function() {
                    
                    var modalDefaults = {
                        windowClass: 'modal-width-70',
                        controller: 'UploadController',
                        template: $templateCache.get('upload-modal.html'),

                        resolve: {
                            fromParent: function() {
                                return {
                                    upload: {
                                        table_name: 'user',
                                        table_id: 100,
                                        multiple: true
                                    }
                                };
                            }
                        }
                    };

                    return modalDefaults;
                }; // end of getModalDefaultUpload

                $scope.templates = {
                    profile: GLOBAL.baseModulePath + 'upload/upload-modal.html?version=' + GLOBAL.version
                };

                $scope.baseUrl = GLOBAL.baseUrl + '/';

                $scope.profile = {};

                Blocker.on('.box-body .media');

                userModel.one('profile').get().then(
                    function(res){
                        $scope.profile = res[0];

                        Blocker.off('.box-body .media');
                    }
                );

                

                /* Load the Grid with Data */
                //$scope.refresh();

                $scope.uploadImage = function() {
                    Focus.active();

                    Modal.show(getModalDefaultUpload()).then(
                        function(res) {
                        window.location.reload();

                            Focus.last();
                        },
                        function(res) {
                            Focus.last();
                        }
                    );
                };

                var destroy = function() {};
                        
                Common.destroy($scope, destroy);

                $scope.$on('$stateChangeStart', 
                    function(event, toState, toParams, fromState, fromParams) { 
                    //event.preventDefault(); 
                    
                    // transitionTo() promise will be rejected with 
                    // a 'transition prevented' error
                    }
                );
            } // end of init
            // Start the Controller
            Common.init($scope, init);

            Focus.on('#gbox_office input[name=grid_search]');
        }
    ]);
}); 