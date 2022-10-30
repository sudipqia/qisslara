@php
$route = 'admin.configuration.master.district.';
@endphp
@if(isset($model))
{!! Form::model($model, ['route' => [$route.'update', $model->id], 'class' => 'form-validate-jquery', 'id' => 'content_form', 'method' => 'PUT', 'files' => true]) !!}
@else
{!! Form::open(['route' => $route.'store', 'class' => 'form-validate-jquery', 'id' => 'content_form', 'files' => true, 'method' => 'POST']) !!}
@endif
<fieldset class="mb-3">
    <legend class="text-uppercase font-size-sm font-weight-bold">{{isset($model) ? _lang('update') : _lang('create')}} <span class="text-danger">*</span> <small> {{ _lang('required') }} </small></legend>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('division', _lang('division') , ['class' => 'col-form-label required']) }}
                @if(isset($division))
                {{ Form::select('division[id]', $divisions, isset($division) ? $division : config('satt.default_division_id'), ['class' => 'form-control select', 'data-placeholder' =>  _lang('division'), 'required' => '', 'id' => 'division', 'data-parsley-errors-container' => '#parsley_division_error']) }}
                @else
                {{ Form::select('division[id]', $divisions, isset($model) && $model->division ? $model->division_id : config('satt.default_division_id'), ['class' => 'form-control select', 'data-placeholder' =>  _lang('division'), 'required' => '', 'id' => 'division', 'data-parsley-errors-container' => '#parsley_division_error_state']) }}
                @endif
                <span id="parsley_division_error_state"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                {{ Form::label('name', _lang('district') , ['class' => 'col-form-label required']) }}
                 @if (isset($name) AND isset($form_id))
                {{ Form::hidden('target', 'state', ['id' => 'target']) }}
                @endif
                {{ Form::text('name', isset($name) ? $name : Null, ['class' => 'form-control', 'placeholder' =>  _lang('district'), 'required' => '']) }}
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-4 offset-lg-4">
            {{ Form::submit(isset($model) ? _lang('update'):_lang('create'), ['class' => 'btn btn-primary ml-3l', 'id' => 'submit']) }}
             <button type="button" class="btn btn-link" id="submiting" style="display: none;" disabled="">{{ _lang('submiting') }}<img src="{{ asset('asset/ajaxloader.gif') }}"></button>
            <button type="button" class="btn btn-danger" @if(isset($name) AND isset($form_id)) id="back_to_previous" @else data-dismiss="modal" @endif> @if(isset($name) AND isset($form_id)) {{ _lang('back')}} @else {{  _lang('close') }} @endif </button>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}
@push('admin.scripts')
@endpush