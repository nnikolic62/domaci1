<?php

$server = "localhost";
$user = "root";
$password = "";
$db = "baza2";

$connection = new mysqli($server, $user, $password, $db);

if($connection -> connect_errno){
    echo "Neuspesno povezivanje sa bazom";
    exit();
}

$connection->set_charset("utf8");

?>