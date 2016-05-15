@extends('layouts.master')

@section('title', 'Settings')

@section('styles')
@parent
<link rel="stylesheet" href="{{ URL::asset('css/jquery.Jcrop.min.css') }}">
<style type="text/css">
/* Hide file input */
input[name=filedata] {
  visibility: hidden;
}
</style>
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
        <!-- Page Content -->
        <div class="content">
            
            <!-- Password Change Modal -->
            @include('partials._changepassword',['changePasswordPostRoute' => 'fieldcoordinator.settings.changePassword'])
            <!-- END Password Change Modal -->
            
            <!-- Settings and Profile Upload Form -->
            @include('partials._settingsprofileupload',['changeProfilePostRoute' => 'fieldcoordinator.settings.changeProfile','settingsPostRoute' => 'fieldcoordinator.settings.store'])
            <!-- END Settings and Profile Upload Form -->
            
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
<script type="text/javascript">
  var FileAPI = {
          debug: false
          , staticPath: "{{ url('js/uploader') }}/"
          , postNameConcat: function (name, idx){
        return  name + (idx != null ? '['+ idx +']' : '');
      }
  };
</script>
 <!-- Page JS Plugins -->
{!! Html::script('js/uploader/FileAPI.min.js') !!}
{!! Html::script('js/uploader/FileAPI.exif.js') !!}
{!! Html::script('js/uploader/jquery.fileapi.js') !!}
{!! Html::script('js/uploader/jquery.Jcrop.min.js') !!}
{!! Html::script('assets/js/plugins/jquery-validation/jquery.validate.min.js') !!}

 <!-- Page JS Code -->
{!! Html::script('js/settingsvalidation.js') !!}
{!! Html::script('js/profileupload.js') !!}
{!! Html::script('js/changepassword.js') !!}
@stop