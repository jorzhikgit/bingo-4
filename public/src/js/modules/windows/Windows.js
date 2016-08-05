define(['app', 'angular'], function(app, angular)
{
    app.factory('windowsFactory',
    [
        'Restangular',

        function(Restangular) {
            //var Factory = {};

            return {
                getAll: function() {

                    return Restangular.all('window');
                },

                grid: {
                    
                    selection: {
                        multiple: null,
                        one: null
                    },
                    api: {},

                    // TOOLBAR variables
                    tb: {},

                    // JqGrid Configurations
                    config: {
                        // Custom configuration
                        _gridId: 'windows',
                        _pager: false,
                        _firstRowSelected: true,
                        _fullParentHeight: true,
                        _additionalHeight: -130,
                        _editable: false,
                        _lock: false,
                        _lockMessage: 'LOADING',

                        _toolbar: [
                            {
                                button: ['btn-info'],
                                click: '$parent.add()',
                                text: 'Add',
                                icon: ['fa fa-plus']
                            },
                            {
                                button: ['btn-danger'],
                                click: '$parent.delete()',
                                disabled: ' ! $parent.grid.tb.delete',
                                text: 'Delete',
                                icon: ['fa fa-trash-o']
                            },
                            {
                                button: ['btn-warning'],
                                click: '$parent.edit()',
                                disabled: ' ! $parent.grid.tb.edit',
                                text: 'Edit',
                                icon: ['fa fa-pencil']
                            },
                            {
                                button: ['btn-success'],
                                click: '$parent.refresh(\'REFRESHING\')',
                                disabled: ' ! $parent.grid.tb.refresh',
                                text: 'Refresh',
                                icon: ['fa fa-refresh']
                            }
                        ],

                        // JqGrid configuration
                        datatype: "local",
                        altRows: true,
                        height: 260,
                        colNames:['Name', 'User', 'id', 'user_id'],
                        colModel:[
                            { name: 'name', index: 'name', width: '40%', search: true },
                            { name: 'display_name', index: 'display_name', width: '40%', search: true },
                            { name: 'id', hidden: true },
                            { name: 'user_id', hidden: true }
                        ],
                        //sortname: 'id',
                        //sortorder: 'desc',  
                        caption: "Windows",
                        autowidth: true,
                        shinkToFit: false,
                        forcefit: true,

                        //rowNum: 0,
                        rowList:[10,20,30],
                        scrollrows: true,
                        viewrecords: true,

                        toolbar: [true, 'top']

                    }, // end of config

                    // Initialize Data
                    data: []
                } // end of grid

            }
        }
    ]);

    app.controller('WindowsController',
    [
        '$scope',
        '$timeout',
        '$stateParams',
        '$templateCache',
        'windowsFactory',
        'commonService',
        'modalService',
        'gritterService',
        'focusService',
        'windowsModel',
        'gridService',
        'GLOBAL',
        
        function($scope, $timeout, $stateParams, $templateCache, Win, Common, Modal, Gritter, Focus, windowsModel, Grid, GLOBAL) {
            var init = function() {
                var modalTemplatePath = 'windows/modal/windows-modal.html?version=' + GLOBAL.version;

                $scope.grid = angular.copy(Win.grid);

                $scope.templates = {
                    office: GLOBAL.baseModulePath + modalTemplatePath
                };

                var t = $timeout(function() {
                    Grid.setModalController('WindowsModalController').setModalTemplate('windows-modal.html').setModalTemplatePath(modalTemplatePath).setModalName('windows');
                    Grid.setJqGrid($scope.jqGrid).setGrid($scope.grid).setModel(windowsModel);

                    $scope.refresh = Grid.refresh;

                    /* Load the Grid with Data */
                    $scope.refresh();

                    /* Attempt to Add Record to Grid, opens a Modal */
                    $scope.add = Grid.add;

                    /* Edit Record in Grid and update the database */
                    $scope.edit = Grid.edit;

                    /* Delete Record in Grid and delete it in the database */
                    $scope.delete = Grid.delete;

                    $timeout.cancel(t);
                });
                
                var destroy = function() {};
                        
                Common.destroy($scope, destroy);

                $scope.$on('$stateChangeStart', 
                    function(event, toState, toParams, fromState, fromParams) {}
                );
            } // end of init
            // Start the Controller
            Common.init($scope, init);

            Focus.on('#gbox_windows input[name=grid_search]');
        }
    ]);


}); 