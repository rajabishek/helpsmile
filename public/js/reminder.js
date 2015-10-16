$(function () {
    
    var Reminder = {

        init: function(){
            this.form = $('#reminder-form');
            this.emailInputField = this.form.find('input[name=email]');
            this.block = this.form.closest('#reminder-block');
            this.messageBox = $('#reminder-messages');
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
                    jQuery(e).parents('.form-group .form-material').append(error);
                },
                highlight: function(e) {
                    jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
                    jQuery(e).closest('.help-block').remove();
                },
                success: function(e) {
                    jQuery(e).closest('.form-group').removeClass('has-error');
                    jQuery(e).closest('.help-block').remove();
                },
                submitHandler:function(form){
                    self.sendData();
                },
                rules: {
                    'email': {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    'email': {
                        required: 'Please enter a valid email address'
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
            if(this.messageBox.hasClass('alert-success'))
                this.messageBox.removeClass('alert-success').addClass('alert-danger');
            this.messageBox.hide().find('p').remove(); 
        },

        ajaxResponseHandler:function(data){
            if(data.success == false){

                var errors = data.errors;
                var messageBox = this.messageBox;
    
                if($.isArray(errors))
                    $.each(errors, function(i){ messageBox.append($("<p>").text(errors[i])); });
                else
                    messageBox.append($("<p>").text(errors));
                this.messageBox.fadeIn();
                
                return this.jumpToNormalState();
            }
            else 
            {
                var messageBox = this.messageBox;
                var messages = data.messages;
                messageBox.removeClass('alert-danger').addClass('alert-success');
                if($.isArray(messages))
                    $.each(messages, function(i){ messageBox.append($("<p>").text(messages[i])); });
                else
                    messageBox.append($("<p>").text(messages));
                messageBox.fadeIn();
                this.emailInputField.blur();
                return this.jumpToNormalState();
            }
        },

        ajaxErrorHandler:function(xhr, textStatus, thrownError) {
            this.jumpToNormalState();
            this.messageBox.append($("<p>").text('Something went wrong, please try again later.'));
            return this.messageBox.fadeIn();  
        }
    };

    Reminder.init();
});