@extends('layouts.master')

@section('title', 'Disinterested Donations')

@section('styles')
{!! Html::style('assets/js/plugins/select2/select2.min.css', [], true) !!}
{!! Html::style('assets/js/plugins/select2/select2-bootstrap.min.css', [], true) !!}
@parent
@stop


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

    	<!-- Page Header -->
		<div class="content bg-gray-lighter">
            <div class="row items-push">
                <div class="col-sm-7">
                    <h1 class="page-heading">Disinterested Donations</h1>
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

        <!-- Page Content -->
       	<div class="content">
       		<div class="row">
       			<div class="col-sm-12">
					@include('flash::message')
			    	@if($donations->count())
						<!-- Donor Bordered Table -->
						<div class="block">
						    <div class="block-header">
						        <h3 class="block-title">
						        	@if(isset($term))
										Showing all donations ({{ $donations->count() }}) for search term "{{$term}}"
									@else
										Showing all donations ({{ $donations->count() }})
									@endif
						        </h3>
						    </div>
						    <div class="block-content">
						        <div class="row">
									<div class="col-md-8 col-xs-12">
										<div class="col-xs-12">
											<h4 class="font-w300 push">Why not try a fuzzy search</h4>
										</div>
										{!! Form::open(['route' => ['fieldcoordinator.donations.getDisinterested',$domain], 'method' => 'GET']) !!}
			                            <div class="form-group">
	                                        <div class="col-xs-12">
	                                            <div class="form-material input-group">
	                                            	{!! Form::text('q',null,['class' => 'form-control','placeholder' => 'You can search for literally anything']) !!}
			                                	<span class="input-group-addon"><i class="fa fa-search"></i></span>
	                                            </div>
	                                        </div>
		                                </div>
										{!! Form::close() !!}
									</div>
									<div class="col-md-4 col-xs-12">
										<div class="col-xs-12">
											<h4 class="font-w300 push">Filter by teamleaders</h4>
										</div>
										{!! Form::open(['route' => ['fieldcoordinator.donations.getDisinterested',$domain], 'method' => 'GET']) !!}
									    	<div class="form-group">
		                                        <div class="col-xs-12">
		                                            <div class="form-material">
		                                                {!! Form::select('teamleader',$teamleadersList,Request::get('teamleader'),['class' => 'form-control js-select2 filter-autosubmitform','style' => 'width: 100%;']) !!}
		                                            </div>
		                                        </div>
		                                    </div>
										{!! Form::close() !!}
									</div>
								</div>
								<br />
								<div class="row">
									<div class="col-sm-12">
										<div class="table-responsive">
											<table class="table table-bordered">
									            <thead>
									                <tr>
									                    <th>Name</th>
									                 	<th class="hidden-xs">Promised Amount</th>
									                 	<th class="hidden-xs">Teamleader</th>
									                  	<th>Appointment</th>
		                                                <th class="text-center" style="width: 100px;">Actions</th>
									                </tr>
									            </thead>
									            <tbody>
									                @foreach($donations as $donation)
														<tr>
									                        <td><a href="{{route('fieldcoordinator.donors.show',[$domain,$donation->donor->id])}}" class="link-effect">{{ $donation->donor->fullname }}</a></td>
														    <td class="hidden-xs">{{ $donation->promised_amount }}</td>
														    <td class="hidden-xs">{{ $donation->teamleader->fullname }}</td>
														    <td><a href="{{route('fieldcoordinator.donations.show',[$domain,$donation->id])}}" class="link-effect">{{ $donation->appointment->toDayDateTimeString() }}</a></td>
									                        <td class="text-center">
									                            <div class="btn-group">
									                                <a class="btn btn-xs btn-default" data-toggle="tooltip" title="Edit Donation" href="{{route('fieldcoordinator.donations.edit',[$domain,$donation->id])}}"><i class="fa fa-pencil"></i></a>
									                            </div>
									                        </td>
									                    </tr>
									                @endforeach
									            </tbody>
									        </table>
								        </div>
									</div>
								</div>
								<div class="text-center">{!! $donations->appends(Request::only('q','teamleader'))->render() !!}</div>
						    </div>
						</div>
						<!-- END Donor Bordered Table -->
					@else
						<div class="row">
							<div class="col-md-8 col-xs-12">
								<div class="alert alert-danger alert-dismissable">
		                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                            <h3 class="font-w300 push-15">No donation records found</h3>
		                            <p>{{$message}}</p>
		                        </div>
		                        <a href="{{route('fieldcoordinator.donations.getDisinterested',$domain)}}" class="btn btn-warning">Go back <i class="glyphicon glyphicon-arrow-left"></i></a>
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
{!! Html::script('assets/js/plugins/select2/select2.full.min.js', [], true) !!}
<script>
	$(function () {
		App.initHelpers(['select2']);
	    $('.filter-autosubmitform').change(function(){ $(this).parents('form:first').submit(); });
	});
</script>
@stop