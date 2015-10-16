$(function () {
    
    var ChangeDonorDetails = {

        init: function(){
            this.form = $('#change-donor-details-form');
            this.block = this.form.closest('#change-donor-details-block');
            this.changeDonorDetailsModal = this.form.closest('#change-donor-details-modal');
            this.donorInformationTable = $('.donor-information');
            this.errorBox = $('#change-donor-details-validation-errors');
            this.validateData();
        },

        validateData:function(){
            
            var self = this;

            this.form.validate({
                errorClass: 'help-block animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function(error, e) {
                jQuery(e).parents('.form-group > div').append(error);
            },
            highlight: function(e) {
                jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
                jQuery(e).closest('.help-block').remove();
            },
            success: function(e) {
                jQuery(e).closest('.form-group').removeClass('has-error');
                jQuery(e).closest('.help-block').remove();
            },
            rules: {
                'fullname': {
                    required: true
                },
                'email': {
                    required: true,
                    email: true
                },
                'mobile': {
                    required: true,
                    minlength: 10,
                    digits: true
                }
            },
            messages: {
                'fullname': {
                    required: 'Please enter a username',
                    minlength: 'Your username must consist of at least 3 characters'
                },
                'email': 'Please enter a valid email address',
                'mobile': {
                    required: 'Please provide a mobile number',
                    minlength: 'Mobile number must be at least 10 characters long',
                    digits: 'Mobile number should have only digits'
                }
            },
            submitHandler:function(form){
                    self.sendData();
                }
            });
        },    

        jumpToLoadingState:function(){
            App.blocks('#' + this.block.attr('id'), 'state_loading');
        },

        jumpToNormalState:function(){
            App.blocks('#' + this.block.attr('id'), 'state_normal');
        },

        sendData: function(){
            event.preventDefault();
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
            this.errorBox.hide().find('p').remove(); 
        },

        updateDonorInformationTable:function(donor){
            this.donorInformationTable.find('.donor-fullname').text(donor.fullname);
            this.donorInformationTable.find('.donor-mobile').text(donor.mobile);
            this.donorInformationTable.find('.donor-email').text(donor.email);
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
                
                return this.jumpToNormalState();
            }
            else{
                //close the modal dialog
                this.changeDonorDetailsModal.modal('hide');
                this.jumpToNormalState();
                this.updateDonorInformationTable(data.donor);
            }
        },

        ajaxErrorHandler:function(xhr, textStatus, thrownError) {
            
            this.jumpToNormalState();
            this.errorBox.append($("<p>").text('Something went wrong, please try again later.'));
            this.errorBox.fadeIn();
            return this.passwordInputField.val('');
        }
    };

    ChangeDonorDetails.init();
});