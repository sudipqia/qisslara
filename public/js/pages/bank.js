var tariq = '';
var DatatableButtonsHtml5 = function() {
    var _componentDatatableButtonsHtml5 = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }
        $(document).on('search.dt', function(e, settings) {
            cardBlock();
        });
        $(document).on('change', 'page.dt', function(e, settings) {
            cardBlock();
        });
        $(document).on('change', 'preInit.dt', function(e, settings) {
            cardBlock();
        });
        $(document).on('change', 'order.dt', function(e, settings) {
            cardBlock()
        });
        $(document).on('change', 'preInit.dt', function(e, settings) {
            cardBlock();
        });
        // Setting datatable defaults
        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            responsive: true,
            dom: '<"dt-buttons-full"B><"datatable-header"fl><"datatable-wrap"t><"datatable-footer"ip>',
            // dom: '<"datatable-header"fBl><"datatable-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                lengthMenu: '<span>Show:</span> _MENU_',
                loadingRecords: "Getting records...",
                paginate: {
                    'first': 'First',
                    'last': 'Last',
                    'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                    'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                },
            }
        });
        // Basic initialization
        tariq = $('.content_managment_table').DataTable({
            fnDrawCallback: function(oSettings) {
                dataTableReload();
            },
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [{
                width: "100px",
                targets: [0, 3]
            }, {
                orderable: false,
                targets: [ 3]
            }],
            order: [0, 'desc'],
            processing: true,
            serverSide: true,
            ajax: $('.content_managment_table').data('url'),
            columns: [
                // { data: 'checkbox', name: 'checkbox' },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },{
                    data: 'account_name',
                    name: 'account_name'
                },{
                    data: 'opening_balance',
                    name: 'opening_balance'
                },
                {
                    data: 'note',
                    name: 'note'
                },
                 {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
    };

    var _componentRemoteModalLoad = function() {
        $(document).on('click', '#content_managment', function(e) {
            e.preventDefault();
            //open modal
            $('#modal_remote').modal('toggle');
            // it will get action url
            var url = $(this).data('url');
            // leave it blank before ajax call
            $('.modal-body').html('');
            // load ajax loader
            $('#modal-loader').show();
            $.ajax({
                    url: url,
                    type: 'Get',
                    dataType: 'html'
                })
                .done(function(data) {
                    $('.modal-body').html(data).fadeIn(); // load response
                    $('#modal-loader').hide();
                    $('#branch_no').focus();
                    _componentInputSwitchery();
                    _modalFormValidation();
                    _componentSelect2Modal();
                    _componentDivisionSelect2();
                    _componentDistrictSelect2();
                    _componentDatePicker();

                })
                .fail(function(data) {
                    $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                    $('#modal-loader').hide();
                });
        });
    };
    return {
        init: function() {
            _componentDatatableButtonsHtml5();
            _componentSelect2Normal();
            _componentRemoteModalLoad();
            _componentAjaxCourtLoad();
            _formValidation();
            _classformValidation();
        }
    }
}();
// Initialize module
// ------------------------------
document.addEventListener('DOMContentLoaded', function() {
    DatatableButtonsHtml5.init();
});