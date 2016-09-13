define(['app', 'angular', 'underscore'], function(app, angular, _)
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

                var revealNumber = function () {
                    $scope.latestDraw.show = true;
                };

                $scope.vars = {};
                $scope.pattern = {};
                $scope.state = {};
                $scope.play = {};

                // variable to holds the drawed numbers
                $scope.drawedNumbers = [];
                $scope.plays = [];


                $scope.getPlays = function () {
                    Restangular.one('plays').get().then(function(result){
                        $scope.plays = result.data;

                        if ($stateParams.id) {
                            $scope.play.id = parseInt($stateParams.id);
                            $scope.getDrawedNumbers();
                            return;
                        }

                        Focus.on('#play');
                    });
                };

                $scope.showDrawedNumbers = function () {
                    $state.go("app.play", {id: $scope.play.id}, {location: "replace", reload: false, notify: false});
                    $scope.getDrawedNumbers();
                };

                $scope.getDrawedNumbers = function() {
                    if(!$scope.play.id) return;

                    $scope.latestDraw = {};
                    Restangular.one('plays').one($scope.play.id.toString()).get().then(function(drawedNumbers){
                        if (!$scope.play.pattern) {
                            $scope.play = _.findWhere($scope.plays, {id: $scope.play.id});
                        }

                        $drawedNumbersLength = drawedNumbers.number_objects.length;
                        $scope.drawedNumbers = [];
                        angular.forEach(drawedNumbers.number_objects, function(drawedNumber,key){
                            if(key < ($drawedNumbersLength - 1))
                                $scope.drawedNumbers.unshift(drawedNumber);
                        });
                        
                        if($drawedNumbersLength > 0)
                            $scope.latestDraw = drawedNumbers.number_objects[$drawedNumbersLength-1];

                        setPattern(drawedNumbers.pattern);

                        // call drawNumber to automatically reveal number on page reload
                        if ($scope.latestDraw.number) {
                            $scope.drawNumber();
                        }
                    });
                };

                $scope.fullScreen = function () {
                    $scope.state.fullscreen = true;
                };

                $scope.closeFullScreen = function () {
                    $scope.state.fullscreen = false;
                };

                $scope.drawNumber = function () {
                    if ($scope.isDrawingNumber) {
                        return;
                    }

                    if (!$scope.play.id || ($scope.drawedNumbers.length  == 74)) {
                        return;
                    }

                    if ($scope.latestDraw.number && !$scope.latestDraw.show) {
                        $scope.drawedNumbers.unshift($scope.latestDraw);
                        revealNumber();
                        return;
                    }

                    playService.changeImageSrc();
                    playService.playDrumRoll();
                    $scope.latestDraw = {};
                    $scope.isDrawingNumber = true;
                    Model.one($scope.play.id).one('pick_a_number').post().then(function(data){
                        var timeout = $timeout(function() {
                            $scope.latestDraw = data;
                            playService.removeAttribute();
                            $scope.isDrawingNumber = false;
                            $timeout.cancel(timeout);
                        }, 2000);
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


                $scope.parseInt = function (number) {
                    return parseInt(number);
                };

                $scope.isDrawn = function (number) {
                    var isDrawn = false;
                    angular.forEach($scope.drawedNumbers, function (numObj) {
                        if (parseInt(numObj.number) === number) {
                            isDrawn = true;
                        }
                    });

                    return isDrawn;
                };

                $scope.columnStart = function (column) {
                    var starts = {
                        S: 0,
                        E: 15,
                        D: 30,
                        P: 45,
                        I: 60,
                    };

                    return starts[column]
                };

                $scope.range = function (start, end) {
                    var arr = [];
                    arr.push(start);
                    while (start != end) {
                        if (start < end) {
                            start++;
                        } else {
                            start--;
                        }

                        arr.push(start);
                    }

                    return arr;
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
