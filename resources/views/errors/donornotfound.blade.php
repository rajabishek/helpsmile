@extends('layouts.error')

@section('title','No Donor Found')

@section('heading','Error')

@section('message')
We are sorry we were not able to find the donor you were looking for.
@stop

@section('searchform')
{!! Form::open(['url' => $backLink, 'method' => 'GET','class' => 'form-horizontal push-50']) !!}
	<div class="form-group">
	    <div class="col-sm-6 col-sm-offset-3">
	        <div class="input-group input-group-lg">
	            {!! Form::text('q',null,['class' => 'form-control','placeholder' => 'Search donors..']) !!}
	            <div class="input-group-btn">
	                <button class="btn btn-default"><i class="fa fa-search"></i></button>
	            </div>
	        </div>
	    </div>
	</div>
{!! Form::close() !!}
@stop

@section('backlink',$backLink)