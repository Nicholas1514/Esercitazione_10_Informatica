<?php
include 'connessione.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$query = "DELETE FROM prodotti WHERE ID = $id";
if ($conn->query($query) === TRUE) {
    header('Location: products.php');
} else {
    echo "Error deleting record: " . $conn->error;
}
?>
