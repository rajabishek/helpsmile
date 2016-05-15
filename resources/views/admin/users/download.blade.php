@extends('layouts.master')

@section('title', 'Download Reports')

@section('styles')
{!! Html::style('assets/js/plugins/select2/select2.min.css', [], true) !!}
{!! Html::style('assets/js/plugins/select2/select2-bootstrap.min.css', [], true) !!}
@parent
@stop

@section('content')
<!-- Page Container -->
<div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">
    
    <!-- Sidebar -->
    @include('partials.admin._sidebar')
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
                        Employees
                    </h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Manage</li>
                        <li><a class="link-effect" href="">Employees</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END Page Header -->

        <!-- Page Content -->
        <div class="content">
            <h2 class="content-heading">Download User Reports</h2>
			<div class="row">
				<div class="col-sm-12 col-lg-6">
                    <div class="block block-themed">
                        <div class="block-header bg-primary">
                            <ul class="block-options">
                                <li>
                                    <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                                </li>
                            </ul>
                            <h3 class="block-title">Export as Excel</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <h2 class="font-w300 push"><i class="fa fa-file-excel-o"></i> Excel</h2>
                                    <p>Employee data will will be downloaded as an excel sheet.</p>
                                </div>
                            </div>
						    <div class="row">
						    	<div class="col-md-6">
						    		{!! Form::open(['route' => ['admin.users.postDownload',$domain],'class' => 'form-horizontal push-10-t push-10']) !!}
									    <div class="form-group">
									    	<div class="col-xs-12">
                                                <div class="form-material">
                                                    {!! Form::select('orderby',$orderByList,null,['class' => 'js-select2 form-control']) !!}
                                                    {!! Form::label('orderby','Order By') !!}
                                                </div>                              
                                            </div>
									    </div>
									    <div class="form-group">
									    	<div class="col-xs-12">
                                                <div class="form-material">
                                                    {!! Form::select('ordertype',$orderTypeList,null,['class' => 'js-select2 form-control']) !!} 
                                                    {!! Form::label('ordertype','Order Type') !!}
                                                </div>          
                                            </div>
									    </div>
									    {!! Form::hidden('format','excel') !!}
								    	<button type="submit" class="btn btn-sm btn-success push-5-r push-10"><i class="fa fa-download"></i> Download</button>	
									{!! Form::close() !!}
						    	</div>
						    </div>
						    <br />
                        </div>
                    </div>
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
    });
</script>
@stop