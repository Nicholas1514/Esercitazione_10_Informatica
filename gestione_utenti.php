<?php
include 'connessione.php';
session_start();

// Controllo accesso: solo gli admin possono accedere
if (!isset($_SESSION['loggedin']) || $_SESSION['ruolo'] != 'admin') {
    header('Location: login.php');
    exit;
}

include 'headerA.php';

// Recupero utenti dal database
$query = "SELECT * FROM clienti";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Utenti</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

</head>
<body>
<div class="container mt-4">
    <h2>Gestione Utenti</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ruolo</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['ruolo']; ?></td>
                    <td>
                        <a href="modifica_utente.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Modifica</a>
                        <a href="elimina_utente.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo utente?');">Elimina</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="aggiungi_utente.php" class="btn btn-primary">Aggiungi Nuovo Utente</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php include 'footer.php'; ?>
