@php
    $route = 'admin.report.';
    $js = ['bank'];
@endphp
@extends('layouts.app', ['title' => _lang('Get Demo Report'), 'modal' => 'lg'])
@section('page.header')
<div class="page-header page-header-light border-bottom-success rounded-top-0">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{ route('home') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{ _lang('Home') }}</a>
				<span class="breanewsletterdcrumb-item active">{{ _lang('Get Demo Report') }}</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
@stop
@section('content')
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{ _lang('Get Demo Report') }}
		    
		</h5>
	</div>
	<div class="card-body">
		<div class="row">

            <div class="col-md-12 table-responsive">
                <table class="table table-bordered content_managment_table" data-url="{{ route($route.'get_demo.datatable') }}">
                    <thead>
                        <tr>
                            <th>{{ _lang('id') }}</th>
                            <th>{{ _lang('Date') }}</th>
                            <th>{{ _lang('Email') }}</th>
                            <th width="10%">{{ _lang('action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</div>
<!-- /basic initialization -->
@stop
@push('scripts')
<!-- Theme JS files -->
<script src="{{ asset('asset/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/tables/datatables/extensions/select.min.js') }}"></script>

<script>
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
                        data: 'date',
                        name: 'date'
                    },{
                        data: 'email',
                        name: 'email'
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

</script>
@endpush