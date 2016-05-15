@extends('layouts.master')

@section('title', 'Edit Employee')

@section('styles')
{!! Html::style('assets/js/plugins/select2/select2.min.css', [], true) !!}
{!! Html::style('assets/js/plugins/select2/select2-bootstrap.min.css', [], true) !!}
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
			<div class="row">
				@include('flash::message')
				<div class="col-sm-12 col-lg-6">
					<!-- Edit Employee Deatails -->
					<div class="block block-themed">
					    <div class="block-header bg-success">
					        <ul class="block-options">
					            <li>
					                <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
					            </li>
					        </ul>
					        <h3 class="block-title">Edit {{ $user->fullname }}'s details</h3>
					    </div>
					    <div class="block-content">
					    	{!! Form::model($user, ['route' => ['admin.users.update', $domain, $user->id], 'method' => 'PUT','class' => 'form-horizontal push-10-t push-10']) !!}
					            <div class="form-group {{set_error('email', $errors)}}">
					                <div class="col-xs-12 col-sm-8">
					                    <div class="form-material">
					                    	{!! Form::email('email',null,['class' => 'form-control']) !!}
											{!! Form::label('email', 'Email Address') !!}
											{!! get_error('email', $errors) !!}
					                    </div>
					                </div>
					            </div>
					            <div class="form-group {{set_error('fullname', $errors)}}">
					                <div class="col-xs-12 col-sm-8">
					                   <div class="form-material">
					                   		{!! Form::text('fullname',null,['class' => 'form-control']) !!}
					                    	{!! Form::label('fullname', 'Fullname') !!}
											{!! get_error('fullname', $errors) !!}
					                   </div>
					                </div>
					            </div>
					            <div class="form-group {{set_error('designation', $errors)}}">
					                <div class="col-xs-12 col-sm-8">
					                    <div class="form-material">
					                    	{!! Form::select('designation',$designationList,null,['class' => 'js-select2 form-control']) !!}
						                    {!! Form::label('designation', 'Designation') !!}
											{!! get_error('designation', $errors) !!}
					                    </div>
					                </div>
					            </div>
					            <div class="form-group {{set_error('mobile', $errors)}}">
					                <div class="col-xs-12 col-sm-8">
					                    <div class="form-material">
					                    	{!! Form::text('mobile',null,['class' => 'form-control']) !!}
					                    	{!! Form::label('mobile', 'Mobile') !!}
											{!! get_error('mobile', $errors) !!}
					                    </div>
					                </div>
					            </div>
					            <div class="form-group {{set_error('address', $errors)}}">
					                <div class="col-xs-12">
					                    <div class="form-material">
					                    	{!! Form::textarea('address',null,['class' => 'form-control','rows' => 3]) !!}
					                    	{!! Form::label('address', 'Address') !!}
											{!! get_error('address', $errors) !!}
					                    </div>
					                </div>
					            </div>
					            <div class="alert alert-info">
					            	<p>Type the password only if you want to change the employee's current password.</p>
					            	<p>If you only indent to change his other details you can leave the password fields empty.</p>
					            </div>
					            <div class="form-group {{set_error('password', $errors)}}">
					                <div class="col-xs-12 col-sm-8">
					                   <div class="form-material">
					                   		{!! Form::password('password',['class' => 'form-control','placeholder' => 'Type a new password']) !!}
					                    	{!! Form::label('password', 'New Password') !!}
											{!! get_error('password', $errors) !!}
					                   </div>
					                </div>
					            </div>
					            <div class="form-group {{set_error('password_confirmation', $errors)}}">
					                <div class="col-xs-12 col-sm-8">
					                    <div class="form-material">
					                    	{!! Form::password('password_confirmation',['class' => 'form-control','placeholder' => 'Confirm the new password']) !!}
					                    	{!! Form::label('password_confirmation', 'Password Confirmation') !!}
											{!! get_error('password_confirmation', $errors) !!}
					                    </div>
					                </div>
					            </div>
					            <div class="form-group">
					                <div class="col-xs-12">
					                    <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-plus push-5-r"></i> Update</button>
					                </div>
					            </div>
					        {!! Form::close() !!}
					    </div>
					</div>
					<!-- END Edit Employee Deatails -->
				</div>
			</div>
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
{!! Html::script('assets/js/plugins/select2/select2.full.min.js', [], true) !!}
<script>
	$(function () {
		App.initHelpers(['select2']);
	});
</script>
@stop