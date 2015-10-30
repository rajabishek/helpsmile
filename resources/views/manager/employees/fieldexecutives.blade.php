@extends('layouts.master')

@section('title', 'Fieldexecutives')

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
                    <h1 class="page-heading">Fieldexecutives performance</h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Manage</li>
                        <li><a class="link-effect" href="">Fieldexecutives</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Page Content -->
        <div class="content">
            <!-- User Image Widgets -->
            <div class="row">
                @foreach($fieldexecutives as $fieldexecutive)
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <a class="block block-link-hover3" href="javascript:void(0)">
                            <div class="block-content block-content-full text-center">
                                <div>
                                    <img class="img-avatar img-avatar96" src="{{ $fieldexecutive->photocss }}" alt="">
                                </div>
                                <div class="h5 push-15-t push-5">{{ str_limit($fieldexecutive->fullname, 21, $end = '..')}}</div>
                            </div>
                            <div class="block-content text-center">
                                <div class="row items-push">
                                    <div class="col-xs-6">
                                        <div class="h3 push-5">{{ $fieldexecutive->total_donations }}</div>
                                        <div class="h5 font-w300 text-muted">Donations</div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="h3 push-5">₹ {{ $fieldexecutive->total_earnings }}</div>
                                        <div class="h5 font-w300 text-muted">Collected</div>
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