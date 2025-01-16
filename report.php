<?php
//include 'header.php';
include 'connessione.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$soglia = 10;  // Example threshold value
$query = "SELECT * FROM prodotti WHERE totale < $soglia";
$result = $conn->query($query);
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

<head>
<div class = "container">
<h2>Alerts</h2>
<?php if ($result->num_rows > 0 || $result2 -> num_rows > 0) { ?>
    <div class="alert alert-warning">
        <strong>Attenzione!</strong> I seguenti prodotti sono sotto la soglia:
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>TOTALE</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['totale']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
<?php } else { ?>
    <div class="alert alert-success">
        <strong>Nessun problema!</strong> Tutti i prodotti sono sopra la soglia.
    </div>
<?php } ?>

<?php include 'footer.php'; ?>
<?php
//include 'header.php';
include 'connessione.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// Modifica la query per unire le tabelle ingredienti, prodotti e ingredienti_prodotti
$query = "
    SELECT ip.ID, i.nome AS nome_ingrediente, p.nome AS nome_prodotto, ip.quantita 
    FROM ingredienti_prodotti ip
    JOIN ingredienti i ON ip.ID_ingrediente = i.ID
    JOIN prodotti p ON ip.ID_prodotto = p.ID
";
$result = $conn->query($query);
?>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class="container">
<h2>VENDITE</h2>
<a href="add_sale.php" class="btn btn-primary mb-2">AGGIUNGI VENDITA</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>PRODOTTO</th>
            <th>INGREDIENTE</th>
            <th>QUANTITA' INGREDIENTE</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['nome_prodotto']; ?></td>
                <td><?php echo $row['nome_ingrediente']; ?></td>
              	<td><?php echo $row['quantita']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
<html>