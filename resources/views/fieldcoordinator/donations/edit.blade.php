@extends('layouts.master')

@section('title', 'Edit Donation')

@section('styles')
{{ HTML::style('assets/js/plugins/select2/select2.min.css') }}
{{ HTML::style('assets/js/plugins/select2/select2-bootstrap.min.css') }}
@parent
{{ HTML::style('packages/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}
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
                    <h1 class="page-heading">
                        Donations
                    </h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Manage</li>
                        <li><a class="link-effect" href="">Donations</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END Page Header -->

        <!-- Page Content -->
        <div class="content">
        	<h2 class="content-heading">Edit donation details</h2>
        	@if($donation->status == 'donated' || $donation->status == 'disinterested')
				<div class="row">
					<div class="col-md-6">
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				    		<strong>Oops!</strong> The donation you are trying to change the details has either been completed or the donor was disinterested for the donation. You can't edit the donation details anymore.
						</div>
					</div>
				</div>
			@else
				<div class="row">
					<div class="col-lg-6">
						@include('flash::message')
						@if($donation->status == 'pending')
							<div class="alert alert-warning alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							    A Field coordinator has been assigned for this donation to collect money from the donor. If you update the details of the donation, the changes will reflect everywhere in the chain.
							</div>
						@endif
						<!-- Bootstrap Register -->
						<div class="block">
						    <div class="block-header">
						        <ul class="block-options">
						            <li>
						                <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
						            </li>
						        </ul>
						        <h3 class="block-title">Donation details</h3>
						    </div>
						    <div class="block-content">
						    	{{ Form::open(['route' => ['fieldcoordinator.donations.update', $donation->id], 'method' => 'PUT','class' => 'form-horizontal push-5-t']) }} 
						            <div class="form-group">
						                <div class="col-xs-12 col-md-8 {{set_error('fullname', $errors)}}">
						                    <div class="form-material">
						                    	{{ Form::text(null,$donation->donor->fullname,['class' => 'form-control','disabled']) }}
							                    {{ Form::label('fullname', 'Fullname') }}
												{{ get_error('fullname', $errors) }}
						                    </div>
						                </div>
						            </div>
						            <div class="form-group">
						                <div class="col-xs-12 col-md-8 {{set_error('email', $errors)}}">
						                    <div class="form-material">
						                    	{{ Form::email(null,$donation->donor->email,['class' => 'form-control','disabled']) }}
						                     	{{ Form::label('email', 'Email Address') }}
												{{ get_error('email', $errors) }}
						                    </div>
						                </div>
						            </div>
						            <div class="form-group">
						                
						                <div class="col-xs-12 col-md-8 {{set_error('mobile', $errors)}}">
						                	<div class="form-material">
						                		{{ Form::text(null,$donation->donor->mobile,['class' => 'form-control','disabled']) }}
							                    {{ Form::label('mobile', 'Mobile') }}
												{{ get_error('mobile', $errors) }}
						                	</div>
						                </div>
						            </div>
						            <div class="form-group {{set_error('promised_amount', $errors)}}">
						                
						                <div class="col-xs-12 col-md-8 {{set_error('promised_amount', $errors)}}">
						                	<div class="form-material">
						                		{{ Form::text('promised_amount',$donation->promised_amount,['class' => 'form-control']) }}
							                    {{ Form::label('promised_amount', 'Promised Amount') }}
												{{ get_error('promised_amount', $errors) }}
						                	</div>   
						                </div>
						            </div>

									<div class="form-group">
										<div class="col-xs-12 col-md-8">
											<div class="form-material">
												{{ Form::text('null',$donation->telecaller->fullname,['class' => 'form-control','disabled']) }}
												{{ Form::label('telecaller', 'Telecaller') }}
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-xs-12 col-md-8">
											<div class="form-material">
												{{ Form::text('null',$donation->teamleader->fullname,['class' => 'form-control','disabled']) }}
												{{ Form::label('teamleader', 'Teamleader') }}
											</div>
										</div>
									</div>
									
									@if($donation->fieldexecutive)
										<div class="form-group">
											<div class="col-xs-12 col-md-8 {{set_error('fieldexecutive_id', $errors)}}">
												<div class="form-material">
													{{ Form::select('fieldexecutive_id',$fieldexecutiveList,$donation->fieldexecutive->id,['class' => 'js-select2 form-control','style' => 'width:100%']) }}
													{{ Form::label('fieldexecutive_id', 'Field Executive') }}
													{{ get_error('fieldexecutive_id', $errors) }}
												</div>
											</div>
										</div>
									@else
										<div class="alert alert-warning">
											No field executive has been assigned for this donation. Please assign a fieldexecutive.
										</div>
										<div class="form-group">
											<div class="col-xs-12 col-md-8 {{set_error('fieldexecutive_id', $errors)}}">
												<div class="form-material">
													{{ Form::select('fieldexecutive_id',$fieldexecutiveList,null,['class' => 'js-select2 form-control','style' => 'width:100%']) }}
													{{ Form::label('fieldexecutive_id', 'Field Executive') }}
													{{ get_error('fieldexecutive_id', $errors) }}
												</div>
											</div>
										</div>
									@endif

									<div class="form-group {{set_error('appointment', $errors)}}">
                                        <div class="col-xs-12 col-md-8">
                                            <div class="form-material input-group date datetime-picker">
                                                {{ Form::text('appointment',$donation->appointment->format('m/d/Y g:i A'),['class' => 'form-control']) }}
                                                {{ Form::label('appointment', 'Appointment') }}
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            {{ get_error('appointment', $errors) }}
                                        </div>
                                    </div>

									<div class="form-group">
										<div class="col-xs-12 col-md-8 {{set_error('address', $errors)}}">
											<div class="form-material">
												{{ Form::textarea('address',$donation->address->address,['class' => 'form-control','rows' => 4]) }}
												{{ Form::label('address', 'Address') }}
												{{ get_error('address', $errors) }}
											</div>	
										</div>
									</div>
									{{  Form::hidden('location',$donation->address->location) }}
									{{  Form::hidden('latitude',$donation->address->latitude) }}
									{{  Form::hidden('longitude',$donation->address->longitude) }}
						            <div class="form-group">
						                <div class="col-xs-12">
						                    <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-plus push-5-r"></i> Update</button>
						                </div>
						            </div>
						        {{ Form::close() }}
						    </div>
						</div>
						<!-- END Bootstrap Register -->
					</div>
					<div class="col-lg-6">
	                    @if($errors->first('location'))
	                        <div class="alert alert-danger alert-dismissable">
	                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                            <p>{{ $errors->first('location') }}</p>
	                        </div>
	                    @endif
	                    <!-- Map Markers Map -->
	                    <div class="block">
	                        <div class="block-content block-content-mini">
	                            <div class="form-material input-group">
	                                {{ Form::text('location',old('location'),['class' => 'js-search-address form-control','id' => 'location-text-box']) }}
	                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            	</div>
	                        </div>
	                        <br />
	                        <!-- Markers Map Container -->
	                        <div id="map-canvas" style="height: 300px;"></div>
	                    </div>
	                    <!-- END Map Markers Map -->
	                </div>
				</div>
			@endif
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
<!-- Page JS Plugins -->
{{ HTML::script('assets/js/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}
{{ HTML::script('packages/moment/min/moment.min.js') }}
{{ HTML::script('packages/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}
{{ HTML::script('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}
{{ HTML::script('assets/js/plugins/masked-inputs/jquery.maskedinput.min.js') }}
{{ HTML::script('assets/js/plugins/select2/select2.full.min.js') }}
{{ HTML::script('https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places') }}

<!-- Page JS Code -->
{{ HTML::script('assets/js/pages/base_forms_wizard.js') }}
{{ HTML::script('js/marklocation.js') }}
<script>
$(function () {
    App.initHelpers(['select2','masked-inputs']);
    $('.filter-autosubmitform').change(function(){
        $(this).parent().submit();
    });
    $('.datetime-picker').datetimepicker();
});
</script>
@stop