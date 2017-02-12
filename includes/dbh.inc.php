<?php

$conn = new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de;dbname=u-if015', 'user', 'password');

if (!$conn) {
    die("Verbindung zur Datenbank konnte nicht hergestellt werden");
}