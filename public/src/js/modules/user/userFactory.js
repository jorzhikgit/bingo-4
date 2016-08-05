define(['app'], function(app)
{
    app.factory('userFactory',
    [
        'Restangular',

        function(Restangular) {
            return {
                getAll: function() {

                    return Restangular.all('user');
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
                        _gridId: 'user-grid',
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
                        colNames:['User Name', 'Display Name', 'Access Level', 'Status', 'id'],
                        colModel:[
                            { name: 'username', index: 'username', width: '35%', search: true },
                            { name: 'display_name', index: 'display_name', width: '50%', search: true },
                            { name: 'access_level', width:"10%", sortable: true, align: 'right' },
                            { name: 'status', width:"5%", sortable: true, formatter: 'checkbox', align: 'center' },
                            { name: 'id', hidden: true }
                        ],
                        //sortname: 'id',
                        //sortorder: 'desc',  
                        caption: "Users",
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
});