@extends('layouts.master')

@section('title', 'Donors')

@section('content')
<!-- Page Container -->
<div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">
    
    <!-- Sidebar -->
    @include('partials.teamleader._sidebar')
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
                    <h1 class="page-heading">Donors</h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Manage</li>
                        <li><a class="link-effect" href="">Donors</a></li>
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
			    	@if($donors->count())
						<!-- Donor Bordered Table -->
						<div class="block">
						    <div class="block-header">
						        <h3 class="block-title">
						        	@if(isset($term))
										Showing all donors ({{ $donors->count() }}) for search term "{{$term}}"
									@else
										Showing all donors ({{ $donors->count() }})
									@endif
						        </h3>
						    </div>
						    <div class="block-content">
						        <div class="row">
									<div class="col-md-8 col-xs-12">
										<h4 class="font-w300 push">Why not try a fuzzy search</h4>
										{!! Form::open(['route' => ['teamleader.donors.index',$domain], 'method' => 'GET']) !!}
										<div class="form-material input-group">
			                                {!! Form::text('q',null,['class' => 'form-control','placeholder' => 'You can search for literally anything']) !!}
			                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
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
									                    <th>Mobile</th>
									                 	<th>Email</th>
		                                                <th class="text-center" style="width: 100px;">Actions</th>
									                </tr>
									            </thead>
									            <tbody>
									                @foreach($donors as $donor)
														<tr>
									                        <td><a class="link-effect" href="{{ route('teamleader.donors.show',[$domain,$donor->id]) }}">{{ $donor->fullname }}</a></td>
														    <td>{{ $donor->mobile }}</td>
														    <td>{{ $donor->email }}</td>
									                        <td class="text-center">
									                            <div class="btn-group">
									                                <a class="btn btn-xs btn-default" data-toggle="tooltip" title="Add Donation" href="{{ route('teamleader.donor.donations.create',[$domain,$donor->id]) }}"><i class="fa fa-plus"></i></a>
									                            </div>
									                        </td>
									                    </tr>
									                @endforeach
									            </tbody>
									        </table>
										</div>
									</div>
								</div>
								<div class="text-center">{!! $donors->appends(Request::only('q','teamleader'))->render() !!}</div>
						    </div>
						</div>
						<!-- END Donor Bordered Table -->
					@else
						<div class="row">
							<div class="col-md-8 col-xs-12">
								<div class="alert alert-danger alert-dismissable">
		                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		                            <h3 class="font-w300 push-15">No donor record's found</h3>
		                            <p>{{$message}}</p>
		                        </div>
		                        <a href="{{route('teamleader.donors.index',$domain)}}" class="btn btn-warning">Go back <i class="glyphicon glyphicon-arrow-left"></i></a>
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
<script>
$(function () {
    $('.filter-autosubmitform').change(function(){ $(this).parent().submit(); });
});
</script>
@stop