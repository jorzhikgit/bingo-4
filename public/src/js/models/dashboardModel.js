define(['app'], function(app)
{
    app.factory('dashboardModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('dashboard');
        }
    ]);
});