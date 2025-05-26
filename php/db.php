<?php
$host = 'db'; // nome del servizio nel docker-compose
$db   = 'sqli_project';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>