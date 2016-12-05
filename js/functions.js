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