<?php

$conn = new PDO('mysql:: host=mars.iuk.hdm-stuttgart.de;dbname=u-if015', 'if015', 'vohcie1ETh');

if (!$conn) {
    die("Verbindung zur Datenbank konnte nicht hergestellt werden");
}
/**
 * Created by PhpStorm.
 * User: danielbrunner
 * Date: 23.11.16
 * Time: 22:10
 */