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

                $scope.state = {};

                // templates
                $scope.templates  = {
                    validation_form  : GLOBAL.baseModulePath + 'play/modal/validation_form.html',
                };

                // variable to holds the drawed numbers
                $scope.drawedNumbers = [];
                $scope.plays = [];

                $scope.drawNumber = function () {
                    $scope.latestDraw = {column: 'S', number: Math.floor((Math.random()*75)+1)};
                    $scope.drawedNumbers.unshift($scope.latestDraw);
                };

                $scope.getPlays = function () {
                    Restangular.one('plays').get().then(function(result){
                        $scope.plays = result.data;
                        if($stateParams.id){
                            console.log($stateParams, 'sample');
                            $scope.playId = $stateParams.id;
                            $scope.getDrawedNumbers();
                        }
                    });
                };

                $scope.getDrawedNumbers = function() {
                    if(!$scope.playId) return;

                    Restangular.one('plays').one($scope.playId).get().then(function(drawedNumbers){
                        angular.forEach(drawedNumbers.number_objects, function(drawedNumber,key){
                            $scope.drawedNumbers.unshift(drawedNumber);
                        });
                    });
                };

                $scope.fullScreen = function () {
                    $scope.state.fullscreen = true;
                };

                $scope.closeFullScreen = function () {
                    $scope.state.fullscreen = false;
                };

                $scope.drawNumber = function () {
                    Model.one($scope.playId).one('pick_a_number').post().then(function(data){
                        console.log(data, 'the data');
                        $scope.latestDraw = data; /*{column: 'S', number: Math.floor((Math.random()*75)+1)};*/
                        $scope.drawedNumbers.unshift($scope.latestDraw); 
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

            }; // end of init

            // Start the Controller
            Common.init($scope, init);

            // Focus.on('#gbox_office input[name=grid_search]');
        }
    ]);
});