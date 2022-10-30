@php
$route = 'admin.configuration.master.union.';
@endphp
@if(isset($model))
{!! Form::model($model, ['route' => [$route.'update', $model->id], 'class' => 'form-validate-jquery', 'id' => 'content_form', 'method' => 'PUT', 'files' => true]) !!}
@else
{!! Form::open(['route' => $route.'store', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => true, 'method' => 'POST']) !!}
@endif
<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">{{isset($model) ? _lang('update') : _lang('create')}} <span class="text-danger">*</span> <small> @lang('satt.required') </small></legend>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('division', _lang('division') , ['class' => 'col-form-label required']) }}
                {{ Form::select('division[id]', $divisions, isset($model) ? $model->division->id : config('satt.default_division_id'), ['class' => 'form-control select', 'data-placeholder' =>  _lang('division'), 'required' => '', 'id' => 'division', 'data-parsley-errors-container' => '#parsley_division_error_area']) }}
                <span id="parsley_division_error_area"></span>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('district', _lang('district') , ['class' => 'col-form-label required']) }}
                {{ Form::select('district[id]', isset($districts) ? $districts : ['' => _lang('select_district')], isset($model)? $model->district->id : config('satt.default_district_id'), ['class' => 'form-control select', 'data-placeholder' =>  _lang('district'), 'required' => '', 'id' => 'district', 'data-parsley-errors-container' => '#parsley_district_error_area']) }}
                <span id="parsley_district_error_area"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('upozila', _lang('upozila') , ['class' => 'col-form-label required']) }}
                {{ Form::select('upozila[id]', isset($districts) ? $districts : ['' => 'Select Division First'], isset($model)? $model->upozila_id : config('satt.default_upozila_id'), ['class' => 'form-control select', 'data-placeholder' =>  _lang('upozila'), 'required' => '', 'id' => 'upozila', 'data-parsley-errors-container' => '#parsley_upozila_error_area']) }}
                <span id="parsley_upozila_error_area"></span>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                {{ Form::label('name', _lang('union') , ['class' => 'col-form-label required']) }}
                {{ Form::text('name', Null, ['class' => 'form-control', 'placeholder' =>  _lang('union'), 'required' => '']) }}
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            {{ Form::submit(isset($model) ? _lang('update'):_lang('create'), ['class' => 'btn btn-primary ml-3l', 'id' => 'submit']) }}
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">{{ _lang('submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}
@push('admin.scripts')
@endpush