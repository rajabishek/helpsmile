@extends('layouts.master')

@section('title', 'Telecallers')

@section('content')
<!-- Page Container -->
<div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">
    
    <!-- Sidebar -->
    @include('partials.manager._sidebar')
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
                    <h1 class="page-heading">Telecallers performance</h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Manage</li>
                        <li><a class="link-effect" href="">Telecallers</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Page Content -->
        <div class="content">
            <!-- User Image Widgets -->
            <div class="row">
                @foreach($telecallers as $telecaller)
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <a class="block block-link-hover3" href="javascript:void(0)">
                            <div class="block-content block-content-full text-center">
                                <div class="h5 push-15-t push-5">{{ str_limit($telecaller->fullname, 21, $end = '..')}}</div>
                            </div>
                            <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                                <div class="text-center text-muted">{{ $telecaller->mobile }}</div>
                            </div>
                            <div class="block-content text-center">
                                <div class="row items-push">
                                    <div class="col-xs-6">
                                        <div class="h3 push-5">{{ $telecaller->total_donations }}</div>
                                        <div class="h5 font-w300 text-muted">Donations</div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="h3 push-5">₹ {{ $telecaller->total_earnings }}</div>
                                        <div class="h5 font-w300 text-muted">Raised</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <!-- END User Image Widgets -->
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