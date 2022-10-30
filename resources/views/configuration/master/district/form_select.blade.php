@php
$route = 'admin.configuration.master.district.';
@endphp
{!! Form::open(['route' => $route.'store', 'class' => 'form-validate-jquery', 'id' => $data['form_id'], 'files' => true, 'method' => 'POST']) !!}
<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">{{_lang('create')}} <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('division', _lang('division') , ['class' => 'col-form-label required']) }}
                {{ Form::hidden('division[id]', isset($data['division']) ? $data['division'] : ''), ['data-parsley-errors-container' => '#parsley_division_error_district'] }}
                {{ Form::select('division', $divisions, isset($data['division']) ? $data['division'] : '', ['class' => 'form-control select', 'data-placeholder' =>  _lang('division'), 'id' => 'division', 'disabled'=>'readonly']) }}
                <span id="parsley_division_error_district"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('name', _lang('district') , ['class' => 'col-form-label required']) }}
                {{ Form::hidden('target', 'district', ['id' => 'target']) }}
                {{ Form::text('name', isset($data['name']) ? $data['name'] : Null, ['class' => 'form-control', 'placeholder' =>  _lang('district'), 'required' => '']) }}
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            {{ Form::submit(_lang('create'), ['class' => 'btn btn-primary ml-3l', 'id' => 'submit']) }}
             <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">{{ _lang('submiting') }}<img src="{{ asset('asset/ajaxloader.gif') }}"></button>
            <button type="button" class="btn btn-danger"  id="back_to_previous">  {{ _lang('back')}} </button>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}
@push('admin.scripts')
@endpush