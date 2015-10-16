@extends('layouts.main')

@section('title', 'Internal Error')

@section('content')
<!-- Error Content -->
<div class="content bg-white text-center pulldown overflow-hidden">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <!-- Error Titles -->
            <h1 class="font-s128 font-w300 text-modern animated zoomInDown">500</h1>
            <h2 class="h3 font-w300 push-50 animated fadeInUp">We are sorry but our server encountered an internal error..</h2>
            <!-- END Error Titles -->
        </div>
    </div>
</div>
<!-- END Error Content -->

<!-- Error Footer -->
<div class="content pulldown text-muted text-center">
    Would you like to let us know about it?<br>
    <a class="link-effect" href="javascript:void(0)">Report it</a> or <a class="link-effect" href="{{route('home')}}">Go Home</a>
</div>
<!-- END Error Footer -->
@stop