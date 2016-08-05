define(['app', 'angular', 'html2canvas', 'canvas2image'], function(app, angular, html2canvas, Canvas2Image)
{
    app.controller('MakerController',
    [
        '$scope',
        '$timeout',
        '$interval',
        'commonService',
        'Restangular',
        'GLOBAL',
        
        function($scope, $timeout, $interval, Common, Restangular, GLOBAL) {
            var cardsToMake = 0, workingPage = 1, totalPage = 0, cardsMade = 0;

            var saveCard = function (filename) {
                var element = $("#bingo"); // global variable
                
                html2canvas(element, {
                 onrendered: function (canvas) {
                        var a = document.createElement('a');
                        // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
                        a.href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
                        a.download = 'card' + filename + '.png';
                        a.click();
                     },
                     taintTest: false
                 });
            };

            $scope.isMakingCard = false;

            $scope.bingoLetters = {
                b: ["S"],
                i: ["E"],
                n: ["D"],
                g: ["P"],
                o: ["I", "nc."]
            };

            var getCards = function () {
                Restangular.one('cards').get({page: workingPage}).then(
                    function (res) {
                        $scope.bingos = res.data;
                        cardsToMake = res.total;

                        if (workingPage > 1) {
                            $scope.start();
                        }

                        workingPage++;

                        if (!totalPage) {
                            totalPage = res.last_page;
                        }
                    }
                );
            };

            $scope.startCaption = function () {
                if ($scope.isMakingCard) {
                    return 'Making Cards ' + (cardsMade + 1) + ' of ' + cardsToMake;
                }

                return 'Start';
            }

            $scope.start = function () {
                $scope.isMakingCard = true;
                var i = $interval(function () {
                    $scope.bingo = $scope.bingos.shift();

                    var t = $timeout(function () {
                        saveCard($scope.bingo.id);

                        cardsMade++;
                        
                        $timeout.cancel(t);
                    }, 500);

                    if (!$scope.bingos.length) {
                        $scope.isMakingCard = false;
                        
                        if (workingPage <= totalPage) {
                            getCards();
                        }

                        $interval.cancel(i);
                    }
                }, 1500);
            };

            getCards();
        }
    ]);
});
