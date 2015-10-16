$(function(){
    var ChangePassword = {

        init: function(){
            this.form = $('#change-password-form');
            this.modalBlock  = $('#modal-block');
            this.changePasswordModal = this.modalBlock.closest('.modal');
            this.submitButton = this.form.find('input[type=submit]');
            this.submitButtonValue = this.submitButton.val();
            this.errorBox = this.modalBlock.find('#change-password-validation-errors');
            this.bindevents();
            this.validateData();
        },

        bindevents: function(){
            //this.form.on('submit',$.proxy(this.sendData,this));
            this.changePasswordModal.on('hidden.bs.modal',$.proxy(this.modalHiddenEventHandler,this));
        },

        validateData:function(){
            
            var self = this;

            this.form.validate({
                errorClass: 'help-block text-right animated fadeInDown',
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    $(e).parents('.form-group .form-material').append(error);
                },
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e){
                    $(e).closest('.form-group').removeClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                submitHandler:function(form){
                    self.sendData();
                },
                rules: {
                    'old_password': {
                        required: true,
                        minlength: 5
                    },
                    'password': {
                        required: true,
                        minlength: 5
                    },
                    'password_confirmation': {
                        required: true,
                        equalTo: '#password'
                    }
                },
                messages: {
                    'old_password': {
                        required: 'Please provide your old password',
                        minlength: 'Password must be at least 5 characters'
                    },
                    'password': {
                        required: 'Please provide a new password',
                        minlength: 'Password must be at least 5 characters'
                    },
                    'password_confirmation': {
                        required: 'Please confirm the new password',
                        minlength: 'Password must be at least 5 characters',
                        equalTo: 'Please enter the same password as above'
                    }
                }
            });
        },

        modalHiddenEventHandler:function(){
            this.form[0].reset();
            return this.errorBox.hide().empty();
        },

        sendData: function(){

            this.submitButton.val('Processing').prop('disabled',true);
            App.blocks('#modal-block', 'state_loading');

            $.ajax({
                type: 'post',
                url: this.form.attr("action"),
                dataType: 'json',
                data: this.form.serialize(),
                beforeSend: $.proxy(this.ajaxBeforeSendHandler,this),
                success: $.proxy(this.ajaxResponseHandler,this),
                error: $.proxy(this.ajaxErrorHandler,this)
            });
        },

        ajaxBeforeSendHandler:function(){
            this.errorBox.hide().find('p').remove(); 
        },

        ajaxResponseHandler:function(data){
            if(data.success == false){

                var errors = data.errors;
                var errorBox = this.errorBox;
                if($.isArray(errors))
                    $.each(errors, function(i){ errorBox.append($("<p>").text(errors[i])); });
                else
                    errorBox.append($("<p>").text(errors));
                this.errorBox.show();
                
                App.blocks('#modal-block', 'state_normal');
                this.submitButton.prop('disabled',false).val(this.submitButtonValue);
            }
            else{
                App.blocks('#modal-block', 'state_normal');
                this.submitButton.prop('disabled',false).val(this.submitButtonValue);
                this.changePasswordModal.modal('hide');
            }
        },

        ajaxErrorHandler:function(xhr, textStatus, thrownError) {
            this.errorBox.html('Something went wrong, please try again later...');
            this.errorBox.show();
            App.blocks('#modal-block', 'state_normal');
            this.submitButton.prop('disabled',false).val(this.submitButtonValue);
            return this.form.find('input[name=login-password]').val('');
        }
    };

    ChangePassword.init();
});