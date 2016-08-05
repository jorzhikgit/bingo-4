define(['app'], function(app)
{
    app.factory('municipalityModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('municipality');
        }
    ]);
});