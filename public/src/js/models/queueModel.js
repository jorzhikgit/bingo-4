define(['app'], function(app)
{
    app.factory('queueModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('queue');
        }
    ]);
});