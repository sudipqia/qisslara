/*
 * Form Checkbox Uniform 
 */
// $('.select').select2();
var _componentUniform = function() {
    if (!$().uniform) {
        console.warn('Warning - uniform.min.js is not loaded.');
        return;
    }
    $('.form-input-styled').uniform();
};

/*
 * Tooltip Custom Color
 */

var _componentTooltipCustomColor = function() {
    $('[data-popup=tooltip-custom]').tooltip({
        template: '<div class="tooltip"><div class="arrow border-teal"></div><div class="tooltip-inner bg-teal"></div></div>'
    });
};

/*
 * Form Datepicker Uniform 
 */

//datepicker setting
$('.pickadate-accessibility').pickadate({
    labelMonthNext: 'Go to the next month',
    labelMonthPrev: 'Go to the previous month',
    labelMonthSelect: 'Pick a month from the dropdown',
    labelYearSelect: 'Pick a year from the dropdown',
    selectMonths: true,
    selectYears: true,
    format: 'mm-dd-yyyy',
    formatSubmit: undefined,
    hiddenPrefix: undefined,
    hiddenSuffix: '_submit',
    hiddenName: undefined,
});


var _componentDatePicker = function(drops = 'down') {
    var locatDate = moment.utc().format('YYYY-MM-DD');
    var stillUtc = moment.utc(locatDate).toDate();
    var year = parseInt(moment(stillUtc).local().format('YYYY')) + 2;
    $('.date').attr('readonly', true);
    // console.log(local);
    $('.date').daterangepicker({
        "applyClass": 'bg-slate-600',
        "cancelClass": 'btn-light',
        "singleDatePicker": true,
        "locale": {
            "format": 'YYYY-MM-DD'
        },
        "drops" : drops,
        "showDropdowns": true,
        "minYear": 1900,
        "maxYear": year,
        "timePicker": false,
        "alwaysShowCalendars": true,
    });
};

/*
 * Form Select 2 For Modal 
 */

var _componentSelect2Modal = function() {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }

    $('.select').select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
    });

    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        dropdownAutoWidth: true,
        width: 'auto'
    });
};

var _componentSelect2SelectModal = function() {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }

    $('#select_form .select').select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
    });
};

/*
 * Form Select2
 */
var _componentSelect2Normal = function() {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }

    $('.select').select2({
        dropdownAutoWidth: true,
    });

    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        dropdownAutoWidth: true,
        width: 'auto'
    });
};

/*
 * For Switchery for Datatable Status 
 */

var _componentStatusSwitchery = function() {
    if (typeof Switchery == 'undefined') {
        console.warn('Warning - switchery.min.js is not loaded.');
        return;
    }

    var elems = Array.prototype.slice.call(document.querySelectorAll('.form-check-status-switchery'));

    if (elems.length > 0) {
        elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });
    }
};

/*
 * For Switchery input field
 */

var _componentInputSwitchery = function() {
    if (typeof Switchery == 'undefined') {
        console.warn('Warning - switchery.min.js is not loaded.');
        return;
    }

    var input_elems = Array.prototype.slice.call(document.querySelectorAll('.form-check-input-switchery'));
    if (input_elems.length > 0) {
        input_elems.forEach(function(html) {
            var switchery = new Switchery(html);
        });
    }
};

/*
 * Form Validation
 */

var _formValidation = function() {
    if ($('#content_form').length > 0) {
        $('#content_form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
    }

    $('#content_form').on('submit', function(e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
        var submit_url = $('#content_form').attr('action');
        //Start Ajax
        var formData = new FormData($("#content_form")[0]);
        $.ajax({
            url: submit_url,
            type: 'POST',
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function(data) {
                if (data.status == 'danger') {
                    new PNotify({
                        title: 'Error',
                        text: data.message,
                        type: 'error',
                        addclass: 'alert alert-danger alert-styled-left',
                    });

                } else {
                    new PNotify({
                        title: 'Success',
                        text: data.message,
                        type: 'success',
                        addclass: 'alert alert-styled-left',
                    });
                    $('#submit').show();
                    $('#submiting').hide();
                    if (data.goto) {
                        setTimeout(function() {

                            window.location.href = data.goto;
                        }, 2500);
                    }
                    if (data.window) {
                        window.open(data.window, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=auto,left=auto,width=700,height=400");
                        setTimeout(function() {
                            window.location.href = '';
                        }, 1000);
                    }
                }
            },
            error: function(data) {
                var jsonValue = $.parseJSON(data.responseText);
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function(key, value) {
                        const first_item = Object.keys(errors)[i]
                        const message = errors[first_item][0];
                        $('#' + first_item).parsley().removeError('required', {
                            updateClass: true
                        });
                        $('#' + first_item).parsley().addError('required', {
                            message: value,
                            updateClass: true
                        });
                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        new PNotify({
                            title: 'Error',
                            text: value,
                            type: 'error',
                            addclass: 'alert alert-danger alert-styled-left',
                        });
                        i++;
                    });
                } else {
                    new PNotify({
                        title: 'Something Wrong!',
                        text: jsonValue.message,
                        type: 'error',
                        addclass: 'alert alert-danger alert-styled-left',
                    });
                }
                _componentSelect2Normal();
                $('#submit').show();
                $('#submiting').hide();
            }
        });
    });
};


