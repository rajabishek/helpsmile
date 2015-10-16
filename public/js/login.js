$(function () {
    
    var Login = {

        init: function(){
            this.form = $('#login-form');
            this.block = this.form.closest('#login-block');
            this.passwordInputField = this.form.find('input[name=password]');
            this.errorBox = $('#login-validation-errors');
            this.validateData();
        },

        jumpToLoadingState:function(){
            App.blocks('#' + this.block.attr('id'), 'state_loading');
        },

        jumpToNormalState:function(){
            App.blocks('#' + this.block.attr('id'), 'state_normal');
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
                    'email': {
                        required: true,
                        email: true
                    },
                    'password': {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    'email': 'Please enter a valid email address',
                    'password': {
                        required: 'Please provide a password',
                        minlength: 'Your password must be at least 5 characters long'
                    }
                }
            });
        },

        sendData: function(){
            
            this.jumpToLoadingState();
        
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
            //Remove the succes message displayed after the logout process
            $('div.alert-success').remove();
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
                this.errorBox.fadeIn();
                
                this.jumpToNormalState();
                return this.passwordInputField.val('');
            }
            else{
                window.location.replace(data.redirect);
            }
        },

        ajaxErrorHandler:function(xhr, textStatus, thrownError) {
            
            this.jumpToNormalState();
            this.errorBox.append($("<p>").text('Something went wrong, please try again later.'));
            this.errorBox.fadeIn();
            return this.passwordInputField.val('');
        }
    };

    Login.init();
});