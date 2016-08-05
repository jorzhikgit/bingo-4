define(['app'], function(app)
{
    app.factory('dailyModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('daily');
        }
    ]);
});