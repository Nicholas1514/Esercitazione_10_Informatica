<?php
include 'headerU.php';
include 'connessione.php';
session_start();

// Verifica che l'utente sia loggato
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
$id_cliente = $_SESSION['user_id'];
$nome_cliente = $_SESSION['username'];

// Recupera gli ordini dal database con i dettagli dei clienti e dei prodotti
$query = "
   SELECT v.ID, p.nome AS nome_prodotto, v.data 
    FROM vendite v
    JOIN prodotti p ON v.ID_prodotto = p.ID
    WHERE v.ID_cliente = ?
    ORDER BY v.data DESC
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();
?>
<html>
<head>
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
<div class = "container">
<h2 class = "alert alert-info"> ID CLIENTE: <?php echo $id_cliente ?></h2>
<h2 class = "alert alert-info">Elenco Ordini</h2>

<!-- Pulsante per aggiungere un nuovo ordine -->
<a href="add_sale.php" class="btn btn-primary mb-2">AGGIUNGI ORDINE</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID Ordine</th>
            <th>Cliente</th>
            <th>Prodotto</th>
            <th>Data Ordine</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Ciclo per visualizzare gli ordini
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $nome_cliente/*$row['nome_cliente']*/ . "</td>";
                echo "<td>" . $row['nome_prodotto'] . "</td>";
                echo "<td>" . $row['data'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nessun ordine trovato.</td></tr>";
        }
     
        ?>
    </tbody>
</table>
</div>
</html>
