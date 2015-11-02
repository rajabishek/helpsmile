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
                    <h1 class="h2 text-white push-10 visibility-hidden" data-toggle="appear" data-class="animated fadeInDown">Support Center.</h1>
                    <h2 class="h5 text-white-op visibility-hidden" data-toggle="appear" data-class="animated fadeInDown">Building products is not our only job. We care about our clients.</h2>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Hero Content -->

        <!-- Categories -->
        <div class="bg-white">
            <section class="content content-boxed overflow-hidden">
                <!-- Section Content -->
                <div class="content-grid">
                    <div class="row">
                        <div class="col-xs-6 col-sm-3 visibility-hidden" data-toggle="appear" data-class="animated fadeInDown">
                            <a class="block block-bordered block-rounded block-link-hover3" href="javascript:void(0)">
                                <div class="block-content block-content-full border-b text-center">
                                    <div class="item">
                                        <i class="si si-user text-amethyst"></i>
                                    </div>
                                </div>
                                <div class="block-content block-content-full block-content-mini">
                                    <span class="font-w600 text-uppercase"><span class="badge badge-default pull-right">23</span> Account</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-6 col-sm-3 visibility-hidden" data-toggle="appear" data-timeout="200" data-class="animated fadeInDown">
                            <a class="block block-bordered block-rounded block-link-hover3" href="javascript:void(0)">
                                <div class="block-content block-content-full border-b text-center">
                                    <div class="item">
                                        <i class="si si-settings text-city"></i>
                                    </div>
                                </div>
                                <div class="block-content block-content-full block-content-mini">
                                    <span class="font-w600 text-uppercase"><span class="badge badge-default pull-right">11</span> Features</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-6 col-sm-3 visibility-hidden" data-toggle="appear" data-timeout="400" data-class="animated fadeInDown">
                            <a class="block block-bordered block-rounded block-link-hover3" href="javascript:void(0)">
                                <div class="block-content block-content-full border-b text-center">
                                    <div class="item">
                                        <i class="si si-target text-flat"></i>
                                    </div>
                                </div>
                                <div class="block-content block-content-full block-content-mini">
                                    <span class="font-w600 text-uppercase"><span class="badge badge-default pull-right">16</span> Services</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-6 col-sm-3 visibility-hidden" data-toggle="appear" data-timeout="600" data-class="animated fadeInDown">
                            <a class="block block-bordered block-rounded block-link-hover3" href="javascript:void(0)">
                                <div class="block-content block-content-full border-b text-center">
                                    <div class="item">
                                        <i class="si si-wallet text-smooth"></i>
                                    </div>
                                </div>
                                <div class="block-content block-content-full block-content-mini">
                                    <span class="font-w600 text-uppercase"><span class="badge badge-default pull-right">19</span> Payment</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Categories -->

        <!-- Search Form -->
        <div class="bg-gray-lighter">
            <section class="content content-full content-boxed">
                <!-- Section Content -->
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <form action="frontend_support.html" method="post">
                            <div class="input-group input-group-lg">
                                <input class="form-control" type="text" placeholder="Search for answers..">
                                <div class="input-group-btn">
                                    <button class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Search Form -->

        <!-- FAQ -->
        <div class="bg-white">
            <section class="content content-full content-boxed">
                <!-- Section Content -->
                <div class="row push-20-t push-20">
                    <div class="col-sm-8 col-sm-offset-2">
                        <!-- Introduction -->
                        <h2 class="h3 font-w600 push-30-t push">Introduction</h2>
                        <div id="frontend-faq1" class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#frontend-faq1" href="#frontend-faq1_q1">Welcome to our service!</a>
                                    </h3>
                                </div>
                                <div id="frontend-faq1_q1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh orci.</p>
                                        <p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh orci.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#frontend-faq1" href="#frontend-faq1_q2">Who are we?</a>
                                    </h3>
                                </div>
                                <div id="frontend-faq1_q2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh orci.</p>
                                        <p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh orci.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#frontend-faq1" href="#frontend-faq1_q3">What are our values?</a>
                                    </h3>
                                </div>
                                <div id="frontend-faq1_q3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>There comes a point in time where you decide that you want to see the world differently. And despite the odds and obstacles that lay in front of you, you won’t be afraid to try. Ordinary people can do extraordinary things.</p>
                                        <p>Everyone here, is here because they are either the best in class or are on the way to be. We’re just a bunch of passionate technology lovers. You will never find someone normal here, we’re the crazy ones!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Introduction -->

                        <!-- Functionality -->
                        <h2 class="h3 font-w600 push-50-t push">Functionality</h2>
                        <div id="frontend-faq2" class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#frontend-faq2" href="#frontend-faq2_q1">What are the key features?</a>
                                    </h3>
                                </div>
                                <div id="frontend-faq2_q1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>We make the process of assigning tasks to field executives really easy.</p>
                                        <p>We provide complete map solution to track every order.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#frontend-faq2" href="#frontend-faq2_q2">Does your App support mobile devices?</a>
                                    </h3>
                                </div>
                                <div id="frontend-faq2_q2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>The website that you are using is completely compatible with all mobile devices.</p>
                                        <p>Even better the field executives have a separate mobile app to receive tasks and collect / deliver the resource.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#frontend-faq2" href="#frontend-faq2_q3">Why should I choose your service?</a>
                                    </h3>
                                </div>
                                <div id="frontend-faq2_q3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>When you can get such a cool service at a very cheap rate, why wouldn't you use such a greate product. I bet you'll start loving us in the first few dayas of trial.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#frontend-faq2" href="#frontend-faq2_q4">Is my data secure?</a>
                                    </h3>
                                </div>
                                <div id="frontend-faq2_q4" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Don't worry. Your data is completely safe with us.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Functionality -->

                        <!-- Payments -->
                        <h2 class="h3 font-w600 push-50-t push">Payments</h2>
                        <div id="frontend-faq3" class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#frontend-faq3" href="#frontend-faq3_q1">Is there any free plan?</a>
                                    </h3>
                                </div>
                                <div id="frontend-faq3_q1" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>There is no free plan, but organisatons can use this SAAS product on a subscription basis for very cheap rate.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#frontend-faq3" href="#frontend-faq3_q2">What are the available payment options?</a>
                                    </h3>
                                </div>
                                <div id="frontend-faq3_q2" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>You can directly write us a cheque or do a wire transfer. Or we have paypal integration that make it easy for us to collect payments.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#frontend-faq3" href="#frontend-faq3_q3">Can multiple people use my account?</a>
                                    </h3>
                                </div>
                                <div id="frontend-faq3_q3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>If your organisation has multiple branches each would require a separate subdomain or account.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Payments -->
                    </div>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END FAQ -->

        <!-- Contact Us -->
        <div class="bg-gray-lighter">
            <section class="content content-full content-boxed">
                <!-- Section Content -->
                <div class="push-20-t push-20 text-center">
                    <h3 class="h4 push-20 visibility-hidden" data-toggle="appear">Can't find what you were looking for?</h3>
                    <a class="btn btn-rounded btn-noborder btn-lg btn-success visibility-hidden" data-toggle="appear" data-class="animated bounceIn" href="{{ route('contact') }}">Contact Us</a>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Contact Us -->
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
        // Init page helpers (Appear plugin)
        App.initHelpers('appear');
    });
</script>
@stop