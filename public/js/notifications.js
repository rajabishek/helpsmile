$(function () {
    
    var Notifications = {

        init: function(){
            this.block = $('#notifications-block');
            this.refreshNotificationsButton = $('#refresh-notifications-button');
            this.notificationsContainer = $('#notifications-container');
            this.notificationTemplate = $("#notification-template");
            this.errorBox = $('#notification-validation-errors');
            this.bindEvents();
        },

        bindEvents:function(){
            this.refreshNotificationsButton.on('click',$.proxy(this.refreshNotifications,this));
        },

        jumpToLoadingState:function(){
            App.blocks('#' + this.block.attr('id'), 'state_loading');
        },

        jumpToNormalState:function(){
            App.blocks('#' + this.block.attr('id'), 'state_normal');
        },

        refreshNotifications: function(event){
            event.preventDefault();
            this.jumpToLoadingState();

            $.ajax({
                type: 'get',
                url: this.block.data('action'),
                dataType: 'json',
                beforeSend: $.proxy(this.refreshNotificationsBeforeSendHandler,this),
                success: $.proxy(this.refreshNotificationsResponseHandler,this),
                error: $.proxy(this.refreshNotificationsErrorHandler,this)
            });
        },

        generateMarkupForNotification:function(notification){

            //Get the source and compile the template
            var template = Handlebars.compile(this.notificationTemplate.html());

            var iconclass = 'si si-close text-danger';

            if(notification.type == 'donation.created')
                iconclass = 'si si-wallet text-success';
            else if(notification.type == 'donor.created')
                iconclass = 'si si-plus text-success'; 
            else if(notification.type == 'donation.assigned')
                iconclass = 'si si-pencil text-info'; 
            else if(notification.type == 'donation.successful')
                iconclass = 'si si-check text-success';
            else if(notification.type == 'donation.cancelled')
                iconclass = 'si si-close text-danger';
            else
                iconclass = 'si si-close text-danger';
        
            //Generate some HTML code from the compiled Template
            return template({ 
                title: notification.title,
                description:notification.description,
                iconclass:iconclass,
                happened_at: notification.happened_at
            });
        },

        refreshNotificationsBeforeSendHandler:function(){
            this.errorBox.hide().find('p').remove(); 
        },

        refreshNotificationsResponseHandler:function(result){
            if(result.success == true)
            {
                this.jumpToNormalState();
                var notifications = result.data;
                if($.isEmptyObject(notifications))
                {
                    console.log('There are no notifications.');
                }
                else
                {
                    var self = this;

                    if($.isArray(notifications))
                    {
                        this.notificationsContainer.empty();
                        $.each(notifications, function(i){ 
                            self.notificationsContainer.append(self.generateMarkupForNotification(notifications[i]));
                        });
                    }

                    this.jumpToNormalState();
                }         
            }
            else
            {
                var errors = result.errors;
                var errorBox = this.errorBox;
    
                if($.isArray(errors))
                    $.each(errors, function(i){ errorBox.append($("<p>").text(errors[i])); });
                else
                    errorBox.append($("<p>").text(errors));
                this.errorBox.fadeIn();
                
                return this.jumpToNormalState();
            }
        },

        refreshNotificationsErrorHandler:function(xhr, textStatus, thrownError) {
            
            this.jumpToNormalState();
            this.errorBox.append($("<p>").text('Something went wrong, please try again later.'));
            return this.errorBox.fadeIn();
        }
    };

    Notifications.init();
});