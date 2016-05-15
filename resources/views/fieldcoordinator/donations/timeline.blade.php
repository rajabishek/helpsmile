@extends('layouts.master')

@section('title', 'Pending Donations')

@section('content')
<!-- Page Container -->
<div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">
    
    <!-- Sidebar -->
    @include('partials.fieldcoordinator._sidebar')
    <!-- END Sidebar -->

    <!-- Header -->
    @include('partials._header')
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        <!-- Page Content -->

		<!-- Page Header -->
		<div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">Pending Donations</h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Manage</li>
                        <li><a class="link-effect" href="">Donations</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

       	<div class="content">
       		<div class="row">
       			<div class="col-sm-12">
					@include('flash::message')
					@if($donations->count())
					<ul class="nav nav-pills pull-right">
					    {!! Navigation::make($domain,Request::path(),'pendingdonationsmenu') !!}
					</ul>
					<!-- Icon Based -->
						<h2 class="content-heading">Pending Donations</h2>
						<div class="block block-themed">
						    <div class="block-header bg-primary">
						        <ul class="block-options">
						            <li>
						                <button type="button" data-toggle="block-option" data-action="fullscreen_toggle"></button>
						            </li>
						            <li>
						                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
						            </li>
						            <li>
						                <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
						            </li>
						        </ul>
						        <h3 class="block-title">Schedule</h3>
						    </div>
						    <div class="block-content">
						        <!-- SlimScroll Container -->
	                        	<div data-toggle="slimscroll" data-height="400px" data-always-visible="true">
	                        		<ul class="list list-timeline pull-t">
							            @foreach($donations as $donation)
							            	<!-- Appointment Notification -->
								            <li>
								                <div class="list-timeline-time">
								                	<span>{{$donation->appointment->format('h:m A')}} - </span> <span>{{$donation->appointment->diffForHumans()}}</span>
								                </div>
								                <i class="fa fa-picture-o list-timeline-icon bg-flat"></i>
								                <div class="list-timeline-content">
								                    <div class="row items-push">
			                                            <div class="col-xs-12 col-sm-6 col-lg-8">
				                                        	<p class="font-w600"><a href="{{ route('fieldcoordinator.donations.show',[$domain,$donation->id]) }}">Appointment</a> with {{ $donation->donor->fullname }}</p>
									                    	<p class="font-s13">{{$donation->fieldexecutive->fullname}} has been assigned to collect money from <a href="{{ route('fieldcoordinator.donors.show',[$domain,$donation->donor->id]) }}">{{ $donation->donor->fullname }}</a>. The donor has promised to provide an amount of {{$donation->promised_amount}} Rs to the organisation.</p>
			                                            </div>
			                                        </div>
								                </div>
								            </li>
								            <!-- END Appointment Notification -->
							            @endforeach
						        	</ul>
						        </div>
						    </div>
						</div>
						<!-- END Icon Based -->
					@else
						<div class="row">
							<div class="col-md-8 col-xs-12">
								<div class="alert alert-danger alert-dismissable">
		                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                            <h3 class="font-w300 push-15">No donation records found</h3>
		                            <p>{{$message}}</p>
		                        </div>
		                        <a href="{{route('fieldcoordinator.donations.getPendingInTimeline',$domain)}}" class="btn btn-warning">Go back <i class="glyphicon glyphicon-arrow-left"></i></a>
							</div>
						</div>
					@endif
				</div>
       		</div>
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
{!! Html::script('assets/js/core/jquery.slimscroll.min.js', [], true) !!}
<script>
    $(function () {
        App.initHelpers('slimscroll');
    });
</script>
@stop