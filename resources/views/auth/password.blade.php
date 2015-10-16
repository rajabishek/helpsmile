@extends('layouts.master')

@section('title','Password Reminder')

@section('content')
<!-- Reminder Content -->
<div class="content overflow-hidden">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
            <!-- Reminder Block -->
            <div class="block block-themed animated fadeIn" id="reminder-block">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <a href="{{ route('auth.getLogin',$domain) }}" data-toggle="tooltip" data-placement="left" title="Log In"><i class="si si-login"></i></a>
                        </li>
                    </ul>
                    <h3 class="block-title">Password Reminder</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                	@include('flash::message')
                	<div class="alert alert-danger alert-dismissable" id="reminder-messages" style="display:none;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>
                    <!-- Reminder Title -->
                    <h1 class="h2 font-w600 push-30-t push-5">{{ $organisation->name }}</h1>
                    <p>Please provide your account’s email and we will send you your password.</p>
                    <!-- END Reminder Title -->

                    <!-- Reminder Form -->
                    {!! Form::open(['class' => 'js-validation-reminder form-horizontal push-30-t push-50','id' => 'reminder-form'])!!}
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material form-material-primary floating">
                                    {!! Form::text('email',Input::old('email'),['class' => 'form-control','id' => 'email']) !!}
                                    {!! Form::label('email', 'Email Address') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-6 col-md-5">
                                {!! Form::submit('Send Mail',['class' => 'btn btn-block btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!-- END Reminder Form -->
                </div>
            </div>
            <!-- END Reminder Block -->
        </div>
    </div>
</div>
<!-- END Reminder Content -->

<!-- Reminder Footer -->
<div class="push-10-t text-center animated fadeInUp">
    <small class="text-muted font-w600"><span class="js-year-copy"></span> &copy; Helpsmile 1.0</small>
</div>
<!-- END Reminder Footer -->
@stop

@section('scripts')
@parent
<!-- Page JS Plugins -->
{!! Html::script('assets/js/plugins/jquery-validation/jquery.validate.min.js') !!}

<!-- Page JS Code -->
{!! Html::script('js/reminder.js') !!}
@stop