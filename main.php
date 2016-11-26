<?php
session_start();
$pdo = new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de;dbname=u-db118', 'db118', 'iad1jai1Ai');

$dirwert = $_SESSION['dir'];
$dir ='uploads/' . $dirwert . '/';

if (is_null($_SESSION['userid'])) {
    header("Location: login.inc.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="de" xmlns="http://www.w3.org/1999/html">

<head>
    <title>Hauptseite</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style/style.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        $(function () {
            $('body').on('click', '.submitUpload', function (e) {
                $(this.form).submit();
                $('#upload').modal('hide');
            });
        });
    </script>

    <script>
        /*--------------------------------LÖSCHEN ----------------------------*/
        $(document).ready(function () {
            $(".delete").click(function () {
                //oben event
                //alert(event.target.id);
                var element = $(this);
                var del_id = element.attr("id");
                var info = 'id=' + del_id;
                if (confirm("Are you sure you want to delete this?")) {
                    $.ajax({
                        type: "POST",
                        url: "unlink.php",
                        data: info,
                        success: function () {
                        }
                    });
                    $(this).closest('tr').fadeOut('fast');
                }
                return false;
            });
        });
    </script>

</head>

<body>





            <img src="img/user.jpeg" height="48" width="48" class="img-circle"/>
            <h2>
                <?php
                echo $_SESSION['vorname'];
                ?>
            </h2>


<a href="includes/logout.inc.php" >Abmelden</a>




<div class="container">
    <h1>Meine Dateien</h1>

    <!-- Trigger the modal with a button -->
    <div class="btn-group" role="group">

        <!-- Ordner sind zu kompliziert
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#newDir">
            <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>  Neuer Ordner
        </button>
        -->

        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#upload">
            <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload
        </button>

        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#download">
            <span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download
        </button>

        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#delete">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Löschen
        </button>

        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#changeName">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Umbenennen
        </button>

        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#share">
            <span class="glyphicon glyphicon-share" aria-hidden="true"></span> Teilen
        </button>


    </div>

    <!-- Modals -->

    <!-- Modal: Upload -->

    <div class="modal fade" id="upload" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload</h4>
                </div>
                <div class="modal-body">
                    <?php
                    if (isset($_FILES["Datei"])) {
                        $startname = $_FILES["Datei"]["tmp_name"];
                        $zielname = $_FILES["Datei"]["name"];
                        $zielname = $dir . basename($zielname);
                        if (@move_uploaded_file($startname, $zielname)) {
                            unset($_FILES["Datei"]);
                            //echo "Datei wurde &uuml;bertragen";
                            //header('location: main.php');
                        } else {
                            echo "Fehler.";
                        }
                    }
                    ?>

                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="Datei" /><br />
                        <!-- <input type="submit" value="Upload" /> -->
                    <!-- </form> -->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary submitUpload">
                        <span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Upload</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<div class="container">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Datei</th>
            <th>Gr&ouml;&szlig;e</th>
            <th>Letzte &Auml;nderung</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <!--
            Anzeige der Dateien mittels scandir
            und Ausgabe als Tabelle
            mit Dateigröße in kb und letzter Änderung
         -->

        <?php

        // echo $dir; //zur Fehlersuche: Verzeichnis oder Datei nicht gefunden?! -> Fehler beseitigt.

        foreach (scandir($dir) as $file) {
            $fileinfo = pathinfo($dir."/".$file);
            $size = ceil(filesize($dir."/".$file)/1024) . "kb";
            $mdate = filemtime($dir."/".$file);
            if ($file != "." && $file != "..") {
                ?>
                <tr>
                    <td>
                        <a href="<?php echo $fileinfo['dirname'] . "/" . $fileinfo['basename']; ?>">
                            <?php echo $fileinfo['basename']; ?></a>
                    </td>
                    <td>
                        <?php echo $size; ?>
                    </td>
                    <td>
                        <?php echo date("d.m.Y H:i", $mdate); ?>
                    </td>
                    <td>
                        <a><span id="<?php echo $dir . $file; ?>" class='delete glyphicon glyphicon-trash'></span> </a>
                        <!--
                        <button type="button" class="btn btn-default btn-sm">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </button>
                        -->
                    </td>
                </tr

                <?php
            }
        };
        ?>
        </tbody>
    </table>
</div>

<div style="position: fixed; bottom: 0;">
&copy; 2016
</div>



</body>
</html>
