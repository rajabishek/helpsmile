@extends('layouts.master')

@section('title','Sign In')

@section('content')
<!-- Login Content -->
<div class="content overflow-hidden">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
            <!-- Login Block -->
            <div class="block block-themed animated fadeIn" id="login-block">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <a href="{{ route('password.getEmail',$domain) }}">Forgot Password?</a>
                        </li>
                    </ul>
                    <h3 class="block-title">Login</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                	@include('flash::message')
                	@include('partials._errors')
                	<div class="alert alert-danger alert-dismissable" id="login-validation-errors" style="display:none;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>
                    <!-- Login Title -->
                    <h1 class="h2 font-w600 push-30-t push-5">{{ $organisation->name }}</h1>
                    <p>Welcome, please login.</p>
                    <!-- END Login Title -->

                    <!-- Login Form -->
                    {!! Form::open(['route' => ['auth.postLogin',$organisation->domain],'class' => 'js-validation-login form-horizontal push-30-t push-50','id' => 'login-form']) !!}
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material form-material-primary floating">
                                    {!! Form::text('email',old('email'),['class' => 'form-control','id' => 'email']) !!}
                                    {!! Form::label('email', 'Email Address') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material form-material-primary floating">
                                    {!! Form::password('password',['class' => 'form-control','id' => 'password']) !!}
                                    {!! Form::label('password', 'Password') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="remember" name="remember"><span></span> Remember Me?
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                {!! Form::submit('Log In',['class' => 'btn btn-block btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!-- END Login Form -->
                </div>
            </div>
            <!-- END Login Block -->
        </div>
    </div>
</div>
<!-- END Login Content -->

<!-- Login Footer -->
<div class="push-10-t text-center animated fadeInUp">
    <small class="text-muted font-w600"><span class="js-year-copy"></span> &copy; Helpsmile 1.0</small>
</div>
<!-- END Login Footer -->
@stop

@section('scripts')
	@parent
    <!-- Page JS Plugins -->
    {!! Html::script('assets/js/plugins/jquery-validation/jquery.validate.min.js', [], true) !!}
    <!-- Page JS Code -->
	{!! Html::script('js/login.js', [], true) !!}
@stop