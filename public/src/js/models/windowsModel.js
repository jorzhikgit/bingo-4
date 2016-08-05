define(['app'], function(app)
{
    app.factory('windowsModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('window');
        }
    ]);
});