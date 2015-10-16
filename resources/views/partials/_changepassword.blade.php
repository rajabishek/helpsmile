<!-- Password Change Modal -->
<div class="modal fade" id="password-change-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-popout">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b" id="modal-block">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Change Password</h3>
                </div>
                <div class="block-content">
                    <div class="alert alert-danger alert-dismissable" id="change-password-validation-errors" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    </div>
                    {!! Form::open(['route' => [$changePasswordPostRoute,$domain],'class' => 'form-horizontal push-10-t push-10','id' => 'change-password-form']) !!}
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material">
                                    {!! Form::password('old_password',['class' => 'form-control','placeholder' => 'Please type the old password']) !!}
                                    {!! Form::label('old_password','Old Password') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material">
                                    {!! Form::password('password',['class' => 'form-control','placeholder' => 'Please enter the new password','id' => 'password']) !!}
                                    {!! Form::label('password','New Password') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material">
                                    {!! Form::password('password_confirmation',['class' => 'form-control','placeholder' => 'Confirm the new password']) !!}
                                    {!! Form::label('password_confirmation','Confirm New Password') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                {!! Form::submit('Change Password',['class' => 'btn btn-sm btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Password Change Modal -->