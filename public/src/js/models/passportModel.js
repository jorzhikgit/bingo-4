define(['app'], function(app)
{
    app.factory('passportModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('passport');
        }
    ]);
});