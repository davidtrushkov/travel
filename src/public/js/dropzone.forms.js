/**
 * This is for the Travel Flyer Banner Photo Uploads.
 * @type {{paramName: string, maxFilesize: number, acceptedFiles: string, init: Function}}
 */
Dropzone.options.addBannerForm = {
    paramName: 'photo',
    maxFilesize: 3,
    acceptedFiles: '.jpg, .jpeg, .png',
    // Refresh page when upload is complete.
    init: function () {
        this.on("queuecomplete", function (file) {
            if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                location.reload();
            }
        });
    }
}


/**
 * This is for the Travel Flyers Photo Uploads.
 * @type {{paramName: string, maxFilesize: number, acceptedFiles: string}}
 */
Dropzone.options.addFlyerPhotosForm = {
    paramName: 'photo',
    maxFilesize: 2,
    maxFiles: 12,
    acceptedFiles: '.jpg, .jpeg, .png'
}



Dropzone.options.addPhotosForm = {
    paramName: 'photo',
    maxFilesize: 3,
    acceptedFiles: '.jpg, .jpeg, .png, .bmp',
    maxFiles: 1,
    // Refresh page when upload is complete.
    init: function () {
        this.on("queuecomplete", function (file) {
            if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                location.reload();
            }
        });
    }
}
//# sourceMappingURL=dropzone.forms.js.map
