define(['app'], function(app)
{
    app.factory('birthPlaceModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('birth_place');
        }
    ]);
});