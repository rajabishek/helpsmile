@extends('layouts.master')

@section('title','About Us')

@section('content')
<!-- Page Container -->
<div id="page-container" class="sidebar-l sidebar-mini sidebar-o side-scroll header-navbar-fixed header-navbar-transparent">

    <!-- Header -->
    @include('partials.pages._sidebar')
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero Content -->
        <div class="bg-primary-dark">
            <section class="content content-full content-boxed">
                <!-- Section Content -->
                <div class="push-100-t push-50 text-center">
                    <h1 class="h2 text-white push-10 visibility-hidden" data-toggle="appear" data-class="animated fadeInDown">We are passionate people.</h1>
                    <h2 class="h5 text-white-op visibility-hidden" data-toggle="appear" data-class="animated fadeInDown">We are creating products that you'll love to use. Let us introduce ourselves.</h2>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Hero Content -->

        <!-- About Info -->
        <div class="bg-white">
            <section class="content content-boxed">
                <!-- Section Content -->
                <div class="row items-push push-20-t nice-copy">
                    <div class="col-md-6">
                        <h3 class="h5 font-w600 text-uppercase push-10">Who are you?</h3>
                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        <h3 class="h5 font-w600 text-uppercase push-10">What can you do for me?</h3>
                        <p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh orci et.</p>
                        <h3 class="h5 font-w600 text-uppercase push-10">What are you currently working on?</h3>
                        <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                    </div>
                    <div class="col-md-6">
                        <!-- Company Timeline -->
                        <div class="block block-transparent">
                            <div class="block-content">
                                <ul class="list list-timeline pull-t">
                                    <li class="visibility-hidden" data-toggle="appear" data-class="animated fadeInRight">
                                        <div class="list-timeline-time">2012</div>
                                        <i class="si si-bulb list-timeline-icon bg-warning"></i>
                                        <div class="list-timeline-content">
                                            <p class="font-w600">The idea was born!</p>
                                            <p class="font-s13">Super excited!</p>
                                        </div>
                                    </li>
                                    <li class="visibility-hidden" data-toggle="appear" data-timeout="100" data-class="animated fadeInRight">
                                        <div class="list-timeline-time">2013</div>
                                        <i class="si si-speedometer list-timeline-icon bg-city"></i>
                                        <div class="list-timeline-content">
                                            <p class="font-w600">Start Up time!</p>
                                            <p class="font-s13">We started and wished for the best!</p>
                                        </div>
                                    </li>
                                    <li class="visibility-hidden" data-toggle="appear" data-timeout="200" data-class="animated fadeInRight">
                                        <div class="list-timeline-time">2014</div>
                                        <i class="si si-briefcase list-timeline-icon bg-smooth"></i>
                                        <div class="list-timeline-content">
                                            <p class="font-w600">5 products created!</p>
                                            <p class="font-s13">Amazing times!</p>
                                        </div>
                                    </li>
                                    <li class="visibility-hidden" data-toggle="appear" data-timeout="300" data-class="animated fadeInRight">
                                        <div class="list-timeline-time">2014</div>
                                        <i class="fa fa-user-plus list-timeline-icon bg-success"></i>
                                        <div class="list-timeline-content">
                                            <p class="font-w600">+ 2 Amazing people joined us!</p>
                                            <ul class="nav-users push-10-t push">
                                                <li>
                                                    <a href="base_pages_profile.html">
                                                        <img class="img-avatar" src="assets/img/avatars/avatar3.jpg" alt="">
                                                        <i class="fa fa-circle text-success"></i> Linda Moore
                                                        <div class="font-w400 text-muted"><small>Web Designer</small></div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="base_pages_profile.html">
                                                        <img class="img-avatar" src="assets/img/avatars/avatar13.jpg" alt="">
                                                        <i class="fa fa-circle text-success"></i> Adam Hall
                                                        <div class="font-w400 text-muted"><small>Web Developer</small></div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="visibility-hidden" data-toggle="appear" data-timeout="400" data-class="animated fadeInRight">
                                        <div class="list-timeline-time">2015</div>
                                        <i class="si si-like list-timeline-icon bg-primary"></i>
                                        <div class="list-timeline-content">
                                            <p class="font-w600">We continue strong!</p>
                                            <p class="font-s13">With over 100 clients and 15 on going projects!</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- END Company Timeline -->
                    </div>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END About Info -->

        <!-- Get Started -->
        <div class="bg-gray-lighter">
            <section class="content content-full content-boxed">
                <!-- Section Content -->
                <div class="push-20-t push-20 text-center">
                    <h3 class="h4 push-20 visibility-hidden" data-toggle="appear">We would love to work together!</h3>
                    <a class="btn btn-rounded btn-noborder btn-lg btn-success visibility-hidden" data-toggle="appear" data-class="animated bounceIn" href="frontend_contact.html">Get In Touch Today</a>
                </div>
                <!-- Section Content END -->
            </section>
        </div>
        <!-- END Get Started -->

        <!-- People -->
        <div class="bg-image" style="background-image: url('assets/img/photos/photo6@2x.jpg');">
            <div class="bg-primary-dark-op">
                <section class="content content-full content-boxed">
                    <!-- Section Content -->
                    <div class="row items-push-2x push-50-t text-center">
                        <div class="col-sm-4 visibility-hidden" data-toggle="appear" data-offset="-150">
                            <img class="img-avatar img-avatar-thumb" src="assets/img/avatars/avatar4.jpg" alt="">
                            <div class="h4 text-white-op push-10-t push-5">Amy Hunter</div>
                            <div class="h6 text-gray">Photographer</div>
                        </div>
                        <div class="col-sm-4 visibility-hidden" data-toggle="appear" data-offset="-150" data-timeout="150">
                            <img class="img-avatar img-avatar-thumb" src="assets/img/avatars/avatar16.jpg" alt="">
                            <div class="h4 text-white-op push-10-t push-5">Ryan Hall</div>
                            <div class="h6 text-gray">Web Designer</div>
                        </div>
                        <div class="col-sm-4 visibility-hidden" data-toggle="appear" data-offset="-150" data-timeout="300">
                            <img class="img-avatar img-avatar-thumb" src="assets/img/avatars/avatar5.jpg" alt="">
                            <div class="h4 text-white-op push-10-t push-5">Ann Parker</div>
                            <div class="h6 text-gray">Web Developer</div>
                        </div>
                        <div class="col-sm-4 visibility-hidden" data-toggle="appear" data-offset="-150" data-timeout="50">
                            <img class="img-avatar img-avatar-thumb" src="assets/img/avatars/avatar16.jpg" alt="">
                            <div class="h4 text-white-op push-10-t push-5">John Parker</div>
                            <div class="h6 text-gray">Support</div>
                        </div>
                        <div class="col-sm-4 visibility-hidden" data-toggle="appear" data-offset="-150" data-timeout="200">
                            <img class="img-avatar img-avatar-thumb" src="assets/img/avatars/avatar5.jpg" alt="">
                            <div class="h4 text-white-op push-10-t push-5">Emma Cooper</div>
                            <div class="h6 text-gray">Web Developer</div>
                        </div>
                        <div class="col-sm-4 visibility-hidden" data-toggle="appear" data-offset="-150" data-timeout="350">
                            <img class="img-avatar img-avatar-thumb" src="assets/img/avatars/avatar10.jpg" alt="">
                            <div class="h4 text-white-op push-10-t push-5">Vincent Sims</div>
                            <div class="h6 text-gray">Marketing</div>
                        </div>
                    </div>
                    <!-- END Section Content -->
                </section>
            </div>
        </div>
        <!-- END People -->
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
        // Init page helpers (Appear plugins)
        App.initHelpers(['appear']);
    });
</script>
@stop