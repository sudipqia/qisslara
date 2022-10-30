@php
$route = 'admin.configuration.master.division.';
@endphp
@if(isset($model))
{!! Form::model($model, ['route' => [$route.'update', $model->id], 'class' => 'form-validate-jquery', 'id' => 'content_form', 'method' => 'PUT', 'files' => true]) !!}
@else
{!! Form::open(['route' => $route.'store', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => true, 'method' => 'POST']) !!}
@endif
<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">{{isset($model) ? _lang('update') : _lang('create')}} <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('name', _lang('division') , ['class' => 'col-form-label required']) }}
                {{ Form::text('name', Null, ['class' => 'form-control', 'placeholder' =>  _lang('division'), 'required' => '']) }}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('sortname', _lang('short_name') , ['class' => 'col-form-label required']) }}
                {{ Form::text('sortname', Null, ['class' => 'form-control', 'placeholder' =>  _lang('short_name'), 'required' => '']) }}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('phonecode', _lang('phone_code') , ['class' => 'col-form-label']) }}
                {{ Form::text('phonecode', Null, ['class' => 'form-control', 'placeholder' =>  _lang('phone_code')]) }}
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