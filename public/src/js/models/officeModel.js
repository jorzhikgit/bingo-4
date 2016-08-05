define(['app'], function(app)
{
    app.factory('officeModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('office');
        }
    ]);
});