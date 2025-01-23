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

// Recupero i dati dell'utente
$query = "SELECT * FROM clienti WHERE ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Utente non trovato.";
    exit;
}

$utente = $result->fetch_assoc();

// Gestione del form di modifica
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $ruolo = $_POST['ruolo'];

    $updateQuery = "UPDATE clienti SET nome = ?, ruolo = ? WHERE ID = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("ssi", $nome, $ruolo, $id);

    if ($updateStmt->execute()) {
        echo "<script>alert('Utente modificato con successo!'); window.location.href='gestione_utenti.php';</script>";
    } else {
        echo "Errore durante la modifica dell'utente.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Utente</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
 <style>
        body {
            background: linear-gradient(to bottom right, #6a11cb, #2575fc);
            color: black;
            font-family: Arial, sans-serif;
        }
        h3
        {
        	font-weight: bold;
            text-align: center;
            text-decoration: underline;
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
<body>
<div class="container mt-4">
    <h2 class="alert alert-warning">Modifica Utente</h2>
    <form method="POST">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($utente['nome']); ?>" required>
        </div>
        <div class="form-group">
            <label for="ruolo">Ruolo</label>
            <select class="form-control" id="ruolo" name="ruolo">
                <option value="admin" <?php if ($utente['ruolo'] == 'admin') echo 'selected'; ?>>Admin</option>
                <option value="utente" <?php if ($utente['ruolo'] == 'utente') echo 'selected'; ?>>Utente</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salva Modifiche</button>
        <a href="gestione_utenti.php" class="btn btn-secondary">Annulla</a>
    </form>
</div>
</body>
</html>
