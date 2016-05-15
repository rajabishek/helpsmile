@extends('layouts.master')

@section('title', 'Donation Details')

@section('styles')
{!! Html::style('assets/js/plugins/select2/select2.min.css', [], true) !!}
{!! Html::style('assets/js/plugins/select2/select2-bootstrap.min.css', [], true) !!}
@parent
@stop

@section('meta')
    <meta name="latitude" content="{{ $donation->address->latitude }}">
    <meta name="longitude" content="{{ $donation->address->longitude }}">
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
            <!-- Pop Out Modal -->
            <div class="modal fade" id="modal-popout" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-popout">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent remove-margin-b">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                <h3 class="block-title">Remove donation ?</h3>
                            </div>
                            <div class="block-content">
                                 <p>Are you sure you want to remove the donation details. Helpsmile will no longer have access to the donation's contact information, and thus no one will be able to reach the donation for collecting their contribution.</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['route' => ['fieldcoordinator.donations.destroy',$domain,$donation->id],'method' => 'DELETE']) !!}
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                {!! Form::submit('Remove',array('class' => 'btn btn-danger')) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Pop Out Modal -->

            <div class="row">
                <div class="col-lg-6">
                    @include('flash::message')
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">{{$donation->donor->fullname}}</h3>
                        </div>
                        <div class="block-content">
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td>Full Name</td>
                                        <td>{{$donation->donor->fullname}}</td>
                                    </tr>
                                    <tr>
                                        <td>Mobile</td>
                                        <td>{{$donation->donor->mobile}}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{$donation->address->address}}</td>
                                    </tr>
                                     <tr>
                                        <td>Teamleader</td>
                                        <td>{{$donation->teamleader->fullname}}</td>
                                    </tr>
                                    <tr>
                                        <td>Telecaller</td>
                                        <td>{{$donation->telecaller->fullname}}</td>
                                    </tr>
                                    @if($donation->fieldexecutive)
                                        <tr>
                                            <td>Field Executive</td>
                                            <td>{{$donation->fieldexecutive->fullname}}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>Field Executive</td>
                                            <td>Not yet assigned</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Appointment Time</td>
                                        <td>{{$donation->appointment->toDayDateTimeString()}}</td>
                                    </tr>
                                    <tr>
                                    <tr>
                                        <td>Promised Amount</td>
                                        <td>{{$donation->promised_amount}}</td>
                                    </tr>
                                    @if($donation->status == 'donated')
                                        <tr>
                                            <td>Donated Amount</td>
                                            <td>{{$donation->donated_amount}}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Status</td>
                                        <td>{{$donation->getStatusMessage() }}</td>
                                    </tr>
                                    <tr>
                                        <td>Location: </td>
                                        <td>{{$donation->address->location}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @if($donation->status == 'unassigned')
                                {!! Form::open(['route' => ['fieldcoordinator.donations.postAssign',$domain,$donation->id],'class' => 'form-inline']) !!}
                                    {!! Form::label('fieldexecutive_id','Field Executive :') !!}
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <div class="form-material">
                                                {!! Form::select('fieldexecutive_id',$fieldexecutiveList,null,['class' => 'js-select2 form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::submit('Assign',['class' => 'btn btn-success']) !!}
                                {!! Form::close() !!}
                            @endif
                            <br />
                            <a type="button" class="btn btn-sm btn-warning" href="{{route('fieldcoordinator.donations.edit',[$domain,$donation->donor->id])}}"><i class="glyphicon glyphicon-edit"></i></a>
                            <span class="pull-right">
                            <a data-toggle="modal" data-target="#modal-popout" data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                            </span>
                        </div>
                        <br />
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- Map Markers Map -->
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Map Location</h3>
                        </div>
                        <!-- Markers Map Container -->
                        <div id="map-canvas" style="height: 350px;"></div>
                    </div>
                    <!-- END Map Markers Map -->
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
<!-- Page JS Plugins -->
{!! Html::script('assets/js/plugins/select2/select2.full.min.js', [], true) !!}
{!! Html::script('https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places') !!}

<!-- Page JS Code -->
{!! Html::script('js/plotmap.js', [], true) !!}
<script>
    $(function () {
        App.initHelpers(['select2']);
    });
</script>
@stop
