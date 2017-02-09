/**
 * Created by danielbrunner on 08.02.17.
 */

Dropzone.options.awesomeDropzone = {
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 5, // MB
    dictDefaultMessage: "Ziehe die Datei hier herein",
    thumbnailHeight: 60, thumbnailWidth: 60,
    init: function () {
        // Set up any event handlers
        this.on('complete', function (file) {
            this.removeFile(file);
            location.reload();
        });
    }
};

$("#inputUpload").fileinput();