//class

var _classformValidation = function() {
    if ($('.ajax_form').length > 0) {
        $('.ajax_form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
    }

    $('.ajax_form').on('submit', function(e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
        var submit_url = $('.ajax_form').attr('action');
        //Start Ajax
        var formData = new FormData($(".ajax_form")[0]);
        $.ajax({
            url: submit_url,
            type: 'POST',
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function(data) {
                if (data.status == 'danger') {
                    new PNotify({
                        title: 'Error',
                        text: data.message,
                        type: 'error',
                        addclass: 'alert alert-danger alert-styled-left',
                    });

                } else {
                    new PNotify({
                        title: 'Success',
                        text: data.message,
                        type: 'success',
                        addclass: 'alert alert-styled-left',
                    });
                    $('#submit').show();
                    $('#submiting').hide();
                    if (data.goto) {
                        setTimeout(function() {

                            window.location.href = data.goto;
                        }, 2500);
                    }
                    if (data.window) {
                        window.open(data.window, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=auto,left=auto,width=700,height=400");
                        setTimeout(function() {
                            window.location.href = '';
                        }, 1000);
                    }
                }
            },
            error: function(data) {
                var jsonValue = $.parseJSON(data.responseText);
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function(key, value) {
                        const first_item = Object.keys(errors)[i]
                        const message = errors[first_item][0];
                        $('#' + first_item).parsley().removeError('required', {
                            updateClass: true
                        });
                        $('#' + first_item).parsley().addError('required', {
                            message: value,
                            updateClass: true
                        });
                        // $('#' + first_item).after('<div class="ajax_error" style="color:red">' + value + '</div');
                        new PNotify({
                            title: 'Error',
                            text: value,
                            type: 'error',
                            addclass: 'alert alert-danger alert-styled-left',
                        });
                        i++;
                    });
                } else {
                    new PNotify({
                        title: 'Something Wrong!',
                        text: jsonValue.message,
                        type: 'error',
                        addclass: 'alert alert-danger alert-styled-left',
                    });
                }
                _componentSelect2Normal();
                $('#submit').show();
                $('#submiting').hide();
            }
        });
    });
};
/*
 * Form Validation For Modal
 */

