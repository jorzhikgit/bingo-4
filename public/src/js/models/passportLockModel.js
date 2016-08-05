define(['app'], function(app)
{
    app.factory('passportLockModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('passport_lock');
        }
    ]);
});