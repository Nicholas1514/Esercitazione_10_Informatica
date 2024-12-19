<?php
include 'header.php';
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

<?php include 'footer.php'; ?>

