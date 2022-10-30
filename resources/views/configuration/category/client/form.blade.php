@php
$route = 'admin.configuration.category.client.';
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
                {{ Form::label('name', _lang('client_category') , ['class' => 'col-form-label required']) }}
                {{ Form::text('name', Null, ['class' => 'form-control', 'placeholder' =>  _lang('client_category'), 'required' => '']) }}
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
    <div class="row">
        <div class="col-lg-12">
            <div class="form-check form-check-switchery form-check-inline form-check-right">
                <label for="" class="form-check-label">{{ _lang('status') }}</label>
                {{-- {{ Form::label('status', _lang('Status') , ['class' => 'col-form-label']) }} --}}

                  <input type="checkbox" name="status" id="status" value="1" class="form-check-input-switchery mt-3" data-fouc {{ (isset($model) and $model) ? $model->status ? 'checked' : '' : 'checked' }}>

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