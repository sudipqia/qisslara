@extends('layouts.app', ['title' => _lang('user Profile'), 'modal' => false])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> {{_lang('User Profile')}}</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
		<div class="card">
	<div class="card-header header-elements-inline">
		<h6 class="card-title">Rounded justified toolbar</h6>
		<div class="header-elements">
			<div class="list-icons">
        		<a class="list-icons-item" data-action="collapse"></a>
        		<a class="list-icons-item" data-action="reload"></a>
        		<a class="list-icons-item" data-action="remove"></a>
        	</div>
    	</div>
	</div>

	<div class="card-body">
		<ul class="nav nav-pills nav-pills-bordered nav-pills-toolbar nav-justified">
			<li class="nav-item"><a href="#toolbar-rounded-justified-pill1" class="nav-link rounded-left-round active" data-toggle="tab">{{_lang('Profile')}}</a></li>
			<li class="nav-item"><a href="#toolbar-rounded-justified-pill2" class="nav-link" data-toggle="tab">{{_lang('Password')}}</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane fade show active" id="toolbar-rounded-justified-pill1">
			 {!! Form::open(['route' => 'admin.postprofile', 'class'=>'ajax_form','files' => true, 'method' => 'POST']) !!}
			     <fieldset class="mb-3" id="form_field">
			      <div class="row">
			     	<div class="col-md-3">
			     	  <div class="form-group">
			            {{ Form::label('first_name', _lang('First Name') , ['class' => 'col-form-label']) }}

			            {{ Form::text('first_name', $model->employee->first_name, ['class' => 'form-control', 'placeholder' =>_lang('First Name')]) }}
			          </div>
			     	</div>
			     	<div class="col-md-3">
			     	  <div class="form-group">
			            {{ Form::label('middle_name', _lang('Middle Name') , ['class' => 'col-form-label']) }}

			            {{ Form::text('middle_name', $model->employee->middle_name, ['class' => 'form-control', 'placeholder' =>_lang('Middle Name')]) }}
			          </div>
			     	</div>
			     	<div class="col-md-3">
			     	  <div class="form-group">
			            {{ Form::label('last_name', _lang('Last Name') , ['class' => 'col-form-label']) }}

			            {{ Form::text('last_name', $model->employee->last_name, ['class' => 'form-control', 'placeholder' =>_lang('Last Name')]) }}
			          </div>
			     	</div>
			     	<div class="col-md-3">
			     	  <div class="form-group">
			            {{ Form::label('date_of_birth', _lang('date_of_birth') , ['class' => 'col-form-label']) }}

			            {{ Form::text('date_of_birth', $model->employee->date_of_birth, ['class' => 'form-control date', 'placeholder' =>_lang('date_of_birth')]) }}
			          </div>
			     	</div>
			     	</div>

			     	 <div class="row">
			     	<div class="col-md-3">
			     	  <div class="form-group">
			            {{ Form::label('date_of_anniversary', _lang('date_of_anniversary') , ['class' => 'col-form-label']) }}

			            {{ Form::text('date_of_anniversary', $model->employee->date_of_anniversary, ['class' => 'form-control date', 'placeholder' =>_lang('date_of_anniversary')]) }}
			          </div>
			     	</div>
			     	<div class="col-md-3">
			     	  <div class="form-group">
			            {{ Form::label('marital_status', _lang('marital_status') , ['class' => 'col-form-label']) }}

			            {{ Form::text('marital_status', $model->employee->marital_status, ['class' => 'form-control', 'placeholder' =>_lang('marital_status')]) }}
			          </div>
			     	</div>
			     	<div class="col-md-3">
			     	  <div class="form-group">
			            {{ Form::label('contact_number', _lang('contact_number') , ['class' => 'col-form-label']) }}

			            {{ Form::text('contact_number', $model->employee->contact_number, ['class' => 'form-control', 'placeholder' =>_lang('contact_number')]) }}
			          </div>
			     	</div>
			     	<div class="col-md-3">
			     	  <div class="form-group">
			            {{ Form::label('alternate_contact_number', _lang('alternate_contact_number') , ['class' => 'col-form-label']) }}

			            {{ Form::text('alternate_contact_number', $model->employee->alternate_contact_number, ['class' => 'form-control ', 'placeholder' =>_lang('alternate_contact_number')]) }}
			          </div>
			     	</div>
			     	</div>


			     	 <div class="row">
			     	<div class="col-md-3">
			     	  <div class="form-group">
			            {{ Form::label('email', _lang('email') , ['class' => 'col-form-label']) }}

			            {{ Form::text('email', $model->employee->email, ['class' => 'form-control', 'placeholder' =>_lang('email')]) }}
			          </div>
			     	</div>
			     	<div class="col-md-3">
			     	  <div class="form-group">
			            {{ Form::label('alternate_email', _lang('alternate_email') , ['class' => 'col-form-label']) }}

			            {{ Form::text('alternate_email', $model->employee->alternate_email, ['class' => 'form-control', 'placeholder' =>_lang('alternate_email')]) }}
			          </div>
			     	</div>
			     	<div class="col-md-3">
			     	  <div class="form-group">
			            {{ Form::label('nationality', _lang('nationality') , ['class' => 'col-form-label']) }}

			            {{ Form::text('nationality', $model->employee->nationality, ['class' => 'form-control', 'placeholder' =>_lang('nationality')]) }}
			          </div>
			     	</div>
			     	<div class="col-md-3">
			     	  <div class="form-group">
			           {{ Form::label('photo', _lang('Image') , ['class' => 'col-form-label']) }} 
                     {{ Form::file('photo', ['class' => 'form-control-file']) }}
			          </div>
			     	</div>
			     	</div>
			     		<div class="text-right">
					    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Update Profile')}}<i class="icon-arrow-right14 position-right"></i></button>
					    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

					   </div>
			      </fieldset>
			      {!! Form::close() !!}
			 </div>

			<div class="tab-pane fade" id="toolbar-rounded-justified-pill2">
				{!! Form::open(['route' => 'admin.password', 'id'=>'content_form','files' => true, 'method' => 'POST']) !!}
			     <fieldset class="mb-3" id="form_field">
				 <div class="row">
			     	<div class="col-md-12">
			     	  <div class="form-group">
			            {{ Form::label('password', _lang('New Password') , ['class' => 'col-form-label']) }}

			            {{ Form::password('password', ['class' => 'form-control', 'placeholder' =>_lang('New Password')]) }}
			          </div>
			     	</div>

			     	<div class="col-md-12">
			     	  <div class="form-group">
			            {{ Form::label('password_confirmation', _lang('Confirm Password') , ['class' => 'col-form-label']) }}

			            {{ Form::password('password_confirmation',  ['class' => 'form-control', 'placeholder' =>_lang('Confirm Password')]) }}
			          </div>
			     	</div>
			     	</div>
			     		<div class="text-right">
					    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Change Password')}}<i class="icon-arrow-right14 position-right"></i></button>
					    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

					   </div>
			     </fieldset>
			      {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>


<!-- /basic initialization -->
@stop
@push('scripts')
<script src="{{ asset('asset/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
<script src="{{ asset('js/pages/user.js') }}"></script>
<!-- /theme JS files -->
@endpush