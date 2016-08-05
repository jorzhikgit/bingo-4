define(['app'], function(app)
{
    app.factory('imageLinkModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('image_link');
        }
    ]);
});