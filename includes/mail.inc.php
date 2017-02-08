<?php
/**
 * Created by PhpStorm.
 * User: isabellefrantzen
 * Date: 06.02.17
 * Time: 21:11
 */
session_start();
include 'files';

//es fehlt noch Bezug zu einem Button

$mailtext = '<html>
<head>
    <title>Folgende Datei wurde mit dir geteilt:</title>
</head>
 
<body>
 
<h1>"/includes/download.inc.php?file=<?php echo $file ?>&dir=<?php echo $dir ?>/"</h1>
 
 
</body>
</html>
';

$empfaenger = $_POST['empfaenger'];
$absender   = $_POST['absender'];
$betreff    = $_POST['betreff'];
$antwortan  = "ICH@testkarnickel.de";

$header  = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=iso-8859-1\r\n";


$header .= "From: $absender\r\n";
$header .= "Reply-To: $antwortan\r\n";

$header .= "X-Mailer: PHP ". phpversion();

mail( $empfaenger,
    $betreff,
    $mailtext,
    $header);

echo "Mail wurde gesendet!";
?>