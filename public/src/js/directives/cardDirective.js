define([
    'app',
    'angular',
    'jquery',
    'text!../../templates/card.html'
], function (app, angular, $, cardTemplate) {

    app.directive('card', [
        '$timeout',
        'GLOBAL',

        function ($timeout, GLOBAL) {
            return {
                restrict: 'E',
                transclude: true,

                scope: {
                    numbers: '=',
                    letters: '=',
                    selected: '=',
                },

                template: cardTemplate,

                link: function (scope, element, attrs, ctrl) {
                    if (!scope.letters) {
                        scope.letters = {
                            b: ["B"],
                            i: ["I"],
                            n: ["N"],
                            g: ["G"],
                            o: ["O"]
                        };
                    }

                } // of link: function
            }; // end of return
        } // end of function
    ]); //end of app.directive
});