var _modalFormValidation = function() {
    if ($('#content_form').length > 0) {
        $('#content_form').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
        });
    }
    $('#content_form').on('submit', function(e) {
        e.preventDefault();
        $('#submit').hide();
        $('#submiting').show();
        $(".ajax_error").remove();
        var submit_url = $('#content_form').attr('action');
        //Start Ajax
        var formData = new FormData($("#content_form")[0]);
        $.ajax({
            url: submit_url,
            type: 'POST',
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function(data) {
                if (data.status == 'danger') {
                    new PNotify({
                        title: 'Error',
                        text: data.message,
                        type: 'error',
                        addclass: 'alert alert-danger alert-styled-left',
                    });

                } else {
                    new PNotify({
                        title: 'Well Done!',
                        text: data.message,
                        type: 'success',
                        addclass: 'alert alert-styled-left',
                    });
                    $('#submit').show();
                    $('#submiting').hide();
                    $('#modal_remote').modal('toggle');
                    if (data.goto) {
                        setTimeout(function() {

                            window.location.href = data.goto;
                        }, 2500);
                    }
                    if (typeof(tariq) != "undefined" && tariq !== null) {
                        tariq.ajax.reload(null, false);
                    }
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
};


$(document).ready(function() {
    /*
     * For Logout
     */
    $(document).on('click', '#logout', function(e) {
        e.preventDefault();
        $('.preloader').show('fade');
        var url = $(this).data('url');
        $.ajax({
            url: url,
            method: 'Post',
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
                new Noty({
                    theme: 'limitless',
                    timeout: 2000,
                    title: 'Welcome',
                    text: 'Be Patient. We are redirecting you to your destination.',
                    type: 'success',
                    modal: true,
                    layout: 'center'
                }).show();
                setTimeout(function() {
                    window.location.href = data.goto;
                }, 2000);
            },
            error: function(data) {
                var jsonValue = $.parseJSON(data.responseText);
                const errors = jsonValue.errors
                var i = 0;
                $.each(errors, function(key, value) {
                    new PNotify({
                        title: 'Something Wrong!',
                        text: value,
                        type: 'error',
                        addclass: 'alert  alert-danger alert-styled-left',
                    });
                    i++;
                });
            }
        });
    });


    /*
     * For Delete Item
     */
    $(document).on('click', '#delete_item', function(e) {
        e.preventDefault();
        var row = $(this).data('id');
        var url = $(this).data('url');
        $('#action_menu_' + row).hide();
        $('#delete_loading_' + row).show();
        //console.log(row, url);
        swal({
                title: "Are you sure?",
                text: "Once deleted, it will deleted all related Data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        method: 'Delete',
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
                            tariq.ajax.reload();
                            if (data.goto) {
                                setTimeout(function() {
                                    window.location.href = data.goto;
                                }, 2500);
                            }

                            if (data.load) {
                                setTimeout(function() {

                                    window.location.href = "";
                                }, 2500);
                            }



                            $('#delete_loading_' + row).hide();
                            $('#action_menu_' + row).show();
                        },
                        error: function(data) {
                            var jsonValue = $.parseJSON(data.responseText);
                            const errors = jsonValue.errors
                            var i = 0;
                            $.each(errors, function(key, value) {
                                new PNotify({
                                    title: 'Error',
                                    text: value,
                                    type: 'error',
                                    addclass: 'alert alert-danger alert-styled-left',
                                });
                                i++;
                            });
                            $('#delete_loading_' + row).hide();
                            $('#action_menu_' + row).show();
                        }
                    });
                } else {
                    $('#delete_loading_' + row).hide();
                    $('#action_menu_' + row).show();
                }
            });
    });

    $(document).on('click', '#click_update', function(e) {
        e.preventDefault();
        var row = $(this).data('id');
        var url = $(this).data('url');
        $('#action_menu_' + row).hide();
        $('#delete_loading_' + row).show();
        //console.log(row, url);
        swal({
                title: "Are you sure?",
                text: "You Will Change IT!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        method: 'Put',
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
                            tariq.ajax.reload();
                            if (data.goto) {
                                setTimeout(function() {

                                    window.location.href = data.goto;
                                }, 2500);
                            }

                            if (data.load) {
                                setTimeout(function() {

                                    window.location.href = "";
                                }, 2500);
                            }
                            $('#delete_loading_' + row).hide();
                            $('#action_menu_' + row).show();
                        },
                        error: function(data) {
                            var jsonValue = $.parseJSON(data.responseText);
                            const errors = jsonValue.errors
                            var i = 0;
                            $.each(errors, function(key, value) {
                                new PNotify({
                                    title: 'Error',
                                    text: value,
                                    type: 'error',
                                    addclass: 'alert alert-danger alert-styled-left',
                                });
                                i++;
                            });
                            $('#delete_loading_' + row).hide();
                            $('#action_menu_' + row).show();
                        }
                    });
                } else {
                    $('#delete_loading_' + row).hide();
                    $('#action_menu_' + row).show();
                }
            });
    });

    /*
     * For Status Change
     */
    $(document).on('click', '#change_status', function(e) {
        e.preventDefault();
        var row = $(this).data('id');
        var url = $(this).data('url');
        var status = $(this).data('status');
        if (status == 1) {
            msg = 'Change Status Form Online To Offline';
        } else {
            msg = 'Change Status Form Offline To Online';
        }
        $('#status_' + row).hide();
        $('#status_loading_' + row).show();
        swal({
                title: "Are you sure?",
                text: msg,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        method: 'Put',
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
                            if (typeof(tariq) != "undefined" && tariq !== null) {
                                tariq.ajax.reload(null, false);
                            }
                        },
                        error: function(data) {
                            var jsonValue = $.parseJSON(data.responseText);
                            const errors = jsonValue.errors
                            if (errors) {
                                var i = 0;
                                $.each(errors, function(key, value) {
                                    new PNotify({
                                        title: 'Something Wrong!',
                                        text: value,
                                        type: 'error',
                                        addclass: 'alert alert-danger alert-styled-left',
                                    });
                                    i++;
                                });
                            } else {
                                new PNotify({
                                    title: 'Something Wrong!',
                                    text: jsonValue.message,
                                    type: 'error',
                                    addclass: 'alert alert-styled-left',
                                });
                            }
                            $('#status_loading_' + row).hide();
                            $('#status_' + row).show();
                        }
                    });
                } else {
                    $('#status_loading_' + row).hide();
                    $('#status_' + row).show();
                }
            });
    });

    /*
     * For Datatabel Reload
     */
    $(document).on('click', '#reload', function() {
        if (typeof(tariq) != "undefined" && tariq !== null) {
            tariq.ajax.reload(null, false);
        }
    });


    /*
     * For Date Picker
     */
    var locatDate = moment.utc().format('YYYY-MM-DD');
    var stillUtc = moment.utc(locatDate).toDate();
    var year = parseInt(moment(stillUtc).local().format('YYYY')) + 2;
    $('.date').attr('readonly', true);
    // console.log(local);
    $('.date').daterangepicker({
        "applyClass": 'bg-slate-600',
        "cancelClass": 'btn-light',
        "singleDatePicker": true,
        "locale": {
            "format": 'YYYY-MM-DD'
        },
        "showDropdowns": true,
        "minYear": 1900,
        "maxYear": year,
        "timePicker": false,
        "alwaysShowCalendars": true,
    });
});


