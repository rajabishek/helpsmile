$(function() {

    var ProfileUpload = {

        init: function(){
            this.form = $('#profile-upload-form');
            this.profileUploadModal = $('#profile-upload-modal');
            this.modalBlock  = this.profileUploadModal.find('#profile-upload-block');
            this.submitButton = $('#profile-upload-submit');
            this.settingSaveButton = $('#settings-save-button');
            this.changePhotoButton = $('.select-image-btn');
            this.imageFileInput = $('#image-file-input');
            this.uploadAvatar = $('#upload-avatar');
            this.cropperPreview = $('#cropper-preview');

            
            this.uploadAvatar.fileapi({
                url: this.form.attr('action'),
                accept: 'image/*',
                data: {
                    _token: this.form.find('input[name=_token]').val()
                },
                imageSize: {
                    minWidth: 100,
                    minHeight: 100
                },
                elements: {
                    active: {
                        show: '.js-upload',
                        hide: '.js-browse'
                    },
                    preview: {
                        el: '.js-preview',
                        width: 96,
                        height: 96
                    }
                },
                onSelect: $.proxy(this.imageFileChangedEventHandler,this),
                
                onComplete: $.proxy(this.profileUploadCompleteEventHandler,this)
            });

            this.bindevents();
            this.preventUserDetailsFormEnterSubmitting();
        },

        preventUserDetailsFormEnterSubmitting:function(){

            // Prevent user details form from submitting on enter key press
            $('.change-user-details-form').on('keyup keypress', function (e) {
                var code = e.keyCode || e.which;

                if (code === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        },

        bindevents: function(){
            this.changePhotoButton.on('click',$.proxy(this.changePhotoButtonClickedEventHandler,this));
            this.submitButton.on('click',$.proxy(this.uploadProfile,this));
        },

        imageFileChangedEventHandler:function(evt, ui){
            var file = ui.all[0];
            if (file) {
                this.cropperPreview.show();

                var self = this;
                $('.js-img').cropper({
                    file: file,
                    bgColor: '#fff',
                    maxSize: [this.cropperPreview.width()-40, $(window).height()-150],
                    minSize: [100, 100],
                    selection: '90%',
                    aspectRatio: 1,
                    onSelect: function(coords) {
                        self.uploadAvatar.fileapi('crop', file, coords);
                    }
                });
            }
        },

        profileUploadCompleteEventHandler:function(evt, xhr){
            this.settingSaveButton.show();
            this.cropperPreview.fadeOut();
            App.blocks('#' + this.cropperPreview.attr('id'), 'state_normal');
            try {
                var result = FileAPI.parseJSON(xhr.xhr.responseText);
                $('#avatar-hidden').attr("value", result.images.filename);
            }catch (er) {
                FileAPI.log('PARSE ERROR:', er.message);
            }
        },

        changePhotoButtonClickedEventHandler: function(event){
            event.preventDefault();
            // When user clicks select image button,
            // open select file dialog programmatically
            this.imageFileInput.click();
            this.settingSaveButton.hide();
        },

        uploadProfile: function(event){
            event.preventDefault();
            
            this.uploadAvatar.fileapi('upload');
            App.blocks('#' + this.cropperPreview.attr('id'), 'state_loading');
        }
    };

    ProfileUpload.init();
});