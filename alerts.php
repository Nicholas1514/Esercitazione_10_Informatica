<?php
include 'header.php';
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
<?php } else { ?>
    <div class="alert alert-success">
        <strong>Nessun problema!</strong> Tutti i prodotti sono sopra la soglia.
    </div>
<?php } ?>

<?php include 'footer.php'; ?>