/*
 * For Uppercase Word first Letter
 */
function jsUcfirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}


/*
 * For Card Block
 */
function cardBlock() {
    var $target = $('#table_card'),
        block = $target.closest('.card');

    // Block card
    $(block).block({
        message: '<i class="icon-spinner2 spinner"></i>',
        overlayCSS: {
            backgroundColor: '#fff',
            opaupozila: 0.8,
            cursor: 'wait',
            'box-shadow': '0 0 0 1px #ddd'
        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: 'none'
        }
    });
}


/*
 * For Unblock Card
 */
function cardUnBlock() {
    var $target = $('#table_card'),
        block = $target.closest('.card');
    $(block).unblock();
}



/*
 * For Datatable Reload
 */
function dataTableReload() {
    cardBlock();
    $('.switchery').remove();
    _componentStatusSwitchery();
    _componentTooltipCustomColor();
    cardUnBlock();
}


/*
 * For Datatable Load
 */
function dataTableLoad() {
    $('.switchery').remove();
    _componentStatusSwitchery();
    _componentTooltipCustomColor();
    cardUnBlock();
}



/*
 * For Get Data Table Selected Rows Id
 */
function getDatatableSelectedRowIds(dt) {
    var ids = [];
    var rows = dt.rows('.selected').data();
    $.each(rows, function(index, value) {
        ids.push(value['id']);
    });
    return ids;
}


/*
 * For Perform Datatable Controles Button
 */
function datatableSelectedRowsAction(dt, url, action = 'delete', msg = 'Are You Sure') {
    var ids = getDatatableSelectedRowIds(dt);
    var url = Base_url_admin + url;
    swal({
            title: "Are you sure?",
            text: msg,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                cardBlock();
                $.ajax({
                    url: url,
                    method: 'Put',
                    data: {
                        action: action,
                        ids: ids
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        new PNotify({
                            title: 'Well Done!',
                            text: data.message,
                            type: 'success',
                            addclass: 'alert alert-styled-left',
                        });
                        tariq.ajax.reload(null, false);
                    },
                    error: function(data) {
                        //console.log(data)
                        var jsonValue = $.parseJSON(data.responseText);
                        const errors = jsonValue.errors
                        if (errors) {
                            var i = 0;
                            $.each(errors, function(key, value) {
                                new PNotify({
                                    title: 'Something Wrong!',
                                    text: value,
                                    type: 'error',
                                    addclass: 'alert alert-danger alert-styled-left',
                                });
                                i++;
                            });
                        } else {
                            new PNotify({
                                title: 'Something Wrong!',
                                text: jsonValue.message,
                                type: 'error',
                                addclass: 'alert alert-danger alert-styled-left',
                            });
                        }
                    }
                });
                dt.ajax.reload(null, false);
            }
        });
}


