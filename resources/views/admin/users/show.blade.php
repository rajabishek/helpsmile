@extends('layouts.master')

@section('title', 'Employee Details')

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
                        Users
                    </h1>
                </div>
                <div class="col-sm-5 text-right hidden-xs">
                    <ol class="breadcrumb push-10-t">
                        <li>Manage</li>
                        <li><a class="link-effect" href="">Users</a></li>
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
                                <h3 class="block-title">Remove employee ?</h3>
                            </div>
                            <div class="block-content">
                                 <p>Are you sure you want remove {{$user->fullname}} from your organisation ?</p>
                                 <p>Once the employee is remove from you organisation, you will no longer be able to access the his/her information and monitor their progress.</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(['route' => ['admin.users.destroy',$domain,$user->id], 'method' => 'DELETE']) !!}
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
                    <div class="block block-themed">
                        <div class="block-header bg-info">
                            <ul class="block-options">
                                <li>
                                    <button type="button"><i class="si si-settings"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title">{{$user->fullname}}</h3>
                        </div>
                        <div class="block-content">
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
			                            <td>Full Name</td>
			                            <td>{{$user->fullname}}</td>
			                        </tr>
			                        <tr>
			                            <td>Email</td>
			                            <td>{{$user->email}}</td>
			                        </tr>
			                        <tr>
			                            <td>Designation</td>
			                            <td>{{$user->designation}}</td>
			                        </tr>
			                        <tr>
			                        @if($user->address)
                                        <tr>
                                            <td>Address</td>
                                            <td>{{$user->address}}</td>
                                        </tr>
                                    @endif
			                        @if($user->mobile)
                                        <tr>
                                            <td>Mobile</td>
                                            <td>{{$user->mobile}}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <a type="button" href="mailto:{{ $user->email }}" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a>
					        <span class="pull-right">
					        <a type="button" class="btn btn-sm btn-warning" href="{{route('admin.users.edit',[$domain,$user->id])}}"><i class="glyphicon glyphicon-edit"></i></a>
					        <a data-toggle="modal" data-target="#modal-popout" data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
					        </span>
                        </div>
                        <br />
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
