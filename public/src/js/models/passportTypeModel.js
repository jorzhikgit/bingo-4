define(['app'], function(app)
{
    app.factory('passportTypeModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('passport_type');
        }
    ]);
});