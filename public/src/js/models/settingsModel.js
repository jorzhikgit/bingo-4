define(['app'], function(app)
{
    app.factory('settingsModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('settings');
        }
    ]);
});