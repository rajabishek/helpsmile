$(function () {
    
    var Webhooks = {

        init: function(){
            this.form = $('#add-webhook-form');
            this.token = this.form.find('input[name=_token]').val();
            this.addWebhookBlock = this.form.closest('#add-webhook-block');

            this.webhooksBlock = $('#webhooks-block');
            this.webhooksBlockContent = this.webhooksBlock.find('.block-content');
            this.modal = $('#add-webhook-modal');
           
            this.submitButton = this.form.find('button[type=button]');
            
            this.refreshWebhooksButton = $('#refresh-webhooks-button');
            this.addWebhookButton = $('#add-webhook-button');
            
            this.errorBox = $('#webhook-validation-errors');
            this.changesErrorBox = $('#webhook-changes-validation-errors');
            this.webhookTemplate = $("#Webhook-Template");
            this.tableTemplate = $("#Table-Template");
            this.bindEvents();
        },

        jumpToLoadingState:function(block){
            App.blocks('#' + block.attr('id'), 'state_loading');
        },

        jumpToNormalState:function(block){
            App.blocks('#' + block.attr('id'), 'state_normal');
        },

        bindEvents:function(){

            this.form.on('submit',$.proxy(this.sendData,this));
            
            var self = this;
            this.refreshWebhooksButton.on('click',function(){
                var endpoint = $(this).data('action');
                self.refreshWebhooks(endpoint);
            });

            this.webhooksBlock.find('.edit-webhook').on('click',function(){
                var id = $(this).closest('tr').data('id');
                var url = $(this).closest('tr').find('.url-text').text();
                var webhook = 
                self.editWebhook({'id':id,'url': url});
            });

            this.webhooksBlock.find('.delete-webhook').on('click',function(){
                var id = $(this).closest('tr').data('id');
                var url = $(this).closest('tr').find('.url-text').text();
                var webhook = 
                self.deleteWebhook({'id':id,'url': url});
            });

            this.addWebhookButton.on('click',$.proxy(this.addWebhookButtonWasClicked,this));
        },

        addWebhookButtonWasClicked:function(){
            this.form[0].reset();
            this.errorBox.hide().find('p').remove(); 
            this.form.find("[name='_method']").remove();
            this.form.attr('action','/admin/webhooks');
            this.modal.modal('show');
        },

        editWebhook:function(webhook){
            this.form.attr('action','/admin/webhooks/' + webhook.id);
            this.errorBox.hide().find('p').remove(); 
            
            if(!this.form.find("[name='_method']").length)
            {
                $('<input>').attr({
                    type: 'hidden',
                    name: '_method',
                    value: 'PUT'
                }).appendTo(this.form);

            }
            
            this.modal.find('input[name=url]').val(webhook.url);
            this.modal.modal('show');
        },

        deleteWebhook:function(webhook){
        
            $.ajax({
                type: 'post',
                url: '/admin/webhooks/' + webhook.id,
                dataType: 'json',
                data: { '_method' : 'DELETE' , '_token' : this.token },
                beforeSend: $.proxy(this.deleteWebhookBeforeSendHandler,this),
                success: $.proxy(this.deleteWebhookResponseHandler,this),
                error: $.proxy(this.deleteWebhookErrorHandler,this)
            });
        },

        deleteWebhookBeforeSendHandler:function(){
            this.changesErrorBox.hide().find('p').remove(); 
            this.jumpToLoadingState(this.webhooksBlock);
        },

        deleteWebhookResponseHandler:function(result){
            
            if(result.success == true)
            {
                this.jumpToNormalState(this.webhooksBlock);
                this.refreshWebhooksButton.click();
            }
            else
            {
                var errors = result.errors;
                var errorBox = this.changesErrorBox;
    
                if($.isArray(errors))
                    $.each(errors, function(i){ errorBox.append($("<p>").text(errors[i])); });
                else
                    errorBox.append($("<p>").text(errors));
                this.jumpToNormalState(this.webhooksBlock);
                return errorBox.fadeIn();
            }
        },

        deleteWebhookErrorHandler:function(xhr, textStatus, thrownError) {
            this.changesErrorBox.append($("<p>").text('Something went wrong, please try again later.'));
            this.jumpToNormalState(this.webhooksBlock);
            return this.changesErrorBox.fadeIn();
        },

        sendData: function(event){
            event.preventDefault();

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

        refreshWebhooks: function(endpoint){
            $.ajax({
                type: 'get',
                url: endpoint,
                dataType: 'json',
                beforeSend: $.proxy(this.refreshWebhooksBeforeSendHandler,this),
                success: $.proxy(this.refreshWebhooksResponseHandler,this),
                error: $.proxy(this.refreshWebhooksErrorHandler,this)
            });
        },

        refreshWebhooksBeforeSendHandler:function(){
            this.errorBox.hide().find('p').remove(); 
            this.changesErrorBox.hide().find('p').remove(); 
            this.jumpToLoadingState(this.webhooksBlock);
        },

        generateMarkupForWebhook:function(webhook){

            //Get the source and compile the template
            var template = Handlebars.compile(this.webhookTemplate.html());
    
            //Generate some HTML code from the compiled Template
            return template({ 
                id:webhook.id,
                url:webhook.url,
            });

        },

        generateMarkupForTable:function(){

            //Get the source and compile the template
            var template = Handlebars.compile(this.tableTemplate.html());
    
            //Generate some HTML code from the compiled Template
            return template({});
        },

        refreshWebhooksResponseHandler:function(result){
            
            if(result.success == true)
            {
                var webhooks = result.data;
                var self = this;
                
                if($.isArray(webhooks))
                {

                    self.webhooksBlockContent.empty().append(this.generateMarkupForTable());
                    if(!$.isEmptyObject(webhooks))
                    {
                        $.each(webhooks, function(i){ 
                            var webhookRow = $(self.generateMarkupForWebhook(webhooks[i]));

                            self.webhooksBlockContent
                                .find('tbody')
                                .append(webhookRow);

                            webhookRow.find('.edit-webhook').on('click',function(){
                                var id = $(this).closest('tr').data('id');
                                var url = $(this).closest('tr').find('.url-text').text();
                                var webhook = 
                                self.editWebhook({'id':id,'url': url});
                            });

                            webhookRow.find('.delete-webhook').on('click',function(){
                                var id = $(this).closest('tr').data('id');
                                var url = $(this).closest('tr').find('.url-text').text();
                                var webhook = 
                                self.deleteWebhook({'id':id,'url': url});
                            });
                        });
                    }
                    else
                    {
                        self.webhooksBlockContent.empty().append(
                            $('<div/>', {
                                'class': 'alert alert-warning',
                                'text':  'There are no webhooks to display.'
                            })
                        );
                    }
                }
                
                this.jumpToNormalState(this.webhooksBlock);
            }
            else
            {
                var errors = result.errors;
                var errorBox = this.errorBox;
    
                if($.isArray(errors))
                    $.each(errors, function(i){ errorBox.append($("<p>").text(errors[i])); });
                else
                    errorBox.append($("<p>").text(errors));
                this.jumpToNormalState(this.webhooksBlock);
                return this.errorBox.fadeIn();
            }
        },

        refreshWebhooksErrorHandler:function(xhr, textStatus, thrownError) {
            this.errorBox.append($("<p>").text('Something went wrong, please try again later.'));
            this.jumpToNormalState(this.webhooksBlock);
            return this.errorBox.fadeIn();
        },

        ajaxBeforeSendHandler:function(){
            this.errorBox.hide().find('p').remove(); 
            this.changesErrorBox.hide().find('p').remove(); 
            this.jumpToLoadingState(this.addWebhookBlock);
        },

        ajaxResponseHandler:function(result){
            
            if(result.success == true)
            {
                this.form[0].reset();
                this.jumpToNormalState(this.addWebhookBlock);
                this.modal.modal('hide');
                this.refreshWebhooksButton.click();
            }
            else
            {
                var errors = result.errors;
                var errorBox = this.errorBox;
    
                if($.isArray(errors))
                    $.each(errors, function(i){ errorBox.append($("<p>").text(errors[i])); });
                else
                    errorBox.append($("<p>").text(errors));
                this.jumpToNormalState(this.addWebhookBlock);
                return this.errorBox.fadeIn();
            }
        },

        ajaxErrorHandler:function(xhr, textStatus, thrownError) {
            this.errorBox.append($("<p>").text('Something went wrong, please try again later.'));
            this.jumpToNormalState(this.addWebhookBlock);
            return this.errorBox.fadeIn();
        }
    };

    Webhooks.init();
});