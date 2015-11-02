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
        <div class="bg-image" style="background-image: url('assets/img/various/hero1.jpg');">
            <div class="bg-primary-dark-op">
                <section class="content content-full content-boxed overflow-hidden">
                    <!-- Section Content -->
                    <div class="push-100-t push-50 text-center">
                        <h1 class="h2 text-white push-10 visibility-hidden" data-toggle="appear" data-class="animated fadeInDown">Manage your collection / delivery in one place, online.</h1>
                        <h2 class="h5 text-white-op push-50 visibility-hidden" data-toggle="appear" data-class="animated fadeInDown">Stay organized, track your orders, and build better relationships.</h2>
                        <a class="btn btn-rounded btn-noborder btn-lg btn-primary visibility-hidden" data-toggle="appear" data-class="animated bounceIn" data-timeout="800" href="{{ route('auth.getRegister') }}">Start Using</a>
                    </div>
                    <div class="row visibility-hidden" data-toggle="appear" data-class="animated fadeInUp">
                        <div class="col-sm-8 col-sm-offset-2">
                            <img class="img-responsive pull-b" src="{{ asset('assets/img/various/promo1.jpg') }}" alt="">
                        </div>
                    </div>
                    <!-- END Section Content -->
                </section>
            </div>
        </div>
        <!-- END Hero Content -->

        <!-- Classic Features #1 -->
        <div class="bg-white">
            <section class="content content-boxed">
                <!-- Section Content -->
                <div class="row items-push-3x push-50-t nice-copy">
                    <div class="col-sm-4">
                        <div class="text-center push-30">
                            <span class="item item-2x item-circle border">
                                <i class="si si-rocket"></i>
                            </span>
                        </div>
                        <h3 class="h5 font-w600 text-uppercase text-center push-10">Understand your funding</h3>
                        <p>With Helpsmile, it's easy to track your finances. Add or import your gifts and pledges with Helpsmile so you always know where your funding is at.</p>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-center push">
                            <span class="item item-2x item-circle border">
                                <i class="si si-screen-smartphone"></i>
                            </span>
                        </div>
                        <h3 class="h5 font-w600 text-uppercase text-center push-10">Track every interaction</h3>
                        <p>Fundraising is all about relationships. Use Helpsmile to remember all the calls, asks, letters, thank you's, meetings, and interactions you've had with the people in your network.</p>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-center push">
                            <span class="item item-2x item-circle border">
                                <i class="si si-clock"></i>
                            </span>
                        </div>
                        <h3 class="h5 font-w600 text-uppercase text-center push-10">Organize your to-do's</h3>
                        <p>Spend less time figuring out what to do next. Keep your fundraising to-do's in Helpsmile and say bye-bye to messy paper to-do lists forever.</p>
                    </div>
                </div>
                <div class="row items-push-3x nice-copy">
                    <div class="col-sm-4">
                        <div class="text-center push">
                            <span class="item item-2x item-circle border">
                                <i class="si si-check"></i>
                            </span>
                        </div>
                        <h3 class="h5 font-w600 text-uppercase text-center push-10">Your fundraising address book.</h3>
                        <p>Store the contact information of your donors, prospects, and everyone else who matters in your fundraising. Since Helpsmile lives in the cloud, you can access this information with an internet connection anytime, anywhere.</p>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-center push-30">
                            <span class="item item-2x item-circle border">{less}</span>
                        </div>
                        <h3 class="h5 font-w600 text-uppercase text-center push-10">Easy, intuitive, and friendly.</h3>
                        <p>Built for fundraisers whose primary responsibility isn't fundraising, Helpsmile gives you the power and functionality you need, while still being light and easy to use.</p>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-center push">
                            <span class="item item-2x item-circle border">
                                <i class="si si-speedometer"></i>
                            </span>
                        </div>
                        <h3 class="h5 font-w600 text-uppercase text-center push-10">Customer support from people who've been there.</h3>
                        <p>The Helpsmile support team is made up of former fundraisers who've experienced the pain, privilege, difficulty, and joy of fundraising. We know what fundraising is like and we know the ins and outs of Helpsmile. You can ask us anything.</p>
                    </div>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Classic Features #1 -->

        <!-- Mini Stats -->
        <div class="bg-gray-lighter">
            <section class="content content-boxed">
                <!-- Section Content -->
                <div class="row items-push push-20-t push-20 text-center">
                    <div class="col-sm-4">
                        <div class="h1 push-5" data-toggle="countTo" data-to="15760" data-after="+"></div>
                        <div class="font-w600 text-uppercase text-muted">Accounts Today</div>
                    </div>
                    <div class="col-sm-4">
                        <div class="h1 push-5" data-toggle="countTo" data-to="3890" data-after="+"></div>
                        <div class="font-w600 text-uppercase text-muted">Products</div>
                    </div>
                    <div class="col-sm-4">
                        <div class="h1 push-5" data-toggle="countTo" data-to="890" data-after="+"></div>
                        <div class="font-w600 text-uppercase text-muted">Web Apps</div>
                    </div>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Mini Stats -->

        <!-- Classic Features #2 -->
        <div class="bg-white">
            <section class="content content-boxed">
                <!-- Section Content -->
                <div class="row items-push-3x push-50-t nice-copy">
                    <div class="col-sm-4">
                        <div class="text-center push-30">
                            <span class="item item-2x item-circle border">
                                <i class="si si-compass"></i>
                            </span>
                        </div>
                        <h3 class="h5 font-w600 text-uppercase text-center push-10">Cross Browser Support</h3>
                        <p>OneUI will play nice with all modern browsers such as Chrome, Firefox, Safari, Opera and the latest versions of Internet Explorer (9 and up).</p>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-center push">
                            <span class="item item-2x item-circle border">
                                <i class="si si-book-open"></i>
                            </span>
                        </div>
                        <h3 class="h5 font-w600 text-uppercase text-center push-10">Documentation</h3>
                        <p>OneUI comes packed with a great documentation which covers all the basics to get you familiar with template’s structure and files. It is the best way to get started.</p>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-center push">
                            <span class="item item-2x item-circle border">
                                <i class="si si-rocket"></i>
                            </span>
                        </div>
                        <h3 class="h5 font-w600 text-uppercase text-center push-10">Clean &amp; Commented Code</h3>
                        <p>The code is created with the developer in mind. It is clean, easy to follow, easy to replicate and at the same time well commented, so that you never feel lost.</p>
                    </div>
                </div>
                <div class="row items-push-3x nice-copy">
                    <div class="col-sm-4">
                        <div class="text-center push-30">
                            <span class="item item-2x item-circle border">
                                <i class="si si-wrench"></i>
                            </span>
                        </div>
                        <h3 class="h5 font-w600 text-uppercase text-center push-10">Components</h3>
                        <p>OneUI comes packed with so many unique components. Carefully picked and integrated to enhance and enrich your project with great functionality. Use them anywhere you want.</p>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-center push">
                            <span class="item item-2x item-circle border">
                                <i class="si si-support"></i>
                            </span>
                        </div>
                        <h3 class="h5 font-w600 text-uppercase text-center push-10">Support</h3>
                        <p>By purchasing a license of OneUI, you are eligible to email support. Should you get stuck somewhere or come accross any issue, don’t worry because I am here to provide assistance.</p>
                    </div>
                    <div class="col-sm-4">
                        <div class="text-center push">
                            <span class="item item-2x item-circle border">
                                <i class="si si-heart"></i>
                            </span>
                        </div>
                        <h3 class="h5 font-w600 text-uppercase text-center push-10">Crafted With Love</h3>
                        <p>I love what I do. I pay extra attention to small details and always try delivering the best I can with each project. My goal is to create a great product for you, that will make your life easier.</p>
                    </div>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Classic Features #2 -->

        <!-- Ratings -->
        <div class="bg-image" style="background-image: url('assets/img/photos/photo3@2x.jpg');">
            <div class="bg-primary-dark-op">
                <section class="content content-full content-boxed">
                    <!-- Section Content -->
                    <div class="row items-push-2x push-50-t text-center">
                        <div class="col-sm-4 visibility-hidden" data-toggle="appear" data-offset="-150">
                            <img class="img-avatar img-avatar-thumb" src="{{ asset('assets/img/avatars/avatar6.jpg') }}" alt="">
                            <div class="text-warning push-10-t push-15">
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                            </div>
                            <div class="h4 text-white-op push-5">Professional design in a reliable UI framework! A pure joy to work with!</div>
                            <div class="h6 text-gray">- Evelyn Willis</div>
                        </div>
                        <div class="col-sm-4 visibility-hidden" data-toggle="appear" data-offset="-150" data-timeout="150">
                            <img class="img-avatar img-avatar-thumb" src="{{ asset('assets/img/avatars/avatar16.jpg') }}" alt="">
                            <div class="text-warning push-10-t push-15">
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                            </div>
                            <div class="h4 text-white-op push-5">Awesome support! Our Web Application looks and works great!</div>
                            <div class="h6 text-gray">- Eugene Burke</div>
                        </div>
                        <div class="col-sm-4 visibility-hidden" data-toggle="appear" data-offset="-150" data-timeout="300">
                            <img class="img-avatar img-avatar-thumb" src="{{ asset('assets/img/avatars/avatar6.jpg') }}" alt="">
                            <div class="text-warning push-10-t push-15">
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                                <i class="fa fa-fw fa-star"></i>
                            </div>
                            <div class="h4 text-white-op push-5">Incredible value for money, highly recommended!</div>
                            <div class="h6 text-gray">- Linda Moore</div>
                        </div>
                    </div>
                    <!-- END Section Content -->
                </section>
            </div>
        </div>
        <!-- END Ratings -->

        <!-- Get Started -->
        <div class="bg-gray-lighter">
            <section class="content content-full content-boxed">
                <!-- Section Content -->
                <div class="push-20-t push-20 text-center">
                    <h3 class="h4 push-20 visibility-hidden" data-toggle="appear">Clean design in one powerful package. It was made for your next awesome project.</h3>
                    <a class="btn btn-rounded btn-noborder btn-lg btn-success visibility-hidden" data-toggle="appear" data-class="animated bounceIn" href="frontend_pricing.html">Get Started Today</a>
                </div>
                <!-- END Section Content -->
            </section>
        </div>
        <!-- END Get Started -->
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