@extends('layouts.master')

@section('title', 'Add Employees')

@section('styles')
@parent
<style type="text/css">
/* Hide file input */
input[name=file] {
  visibility: hidden;
}
#excel-sample-format thead tr th{
    text-transform: lowercase;
}
</style>
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
            <!-- Pop Out Modal -->
            <div class="modal fade" id="modal-popout" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-popout modal-lg">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent remove-margin-b">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                <h3 class="block-title">Excel sheet format</h3>
                            </div>
                            <div class="block-content">
                                <p>The excel file with single sheet must have the users data in the following format:</p>
                                <table class="table table-bordered" id="excel-sample-format">
                                    <thead>
                                        <tr>
                                            <th>email</th>
                                            <th>fullname</th>
                                            <th>address</th>
                                            <th>mobile</th>
                                            <th>designation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>emma@gmail.com</td>
                                            <td>Emma Cooper</td>
                                            <td>795 Folsom Ave, Suite 600
                                            San Francisco...</td>
                                            <td>9840944289</td>
                                            <td>Telecaller</td>
                                        </tr>
                                        <tr>
                                            <td>vincet@hotmail.com</td>
                                            <td>Vincent Sims</td>
                                            <td>795 Folsom Ave, Suite 600
                                            San Francisco...</td>
                                            <td>9943598647</td>
                                            <td>Team Leader</td>
                                        </tr>
                                        <tr>
                                            <td>rebeccagrey@gmail.com</td>
                                            <td>Rebecca Gray</td>
                                            <td>795 Folsom Ave, Suite 600
                                            San Francisco...</td>
                                            <td>9856788234</td>
                                            <td>Field Coordinator</td>
                                        </tr>
                                        <tr>
                                            <td>linda@gmail.com</td>
                                            <td>Linda Moore</td>
                                            <td>795 Folsom Ave, Suite 600
                                            San Francisco...</td>
                                            <td>9345988234</td>
                                            <td>Field Executive</td>
                                        </tr>
                                        <tr>
                                            <td>juliacole@yahoo.in</td>
                                            <td>Julia Cole</td>
                                            <td>795 Folsom Ave, Suite 600
                                            San Francisco...</td>
                                            <td>9954687234</td>
                                            <td>Manager</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-sm btn-primary" type="button" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Pop Out Modal -->

            <div class="row">
                <div class="col-xs-12 col-lg-10">
                    <div class="block block-themed">
                        <div class="block-header bg-success">
                            <ul class="block-options">
                                <li>
                                    <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                                </li>
                            </ul>
                            <h3 class="block-title">Instructions</h3>
                        </div>
                        <div class="block-content">
                            <h3 class="push">Instructions</h3>
                            <ol>
                                <li>The employee data must be uploded as an excel file.</li>
                                <li>The excel file must contain only one sheet having the employees data in <a data-toggle="modal" data-target="#modal-popout" class="link-effect" style="cursor:pointer">this</a> specific format.</li>
                                <li>Make sure the column names in excel sheet are in lowercase just like how it is given in the above format.</li>
                                <li>By default password for all employees will be set as <strong>password</strong></li>
                                <li>It is recomended that once the employees data has been uploaded the employees login to their respective account and change their password immediately under the settings section.</li>
                            </ol>
                            <br />
                        </div>
                    </div>
                </div>
            </div>	
			<div class="row">
                <div class="col-xs-12 col-lg-6">
                    <div class="alert alert-success alert-dismissable" style="display:none;" id="upload-success-message">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>You have succesfully uploaded the employee details.</p>
                    </div>
                    <!-- Progress Mini -->
                    <div class="block">
                        <div class="block-header">
                            <ul class="block-options">
                                <li>
                                    <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                                </li>
                            </ul>
                            <h3 class="block-title">Upload <small>Progress</small></h3>
                        </div>
                        <div class="block-content" id="upload-block-content">
                            {!! Form::open(['route' => ['admin.users.postImport',$domain],'files' => true,'id' => 'file-upload-form']) !!}
                            <input type="file" name="file"/>
                            <button class="btn btn-sm btn-primary push-5-r push-10" type="button"><i class="fa fa-upload"></i> Upload Files</button>
                            {!! Form::close() !!}
                            <br />
                        </div>
                    </div>
                    <!-- END Progress Mini -->
                </div>
                <div class="col-xs-12 col-lg-6" style="display:none;" id="errors-block">
                    <div class="block block-themed">
                        <div class="block-header bg-danger">
                            <ul class="block-options">
                                <li>
                                    <button type="button" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title">Review the following errors</h3>
                        </div>
                        <div class="block-content" id="errors-block-content">
                            <p>The uploaded excel file has the following errors.</p>

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
{!! Html::script('packages/handlebars/handlebars.min.js') !!}
<script id="File-Element-Template" type="text/x-handlebars-template">
<p class="working">
    <div class="row">
        <div class="col-sm-1 col-xs-2">
            <i class="fa fa-folder-open"></i>
        </div>
        <div class="col-sm-9 col-xs-8">
            <span>@{{filename}} - <strong>@{{filesize}}</strong></span>
            <div class="progress progress-mini">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
            </div>
        </div>
        <div class="col-sm-2 col-xs-2">
            <i class="fa fa-close cancel-upload"></i>
        </div>
    </div>
</p>
</script>
<script id="Row-Error-Template" type="text/x-handlebars-template">
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        @{{#if rowNumber}}
            <strong>In row @{{rowNumber}}: </strong>
        @{{/if}}
    </div>
</script>
@parent
<!-- jQuery File Upload Dependencies -->
{!! Html::script('js/jquery.ui.widget.js') !!}
{!! Html::script('js/jquery.iframe-transport.js') !!}
{!! Html::script('js/jquery.fileupload.js') !!}
{!! Html::script('js/excelimport.js') !!}
@stop