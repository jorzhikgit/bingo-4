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

        }
    ]);

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
                var setPattern = function (pattern) {
                    $scope.pattern = pattern;
                };

                $scope.pattern = {};
                $scope.state = {};

                // templates
                $scope.templates  = {
                    validation_form  : GLOBAL.baseModulePath + 'play/modal/validation_form.html',
                };

                // variable to holds the drawed numbers
                $scope.drawedNumbers = [];
                $scope.plays = [];

                $scope.drawNumber = function () {
                    $scope.drawedNumbers.unshift($scope.latestDraw); 
                    Model.one($scope.playId).one('pick_a_number').post().then(function(data){
                        $scope.latestDraw = data;
                    });
                };

                $scope.getPlays = function () {
                    Restangular.one('plays').get().then(function(result){
                        $scope.plays = result.data;
                        if ($stateParams.id) {
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

                    Restangular.one('plays').one($scope.playId.toString()).get().then(function(drawedNumbers){
                        $drawedNumbersLength = drawedNumbers.number_objects.length;
                        angular.forEach(drawedNumbers.number_objects, function(drawedNumber,key){
                            if(key < ($drawedNumbersLength - 1))
                                $scope.drawedNumbers.unshift(drawedNumber);
                        });
                        
                        if($drawedNumbersLength > 0)
                            $scope.latestDraw = drawedNumbers.number_objects[$drawedNumbersLength-1];

                        setPattern(drawedNumbers.pattern);
                    });
                };

                $scope.fullScreen = function () {
                    $scope.state.fullscreen = true;
                };

                $scope.closeFullScreen = function () {
                    $scope.state.fullscreen = false;
                };

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
                                    cardId : $scope.cardId,
                                    pattern: $scope.pattern
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

            }; // end of init

            // Start the Controller
            Common.init($scope, init);

            // Focus.on('#gbox_office input[name=grid_search]');
        }
    ]);
});
