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
                select: {
                    rows: {
                        _: "%d rows Selected",
                        0: "Click a row to select it",
                        1: "1 row Selected"
                    }
                }
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
            buttons: [{
                extend: 'selectAll',
                className: 'btn bg-indigo-800'
            }, {
                extend: 'selectNone',
                className: 'btn bg-blue-800',
                text: 'Unselect All'
            }, {
                extend: 'selected',
                className: 'btn btn-danger',
                text: 'Delete',
                action: function(e, dt, node, config) {
                    datatableSelectedRowsAction(dt, 'cases/action', action = 'delete', msg = 'Once deleted, it will deleted all related Data!');
                }
            }],
            select: true,
            columnDefs: [{
                width: "100px",
                targets: [0, 4]
            }, {
                orderable: false,
                targets: [ 4]
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
                    data: 'title',
                    name: 'title'
                },{
                    data: 'case_no',
                    name: 'case_no'
                },{
                    data: 'client',
                    name: 'client'
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
                    _componentCaseCategorySelect2();
                    _componentDatePicker('up');
                    _componentClientSelect2();
                    _componentClientCategorySelect2();
                    _componentCaseStageSelect2();
                    _componentActSelect2();
                    _componentCourtCategorySelect2();
                    _componentCourtSelect2();

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

  $(document).on('submit','.case', function(e){
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
        var formData = new FormData($(this)[0]);
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function(data) {
                new PNotify({
                    title: 'Well Done!',
                    text: data.message,
                    type: 'success',
                    addclass: 'alert alert-styled-left',
                });
                $('#submit').show();
                $('#submiting').hide();
               if (data.goto) {
                   setTimeout(function(){

                     window.location.href=data.goto;
                   },2500);
                }
            },
            error: function(data) {
                var jsonValue = data.responseJSON;
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function(key, value) {
                        const first_item = Object.keys(errors)[i];
                        const message = errors[first_item][0];
                        if ($('#' + first_item).length > 0) {
                            $('#' + first_item).parsley().removeError('required', {
                                updateClass: true
                            });
                            $('#' + first_item).parsley().addError('required', {
                                message: value,
                                updateClass: true
                            });
                        }

                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        new PNotify({
                            width: '30%',
                            title: jsUcfirst(first_item) + ' Error!!',
                            text: value,
                            type: 'error',
                            addclass: 'alert alert-danger alert-styled-left',
                        });
                        i++;
                    });
                } else {
                    new PNotify({
                        width: '30%',
                        title: 'Something Wrong!',
                        text: jsonValue.message,
                        type: 'error',
                        addclass: 'alert alert-danger alert-styled-left',
                    });
                }
                $('#submit').show();
                $('#submiting').hide();
            }
        });
    });
