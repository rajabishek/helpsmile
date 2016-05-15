@extends('layouts.master')

@section('title', 'Donor Details')

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
                    <h1 class="page-heading">
                        Donor
                    </h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Manage</li>
                        <li><a class="link-effect" href="">Donors</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END Page Header -->

        <!-- Page Content -->
        <div class="content">
            <!-- Pop Out Modal -->
            <div class="modal fade" id="delete-donor-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-popout">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent remove-margin-b">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                <h3 class="block-title">Remove donor ?</h3>
                            </div>
                            <div class="block-content">
                                 <p>Are you sure you want to remove the donor details. Helpsmile will no longer have access to the donor's contact information and all of the donor's donation details will be removed completely. This also means that no one from the organisation will be able to reach the donor for collecting their contribution.</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['route' => ['teamleader.donors.destroy',$domain,$donor->id],'method' => 'DELETE']) !!}
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                {!! Form::submit('Remove',array('class' => 'btn btn-danger')) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Pop Out Modal -->

            <!-- Password Change Modal -->
            <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"id="change-donor-details-modal">
                <div class="modal-dialog modal-sm modal-dialog-popout" >
                    <div class="modal-content">
                        <div class="block block-themed block-transparent remove-margin-b" id="change-donor-details-block">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                <h3 class="block-title">Edit donor details</h3>
                            </div>
                            <div class="block-content">
                                <div class="alert alert-danger alert-dismissable" id="change-donor-details-validation-errors" style="display:none;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                </div>
                                {!! Form::model($donor,['route' => ['teamleader.donors.update',$domain,$donor->id],'method' => 'PUT','class' => 'form-horizontal push-10-t push-10','id' => 'change-donor-details-form']) !!}
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <div class="form-material">
                                                {!! Form::text('fullname',null,['class' => 'form-control']) !!}
                                                {!! Form::label('fullname','Fullname') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <div class="form-material">
                                                {!! Form::email('email',null,['class' => 'form-control']) !!}
                                                {!! Form::label('email','Email Address') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            <div class="form-material">
                                                {!! Form::text('mobile',null,['class' => 'form-control']) !!}
                                                {!! Form::label('mobile','Mobile') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-12">
                                            {!! Form::submit('Change Details',['class' => 'btn btn-sm btn-primary']) !!}
                                        </div>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Password Change Modal -->

            <div class="row">
                <div class="col-md-5 col-xs-12">
                    @include('flash::message')
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Donor Details</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-user-information donor-information">
                                        <tbody>
                                            <tr>
                                                <td>Name</td>
                                                <td class="donor-fullname">{{$donor->fullname}}</td>
                                            </tr>
                                            <tr>
                                                <td>Mobile</td>
                                                <td class="donor-mobile">{{$donor->mobile}}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td class="donor-email">{{$donor->email}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <a class="btn btn-sm btn-success" type="submit" href="{{ route('teamleader.donor.donations.create',[$domain,$donor->id]) }}"><i class="fa fa-plus push-5-r"></i> Add Donation</a>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-xs-12">
                                    <a data-toggle="modal" data-target="#change-donor-details-modal" data-original-title="Remove Plan" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i>
                                    </a>
                                    <span class="pull-right">
                                        <a data-toggle="modal" data-target="#delete-donor-modal" data-original-title="Remove Plan" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <br />
                    </div>
                </div>
                <div class="col-md-7 col-xs-12">
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Donations</h3>
                        </div>
                        <div class="block-content">
                            @if($donor->donations()->count())
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Promised Amount</th>
                                                <th>Telecaller</th>
                                                <th class="hidden-xs" style="width: 15%;">Status</th>
                                                <th class="text-center" style="width: 100px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($donor->donations()->paginate(5) as $donation)
                                                <tr>
                                                    <td><a href="{{ route('teamleader.donations.show',[$domain,$donation->id]) }}">{{ $donation->promised_amount }} Rs</a></td>
                                                    <td>{{ $donation->telecaller->fullname }}</td>
                                                    <td class="hidden-xs">
                                                        <span class="{{ $donation->getStatusClass() }}">{{ $donation->status }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a class="btn btn-xs btn-default" data-toggle="tooltip" title="Edit Donation" href="{{route('teamleader.donations.edit',[$domain,$donation->id])}}"><i class="fa fa-pencil"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center">{{ $donor->donations()->paginate(5)->render() }}</div>
                            @else
                                <div class="alert alert-warning">There are no donations associated with this donor, we suggest you to add one. You can add donations to the donor by <a href="{{ route('teamleader.donations.create') }}">editing</a> the donor.</div>
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
    @parent
    <!-- Page JS Plugins -->
    {!! Html::script('assets/js/plugins/jquery-validation/jquery.validate.min.js') !!}
    <!-- Page JS Code -->
    {!! Html::script('js/editdonor.js') !!}
@stop