@extends('layouts.app', ['title' => 'setting', 'modal' => false])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item"><i class="icon-home2 mr-2"></i> {{_lang('home')}}</span>
                 <span class="breadcrumb-item active"><i class="icon-cog mr-2"></i> {{_lang('setting')}}</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
   	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header header-elements-inline">
					<h6 class="card-title">{{_lang('System Configuration')}}</h6>
					<div class="header-elements">
						<div class="list-icons">
							<a class="list-icons-item" data-action="collapse"></a>
							<a class="list-icons-item" data-action="reload"></a>
							<a class="list-icons-item" data-action="remove"></a>
						</div>
					</div>
				</div>

				<div class="card-body">
					<ul class="nav nav-tabs nav-tabs-solid nav-justified bg-light">
						<li class="nav-item"><a href="#solid-bordered-justified-tab1" class="nav-link active" data-toggle="tab">{{_lang('general')}}</a></li>
						<li class="nav-item"><a href="#solid-bordered-justified-tab2" class="nav-link" data-toggle="tab">{{_lang('logo')}}</a></li>
						<li class="nav-item"><a href="#solid-bordered-justified-tab4" class="nav-link" data-toggle="tab">{{_lang('Social Link')}}</a></li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane fade show active" id="solid-bordered-justified-tab1">
							{!! Form::open(['route' => 'admin.configuration', 'class' => 'ajax_submit','files' => true, 'method' => 'POST']) !!}
								<fieldset class="mb-3" id="form_field">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												{{ Form::label('company_name', _lang('Company Name') , ['class' => 'col-form-label ']) }}
												{{ Form::text('company_name', get_option('company_name'), ['class' => 'form-control', 'placeholder' => _lang('Enter Company Name')]) }}
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												{{ Form::label('site_title', _lang('title') , ['class' => 'col-form-label ']) }}
												{{ Form::text('site_title', get_option('site_title'), ['class' => 'form-control', 'placeholder' => _lang('title')]) }}
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												{{ Form::label('email', _lang('Email') , ['class' => 'col-form-label ']) }}
												{{ Form::text('email', get_option('email'), ['class' => 'form-control', 'placeholder' => _lang('Email')]) }}
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												{{ Form::label(_lang('phone'), _lang('phone') , ['class' => 'col-form-label ']) }}
												{{ Form::text('phone',get_option('phone'), ['class' => 'form-control', 'placeholder' => _lang('phone')]) }}
											</div>
										</div>

										<div class="col-lg-6">
											<div class="form-group">
												{{ Form::label(_lang('address'), _lang('Address') , ['class' => 'col-form-label ']) }}
												{{ Form::text('address',get_option('address'), ['class' => 'form-control', 'placeholder' => _lang('Address')]) }}
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="form-group">
												{{ Form::label(_lang('address_link'), _lang('Address Link') , ['class' => 'col-form-label ']) }}
												{{ Form::text('address_link',get_option('address_link'), ['class' => 'form-control', 'placeholder' => _lang('Address Link')]) }}
											</div>
										</div>

										<div class="col-md-12 form-group">
											<label for="footar_content">Footer Content</label>
											<textarea name="footar_content" id="footar_content" cols="30" rows="3" class="form-control">{{ get_option('footar_content') }}</textarea>
										</div>
										
										<div class="col-md-12 form-group">
											<label for="newsletter_content">Footer Content</label>
											<textarea name="newsletter_content" id="newsletter_content" cols="30" rows="3" class="form-control">{{ get_option('newsletter_content') }}</textarea>
										</div>

									</div>

									<div class="text-right">
										<button type="submit" class="btn btn-primary"  id="submit">{{_lang('update_setting')}}<i class="icon-arrow-right14 position-right"></i></button>
										<button type="button" class="btn btn-link" id="submiting" style="display: none;">{{ _lang('processing') }} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
									</div>
								</fieldset>
							{!!Form::close()!!}
						</div>

						<div class="tab-pane fade" id="solid-bordered-justified-tab2">
							{!! Form::open(['route' => 'admin.logo', 'class' => 'ajax_submit','files' => true, 'method' => 'POST']) !!}
								<fieldset class="mb-3" id="form_field">
									<div class="row">

										<div class="col-md-6">
											<div class="form-group">
											{{ Form::label('logo', _lang('logo') , ['class' => 'col-form-label']) }}
												<input type="file" class="file" name="logo" data-default-file="{{ asset('storage/logo/'. get_option('logo')) }}">
												@if(get_option('logo'))
													<input type="hidden" name="oldLogo" value="{{get_option('logo')}}">
												@endif
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
											{{ Form::label('favicon', _lang('favicon') , ['class' => 'col-form-label']) }}
												<input class="file" type="file" name="favicon" data-default-file="{{ asset('storage/logo/'. get_option('favicon')) }}">
												@if(get_option('favicon'))
													<input type="hidden" name="oldfavicon" value="{{get_option('favicon')}}">
												@endif
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
											{{ Form::label('logo_alter_tag', _lang('Logo Alter Tag') , ['class' => 'col-form-label']) }}
												<input type="text" class="form-control" name="logo_alter_tag" value="{{ get_option('logo_alter_tag') }}">
											</div>
										</div>
									</div>
									<div class="text-right">
										<button type="submit" class="btn btn-primary"  id="submit">{{_lang('update_setting')}}<i class="icon-arrow-right14 position-right"></i></button>
										<button type="button" class="btn btn-link" id="submiting" style="display: none;">{{ _lang('processing') }} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
									</div>
								</fieldset>
							{!!Form::close()!!}
						</div>

						<div class="tab-pane fade" id="solid-bordered-justified-tab4">
							{!! Form::open(['route' => 'admin.social', 'class' => 'ajax_submit','files' => true, 'method' => 'POST']) !!}
								<fieldset class="mb-3" id="form_field">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
											{{ Form::label('Facebook_link', ' Facebook Link' , ['class' => 'col-form-label ']) }}
											{{ Form::text('Facebook_link', get_option('Facebook_link'), ['class' => 'form-control', 'placeholder' => 'Facebook Link']) }}
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
											{{ Form::label('twiter_link', 'Twiter Link' , ['class' => 'col-form-label ']) }}
											{{ Form::text('twiter_link', get_option('twiter_link'), ['class' => 'form-control', 'placeholder' => 'Twiter Link']) }}
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
											{{ Form::label('youtube_link', 'Youtube Link' , ['class' => 'col-form-label ']) }}
											{{ Form::text('youtube_link', get_option('youtube_link'), ['class' => 'form-control', 'placeholder' => 'Youtube Link']) }}
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
											{{ Form::label('google+_link', 'Google+ Link' , ['class' => 'col-form-label ']) }}
											{{ Form::text('google+_link', get_option('google+_link'), ['class' => 'form-control', 'placeholder' => 'Google+ Link']) }}
											</div>
										</div>
									</div>
									<div class="text-right">
										<button type="submit" class="btn btn-primary"  id="submit">{{_lang('update_setting')}}<i class="icon-arrow-right14 position-right"></i></button>
										<button type="button" class="btn btn-link" id="submiting" style="display: none;">{{ _lang('processing') }} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
									</div>
								</fieldset>
							{!!Form::close()!!}
						</div>

					</div>
				</div>
			</div>
		</div>
    </div>
@stop
@push('scripts')
	<link rel="stylesheet" href="{{ asset('asset/assets/css/dropify.min.css') }}">
	<script src="{{ asset('asset/assets/js/dropify.js') }}"></script>
	<script src="{{ asset('js/setting.js') }}"></script>
	<script>
		$('.file').dropify();
	</script>
@endpush