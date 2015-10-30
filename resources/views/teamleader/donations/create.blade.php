@extends('layouts.master')

@section('title', 'Add Donation')

@section('styles')
{!! Html::style('packages/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') !!}
{!! Html::style('assets/js/plugins/select2/select2.min.css') !!}
{!! Html::style('assets/js/plugins/select2/select2-bootstrap.min.css') !!}
@parent
@stop

@section('content')
<!-- Page Container -->
<div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">
    
    <!-- Sidebar -->
    @include('partials.teamleader._sidebar')
    <!-- END Sidebar -->

    <!-- Header -->
    @include('partials._header')
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Header -->
        <div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">
                        Add Donation
                    </h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Manage</li>
                        <li><a class="link-effect" href="">Donations</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END Page Header -->

        <!-- Page Content -->
        <div class="content">
            <h2 class="content-heading">Add donation details</h2>
            <div class="row">
                <div class="col-lg-6">

                    @include('flash::message')
                    <!-- Wizards with Progress -->
                    <div class="js-wizard-simple block">
                        <!-- Step Tabs -->
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active">
                                <a href="#simple-classic-progress-step1" data-toggle="tab">1. Personal</a>
                            </li>
                            <li>
                                <a href="#simple-classic-progress-step2" data-toggle="tab">2. Appointment</a>
                            </li>
                        </ul>
                        <!-- END Step Tabs -->

                        <!-- Form -->
                        {!! Form::open(['route' => ['teamleader.donations.store',$domain],'class' => 'form-horizontal push-10-t push-10']) !!}
                            <!-- Steps Progress -->
                            <div class="block-content block-content-mini block-content-full border-b">
                                <div class="wizard-progress progress progress-mini remove-margin-b">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 0"></div>
                                </div>
                            </div>
                            <!-- END Steps Progress -->

                            <!-- Steps Content -->
                            <div class="block-content tab-content">
                                <!-- Step 1 -->
                                <div class="tab-pane fade fade-up in push-30-t push-50 active" id="simple-classic-progress-step1">
                                    <div class="form-group {{set_error('fullname', $errors)}}">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="form-material">
                                                {!! Form::text('fullname',old('fullname'),['class' => 'form-control','placeholder' => 'Please enter your fullname']) !!}
                                                {!! Form::label('fullname', 'Full Name') !!}
                                                {!! get_error('fullname', $errors) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{set_error('email', $errors)}}">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="form-material">
                                                {!! Form::email('email',old('email'),['class' => 'form-control','placeholder' => 'Please enter your email']) !!}
                                                {!! Form::label('email', 'Email Address') !!}
                                                {!! get_error('email', $errors) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{set_error('mobile', $errors)}}">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <div class="form-material">
                                                {!! Form::text('mobile',old('mobile'),['class' => 'form-control','placeholder' => '9965497345']) !!}
                                                {!! Form::label('mobile', 'Mobile') !!}
                                                {!! get_error('mobile', $errors) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Step 1 -->

                                <!-- Step 2 -->
                                <div class="tab-pane fade fade-up push-30-t push-50" id="simple-classic-progress-step2">
                                    <div class="form-group {{set_error('address', $errors)}}">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="form-material">
                                                {!! Form::textarea('address',null,['class' => 'form-control','rows' => 4,'placeholder' => 'Provide the adress specified by the donor']) !!}
                                                {!! Form::label('address', 'Address') !!}
                                                {!! get_error('address', $errors) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{set_error('telecaller_id', $errors)}}">
                                        <div class="col-sm-6 col-sm-offset-2">
                                            <div class="form-material">
                                                {!! Form::select('telecaller_id',$telecallerList,null,['class' => 'form-control js-select2','style' => 'width: 100%;','data-placeholder' => 'Choose one..']) !!}
                                                {!! Form::label('telecaller_id', 'Telecaller') !!}
                                                {!! get_error('telecaller_id', $errors) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{set_error('promised_amount', $errors)}}">
                                        <div class="col-sm-6 col-sm-offset-2">
                                            <div class="form-material">
                                                {!! Form::text('promised_amount',old('promised_amount'),['class' => 'form-control','placeholder' => 'Enter the promised amount']) !!}
                                                {!! Form::label('promised_amount', 'Promised Amount') !!}
                                                {!! get_error('promised_amount', $errors) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group {{set_error('appointment', $errors)}}">
                                        <div class="col-sm-6 col-sm-offset-2">
                                            <div class="form-material input-group date datetime-picker">
                                                {!! Form::text('appointment',null,['class' => 'form-control']) !!}
                                                {!! Form::label('appointment', 'Appointment') !!}
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            {!! get_error('appointment', $errors) !!}
                                        </div>
                                    </div>

                                    {!! Form::hidden('location',null) !!}
                                    {!! Form::hidden('latitude',null) !!}
                                    {!! Form::hidden('longitude',null) !!}
                                </div>
                                <!-- END Step 2 -->
                            </div>
                            <!-- END Steps Content -->

                            <!-- Steps Navigation -->
                            <div class="block-content block-content-mini block-content-full border-t">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <button class="wizard-prev btn btn-default" type="button"><i class="fa fa-arrow-left"></i> Previous</button>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <button class="wizard-next btn btn-default" type="button">Next <i class="fa fa-arrow-right"></i></button>
                                        <button class="wizard-finish btn btn-primary" type="submit"><i class="fa fa-check"></i> Submit</button>
                                    </div>
                                </div>
                            </div>
                            <!-- END Steps Navigation -->
                        {!! Form::close() !!}
                        <!-- END Form -->
                    </div>
                    <!-- END Simple Classic Progress Wizard -->
                </div>
                <div class="col-lg-6">
                    @if($errors->first('location'))
                        <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <p>{{ $errors->first('location') }}</p>
                        </div>
                    @endif
                    <!-- Map Markers Map -->
                    <div class="block">
                        <div class="block-content block-content-mini">
                            <div class="form-material input-group">
                                {!! Form::text('location',old('location'),['class' => 'js-search-address form-control','id' => 'location-text-box']) !!}
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <br />
                        <!-- Markers Map Container -->
                        <div id="map-canvas" style="height: 300px;"></div>
                    </div>
                    <!-- END Map Markers Map -->
                </div>
            </div>
            <!-- END Simple Classic Progress Wizard -->
        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    @include('partials._footer')
    <!-- END Footer -->

</div>
<!-- END Page Container -->
@stop


@section('scripts')
@parent
<!-- Page JS Plugins -->
{!! Html::script('assets/js/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') !!}
{!! Html::script('packages/moment/min/moment.min.js') !!}
{!! Html::script('packages/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}
{!! Html::script('assets/js/plugins/jquery-validation/jquery.validate.min.js') !!}
{!! Html::script('assets/js/plugins/select2/select2.full.min.js') !!}
{!! Html::script('https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places') !!}

<!-- Page JS Code -->
{!! Html::script('assets/js/pages/base_forms_wizard.js') !!}
{!! Html::script('js/marklocation.js') !!}
<script>
$(function () {
    App.initHelpers(['select2']);
    $('.filter-autosubmitform').change(function(){
        $(this).parent().submit();
    });
    $('.datetime-picker').datetimepicker();
});
</script>
@stop