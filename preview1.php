
<html>
<head>
</head>
<body>
 

<?php

$alldata = scandir('files'); // ordner, wo bei mir dateien liegen

foreach ($alldata as $file) {
	$info = pathinfo('files'."/".$file); 
	
	if ($file != "." && $file != ".."  && $file != "_notes" && $dateiinfo['basename'] != "Thumbs.db")  
 {
	$bildtypen= array("jpg", "jpeg", "gif", "png");
 	if(in_array($dateiinfo['extension'],$bildtypen)){

 ?>
            <div class="galerie">
                <a href="<?php echo $info['dirname']."/".$info['basename'];?>">
                <img src="<?php echo $info['dirname']."/".$info['basename'];?>" width="140" alt="Vorschau" /></a> 
                <span><?php echo $info['filename']; ?> </span>
            </div>
 <?php 
 } else { ?>
            <div class="file">
             <a href="<?php echo $info['dirname']."/".$info['basename'];?>">&raquo<?php echo $info['filename']; ?></a> (<?php echo $dateiinfo['extension']; ?> 
            </div>
            <?php } ?>
<?php
 };
 };
?>
 






</body>
</html>