var _componentDivisionSelect2 = function(id = '#content_form', select_id = '#division') {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link add_new_customer" data-form_id="' + id + '"  id="add_new_division" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Division </button>'
                    );
                } else {
                    return 'No Division Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};

var _componentDistrictSelect2 = function(id = '#content_form', select_id = '#district') {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link add_new_customer" data-form_id="' + id + '" id="add_new_district" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New District </button>'
                    );
                } else {
                    return 'No District Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};

var _componentUpozilaSelect2 = function(id = '#content_form', select_id = '#upozila') {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_upozila" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Upozila </button>'
                    );
                } else {
                    return 'No Upozila Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_upozila', function() {
    var form_id = $(this).data('form_id');
    $('#division').select2('close');
    $('#district').select2('close');
    $('#upozila').select2('close');
    $('#content_form').hide();
    $('#modal-loader').show();
    var name = $(this).data('name');
    var division = $('select#division').val();
    var district = $('select#district').val();
    if (!division) {
        swal({
                title: "Opps?",
                text: 'Select A Division First To Add Upozila',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    if ($('#division > option').length > 1) {
                        $('#modal-loader').hide();
                        $('#content_form').show();
                    } else {
                        $.ajax({
                                url: Base_url_admin + 'configuration/master/create?form_id=select_form',
                                type: 'Get',
                                dataType: 'html'
                            })
                            .done(function(data) {
                                $('.modal-body').append(data).fadeIn(); // load response
                                $('#modal-loader').hide();
                                $('#select_form #name').focus();
                                // _componentSelect2Modal();
                                _modalSelectFormValidation();
                            })
                            .fail(function(data) {
                                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                                $('#modal-loader').hide();
                            });
                    }
                } else {
                    $('#modal-loader').hide();
                    $('#content_form').show();
                }
            });
    } else if (!district) {
        swal({
                title: "Opps?",
                text: 'Select A District First To Add Upozila',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    if ($('#district > option').length > 1) {
                        $('#modal-loader').hide();
                        $('#content_form').show();
                    } else {
                        $.ajax({
                                url: Base_url_admin + 'configuration/master/district/create?name=' + name + '&form_id=select_form&division=' + division,
                                type: 'Get',
                                dataType: 'html'
                            })
                            .done(function(data) {
                                $('.modal-body').append(data).fadeIn(); // load response
                                $('#modal-loader').hide();
                                $('#select_form #name').focus();
                                // _componentSelect2Modal();
                                _componentDivisionSelect2('#select_form');
                                _modalSelectFormValidation();
                            })
                            .fail(function(data) {
                                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                                $('#modal-loader').hide();
                            });
                    }
                } else {
                    $('#modal-loader').hide();
                    $('#content_form').show();
                }
            });
    } else {
        $.ajax({
                url: Base_url_admin + 'configuration/master/upozila/create?name=' + name + '&form_id=select_form&division=' + division + '&district=' + district,
                type: 'Get',
                dataType: 'html'
            })
            .done(function(data) {
                $('.modal-body').append(data).fadeIn(); // load response
                $('#modal-loader').hide();
                _componentDivisionSelect2('#select_form');
                _componentDistrictSelect2('#select_form');
                _modalSelectFormValidation();
            })
            .fail(function(data) {
                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                $('#modal-loader').hide();
            });
    }
});
$(document).on('click', '#add_new_district', function() {
    var form_id = $(this).data('form_id');
    $('#district').select2('close');
    $('#content_form').hide();
    $('#modal-loader').show();
    var name = $(this).data('name');
    var division = $('select#division').val();
    if (!division) {
        swal({
                title: "Opps?",
                text: 'Select A Division First To Add district',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    if ($('#division > option').length > 1) {
                        $('#modal-loader').hide();
                        $('#content_form').show();
                    } else {
                        $.ajax({
                                url: Base_url_admin + 'configuration/master/create?form_id=select_form',
                                type: 'Get',
                                dataType: 'html'
                            })
                            .done(function(data) {
                                $('.modal-body').append(data).fadeIn(); // load response
                                $('#modal-loader').hide();
                                $('#select_form #name').focus();
                                // _componentSelect2Modal();
                                _modalSelectFormValidation();
                            })
                            .fail(function(data) {
                                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                                $('#modal-loader').hide();
                            });
                    }
                } else {
                    $('#modal-loader').hide();
                    $('#content_form').show();
                }
            });
    } else {
        $.ajax({
                url: Base_url_admin + 'configuration/master/district/create?name=' + name + '&form_id=select_form&division=' + division,
                type: 'Get',
                dataType: 'html'
            })
            .done(function(data) {
                $('.modal-body').append(data).fadeIn(); // load response
                $('#modal-loader').hide();
                _componentDivisionSelect2('#select_form');
                _modalSelectFormValidation();
            })
            .fail(function(data) {
                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                $('#modal-loader').hide();
            });
    }
});
$(document).on('click', '#add_new_division', function() {
    var form_id = $(this).data('form_id');
    $(form_id + ' #division').select2('close');
    $('#content_form').hide();
    $('#select_form').remove();
    $('#modal-loader').show();
    var name = $(this).data('name');
    $.ajax({
            url: Base_url_admin + 'configuration/master/division/create?name=' + name + '&form_id=select_form',
            type: 'Get',
            dataType: 'html'
        })
        .done(function(data) {
            $('.modal-body').append(data).fadeIn(); // load response
            $('#modal-loader').hide();
            $('#select_form #sortname').focus();
            // _componentSelect2Modal();
            _modalSelectFormValidation();
        })
        .fail(function(data) {
            $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
            $('#modal-loader').hide();
        });
});

