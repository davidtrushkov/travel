

Dropzone.prototype.getErroredFiles = function () {
    var file, _i, _len, _ref, _results;
    _ref = this.files;
    _results = [];
    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        file = _ref[_i];
        if (file.status === Dropzone.ERROR) {
            _results.push(file);
        }
    }
    return _results;
};

/**
 * This is for the Travel Flyers Photo Uploads.
 * @type {{paramName: string, maxFilesize: number, acceptedFiles: string}}
 */
Dropzone.options.addFlyerPhotosForm = {
    paramName: 'photo',
    maxFilesize: 2,
    maxFiles: 12,
    acceptedFiles: '.jpg, .jpeg, .png',
    init: function () {
        this.on("queuecomplete", function (file) {
            if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0 && this.getErroredFiles().length === 0) {
                location.reload();
            }
        });
    }
}
//# sourceMappingURL=dropzone.flyer.js.map
