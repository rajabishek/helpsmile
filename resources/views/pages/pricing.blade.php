@extends('layouts.master')

@section('title','Home Page')

@section('content')
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
                    <h1 class="h2 text-white push-10 visibility-hidden" data-toggle="appear" data-class="animated fadeInDown">Super flexible plans just for you.</h1>
                    <h2 class="h5 text-white-op visibility-hidden" data-toggle="appear" data-class="animated fadeInDown">Choose the one that fits you best and start building your web application today.</h2>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Hero Content -->

        <!-- Pricing -->
        <div class="bg-white">
            <section class="content content-boxed overflow-hidden">
                <!-- Section Content -->
                <div class="row push-20-t push-20">
                    <div class="col-sm-6 col-lg-4 col-sm-offset-3 col-lg-offset-4 visibility-hidden" data-toggle="appear" data-offset="50" data-timeout="200" data-class="animated fadeInUp">
                        <!-- Startup Plan -->
                        <a class="block block-bordered block-link-hover3 text-center" href="frontend_signup.html">
                            <div class="block-header">
                                <h3 class="block-title text-primary">Startup</h3>
                            </div>
                            <div class="block-content block-content-full bg-gray-lighter">
                                <div class="h1 font-w700 text-primary push-10">$50</div>
                                <div class="h5 font-w300 text-muted">per month</div>
                            </div>
                            <div class="block-content">
                                <table class="table table-borderless table-condensed">
                                    <tbody>
                                        <tr>
                                            <td><strong>10</strong> Employees</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Single</strong> Branch</td>
                                        </tr>
                                        <tr>
                                            <td><strong>50</strong> Field Executives</td>
                                        </tr>
                                        <tr>
                                            <td><strong>FULL</strong> Support</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                                <span class="btn btn-primary">Sign Up</span>
                            </div>
                        </a>
                        <!-- END Startup Plan -->
                    </div>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Pricing -->

        <!-- Get Started -->
        <div class="bg-gray-lighter">
            <section class="content content-full content-boxed">
                <!-- Section Content -->
                <div class="push-20-t push-20 text-center">
                    <h3 class="h4 push-20 visibility-hidden" data-toggle="appear">Imagine the next great thing. Then build it.</h3>
                    <a class="btn btn-rounded btn-noborder btn-lg btn-success visibility-hidden" data-toggle="appear" data-class="animated bounceIn" href="{{ route('auth.getRegister') }}">Get Started Today</a>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Get Started -->

        <!-- Features -->
        <div class="bg-white">
            <section class="content content-full content-boxed">
                <!-- Section Content -->
                <div class="push-20-t push-20 nice-copy">
                    <!-- Circle Mini Features -->
                    <div class="row items-push text-center push-50">
                        <div class="col-xs-4 col-md-2 visibility-hidden" data-toggle="appear" data-offset="-100" data-class="animated bounceIn">
                            <div class="item item-circle bg-white border push-10">
                                <i class="si si-vector text-default"></i>
                            </div>
                            <div class="font-w600">Design</div>
                        </div>
                        <div class="col-xs-4 col-md-2 visibility-hidden" data-toggle="appear" data-offset="-100" data-class="animated bounceIn" data-timeout="150">
                            <div class="item item-circle bg-white border push-10">
                                <i class="si si-badge text-flat"></i>
                            </div>
                            <div class="font-w600">Quality</div>
                        </div>
                        <div class="col-xs-4 col-md-2 visibility-hidden" data-toggle="appear" data-offset="-100" data-class="animated bounceIn" data-timeout="300">
                            <div class="item item-circle bg-white border push-10">
                                <i class="si si-chemistry text-smooth"></i>
                            </div>
                            <div class="font-w600">Creativity</div>
                        </div>
                        <div class="col-xs-4 col-md-2 visibility-hidden" data-toggle="appear" data-offset="-100" data-class="animated bounceIn" data-timeout="450">
                            <div class="item item-circle bg-white border push-10">
                                <i class="si si-heart text-city"></i>
                            </div>
                            <div class="font-w600">Passion</div>
                        </div>
                        <div class="col-xs-4 col-md-2 visibility-hidden" data-toggle="appear" data-offset="-100" data-class="animated bounceIn" data-timeout="600">
                            <div class="item item-circle bg-white border push-10">
                                <i class="si si-clock text-modern"></i>
                            </div>
                            <div class="font-w600">Time</div>
                        </div>
                        <div class="col-xs-4 col-md-2 visibility-hidden" data-toggle="appear" data-offset="-100" data-class="animated bounceIn" data-timeout="750">
                            <div class="item item-circle bg-white border push-10">
                                <i class="si si-drop text-warning"></i>
                            </div>
                            <div class="font-w600">Colors</div>
                        </div>
                    </div>
                    <!-- END Circle Mini Features -->

                    <!-- Feature List -->
                    <div class="row items-push">
                        <div class="col-sm-6">
                            <h3 class="h5 font-w600 text-uppercase push-10"><i class="fa fa-check text-primary push-5-r"></i> Support</h3>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        </div>
                        <div class="col-sm-6">
                            <h3 class="h5 font-w600 text-uppercase push-10"><i class="fa fa-check text-primary push-5-r"></i> Rich Features</h3>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        </div>
                    </div>
                    <div class="row items-push">
                        <div class="col-sm-6">
                            <h3 class="h5 font-w600 text-uppercase push-10"><i class="fa fa-check text-primary push-5-r"></i> Updates</h3>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        </div>
                        <div class="col-sm-6">
                            <h3 class="h5 font-w600 text-uppercase push-10"><i class="fa fa-check text-primary push-5-r"></i> Services</h3>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        </div>
                    </div>
                    <div class="row items-push">
                        <div class="col-sm-6">
                            <h3 class="h5 font-w600 text-uppercase push-10"><i class="fa fa-check text-primary push-5-r"></i> Versions</h3>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        </div>
                        <div class="col-sm-6">
                            <h3 class="h5 font-w600 text-uppercase push-10"><i class="fa fa-check text-primary push-5-r"></i> Applications</h3>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                        </div>
                    </div>
                    <!-- END Feature List -->
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Features -->

        <!-- Mini Stats -->
        <div class="bg-image" style="background-image: url('assets/img/various/hero1.jpg');">
            <div class="bg-primary-dark-op">
                <section class="content content-boxed overflow-hidden">
                    <!-- Section Content -->
                    <div class="row items-push push-20-t push-20 text-center">
                        <div class="col-sm-4">
                            <div class="h1 text-white push-5" data-toggle="countTo" data-to="15760" data-after="+"></div>
                            <div class="font-w600 text-uppercase text-white-op">Accounts Today</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="h1 text-white push-5" data-toggle="countTo" data-to="3890" data-after="+"></div>
                            <div class="font-w600 text-uppercase text-white-op">Products</div>
                        </div>
                        <div class="col-sm-4">
                            <div class="h1 text-white push-5" data-toggle="countTo" data-to="890" data-after="+"></div>
                            <div class="font-w600 text-uppercase text-white-op">Web Apps</div>
                        </div>
                    </div>
                    <!-- END Section Content -->
                </section>
            </div>
        </div>
        <!-- END Mini Stats -->
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