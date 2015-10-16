
var SettingsFormValidation = function() {

    var initValidation = function()
    {
        $('.change-user-details-form').validate({
            errorClass: 'help-block text-right animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function(error, e) {
                $(e).parents('.form-group .form-material').append(error);
            },
            highlight: function(e) {
                $(e).closest('.form-group').removeClass('has-error').addClass('has-error');
                $(e).closest('.help-block').remove();
            },
            success: function(e) {
                $(e).closest('.form-group').removeClass('has-error');
                $(e).closest('.help-block').remove();
            },
            rules: {
                'fullname': {
                    required: true,
                },
                'mobile': {
                    digits: true
                }
            },
            messages: {
                'fullname': {
                    required: 'Please provide you fullname',
                },
                'mobile': 'Please enter a valid mobile number',
            }
        });
    };

    return {
        init:function()
        {
            initValidation();
        }
    };
}();

// Initialize when page loads
$(function(){ SettingsFormValidation.init(); });