/**
 * Created by danielbrunner on 26.11.16.
 */


//Datein löschen - funktioniert
//eventuell noch Abfrage einbauen if(confirm...)?

$(document).ready(function () {
    $(".unlink").click(function () {
        //oben event
        //alert(event.target.id);
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