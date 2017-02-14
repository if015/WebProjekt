/**
 * Created by danielbrunner on 08.02.17.
 */

Dropzone.options.awesomeDropzone = {
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 10, // MB
    dictDefaultMessage: "Ziehe die Datei hier hinein",
    dictFileTooBig: "Die Datei ist zu groß (maximal 10 MB)",
    thumbnailHeight: 60, thumbnailWidth: 60,
    init: function () {
        // Set up any event handlers
        this.on('complete', function (file) {
            this.removeFile(file);
            location.reload();
        });
    }
};

Dropzone.options.avatarDropzone = {
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 2, // MB
    acceptedFiles: "image/jpeg,image/png,image/gif",
    dictDefaultMessage: "Ziehe dein neues Profilbild hinein",
    dictInvalidFileType: "Es muss ein Bild sein",
    dictFileTooBig: "Das Bild ist zu groß (maximal 2 MB)",
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