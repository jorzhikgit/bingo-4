define(['app', 'angular'], function(app, angular)
{
    app.controller('ImageViewerController',
    [
        '$scope',
        '$timeout',
        'modalService',
        'fromParent',
        'GLOBAL',
        
        function($scope, $timeout, Modal, fromParent, GLOBAL) {
            var photos = angular.copy(fromParent.photos);

            var removeThumbnail = function() {
                angular.forEach(photos, function(photo) {
                    photo.filename = photo.filename.replace('thumbnail/', '');
                });
            };

            removeThumbnail();

            $scope.photos = photos;
            //angular.extend($scope, );

            $scope.baseUrl = GLOBAL.baseUrl;

            $scope._Index = fromParent.index;

            // if a current image is the same as requested image
            $scope.isActive = function (index) {
                return $scope._Index === index;
            };

            // show prev image
            $scope.showPrev = function () {
                $scope._Index = ($scope._Index > 0) ? --$scope._Index : $scope.photos.length - 1;
            };

            // show next image
            $scope.showNext = function () {
                $scope._Index = ($scope._Index < $scope.photos.length - 1) ? ++$scope._Index : 0;
            };

            // show a certain image
            $scope.showPhoto = function (index) {
                $scope._Index = index;
            };
            
            $scope.cancel = function() {
                $scope.$dismiss();
            };

            $scope.imageLoaded = function(index) {
                $scope.$apply(function() {
                    $scope.photos[index].loaded = true;    
                });
            };

            Modal.destroy($scope);
        }
    ]);
}); 