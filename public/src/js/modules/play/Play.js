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
        '$state',
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
        
        function($scope, $timeout, $state, $stateParams, $templateCache, Common, Modal, Gritter, Focus, Blocker, playService, Model, GLOBAL, Restangular) {

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
                        if($stateParams.id){
                            $scope.playId = parseInt($stateParams.id);
                            $scope.getDrawedNumbers();
                        }
                    });
                };

                $scope.showDrawedNumbers = function () {
                    $state.go('app.play', {id: $scope.playId}, {location: "replace", reload: false});
                };

                $scope.getDrawedNumbers = function() {
                    if(!$scope.playId) return;

                    Restangular.one('plays').one(''+$scope.playId+'').get().then(function(drawedNumbers){
                        $drawedNumbersLength = drawedNumbers.number_objects.length - 1;
                        angular.forEach(drawedNumbers.number_objects, function(drawedNumber,key){
                            if(key < $drawedNumbersLength)
                                $scope.drawedNumbers.unshift(drawedNumber);
                        });
                        if($drawedNumbersLength > 0)
                            $scope.latestDraw = drawedNumbers.number_objects[$drawedNumbersLength];
                    });
                }

                $scope.drawNumber = function () {
                    $scope.drawedNumbers.unshift($scope.latestDraw); 
                    Model.one($scope.playId).one('pick_a_number').post().then(function(data){
                        $scope.latestDraw = data;
                    });
                };

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
                };

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