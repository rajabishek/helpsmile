@extends('layouts.master')

@section('title', 'Manage Webhooks')

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
                    <h1 class="page-heading">Webhooks</h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Manage</li>
                        <li><a class="link-effect" href="">Webhooks</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

		<!-- Page Content -->
       	<div class="content">

       		<!-- Normal Modal -->
            <div class="modal fade" id="add-webhook-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent remove-margin-b" id="add-webhook-block">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                <h3 class="block-title">Endpoint</h3>
                            </div>
                            <div class="block-content">
                                <div class="alert alert-danger alert-dismissable" id="webhook-validation-errors" style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                </div>
                                {!! Form::open(['route' =>['admin.webhooks.store',$domain],'class' => 'form-horizontal push-5-t','id' => 'add-webhook-form']) !!}
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <div class="form-material">
                                                {!! Form::text('url',null,['class' => 'form-control','placeholder' => 'Please provide a valid url']) !!}
                                                {!! Form::label('url','URL') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-check"></i> Save</button>
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Normal Modal -->

       		<div class="row">
       			<div class="col-xs-6">
                    <div class="alert alert-danger alert-dismissable" id="webhook-changes-validation-errors" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    <div class="block" id="webhooks-block">
                        <div class="block-header">
                            <ul class="block-options">
                                <li>
                                    <button type="button" id="add-webhook-button" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add New"><i class="si si-plus"></i></button>
                                </li>
                                <li>
                                    <button type="button" id="refresh-webhooks-button" data-toggle="block-option" data-action-mode="demo" data-action="{{ route('admin.webhooks.json',$domain) }}"><i class="si si-refresh"></i></button>
                                </li>
                                <li>
                                    <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                                </li>
                            </ul>
                            <h3 class="block-title">Webhooks</h3>
                        </div>
                        <div class="block-content">
                            @if($webhooks->count())
                                <!-- Default Table -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>URL</th>
                                            <th class="text-center" style="width: 100px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="webhooks-container">
                                        @foreach ($webhooks as $webhook)
                                            <tr data-id="{{ $webhook->id }}">
                                                <td class="url-text">{{ $webhook->url }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs btn-default edit-webhook" type="button" data-toggle="tooltip" title="Edit Webhook"><i class="fa fa-pencil"></i></button>
                                                        <button class="btn btn-xs btn-default delete-webhook" type="button" data-toggle="tooltip" title="Remove Webhook"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- END Default Table -->
                            @else
                                <div class="alert alert-warning">There are no webhooks to display.</div>
                            @endif
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
<script id="Webhook-Template" type="text/x-handlebars-template">
<tr data-id="@{{id}}">
    <td class="url-text">@{{url}}</td>
    <td class="text-center">
        <div class="btn-group">
            <button class="btn btn-xs btn-default edit-webhook" type="button" data-toggle="tooltip" title="Edit Webhook"><i class="fa fa-pencil"></i></button>
            <button class="btn btn-xs btn-default delete-webhook" type="button" data-toggle="tooltip" title="Remove Webhook"><i class="fa fa-times"></i></button>
        </div>
    </td>
</tr>
</script>

<script id="Table-Template" type="text/x-handlebars-template">
<table class="table">
    <thead>
        <tr>
            <th>URL</th>
            <th class="text-center" style="width: 100px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</script>
@parent
{!! Html::script('assets/js/plugins/select2/select2.full.min.js', [], true) !!}
{!! Html::script('packages/handlebars/handlebars.min.js', [], true) !!}
{!! Html::script('js/webhooks.js', [], true) !!}
<script>
	$(function () {
		App.initHelpers(['select2']);
	    $('.filter-autosubmitform').change(function(){ $(this).parents('form:first').submit(); });
	});
</script>
@stop