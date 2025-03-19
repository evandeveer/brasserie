<?php
$servername = "sql208.infinityfree.com";
$username = "if0_38342249";
$password = "8p8SMDlMUOmSd";
$dbname = "if0_38342249_brasserie";
date_default_timezone_set('Europe/Paris'); 

$bdd = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

if (isset($_GET['id_caissier'])) {
    $id_caissier = $_GET['id_caissier'];
} else {
    header("Location: index.php");
}