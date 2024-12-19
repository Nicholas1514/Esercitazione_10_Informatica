<?php
include 'header.php';
include 'connessione.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$query = "SELECT * FROM prodotti";
$result = $conn->query($query);
?>

<h2>Prodotti</h2>
<a href="add_product.php" class="btn btn-primary mb-2">Aggiungi Prodotto</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>TOTALE</th>
            <th>FUNZIONI</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['totale']; ?></td>
                <td>
                    <a href="edit_product.php?id=<?php echo $row['ID']; ?>" class="btn btn-warning btn-sm">Modifica</a>
                    <a href="delete_product.php?id=<?php echo $row['ID']; ?>" class="btn btn-danger btn-sm">Elimina</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
