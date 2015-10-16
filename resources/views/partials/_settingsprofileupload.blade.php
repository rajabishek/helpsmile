<div class="row">
	<div class="col-lg-4">
        @include('flash::message')
        <!-- Bootstrap Lock -->
        <div class="block">
            <div class="block-header">
                <ul class="block-options">
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                    </li>
                </ul>
                <h3 class="block-title">Account details</h3>
            </div>
            <div class="block-content">
                {!! Form::open(['route' => [$settingsPostRoute,$domain],'class' => 'form-horizontal push-10-t push-10 change-user-details-form']) !!}
                    <div class="text-center push-10-t push-30 upload-avatar" id="upload-avatar">
                        <input type="hidden" id="avatar-hidden" name="avatar" value="">
                        <div class="userpic" style="background-image: url('{{{ $user->photocss }}}');">
                            <div class="js-preview userpic__preview"></div>
                        </div>
                        <div class="js-fileapi-wrapper">
                            <div class="js-browse">
                                <input type="file" name="filedata" id="image-file-input">
                                <button class="btn btn-sm btn-warning select-image-btn">Change your photo</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{set_error('fullname', $errors)}}">
                        <div class="col-xs-12">
                            <div class="form-material">
                                {!! Form::text('fullname',$user->fullname,['class' => 'form-control']) !!}
                                {!! Form::label('fullname','Fullname') !!}
                                {!! get_error('fullname', $errors) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="form-material input-group">
                                {!! Form::email(null,$user->email,['class' => 'form-control','disabled']) !!}
                                {!! Form::label('email','Email Address') !!}
                                <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="form-material">
                                {!! Form::text(null,$user->designation,['class' => 'form-control','disabled']) !!}
                                {!! Form::label('designation','Designation') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{set_error('mobile', $errors)}}">
                        <div class="col-xs-12">
                            <div class="form-material">
                                {!! Form::text('mobile',$user->mobile,['class' => 'form-control']) !!}
                                {!! Form::label('mobile','Mobile') !!}
                                {!! get_error('mobile', $errors) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{set_error('address', $errors)}}">
                        <div class="col-xs-12">
                           <div class="form-material">
                                {!! Form::textarea('address',$user->address,['class' => 'form-control','rows' => 3]) !!}
                                {!! Form::label('address','Address') !!}
                                {!! get_error('address', $errors) !!}
                           </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="example-hf-email">Password</label>
                        <div class="col-md-7">
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#password-change-modal" type="button">Change Password</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <button class="btn btn-sm btn-success" type="submit" id="settings-save-button"><i class="fa fa-save push-5-r"></i> Save</button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- END Bootstrap Lock -->
    </div>
    <div class="col-md-8">
        <!-- Bootstrap Register -->
        <div class="block block-themed" id="cropper-preview" style="display:none;">
            <div class="block-header bg-success">
                <ul class="block-options">
                    <li>
                        <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                    </li>
                    <li>
                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                    </li>
                </ul>
                <h3 class="block-title">Crop the image</h3>
            </div>
            <div class="block-content">
                <div class="js-img"></div>
                <br />
                {!! Form::open(['route' => $changeProfilePostRoute,'class' => 'form-horizontal push-5-t','id' => 'profile-upload-form']) !!}
                <button class="btn btn-success" id="profile-upload-submit">Upload</button>
                {!! Form::close() !!}
            </div>
            <br />
        </div>
        <!-- END Settings Form -->
    </div>
</div>   