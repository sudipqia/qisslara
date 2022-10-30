@extends('layouts.app', ['title' => _lang('dashboard'), 'modal' => 'full'])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> {{ _lang('home') }}</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<div class="row">
    <div class="col-sm-6 col-xl-3">
        <div class="card card-body">
            <div class="media mb-3">
                <div class="media-body">
                    <h6 class="font-weight-semibold mb-0">Get Demo Request</h6>
                    <span class="text-muted">Until {{ date('F d, Y') }}</span>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-magazine icon-2x text-indigo opacity-75"></i>
                </div>
            </div>

            <div class="progress mb-2" style="height: 0.125rem;">
                <div class="progress-bar bg-indigo" style="width: 67%">
                    <span class="sr-only">67% Complete</span>
                </div>
            </div>

            <div>
                <span class="float-right">
                    @php
                        $getDemoCounter = App\GetDemo::count();
                        echo $getDemoCounter;
                    @endphp
                </span>
                <a class="text-dark" href="{{ route('admin.report.get_demo') }}"><b>Show All</b></a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-body">
            <div class="media mb-3">
                <div class="media-body">
                    <h6 class="font-weight-semibold mb-0">Newsletter Request</h6>
                    <span class="text-muted">{{ date('F, Y') }}</span>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-newspaper icon-2x text-danger opacity-75"></i>
                </div>
            </div>

            <div class="progress mb-2" style="height: 0.125rem;">
                <div class="progress-bar bg-danger" style="width: 80%">
                    <span class="sr-only">
                        
                    </span>
                </div>
            </div>
            
            <div>
                <span class="float-right">
                    <b>@php
                        $newsletterCounter = App\NewsletterInformation::count();
                        echo $newsletterCounter;
                    @endphp</b>
                </span>
                <a class="text-dark" href="{{ route('admin.report.newsletter') }}"><b>Show All</b></a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-body">
            <div class="media mb-3">
                <div class="mr-3 align-self-center">
                    <i class="icon-file-text2 icon-2x text-primary opacity-75"></i>
                </div>

                <div class="media-body">
                    <h6 class="font-weight-semibold mb-0">Contact Form Submitted</h6>
                    <span class="text-muted">Until {{ date('F d, Y') }}</span>
                </div>
            </div>

            <div class="progress mb-2" style="height: 0.125rem;">
                <div class="progress-bar bg-primary" style="width: 67%">
                    <span class="sr-only">
                        
                    </span>
                </div>
            </div>
            
            <div>
                <span class="float-right">
                    <b>@php
                        $contactCounter = App\ContactInformation::count();
                        echo $contactCounter;
                    @endphp</b>
                </span>
                <a class="text-dark" href="{{ route('admin.report.contact') }}"><b>Show All</b></a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card card-body">
            <div class="media mb-3">
                <div class="mr-3 align-self-center">
                    <i class="icon-user icon-2x text-success opacity-75"></i>
                </div>

                <div class="media-body">
                    <h6 class="font-weight-semibold mb-0">Total System User</h6>
                    <span class="text-muted">Until {{ date('F d, Y') }}</span>
                </div>
            </div>

            <div class="progress mb-2" style="height: 0.125rem;">
                <div class="progress-bar bg-success" style="width: 80%">
                    <span class="sr-only">80% Complete</span>
                </div>
            </div>
            
            <div>
                <span class="float-right">
                    <b>@php
                        $userConter = App\User::count();
                        echo $userConter;
                    @endphp</b>
                </span>
                <a class="text-dark" href="{{ route('admin.user.index') }}"><b>Show All</b></a>
            </div>
        </div>
    </div>
</div>
@stop
@push('scripts')
@endpush