define(['app'], function(app)
{
    app.factory('profileFactory',
    [
        'Restangular',

        function(Restangular) {
            return {
                getAll: function() {

                    return Restangular.all('office');
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
                        _gridId: 'office',
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
                        colNames:['Office Name', 'Office Address', 'id'],
                        colModel:[
                            { name: 'office_name', index: 'office_name', width: '40%', search: true },
                            { name: 'office_address', width: '60%', search: true },
                            { name: 'id', hidden: true }
                        ],
                        //sortname: 'id',
                        //sortorder: 'desc',  
                        caption: "Offices",
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