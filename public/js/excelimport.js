$(function(){

    var block = $('#upload-block-content');

    $('#file-upload-form button').click(function(event){
        event.preventDefault();
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input[name=file]').click();
    });

    // Initialize the jQuery File Upload plugin
    $('#file-upload-form').fileupload({

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
             
            //Get the source and compile the template
            var template = Handlebars.compile($("#File-Element-Template").html());
             
            //Generate some HTML code from the compiled Template
            var html = template({ 
                filename : data.files[0].name, 
                filesize: formatFileSize(data.files[0].size) 
            });
            
            var fileElement = $(html);

            // Add the HTML to the UL element
            data.context = fileElement.appendTo(block);

            // Listen for clicks on the cancel icon
            fileElement.find('.cancel-upload').click(function(){
                
                if(fileElement.hasClass('working')){
                    jqXHR.abort();
                }

                fileElement.fadeOut(function(){
                    fileElement.remove();
                });

            });

            $('#errors-block').hide().find('div.alert').remove();
            $('#upload-success-message').hide();

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('.progress-bar').width(progress + '%');

            if(progress == 100){
                data.context.removeClass('working');
                data.context.find('.cancel-upload').removeClass('fa-close').addClass('fa-check')
                        
            }
        },

        done:function(e, data){
            if(data.result.success == false){

                var errorBlock = $('#errors-block-content');
                
                if($.type(data.result.errors) === 'string'){
                    var template = Handlebars.compile($("#Row-Error-Template").html());
                    var rowError = $(template({ rowNumber : false}));
                    rowError.append($("<p>").text(data.result.errors));
                    errorBlock.append(rowError);
                    return $('#errors-block').fadeIn();
                }

                var errors = data.result.errors;
                Object.keys(errors).forEach(function (rowNumber){ 
                    //Get the source and compile the template
                    var template = Handlebars.compile($("#Row-Error-Template").html());
                    var rowError = $(template({ rowNumber : rowNumber}));
                    var error = errors[rowNumber];
                    if($.isArray(error))
                        $.each(error, function(i){ rowError.append($("<p>").text(error[i])); });
                    errorBlock.append(rowError);
                });
                $('#errors-block').fadeIn();
            }
            else{
                 $('#upload-success-message').fadeIn();
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            console.log(data.result);
            //data.context.addClass('error');
        }

    });

    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes)
    {    
        if (typeof bytes !== 'number') {
            return '';
        }
        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }
        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }
        return (bytes / 1000).toFixed(2) + ' KB';
    }
});