define(['app'], function(app)
{
    app.factory('filterModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('filter');
        }
    ]);
});