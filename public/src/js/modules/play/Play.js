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

            _this.changeImageSrc = function() {
                $('.bingo-ball-img').css(
                    {
                        'background': 'url(/images/random.gif)',
                        'background-size' : '100% 100%',
                        'background-repeat' : 'no-repeat',
                    }
                );
            };

            _this.removeAttribute = function () {
                $('.bingo-ball-img').removeAttr('style');
            }

            _this.playDrumRoll = function () {
                $('#drum-roll').load();
                setTimeout($('#drum-roll')[0].play(), 100);
            }

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

                $scope.vars = {};
                $scope.pattern = {};
                $scope.state = {};

                // variable to holds the drawed numbers
                $scope.drawedNumbers = [];
                $scope.plays = [];


                $scope.getPlays = function () {
                    Restangular.one('plays').get().then(function(result){
                        $scope.plays = result.data;
                        if ($stateParams.id) {
                            $scope.playId = parseInt($stateParams.id);
                            $scope.getDrawedNumbers();
                        }
                    });
                };

                $scope.revealNumber = function () {
                    $scope.latestDraw.show = true;
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
                    playService.changeImageSrc();
                    playService.playDrumRoll();
                    $scope.drawedNumbers.unshift($scope.latestDraw);
                    $scope.latestDraw = {};
                    Model.one($scope.playId).one('pick_a_number').post().then(function(data){
                        var timeout = $timeout(function() {
                            $scope.latestDraw = data;
                            playService.removeAttribute();
                        }, 2000);
                        timeout.cancel();
                    });
                };

                $scope.validateCard = function () {
                    Restangular.one('patterns').one($scope.pattern.id.toString()).one('compare').one($scope.cardId.toString()).get().then(
                        function (res) {
                            $scope.compare = res;

                            Focus.on('#btn-close-validation');

                            $scope.vars.validating = true;
                            
                            if (res.status === 'Matched') {
                                $scope.vars.matched = true;
                                return;
                            }

                            $scope.vars.matched = false;
                        },

                        function () {

                        }
                    );
                };

                $scope.closeValidation = function () {
                    $scope.vars.validating = false;
                };

                $scope.getPlays();

            }; // end of init

            // Start the Controller
            Common.init($scope, init);
        }
    ]);
});
