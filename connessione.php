<?php
$host = 'localhost';
$user = 'zappanicholas';
$password = '';
$dbname = 'my_zappanicholas';

$conn = new mysqli($host, $user, $password, $dbname);

if($conn -> connect_error)
{
    die("Connessione fallita: " . $conn -> connect_error);
}

?>