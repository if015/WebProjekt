<?php

session_start();

unlink("../avatar/".$_SESSION['dir'].".jpeg");
unlink("../avatar/".$_SESSION['dir'].".jpg");
unlink("../avatar/".$_SESSION['dir'].".gif");
unlink("../avatar/".$_SESSION['dir'].".png");

header('location: ../profile.php');