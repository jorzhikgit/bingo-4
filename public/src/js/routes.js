define([], function()
{
    var baseSourcePath = Bingo.baseSourcePath + 'js/modules/';

    return {
        defaultRoutePath: '/',
        routes: {
            '/': {
                views: {
                    'main': {
                        templateUrl: baseSourcePath + 'main/main.html?version=' + Bingo.version,
                        controller: 'MainController'
                    },
                    'loading': {
                        templateUrl: baseSourcePath + 'main/loading/loading.html?version=' + Bingo.version,
                        controller: 'LoadingController'  
                    },
                    'notify': {
                        templateUrl: baseSourcePath + 'main/notify/notify.html?version=' + Bingo.version,
                        controller: 'NotifyController'
                    }
                },
                
                dependencies: [
                    'modules/main/index'
                ],
                name: 'app'
            },

            'play/:id': {
                views: {
                    'content': {
                        templateUrl: baseSourcePath + 'play/play.html?version=' + Bingo.version,
                        controller: 'PlayController'   
                    }
                },
                dependencies: [
                    'modules/play/index'
                ],
                name: 'app.play'
            },

            'validate': {
                views: {
                    'content': {
                        templateUrl: baseSourcePath + 'validate/validate.html?version=' + Bingo.version,
                        controller: 'ValidateController'   
                    }
                },
                dependencies: [
                    'modules/validate/index'
                ],
                name: 'app.validate'
            },

            'maker': {
                views: {
                    'content': {
                        templateUrl: baseSourcePath + 'maker/maker.html?version=' + Bingo.version,
                        controller: 'MakerController'   
                    }
                },
                dependencies: [
                    'modules/maker/index'
                ],
                name: 'app.maker'
            },

            
            'user': {
                views: {
                    'content': {
                        templateUrl: baseSourcePath + 'user/user.html?version=' + Bingo.version,
                        controller: 'UserController'   
                    }
                },
                dependencies: [
                    'modules/user/index'
                ],
                name: 'app.user'
            },
        }
    };
});