@php
$route = 'admin.configuration.master.upozila.';
@endphp
{!! Form::open(['route' => $route.'store', 'class' => 'form-validate-jquery', 'id' =>  $data['form_id'], 'files' => true, 'method' => 'POST']) !!}

<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">{{_lang('create')}} <span class="text-danger">*</span> <small> @lang('satt.required') </small></legend>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('division', _lang('division') , ['class' => 'col-form-label required']) }}
                {{ Form::hidden('division[id]', isset($data['division']) ? $data['division'] : Null), ['data-parsley-errors-container' => '#parsley_division_error_upozila'] }}
                {{ Form::select('division', $divisions, isset($data['division']) ? $data['division'] : Null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('division'), 'disabled'=>'readonly']) }}
                <span id="parsley_division_error_upozila"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('district', _lang('district') , ['class' => 'col-form-label required']) }}
                {{ Form::hidden('district[id]', isset($data['district']) ? $data['district'] : config('satt.default_district_id'), ['data-parsley-errors-container' => '#parsley_division_error_upozila']) }}
                {{ Form::select('district', $districts, isset($data['district']) ? $data['district'] : config('satt.default_district_id'), ['class' => 'form-control select', 'data-placeholder' =>  _lang('district'), 'id' => 'district', 'disabled' => 'readonly']) }}
                <span id="parsley_district_error_upozila"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('name', _lang('upozila') , ['class' => 'col-form-label required']) }}
                {{ Form::hidden('target', 'upozila', ['id' => 'target']) }}
                {{ Form::text('name', isset($data['name']) ? $data['name'] : Null, ['class' => 'form-control', 'placeholder' =>  _lang('upozila'), 'required' => '']) }}
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            {{ Form::submit(_lang('Create'), ['class' => 'btn btn-primary ml-3l', 'id' => 'submit']) }}
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">{{ _lang('submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
            <button type="button" class="btn btn-danger"  id="back_to_previous" > {{ _lang('back')}} </button>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}
@push('admin.scripts')
@endpush