define(['app'], function(app)
{
    app.factory('validityModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('validity');
        }
    ]);
});