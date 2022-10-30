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
					<h6 class="card-title">{{_lang('Email Templates')}}</h6>
					<div class="header-elements">
						<div class="list-icons">
							<a class="list-icons-item" data-action="collapse"></a>
							<a class="list-icons-item" data-action="reload"></a>
							<a class="list-icons-item" data-action="remove"></a>
						</div>
					</div>
				</div>

				<div class="card-body">
					<form action="{{ route('admin.mail-setup') }}" method="POST">
                        @csrf
                        <div class="row">
                            @if(Session::has('success_message'))
                                <div class="col-md-12 mb-3">
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('success_message') }}
                                    </div>
                                </div>
                            @endif
                                
                            <div class="col-md-12">
                                <h4>Email Content For Contact form</h4>
                                <div class="card">
                                    <div class="card-header">
                                        <b>Short Code</b>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <td class="text-center">Name</td>
                                                <td class="text-center">Code</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Client Name</td>
                                                <td class="text-center">[CLIENT_NAME]</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Client Email</td>
                                                <td class="text-center">[CLIENT_EMAIL]</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Client PHONE</td>
                                                <td class="text-center">[CLIENT_PHONE]</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Client Website</td>
                                                <td class="text-center">[CLIENT_WEBSITE]</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Client Message</td>
                                                <td class="text-center">[CLIENT_MESSAGE]</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="client_contact_template">Client Contact Template</label>
                                <textarea name="client_contact_template" id="client_contact_template" cols="30" rows="10">{{ get_option('client_contact_template') }}</textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="admin_contact_template">Admin Contact Template</label>
                                <textarea name="admin_contact_template" id="admin_contact_template" cols="30" rows="10">{{ get_option('admin_contact_template') }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <h4>Email Content For Get Demo</h4>
                                <div class="card">
                                    <div class="card-header">
                                        <b>Short Code</b>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <td class="text-center">Name</td>
                                                <td class="text-center">Code</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Client Email</td>
                                                <td class="text-center">[CLIENT_EMAIL]</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="client_get_demo_template">Client Get Demo Template</label>
                                <textarea name="client_get_demo_template" id="client_get_demo_template" cols="30" rows="10">{{ get_option('client_get_demo_template') }}</textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="admin_get_demo_template">Admin Get Demo Template</label>
                                <textarea name="admin_get_demo_template" id="admin_get_demo_template" cols="30" rows="10">{{ get_option('admin_get_demo_template') }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <h4>Email Content For Newsletter</h4>
                                <div class="card">
                                    <div class="card-header">
                                        <b>Short Code</b>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <td class="text-center">Name</td>
                                                <td class="text-center">Code</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Client Email</td>
                                                <td class="text-center">[CLIENT_EMAIL]</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="client_newsletter_template">Client Newsletter Template</label>
                                <textarea name="client_newsletter_template" id="client_newsletter_template" cols="30" rows="10">{{ get_option('client_newsletter_template') }}</textarea>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="admin_newsletter_template">Admin Newsletter Template</label>
                                <textarea name="admin_newsletter_template" id="admin_newsletter_template" cols="30" rows="10">{{ get_option('admin_newsletter_template') }}</textarea>
                            </div>

                            <div class="col-md-4 mx-auto">
                                <button class="btn btn-outline-success btn-block" type="submit">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
				</div>
			</div>
		</div>
    </div>
@stop
@push('scripts')
<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( "client_contact_template" );
    CKEDITOR.replace( "admin_contact_template" );
    CKEDITOR.replace( "client_get_demo_template" );
    CKEDITOR.replace( "admin_get_demo_template" );
    CKEDITOR.replace( "client_newsletter_template" );
    CKEDITOR.replace( "admin_newsletter_template" );
</script>
@endpush