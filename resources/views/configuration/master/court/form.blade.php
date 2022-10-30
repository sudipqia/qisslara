@php
$route = 'admin.configuration.master.court.';
@endphp
@if(isset($model))
{!! Form::model($model, ['route' => [$route.'update', $model->id], 'class' => 'form-validate-jquery', 'id' => 'content_form', 'method' => 'PUT', 'files' => true]) !!}
@else
{!! Form::open(['route' => $route.'store', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => true, 'method' => 'POST']) !!}
@endif
<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">{{isset($model) ? _lang('update') : _lang('Create')}} <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('name', _lang('court') , ['class' => 'col-form-label required']) }}
                {{ Form::text('name', Null, ['class' => 'form-control', 'placeholder' =>  _lang('court'), 'required' => '']) }}
            </div>
        </div>
    </div>

 <div class="row">
        <div class="col-lg-12">
             <div class="form-group">
                {{ Form::label('division', _lang('division') , ['class' => 'col-form-label required']) }}
                {{ Form::select('division[id]', $divisions, isset($model) ? $model->division->id : config('satt.default_division_id'), ['class' => 'form-control select', 'data-placeholder' =>  _lang('division'), 'required' => '', 'id' => 'division', 'data-parsley-errors-container' => '#parsley_division_error_area']) }}
                <span id="parsley_division_error_area"></span>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('district', _lang('district') , ['class' => 'col-form-label required']) }}
                {{ Form::select('district[id]', isset($districts) ? $districts : ['' => 'Select Division First'], null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('district'), 'required' => '', 'id' => 'district', 'data-parsley-errors-container' => '#parsley_district_error_area']) }}
                <span id="parsley_district_error_area"></span>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('court_category', _lang('court_category') , ['class' => 'col-form-label required']) }}
                {{ Form::select('court_category[id]',$categories,null, ['class' => 'form-control select', 'data-placeholder' =>  _lang('court_category'), 'required' => '', 'id' => 'court_category', 'data-parsley-errors-container' => '#category_error_area']) }}
                <span id="category_error_area"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('description', _lang('description') , ['class' => 'col-form-label']) }}
                {{ Form::textarea('description', Null, ['class' => 'form-control', 'placeholder' =>  _lang('description'), 'style' => 'resize: none;', 'rows' => '3']) }}
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            {{ Form::submit(isset($model) ? _lang('update'):_lang('create'), ['class' => 'btn btn-primary ml-3l', 'id' => 'submit']) }}
            <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">{{ _lang('submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"> {{  _lang('close') }} </button>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}
@push('admin.scripts')
@endpush