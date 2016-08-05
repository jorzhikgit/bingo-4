define(['app', 'angular', 'html2canvas', 'canvas2image'], function(app, angular, html2canvas, Canvas2Image)
{
    app.controller('MakerController',
    [
        '$scope',
        '$timeout',
        '$interval',
        '$stateParams',
        'commonService',
        'GLOBAL',
        
        function($scope, $timeout, $interval, Common, GLOBAL) {
            var getCanvas; // global variable

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

                $timeout.cancel(t);
            };

            $scope.bingoLetters = {
                b: ["S"],
                i: ["E"],
                n: ["D"],
                g: ["P"],
                o: ["I", "nc."]
            };

            $scope.selected = {
                b: [0, 0, 0, 0, 1],
                i: [0, 0, 0, 0, 1],
                n: [0, 0, 0, 0, 1],
                g: [0, 0, 0, 0, 1],
                o: [0, 0, 0, 0, 1]
            };

            $scope.bingos = [
                {
                    id: "00001",
                    b: [1, 2, 3, 4, 5],
                    i: [16, 17, 18, 19, 20],
                    n: [31, 32, 33, 34, 35],
                    g: [46, 47, 48, 49, 50],
                    o: [61, 62, 63, 64, 65]
                }, {
                    id: "00002",
                    b: [5, 2, 3, 4, 1],
                    i: [20, 17, 18, 19, 15],
                    n: [35, 32, 33, 34, 31],
                    g: [50, 47, 48, 49, 46],
                    o: [65, 62, 63, 64, 61]
                }
            ];

            $scope.start = function () {
                var i = $interval(function () {
                    $scope.bingo = $scope.bingos.shift();

                    var t = $timeout(function () {
                        saveCard($scope.bingo.id);    
                        $timeout.cancel(t);
                    }, 500);

                    if (!$scope.bingos.length) {
                        $interval.cancel(i);
                    }
                }, 2000);
            };

            $scope.previewImage = function () {
                var element = $("#bingo"); // global variable
                
                html2canvas(element, {
                 onrendered: function (canvas) {
                        var a = document.createElement('a');
                        // toDataURL defaults to png, so we need to request a jpeg, then convert for file download.
                        a.href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
                        a.download = 'somefilename.jpg';
                        a.click();
                        
                        /*$("#previewImage").append(canvas);
                        getCanvas = canvas;*/
                     },
                     taintTest: false
                 });
            };
        }
    ]);
});