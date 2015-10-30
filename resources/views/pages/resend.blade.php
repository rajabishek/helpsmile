@extends('layouts.master')

@section('title','Resend Verification')

@section('styles')
@parent
<style type="text/css">
    .form-material .append {
        position: absolute;
        top: 4px;
        right: 10px;
        color: #999;
        line-height: 28px;
    }
</style>
@stop


@section('content')
<!-- Lock Screen Content -->
<div class="content overflow-hidden">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
            <!-- Lock Screen Block -->
            <div class="block block-themed animated bounceIn">
                <div class="block-header bg-primary">
                    <ul class="block-options">
                        <li>
                            <a href="{{ route('home') }}" data-toggle="tooltip" data-placement="left" title="Log in with another account"><i class="si si-login"></i></a>
                        </li>
                    </ul>
                    <h3 class="block-title">Account Locked</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                    <!-- Lock Screen Avatar -->
                    <div class="text-center push-15-t push-15">
                        @include('flash::message')
                        <div class="alert alert-warning">
                            <p>The admin needs to confirm their email address before proceeding.</p>
                        </div>
                    </div>
                    <!-- END Lock Screen Avatar -->

                    <!-- Lock Screen Form -->
                    {!! Form::open(['route' => 'auth.verification.postResend','class' => 'js-validation-lock form-horizontal push-30-t push-30']) !!}
                        <div class="form-group">
                            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
                                <div class="form-material {{set_error('domain', $errors)}}">
                                    {!! Form::text('domain',old('domain'),['class' => 'form-control','id' => 'domain','size' => 20, 'style' => 'padding-right: 120px']) !!}
                                    <span class="append">.helpsmile.net</span>
                                    {!! Form::label('domain', 'Provide the company URL') !!}
                                    {!! get_error('domain', $errors) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
                                <div class="form-material {{set_error('email', $errors)}}">
                                    {!! Form::email('email',old('email'),['class' => 'form-control','placeholder' => "admin's email address"]) !!}
                                    {!! Form::label('email','Email Address') !!}
                                    {!! get_error('email', $errors) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3">
                                <button class="btn btn-block btn-success" type="submit"><i class="si si-paper-plane pull-right"></i> Resend</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!-- END Lock Screen Form -->
                </div>
            </div>
            <!-- END Lock Screen Block -->
        </div>
    </div>
</div>
<!-- END Lock Screen Content -->

<!-- Lock Screen Footer -->
<div class="push-10-t text-center animated fadeInUp">
    <small class="text-black-op font-w600"><span class="js-year-copy"></span> &copy; Helpsmile 1.1</small>
</div>
<!-- END Lock Screen Footer -->
@stop

@section('scripts')
@parent
<!-- Page JS Code -->
<script>
    $(function () {
        // Init page helpers (Appear + CountTo plugins)
        App.initHelpers(['appear', 'appear-countTo']);
    });
</script>
@stop