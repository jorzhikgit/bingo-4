define(['app'], function(app)
{
    app.factory('processingModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('processing');
        }
    ]);
});