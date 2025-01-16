<?php
include 'connessione.php';
session_start();

// Controllo accesso: solo gli admin possono accedere
if (!isset($_SESSION['loggedin']) || $_SESSION['ruolo'] != 'admin') {
    header('Location: login.php');
    exit;
}

include 'headerA.php';

// Gestione del form di aggiunta utente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $password = $_POST['password'];
    $ruolo = $_POST['ruolo'];
    
    $query = "INSERT INTO clienti (nome, cognome, ruolo) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $nome, $password, $ruolo);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Utente aggiunto con successo!</div>";
    } else {
        echo "<div class='alert alert-danger'>Errore nell'aggiunta dell'utente.</div>";
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Utente</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom right, #6a11cb, #2575fc);
            color: black;
            font-family: Arial, sans-serif;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            margin-top: 50px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .btn-primary {
            background-color: green;
            border: none;
        }
        .btn-primary:hover {
            background-color: limegreen;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2>Aggiungi Nuovo Utente</h2>
    <form action="aggiungi_utente.php" method="POST">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="ruolo">Ruolo:</label>
            <select class="form-control" id="ruolo" name="ruolo" required>
                <option value="utente">Utente</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Aggiungi Utente</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


