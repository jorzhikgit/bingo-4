define(['app'], function(app)
{
    app.factory('importModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('import');
        }
    ]);
});