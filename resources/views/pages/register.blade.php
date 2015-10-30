@extends('layouts.master')

@section('title','Sign Up')

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
<div id="page-container" class="sidebar-l sidebar-mini sidebar-o side-scroll header-navbar-fixed header-navbar-transparent">
    
    <!-- Header -->
    @include('partials.pages._sidebar')
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero Content -->
        <div class="bg-success">
            <section class="content content-full content-boxed overflow-hidden">
                <!-- Section Content -->
                <div class="push-100-t push-50 text-center">
                    <h1 class="h2 text-white push-10 visibility-hidden" data-toggle="appear" data-class="animated fadeInDown">Sign up for a new account.</h1>
                    <h2 class="h5 text-white-op visibility-hidden" data-toggle="appear" data-class="animated fadeInDown">Unlimited ideas. Unlimited power. Unlimited joy. Unlimited opportunities.</h2>
                </div>
                <div class="row visibility-hidden" data-toggle="appear" data-class="animated fadeInUp">
                    <div class="col-sm-8 col-sm-offset-2">
                        <img class="img-responsive pull-b" src="{{ asset('assets/img/various/promo2.jpg') }}" alt="">
                    </div>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Hero Content -->

        <!-- Content -->
        <div class="bg-white">
            <section class="content content-boxed">
                <!-- Section Content -->
                <div class="row items-push push-50-t push-30">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="alert alert-info">
                            <p>The person registering the company with us will be added as the admin for the company. The email address provided below will be used as the admin account for the company. Only the admin is advised to proceed with the following process to register their company.</p>
                        </div>
                        @include('flash::message')

                        {!! Form::open(['route' => 'auth.postRegister','class' => 'js-validation-registration form-horizontal push-30-t push-50','id' => 'registration-form']) !!}
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-6 {{set_error('email', $errors)}}">
                                    <div class="form-material form-material-success">
                                        <input type="email" name="email" class="form-control" id="email" data-toggle="popover" title="" data-placement="top" data-content="This email address will be used for setting up the admin account for the company you are registering." data-original-title="Admin Account" value="{{ old('email') }}" placeholder="Please provide your email">
                                        {!! Form::label('email', 'Email Address') !!}
                                        {!! get_error('email', $errors) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 {{set_error('fullname', $errors)}}">
                                    <div class="form-material form-material-success">
                                        {!! Form::text('fullname',old('fullname'),['class' => 'form-control','id' => 'fullname','placeholder' => 'Please provide your fullname']) !!}
                                        {!! Form::label('fullname', 'Fullname') !!}
                                        {!! get_error('fullname', $errors) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-6 {{set_error('password', $errors)}}">
                                    <div class="form-material form-material-success">
                                        {!! Form::password('password',['class' => 'form-control','id' => 'password','placeholder' => 'Choose a strong password..']) !!}
                                        {!! Form::label('password', 'Password') !!}
                                        {!! get_error('password', $errors) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 {{set_error('password_confirmation', $errors)}}">
                                    <div class="form-material form-material-success">
                                        {!! Form::password('password_confirmation',['class' => 'form-control','id' => 'password_confirmation','placeholder' => '..and confirm it']) !!}
                                        {!! Form::label('password_confirmation', 'Password') !!}
                                        {!! get_error('password_confirmation', $errors) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-6 {{set_error('name', $errors)}}">
                                    <div class="form-material form-material-success">
                                        {!! Form::text('name',old('name'),['class' => 'form-control','id' => 'name','placeholder' => 'Provide the name of your company']) !!}
                                        {!! Form::label('name', 'Company name') !!}
                                        {!! get_error('name', $errors) !!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 {{set_error('domain', $errors)}}">
                                    <div class="form-material form-material-success">
                                        {!! Form::text('domain',old('domain'),['class' => 'form-control','id' => 'domain','size' => 20, 'style' => 'padding-right: 120px']) !!}
                                        <span class="append">.helpsmile.net</span>
                                        {!! Form::label('domain', 'Choose a company URL') !!}
                                        {!! get_error('domain', $errors) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 text-center">
                                    <label class="css-input switch switch-sm switch-success">
                                        <input type="checkbox" id="frontend-signup-terms" name="frontend-signup-terms"><span></span> I agree with <a data-toggle="modal" data-target="#modal-signup-terms" href="#">terms &amp; conditions</a>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button class="btn btn-block btn-success" type="submit"><i class="fa fa-plus pull-right"></i> Sign Up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Content -->

        <!-- Login -->
        <div class="bg-gray-lighter">
            <section class="content content-full content-boxed">
                <!-- Section Content -->
                <div class="push-20-t push-20 text-center">
                    <h3 class="h4 push-20 visibility-hidden" data-toggle="appear">Do you already have an account?</h3>
                    <a class="btn btn-rounded btn-noborder btn-lg btn-success visibility-hidden" data-toggle="appear" data-class="animated bounceIn" href="frontend_login.html">Log In</a>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Login -->

        <!-- Terms Modal -->
        <div class="modal fade" id="modal-signup-terms" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-popout">
                <div class="modal-content">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <ul class="block-options">
                                <li>
                                    <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title">Terms &amp; Conditions</h3>
                        </div>
                        <div class="block-content">
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-sm btn-primary" type="button" data-dismiss="modal"><i class="fa fa-check"></i> I agree</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Terms Modal -->
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    @include('partials.pages._footer')
    <!-- END Footer -->
</div>
<!-- END Page Container -->
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