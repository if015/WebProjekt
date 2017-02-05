//Datein löschen - funktioniert
//eventuell noch Abfrage einbauen if(confirm...)?

$(document).ready(function () {
    $(".unlink").click(function () {
        var element = $(this);
        var del_id = element.attr("id");
        var info = 'id=' + del_id;
        $.ajax({
            type: "POST",
            url: "includes/unlink.inc.php",
            data: info
        });
        $(this).closest('tr').fadeOut('slow');
        return false;
    });
});

$(document).ready(function () {
    $(".movetotrash").click(function () {
        var element = $(this);
        var pkk = element.attr("id");
        var value = "trash//"+pkk;
        $.ajax({
            type: "POST",
            url: "includes/rename.inc.php",
            data: {value:value, pk:pkk}
        });
        $(this).closest('tr').fadeOut('slow');
        return false;
    });
});

$(document).ready(function () {
    $(".undo").click(function () {
        var element = $(this);
        var value = element.attr("id");
        var pkk = "trash//"+value;
        $.ajax({
            type: "POST",
            url: "includes/rename.inc.php",
            data: {value:value, pk:pkk}
        });
        $(this).closest('tr').fadeOut('slow');
        return false;
    });
});


//Dateien umbennen - funktioniert


$(function() {
    $.fn.editable.defaults.mode = 'inline';
    $(document).on('click', '.edit', function (e) {
        e.stopPropagation();
        $(this).parent().prev('td').prev('td').prev('td').find('a').editable('toggle');
    });
    $('publicname-change').editable();
    $(document).on('click', '.editable-submit', function () {
        var pkk = $(this).closest('td').find('a').attr('data-pk');
        var value = $('.input-sm').val();
        $.ajax({
            type: "POST",
            url: "includes/rename.inc.php",
            data: {value:value, pk:pkk},
            success: function () {
                $("#userfiles").load("files.php #userfiles");
            }
        });
    });
    $(document).on('click', '.editable-submit', function (e) {
        $("#userfiles").load("files.php #userfiles");
    });
});

  // Drag and Drop
+ function($) {
    'use strict';


    var dropZone = document.getElementById('drop-zone');
    var uploadForm = document.getElementById('js-upload-form');

    var startUpload = function(files) {
        console.log(files)
    }

    uploadForm.addEventListener('submit', function(e) {
        var uploadFiles = document.getElementById('js-upload-files').files;
        e.preventDefault()

        startUpload(uploadFiles)
    })

    dropZone.ondrop = function(e) {
        e.preventDefault();
        this.className = 'upload-drop-zone';

        startUpload(e.dataTransfer.files)
    }

    dropZone.ondragover = function() {
        this.className = 'upload-drop-zone drop';
        return false;
    }

    dropZone.ondragleave = function() {
        this.className = 'upload-drop-zone';
        return false;
    }

}(jQuery);
