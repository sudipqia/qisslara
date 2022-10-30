@php
$route = 'admin.configuration.master.division.';
@endphp
{!! Form::open(['route' => $route.'store', 'class' => 'form-validate-jquery', 'id' =>  $data['form_id'], 'files' => true, 'method' => 'POST']) !!}
<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">{{ _lang('create') }} <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('name', _lang('name') , ['class' => 'col-form-label required']) }}
                {{ Form::hidden('target', 'division', ['id' => 'target']) }}
                {{ Form::text('name', isset($data['name']) ? $data['name'] : Null, ['class' => 'form-control', 'placeholder' =>  _lang('division'), 'required' => '']) }}
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                {{ Form::label('sortname', _lang('sort_name') , ['class' => 'col-form-label required']) }}
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
            {{ Form::submit(_lang('Create'), ['class' => 'btn btn-primary ml-3l', 'id' => 'submit']) }}
           <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">{{ _lang('submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
            <button type="button" class="btn btn-danger"  id="back_to_previous" >{{ _lang('back')}} </button>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}
@push('admin.scripts')
@endpush