var _modalSelectFormValidation = function(multiple = false) {
    $('#select_form').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
    });
    $('#select_form').on('submit', function(e) {
        e.preventDefault();
        $('#select_form #submit').hide();
        $('#select_form #submiting').show();
        $("#select_form .ajax_error").remove();
        var target = $("#select_form #target").val();
        var submit_url = $('#select_form').attr('action');
        //Start Ajax
        var formData = new FormData($("#select_form")[0]);
        $.ajax({
            url: submit_url,
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
                $('select#' + target).append(
                    $('<option>', {
                        value: data.model.id,
                        text: data.model.name
                    })
                );
                if (multiple) {
                    var pre_val = $('select#' + target)
                    .val();
                   pre_val.push(data.model.id);
                    $('select#' + target)
                    .val(pre_val)
                    .trigger('change');
                } else{
                    $('select#' + target)
                    .val(data.model.id)
                    .trigger('change');
                }
                
                $('#content_form').show();
                $('#select_form').remove();
            },
            error: function(data) {
                var jsonValue = data.responseJSON;
                const errors = jsonValue.errors;
                if (errors) {
                    var i = 0;
                    $.each(errors, function(key, value) {
                        const first_item = Object.keys(errors)[i];
                        const message = errors[first_item][0];
                        if ($('#select_form #' + first_item).length > 0) {
                            $('#select_form #' + first_item).parsley().removeError('required', {
                                updateClass: true
                            });
                            $('#select_form #' + first_item).parsley().addError('required', {
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
                $('#select_form #submit').show();
                $('#select_form #submiting').hide();
            }
        });
    });
};

$(document).on('click', '#back_to_previous', function() {
    $('#select_form').remove();
    $('#content_form').show();
});

var _componentAjaxDistrictLoad = function(form_id = '#content_form', select_id = '#division', district_id = '#district') {
    $(document).on('change', select_id, function(e) {
        var content_id = form_id + ' ' + district_id;
        var division = $(this).val();
        $(content_id + '>option').remove();
        var district = $(form_id + ' select' + district_id);
        district.append(
            $('<option>', {
                value: '',
                text: 'Select Division'
            })
        );
        district.trigger('change');
        $.ajax({
                url: Base_url + '/api/select/district',
                type: 'post',
                data: {
                    division: division
                },
                dataType: 'json'
            })
            .done(function(data) {
                $.each(data, function(i, v) {
                    district.append(
                        $('<option>', {
                            value: v.id,
                            text: v.name
                        })
                    );
                })
                district.trigger('change');
            })
            .fail(function(data) {
                new PNotify({
                    title: 'Something Wrong!',
                    text: 'Check Again And Try Again',
                    type: 'error',
                    addclass: 'alert alert-danger alert-styled-left',
                });
            });
    });
};

var _componentAjaxCourtLoad = function(form_id = '#content_form', select_id = '#court_category', court_id = '#court') {
    $(document).on('change', select_id, function(e) {
        var content_id = form_id + ' ' + court_id;
        var category = $(this).val();
        $(content_id + '>option').remove();
        var court = $(form_id + ' select' + court_id);
        court.append(
            $('<option>', {
                value: '',
                text: 'Select Court'
            })
        );
        court.trigger('change');
        $.ajax({
                url: Base_url + '/api/select/court',
                type: 'post',
                data: {
                    category: category
                },
                dataType: 'json'
            })
            .done(function(data) {
                $.each(data, function(i, v) {
                    court.append(
                        $('<option>', {
                            value: v.id,
                            text: v.name
                        })
                    );
                })
                court.trigger('change');
            })
            .fail(function(data) {
                new PNotify({
                    title: 'Something Wrong!',
                    text: 'Check Again And Try Again',
                    type: 'error',
                    addclass: 'alert alert-danger alert-styled-left',
                });
            });
    });
};

var _componentAjaxUpozilaLoad = function(form_id = '#content_form') {
    $(document).on('change', '#district', function(e) {
        var district = $(this).val();
        var division = $(form_id + ' #division').val();
        $(form_id + ' #upozila>option').remove();
        var upozila = $(form_id + ' select#upozila');
        upozila.append(
            $('<option>', {
                value: '',
                text: 'Select District'
            })
        );
        upozila.trigger('change');
        $.ajax({
                url: Base_url + '/api/select/upozila',
                type: 'post',
                data: {
                    division: division,
                    district: district
                },
                dataType: 'json'
            })
            .done(function(data) {
                $.each(data, function(i, v) {
                    upozila.append(
                        $('<option>', {
                            value: v.id,
                            text: v.name
                        })
                    );
                })
                upozila.trigger('change');
            });
    });
};

function p_notify(msg = 'Something Wrong', type = 'error', title = "Opps!!") {
    new PNotify({
        title: title,
        text: msg,
        type: type,
        addclass: 'alert alert-styled-left',
    });
}

function noty(msg = 'Something Wrong', type = 'error', title = "Opps!!", layout = 'topRight') {
    new Noty({
        theme: 'limitless',
        timeout: 2000,
        title: title,
        text: msg,
        type: type,
        modal: true,
        layout: 'center'
    }).show();
}



var _componentCaseCategorySelect2 = function(id = '#content_form', select_id = '#case_category') {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;

    $(content_id).select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
        language: {
            noResults: function() {
                var name = $(content_id).parent().find('.select2-search__field').val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_case_category" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Case Category </button>'
                    );
                } else {
                    return 'No Case Category Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });


};
$(document).on('click', '#add_new_case_category', function() {
    var form_id = $(this).data('form_id');
    $('#case_category').select2('close');
    $('#content_form').hide();
    $('#modal-loader').show();
    var name = $(this).data('name');

    $.ajax({
            url: Base_url_admin + 'configuration/category/case/create?name=' + name + '&form_id=select_form',
            type: 'Get',
            dataType: 'html'
        })
        .done(function(data) {
            $('.modal-body').append(data).fadeIn(); // load response
            $('#modal-loader').hide();
            _modalSelectFormValidation(true);
        })
        .fail(function(data) {
            $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
            $('#modal-loader').hide();
        });
});

var _componentClientSelect2 = function(id = '#content_form', select_id = '#client') {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_client" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Client </button>'
                    );
                } else {
                    return 'No Client Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_client', function() {
    var form_id = $(this).data('form_id');
    $('#client').select2('close');
    $('#content_form').hide();
    $('#modal-loader').show();
    var name = $(this).data('name');
   
    
        $.ajax({
                url: Base_url_admin + 'client/create?name=' + name + '&form_id=select_form',
                type: 'Get',
                dataType: 'html'
            })
            .done(function(data) {
                $('.modal-body').append(data).fadeIn(); // load response
                $('#modal-loader').hide();
                _modalSelectFormValidation();
            })
            .fail(function(data) {
                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                $('#modal-loader').hide();
            });
});


var _componentClientCategorySelect2 = function(id = '#content_form', select_id = '#client_category') {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_client_category" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Client Category </button>'
                    );
                } else {
                    return 'No Client Category Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_client_category', function() {
    var form_id = $(this).data('form_id');
    $('#client_category').select2('close');
    $('#content_form').hide();
    $('#modal-loader').show();
    var name = $(this).data('name');
   
    
        $.ajax({
                url: Base_url_admin + 'configuration/category/client/create?name=' + name + '&form_id=select_form',
                type: 'Get',
                dataType: 'html'
            })
            .done(function(data) {
                $('.modal-body').append(data).fadeIn(); // load response
                $('#modal-loader').hide();
                _modalSelectFormValidation();
            })
            .fail(function(data) {
                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                $('#modal-loader').hide();
            });
});

var _componentCaseStageSelect2 = function(id = '#content_form', select_id = '#case_stage') {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_case_stage" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Case Stage</button>'
                    );
                } else {
                    return 'No Case Stage Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_case_stage', function() {
    var form_id = $(this).data('form_id');
    $('#case_stage').select2('close');
    $('#content_form').hide();
    $('#modal-loader').show();
    var name = $(this).data('name');
   
    
        $.ajax({
                url: Base_url_admin + 'configuration/master/case_stage/create?name=' + name + '&form_id=select_form',
                type: 'Get',
                dataType: 'html'
            })
            .done(function(data) {
                $('.modal-body').append(data).fadeIn(); // load response
                $('#modal-loader').hide();
                _modalSelectFormValidation();
            })
            .fail(function(data) {
                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                $('#modal-loader').hide();
            });
});

var _componentActSelect2 = function(id = '#content_form', select_id = '#act') {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;

    $(content_id).select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
        language: {
            noResults: function() {
                var name = $(content_id).parent().find('.select2-search__field').val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_act" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Act </button>'
                    );
                } else {
                    return 'No Act Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });


};
$(document).on('click', '#add_new_act', function() {
    var form_id = $(this).data('form_id');
    $('#act').select2('close');
    $('#content_form').hide();
    $('#modal-loader').show();
    var name = $(this).data('name');

    $.ajax({
            url: Base_url_admin + 'configuration/master/act/create?name=' + name + '&form_id=select_form',
            type: 'Get',
            dataType: 'html'
        })
        .done(function(data) {
            $('.modal-body').append(data).fadeIn(); // load response
            $('#modal-loader').hide();
            _modalSelectFormValidation(true);
        })
        .fail(function(data) {
            $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
            $('#modal-loader').hide();
        });
});

var _componentCourtCategorySelect2 = function(id = '#content_form', select_id = '#court_category') {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link " data-form_id="' + id + '" id="add_new_court_category" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Court Category</button>'
                    );
                } else {
                    return 'No Court Category Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_court_category', function() {
    var form_id = $(this).data('form_id');
    $('#court_category').select2('close');
    $('#content_form').hide();
    $('#modal-loader').show();
    var name = $(this).data('name');
   
    
        $.ajax({
                url: Base_url_admin + 'configuration/category/court/create?name=' + name + '&form_id=select_form',
                type: 'Get',
                dataType: 'html'
            })
            .done(function(data) {
                $('.modal-body').append(data).fadeIn(); // load response
                $('#modal-loader').hide();
                _modalSelectFormValidation();
            })
            .fail(function(data) {
                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                $('#modal-loader').hide();
            });
});

var _componentCourtSelect2 = function(id = '#content_form', select_id = '#court') {
    if (!$().select2) {
        console.warn('Warning - select2.min.js is not loaded.');
        return;
    }
    var content_id = id + ' ' + select_id;
    $(content_id).select2({
        dropdownAutoWidth: true,
        dropdownParent: $("#modal_remote .modal-content"),
        language: {
            noResults: function() {
                var name = $(content_id)
                    .data('select2')
                    .dropdown.$search.val();
                if (name) {
                    return (
                        '<button type="button" data-name="' +
                        name +
                        '" class="btn btn-link add_new_customer" data-form_id="' + id + '" id="add_new_court" ><i class="icon-plus-circle2" aria-hidden="true"></i>&nbsp;Add "' + name + '" As A New Court </button>'
                    );
                } else {
                    return 'No Court Found';
                }

            },
        },
        escapeMarkup: function(markup) {
            return markup;
        },
    });
};
$(document).on('click', '#add_new_court', function() {
    var form_id = $(this).data('form_id');
    $('#court').select2('close');
    $('#content_form').hide();
    $('#modal-loader').show();
    var name = $(this).data('name');
    var court_category = $('select#court_category').val();
    if (!court_category) {
        swal({
                title: "Opps?",
                text: 'Select A Court Category First To Add Court',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    if ($('#court_category > option').length > 1) {
                        $('#modal-loader').hide();
                        $('#content_form').show();
                    } else {
                        $.ajax({
                                url: Base_url_admin + 'configuration/category/court/create?form_id=select_form',
                                type: 'Get',
                                dataType: 'html'
                            })
                            .done(function(data) {
                                $('.modal-body').append(data).fadeIn(); // load response
                                $('#modal-loader').hide();
                                $('#select_form #name').focus();
                                _modalSelectFormValidation();
                            })
                            .fail(function(data) {
                                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                                $('#modal-loader').hide();
                            });
                    }
                } else {
                    $('#modal-loader').hide();
                    $('#content_form').show();
                }
            });
    } else {
        $.ajax({
                url: Base_url_admin + 'configuration/master/court/create?name=' + name + '&form_id=select_form&court_category=' + court_category,
                type: 'Get',
                dataType: 'html'
            })
            .done(function(data) {
                $('.modal-body').append(data).fadeIn(); // load response
                $('#modal-loader').hide();
                _componentSelect2SelectModal();
                _componentAjaxDistrictLoad('#select_form');
                _modalSelectFormValidation();
            })
            .fail(function(data) {
                $('.modal-body').html('<span style="color:red; font-weight: bold;"> Something Went Wrong. Please Try again later.......</span>');
                $('#modal-loader').hide();
            });
    }
});