@php
$route = 'admin.configuration.master.act.';
@endphp
{!! Form::open(['route' => $route.'store', 'class' => 'form-validate-jquery', 'id' =>  $data['form_id'], 'files' => true, 'method' => 'POST']) !!}
<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">{{ _lang('create') }} <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('name', _lang('act') , ['class' => 'col-form-label required']) }}
                  {{ Form::hidden('target', 'act', ['id' => 'target']) }}
                {{ Form::hidden('status', 1) }}
                {{ Form::text('name', isset($data['name']) ? $data['name'] : Null, ['class' => 'form-control', 'placeholder' =>  _lang('act'), 'required' => '']) }}
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('act_no', _lang('act_no') , ['class' => 'col-form-label required']) }}
                {{ Form::text('act_no', Null, ['class' => 'form-control', 'placeholder' =>  _lang('act_no'), 'required' => '']) }}
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
            {{ Form::submit(_lang('Create'), ['class' => 'btn btn-primary ml-3l', 'id' => 'submit']) }}
           <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">{{ _lang('submiting') }} <img src="{{ asset('asset/ajaxloader.gif') }}"></button>
            <button type="button" class="btn btn-danger"  id="back_to_previous" >{{ _lang('back')}} </button>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}
@push('admin.scripts')
@endpush