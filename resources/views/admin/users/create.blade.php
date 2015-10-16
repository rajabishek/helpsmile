@extends('layouts.master')

@section('title', 'Add Employee')

@section('styles')
{!! Html::style('assets/js/plugins/select2/select2.min.css') !!}
{!! Html::style('assets/js/plugins/select2/select2-bootstrap.min.css') !!}
@parent
@stop

@section('content')
<!-- Page Container -->
<div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">
    
    <!-- Sidebar -->
    @include('partials.admin._sidebar')
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
                        Employees
                    </h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Manage</li>
                        <li><a class="link-effect" href="">Employees</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END Page Header -->

        <!-- Page Content -->
        <div class="content">
            <h2 class="content-heading">Add employee details</h2>
            <div class="row">
				<div class="col-md-6">
					@include('flash::message')
					<!-- END Simple Classic Progress Wizard -->
                    <div class="js-wizard-simple block">
                        <!-- Step Tabs -->
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active">
                                <a href="#simple-classic-progress-step1" data-toggle="tab">1. Personal</a>
                            </li>
                            <li>
                                <a href="#simple-classic-progress-step2" data-toggle="tab">2. Account</a>
                            </li>
                            <li>
                                <a href="#simple-classic-progress-step3" data-toggle="tab">3. Contact</a>
                            </li>
                        </ul>
                        <!-- END Step Tabs -->

                        <!-- Form -->
                        {!! Form::open(['route' => ['admin.users.store',$domain],'class' => 'form-horizontal push-10-t']) !!}
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
                                <div class="tab-pane fade fade-up in push-30-t push-50 active" id="simple-classic-progress-step1" data-step="1">
                                	
                                	<div class="form-group {{set_error('fullname', $errors)}}">
                                        <div class="col-sm-8 col-sm-offset-2">
											<div class="form-material">
                                                {!! Form::text('fullname',null,['class' => 'form-control','placeholder' => "Please enter employee's fullname"]) !!}
                                                {!! Form::label('fullname', 'Full Name') !!}
                                                {!! get_error('fullname', $errors) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{set_error('designation', $errors)}}">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="form-material">
                                                {!! Form::select('designation',$designationList,null,['class' => 'js-select2 form-control']) !!}
                                                {!! Form::label('designation', 'Designation') !!}
                                                {!! get_error('designation', $errors) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Step 1 -->

                                <!-- Step 2 -->
                                <div class="tab-pane fade fade-up push-30-t push-50" id="simple-classic-progress-step2" data-step="2">
                                    <div class="form-group {{set_error('email', $errors)}}">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="form-material">
                                                {!! Form::email('email',null,['class' => 'form-control','placeholder' => "Enter the employee's email address"]) !!}
                                                {!! Form::label('email', 'Email Address') !!}
                                                {!! get_error('email', $errors) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{set_error('password', $errors)}}">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="form-material">
                                                {!! Form::password('password',['class' => 'form-control','placeholder' => "Please enter password for employee"]) !!}
                                                {!! Form::label('password', 'Password') !!}
                                                {!! get_error('password', $errors) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group {{set_error('password_confirmation', $errors)}}">
                                        <div class="col-sm-8 col-sm-offset-2">
											<div class="form-material">
                                                {!! Form::password('password_confirmation',['class' => 'form-control','placeholder' => 'Confirm the password']) !!}
                                                {!! get_error('password_confirmation', $errors) !!}
                                                {!! Form::label('password_confirmation', 'Password Confirmation : ') !!}         
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Step 2 -->

                                <!-- Step 3 -->
                                <div class="tab-pane fade fade-up push-30-t push-50" id="simple-classic-progress-step3" data-step="3">
                                    <div class="form-group {{set_error('mobile', $errors)}}">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="form-material">
                                                {!! Form::text('mobile',Input::old('mobile'),['class' => 'form-control','placeholder' => 'Provide the mobile number of the employee']) !!}
                                                {!! Form::label('mobile', 'Mobile') !!}
                                                {!! get_error('mobile', $errors) !!}
                                            </div>
                                        </div>
                                    </div>
									<div class="form-group {{set_error('address', $errors)}}">
                                        <div class="col-sm-8 col-sm-offset-2">
                                        	<div class="form-material">
                                                {!! Form::textarea('address',null,['class' => 'form-control','rows' => 3,'placeholder' => 'Provide the residential address of the employee']) !!}
                                                {!! Form::label('address', 'Address') !!}
                                                {!! get_error('address', $errors) !!}   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Step 3 -->
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
{!! Html::script('assets/js/plugins/jquery-validation/jquery.validate.min.js') !!}
{!! Html::script('assets/js/plugins/select2/select2.full.min.js') !!}

<!-- Page JS Code -->
{!! Html::script('assets/js/pages/base_forms_wizard.js') !!}
<script>
    $(function () {
        
        App.initHelpers(['select2']);

        step = $('.has-error:first').closest('.tab-pane').data('step');
        if(step)
            $('.js-wizard-simple').bootstrapWizard('show',step - 1);
    });
</script>
@stop