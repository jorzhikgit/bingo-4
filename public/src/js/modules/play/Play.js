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
            var audio = {
                draw: new Audio('../../audio/drum_roll.mp3'),
                reveal: new Audio('../../audio/triangle_hit.mp3'),
                matched: new Audio('../../audio/tada.mp3'),
                mis_matched: new Audio('../../audio/wrong_buzzer.mp3'),
            };

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
            };

            _this.audio = function (name) {
                return audio[name];
            };
        }
    ]);

    app.controller('PlayController',
    [
        '$scope',
        '$timeout',
        '$state',
        '$stateParams',
        '$templateCache',
        '$q',
        'commonService',
        'modalService',
        'gritterService',
        'focusService',
        'blockerService',
        'playService',
        'playModel',
        'GLOBAL',
        'Restangular',
        
        function($scope, $timeout, $state, $stateParams, $templateCache, $q, Common, Modal, Gritter, Focus, Blocker, playService, Model, GLOBAL, Restangular) {
            var abortLoadWinners;

            var init = function() {
                var setPattern = function (pattern) {
                    $scope.pattern = pattern;
                };

                var revealNumber = function () {
                    playService.audio('reveal').play();
                    $scope.drawedNumbers.unshift($scope.latestDraw);
                    $scope.latestDraw.show = true;
                };

                $scope.revealNumber = revealNumber;

                $scope.vars = {};
                $scope.parish = {};
                $scope.pattern = {};
                $scope.state = {};
                $scope.play = {};
                $scope.winners = [];

                // variable to holds the drawed numbers
                $scope.drawedNumbers = [];
                $scope.plays = [];

                $scope.showWinners = function () {
                    $scope.vars.showWinners = !$scope.vars.showWinners;
                };

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
                    Restangular.one('plays').one($scope.play.id.toString()).get().then(function(play){
                        if (!$scope.play.pattern) {
                            $scope.play = _.findWhere($scope.plays, {id: $scope.play.id});
                        }

                        $scope.drawedNumbers = play.number_objects.reverse();
                        
                        if (play.number_objects.length) {
                            $scope.latestDraw = $scope.drawedNumbers[0];
                            $scope.latestDraw.show = true;
                        }

                        setPattern(play.pattern);
                    });

                    $scope.loadWinners();
                };

                $scope.loadWinners = function () {
                    if (abortLoadWinners) abortLoadWinners.resolve();

                    abortLoadWinners = $q.defer();
                    
                    Restangular.one('plays').one($scope.play.id.toString()).one('winners').withHttpConfig({timeout: abortLoadWinners.promise}).get().then(function (res) {
                        $scope.winners = res.plain().winners;
                        abortLoadWinners.resolve();
                    });
                };

                $scope.fullScreen = function () {
                    $scope.state.fullscreen = true;
                };

                $scope.closeFullScreen = function () {
                    $scope.state.fullscreen = false;
                };

                $scope.drawNumber = function () {
                    if (abortLoadWinners) abortLoadWinners.resolve();

                    if ($scope.isDrawingNumber) {
                        return;
                    }

                    if (!$scope.play.id || ($scope.drawedNumbers.length  == $scope.pattern.max_numbers)) {
                        return;
                    }

                    if ($scope.latestDraw.number && !$scope.latestDraw.show) {
                        revealNumber();
                        return;
                    }

                    playService.changeImageSrc();
                    playService.audio('draw').play();
                    $scope.latestDraw = {};
                    $scope.isDrawingNumber = true;
                    Model.one($scope.play.id).one('pick_a_number').post().then(function(latestDraw){
                        var timeout = $timeout(function() {
                            $scope.latestDraw = latestDraw;
                            playService.removeAttribute();
                            $scope.isDrawingNumber = false;
                            $scope.loadWinners();
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
                                playService.audio('matched').play()
                                return;
                            }

                            playService.audio('mis_matched').play();
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

                Restangular.service('parishes').one('active').get().then(function (parish) {
                    $scope.parish = parish;
                })

            }; // end of init

            // Start the Controller
            Common.init($scope, init);
        }
    ]);
});
