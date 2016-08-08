define(['app', 'angular'], function(app, angular)
{
    app.factory('playModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('plays');
        }
    ]);

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
        'playModel',
        'GLOBAL',
        'Restangular',
        
        function($scope, $timeout, $stateParams, $templateCache, Common, Modal, Gritter, Focus, Blocker, playService, Model, GLOBAL, Restangular) {

            var init = function() {
                
                playService.toggleMenuSidebar();
                playService.toggleHeader();

                // templates
                $scope.templates  = {
                    validation_form  : GLOBAL.baseModulePath + 'play/modal/validation_form.html',
                };

                // variable to holds the drawed numbers
                $scope.drawedNumbers = [];
                $scope.plays = [];

                $scope.getPlays = function () {
                    Restangular.one('plays').get().then(function(result){
                        $scope.plays = result.data;
                    });
                }

                $scope.drawNumber = function () {
                    Model.one($scope.playId).one('pick_a_number').post().then(function(data){
                        console.log(data, 'the data');
                        $scope.latestDraw = data; /*{column: 'S', number: Math.floor((Math.random()*75)+1)};*/
                        $scope.drawedNumbers.unshift($scope.latestDraw);    
                    });
                }

                $scope.validateCard = function() {
                    var modalOptions = {
                        template   : $templateCache.get("validation-form.html"),
                        controller : 'ValidateController',
                        windowClass: 'validation-modal-window',
                        resolve    : {
                            fromParent : function () {
                                return {
                                    patternUrl : 'ns.gif',
                                    cardId : $scope.cardId
                                };
                            }
                        }
                    };

                    Modal.showModal(modalOptions).then(
                        function (res) {
                        }
                    )
                }

                $scope.getPlays();

                $scope.$on('$stateChangeStart', 
                    function(event, toState, toParams, fromState, fromParams) {
                        $("header").show();
                        $(".navbar-btn").trigger("click");
                    }
                );

            } // end of init

            // Start the Controller
            Common.init($scope, init);

            // Focus.on('#gbox_office input[name=grid_search]');
        }
    ]);
}); 