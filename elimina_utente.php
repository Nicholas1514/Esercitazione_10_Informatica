<?php
include 'connessione.php';
session_start();

// Controllo accesso: solo gli admin possono accedere
if (!isset($_SESSION['loggedin']) || $_SESSION['ruolo'] != 'admin') {
    header('Location: login.php');
    exit;
}

// Verifica se è stato passato un ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID utente non valido.";
    exit;
}

$id = intval($_GET['id']);

// Eliminazione utente
$query = "DELETE FROM clienti WHERE ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('Utente eliminato con successo!'); window.location.href='gestione_utenti.php';</script>";
} else {
    echo "Errore durante l'eliminazione dell'utente.";
}
?>
