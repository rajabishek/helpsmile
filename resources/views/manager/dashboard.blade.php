@extends('layouts.master')

@section('title', 'Dashboard')

@section('styles')
@parent
<style type="text/css">
#donations-chart {
    width   : 100%;
    height  : 500px;
}
</style>
@stop

@section('content')
<!-- Page Container -->
<div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">

    <!-- Side Overlay -->
    @include('partials._sideoverlay')
    <!-- END Side Overlay -->
    
    <!-- Sidebar -->
    @include('partials.manager._sidebar')
    <!-- END Sidebar -->

    <!-- Header -->
    @include('partials._header')
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Header -->
        <div class="content bg-image overflow-hidden" style="background-image: url('/assets/img/photos/photo3@2x.jpg');">
            <div class="push-50-t push-15">
                <h1 class="h2 text-white animated zoomIn">Dashboard</h1>
                <h2 class="h5 text-white-op animated zoomIn">Welcome {{ ucwords(Auth::user()->fullname) }}</h2>
            </div>
        </div>
        <!-- END Page Header -->

        <!-- Stats -->
        <div class="content bg-white border-b">
            <div class="row items-push text-uppercase">
                <div class="col-xs-6 col-sm-3">
                    <div class="font-w700 text-gray-darker animated fadeIn">Donations</div>
                    <div class="text-muted animated fadeIn"><small><i class="si si-calendar"></i> Today</small></div>
                    <a class="h2 font-w300 text-primary animated flipInX" href="base_comp_charts.html">{{ $donated }}</a>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="font-w700 text-gray-darker animated fadeIn">Raised</div>
                    <div class="text-muted animated fadeIn"><small><i class="si si-calendar"></i> Today</small></div>
                    <a class="h2 font-w300 text-primary animated flipInX" href="base_comp_charts.html">₹ {{ $raised_today }}</a>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="font-w700 text-gray-darker animated fadeIn">Total Donations</div>
                    <div class="text-muted animated fadeIn"><small><i class="si si-calendar"></i> All Time</small></div>
                    <a class="h2 font-w300 text-primary animated flipInX" href="base_comp_charts.html">{{$donations}}</a>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <div class="font-w700 text-gray-darker animated fadeIn">Total Raised</div>
                    <div class="text-muted animated fadeIn"><small><i class="si si-calendar"></i> All Time</small></div>
                    <a class="h2 font-w300 text-primary animated flipInX" href="base_comp_charts.html">₹ {{$raised}}</a>
                </div>
            </div>
        </div>
        <!-- END Stats -->

        <!-- Page Content -->
        <div class="content">
            <!-- Donation Details -->
            <h2 class="content-heading">Today's Donations Status</h2>
            <!-- Background Colored Donation Details -->
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="block">
                        <table class="block-table text-center">
                            <tbody>
                                <tr>
                                    <td class="bg-primary" style="width: 50%;">
                                        <div class="push-30 push-30-t">
                                            <i class="si si-pin fa-3x text-white-op"></i>
                                        </div>
                                    </td>
                                    <td style="width: 50%;">
                                        <div class="h1 font-w700">{{ $unassigned }}</div>
                                        <div class="h5 text-muted text-uppercase push-5-t">Unassigned</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="block">
                        <table class="block-table text-center">
                            <tbody>
                                <tr>
                                    <td class="bg-info" style="width: 50%;">
                                        <div class="push-30 push-30-t">
                                            <i class="si si-clock fa-3x text-white-op"></i>
                                        </div>
                                    </td>
                                    <td style="width: 50%;">
                                        <div class="h1 font-w700">{{ $pending }}</div>
                                        <div class="h5 text-muted text-uppercase push-5-t">Pending</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="block">
                        <table class="block-table text-center">
                            <tbody>
                                <tr>
                                    <td style="width: 50%;">
                                        <div class="h1 font-w700">{{ $donated }}</div>
                                        <div class="h5 text-muted text-uppercase push-5-t">Donated</div>
                                    </td>
                                    <td class="bg-success" style="width: 50%;">
                                        <div class="push-30 push-30-t">
                                            <i class="si si-check fa-3x text-white-op"></i>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="block">
                        <table class="block-table text-center">
                            <tbody>
                                <tr>
                                    <td style="width: 50%;">
                                        <div class="h1 font-w700">{{ $disinterested }}</div>
                                        <div class="h5 text-muted text-uppercase push-5-t">Disinterested</div>
                                    </td>
                                    <td class="bg-danger" style="width: 50%;">
                                        <div class="push-30 push-30-t">
                                            <i class="si si-close fa-3x text-white-op"></i>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END Background Colored Donation Details --> 


            <!-- Donation Details -->
            <h2 class="content-heading">Overall Donations</h2>
            <!-- Background Colored Donation Details -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="block">
                        <div id="donations-chart"></div>   
                    </div>
                </div>
            </div>
            <!-- END Background Colored Donation Details --> 
             
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

@section('scripts')
@parent
<script src="http://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="http://www.amcharts.com/lib/3/serial.js"></script>
<script src="http://www.amcharts.com/lib/3/themes/light.js"></script>
{!! Html::script('assets/js/core/jquery.slimscroll.min.js') !!}
{!! Html::script('packages/handlebars/handlebars.min.js') !!}

<!-- Page JS Code -->
<script id="notification-template" type="text/x-handlebars-template">
<li>
    <i class="@{{ iconclass }}"></i>
    <div class="font-w600">@{{ title }}</div>
    <div>@{{ description }}</div>
    <div><small class="text-muted">@{{ happened_at }}</small></div>
</li>
</script>
{!! Html::script('js/reporting.js') !!}
{!! Html::script('js/notifications.js') !!}
<script>
    $(function () {
        // Init page helpers (SlimScroll plugin)
        App.initHelpers('slimscroll');
    });
</script>
@stop