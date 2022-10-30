@php
$route = 'admin.configuration.';
$lang = 'configuration.';
$js = ['configuration/configuration'];
@endphp
@extends('layouts.app', ['title' => __($lang.'title'), 'modal' => false])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> @lang('satt.home')</a>
                <span class="breadcrumb-item active">@lang($lang.'title')</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">@lang($lang.'title')
        </h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
            </div>
        </div>
    </div>
    <div class="card-body">

        {!! Form::open(['route' => $route.'store', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => true, 'method' => 'POST']) !!}
        <fieldset class="mb-3">
            <legend class="text-uppercase font-size-sm font-weight-bold">{{ __($lang.'create') }} <span class="text-danger">*</span> <small> @lang('satt.required') </small></legend>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                {{ Form::label('joining_date', __($lang.'form.joining_date_label') , ['class' => 'col-form-label col-lg-4 text-right required']) }}
                                <div class="col-lg-8">
                                    {{ Form::text('joining_date', Null, ['class' => 'form-control date', 'placeholder' =>  __($lang.'form.joining_date')]) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                {{ Form::label('photo', __($lang.'form.photo_label') , ['class' => 'col-form-label col-lg-4 text-right required']) }}
                                <div class="col-lg-8">
                                    {{ Form::file('photo', ['class' => 'form-control-file', 'placeholder' =>  __($lang.'form.photo'),'accept' => 'image/*']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                {{ Form::label('basic_salary', __($lang.'form.basic_salary_label') , ['class' => 'col-form-label col-lg-4 text-right required']) }}
                                <div class="col-lg-8">
                                    {{ Form::text('basic_salary', Null, ['class' => 'form-control', 'placeholder' =>  __($lang.'form.basic_salary'), 'data-parsley-type' => 'number', 'required' => '']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                {{ Form::label('house_rent', __($lang.'form.house_rent_label') , ['class' => 'col-form-label col-lg-4 text-right required']) }}
                                <div class="col-lg-8">
                                    {{ Form::text('house_rent', Null, ['class' => 'form-control', 'placeholder' =>  __($lang.'form.house_rent'), 'required' => '', 'data-parsley-type' => 'number']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                {{ Form::label('medical_allowance', __($lang.'form.medical_allowance_label') , ['class' => 'col-form-label col-lg-4 text-right required']) }}
                                <div class="col-lg-8">
                                    {{ Form::text('medical_allowance', Null, ['class' => 'form-control', 'placeholder' =>  __($lang.'form.medical_allowance'), 'data-parsley-type' => 'number', 'required' => '']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                {{ Form::label('transport_allowance', __($lang.'form.transport_allowance_label') , ['class' => 'col-form-label col-lg-4 text-right required']) }}
                                <div class="col-lg-8">
                                    {{ Form::text('transport_allowance', Null, ['class' => 'form-control', 'placeholder' =>  __($lang.'form.transport_allowance'), 'required' => '', 'data-parsley-type' => 'number']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                {{ Form::label('insurance', __($lang.'form.insurance_label') , ['class' => 'col-form-label col-lg-4 text-right required']) }}
                                <div class="col-lg-8">
                                    {{ Form::text('insurance', Null, ['class' => 'form-control', 'placeholder' =>  __($lang.'form.insurance'), 'data-parsley-type' => 'number', 'required' => '']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                {{ Form::label('commission', __($lang.'form.commission_label') , ['class' => 'col-form-label col-lg-4 text-right required']) }}
                                <div class="col-lg-8">
                                    {{ Form::text('commission', Null, ['class' => 'form-control', 'placeholder' =>  __($lang.'form.commission'), 'required' => '', 'data-parsley-type' => 'number']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                {{ Form::label('extra', __($lang.'form.extra_label') , ['class' => 'col-form-label col-lg-4 text-right required']) }}
                                <div class="col-lg-8">
                                    {{ Form::text('extra', Null, ['class' => 'form-control', 'placeholder' =>  __($lang.'form.extra'), 'data-parsley-type' => 'number', 'required' => '']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                {{ Form::label('overtime', __($lang.'form.overtime_label') , ['class' => 'col-form-label col-lg-4 text-right required']) }}
                                <div class="col-lg-8">
                                    {{ Form::text('overtime', Null, ['class' => 'form-control', 'placeholder' =>  __($lang.'form.overtime'), 'required' => '', 'data-parsley-type' => 'number']) }}
                                </div>
                            </div>
                        </div>
                    </div>

            <div class="mt-3">
                <div class="form-group row">
                    <div class="col-lg-4 offset-lg-4">
                        {{ Form::submit(__('satt.form.create'), ['class' => 'btn btn-primary ml-3l', 'id' => 'submit']) }}
                        <button type="button" class="btn btn-link" id="submiting" style="display: none;">Submiting <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </fieldset>
        {!! Form::close() !!}
        @push('admin.scripts')
        @endpush
    </div>
</div>
<!-- /basic initialization -->
@stop
@push('admin.scripts')
<!-- Theme JS files -->
<script src="{{ asset('asset/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/extensions/jquery_ui/widgets.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/extensions/jquery_ui/effects.min.js') }}"></script>
@if ($js != '')
@forelse ($js as $element)
<script src="{{ asset('js/pages/'.$element.'.js') }}"></script>
@empty
@endforelse
@endif
<!-- /theme JS files -->
@endpush