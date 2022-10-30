@extends('layouts.app', ['title' => _lang('user_management'), 'modal' => false])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> {{_lang('user_management')}}</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{_lang('user_management')}}
		</h5>
		<div class="header-elements">
			<div class="list-icons">
				<a class="list-icons-item" data-action="fullscreen" title="{{ _lang('fullscreen') }}" data-popup="tooltip" data-placement="bottom"></a>
				<a class="list-icons-item" data-action id="reload" title="{{ _lang('reload') }}" data-popup="tooltip" data-placement="bottom"><i class="icon-reload-alt"></i></a>
				<a class="list-icons-item" data-action="collapse" title="{{ _lang('collapse') }}" data-popup="tooltip" data-placement="bottom"></a>
			</div>
		</div>
	</div>
	<div class="card-body">
		{{-- <div class="text-center">
			<img src="{{ asset('asset/table_loader.gif') }}" id="table_loading" width="100px">
		</div> --}}
    {!! Form::open(['route' => 'admin.user.create', 'id'=>'content_form','files' => true, 'method' => 'POST']) !!}
    <fieldset class="mb-3" id="form_field">
     <div class="row">
     	<div class="col-md-2">
     	  <div class="form-group">
            {{ Form::label('surname', _lang('prefix') , ['class' => 'col-form-label required']) }}

            {{ Form::text('surname', null, ['class' => 'form-control', 'placeholder' => 'Dr/Mr/Mrs','required'=>'']) }}
          </div>
     	</div>

     	<div class="col-md-5">
     	  <div class="form-group">
            {{ Form::label('first_name', _lang('first_name') , ['class' => 'col-form-label required']) }}

            {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => _lang('first_name'),'required'=>'']) }}
          </div>
     	</div>

     	<div class="col-md-5">
     	  <div class="form-group">
            {{ Form::label('last_name', _lang('last_name') , ['class' => 'col-form-label required']) }}

            {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => _lang('last_name'),'required'=>'']) }}
          </div>
     	</div>
     </div>

     <div class="row">
     	<div class="col-md-4">
     		<div class="form-group">
            {{ Form::label('email', _lang('email') , ['class' => 'col-form-label required']) }}

            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => _lang('email'),'required'=>'']) }}
          </div>
     	</div>

     	<div class="col-md-4">
        <div class="form-group">
          {{ Form::label('role', _lang('role_name') , ['class' => 'col-form-label required']) }}
            {!! Form::select('role', $roles, null, ['class' => 'form-control select', 'data-placeholder' => _lang('select_role')]); !!}
        </div>
      </div>

      <div class="col-md-4">
     		<div class="form-group">
            {{ Form::label('username', _lang('user_name') , ['class' => 'col-form-label required']) }}

            {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => _lang('user_name'),'required'=>'']) }}
          </div>
     	</div>
     </div>

     <div class="row">
     	<div class="col-md-6">
     		<div class="form-group">
            {{ Form::label('password', _lang('password') , ['class' => 'col-form-label required']) }}

            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => _lang('password'),'required'=>'']) }}
          </div>
     	</div>

     	<div class="col-md-6">
     	 <div class="form-group">
            {{ Form::label('password_confirmation', _lang('confirm_password') , ['class' => 'col-form-label required']) }}

            {{ Form::password('password_confirmation',['class' => 'form-control', 'placeholder' => _lang('confirm_password'),'required'=>'']) }}
          </div>
     	</div>
     </div>
        @can('user.create')
		<div class="text-right">
		    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('create_user')}}<i class="icon-arrow-right14 position-right"></i></button>
		    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

		   </div>
           @endcan
     </fieldset>
    {!!Form::close()!!}
	</div>
</div>

<!-- /basic initialization -->
@stop
@push('scripts')
<!-- Theme JS files -->
<script src="{{ asset('js/pages/user.js') }}"></script>
<!-- /theme JS files -->
@endpush