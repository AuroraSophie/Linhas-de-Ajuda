<?php
$hostname = "127.0.0.1";
$database = "foryourvoice";
$username = "Aurora";
$password = "91800760Bh@";

$mysqli = new mysqli($hostname, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}
?>
