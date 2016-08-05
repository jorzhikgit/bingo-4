define(['app'], function(app)
{
    app.factory('provinceModel',
    [
        'Restangular',

        function(Restangular) {
            return Restangular.service('province');
        }
    ]);
});