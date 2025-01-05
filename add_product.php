<?php
include 'header.php';
include 'connessione.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $total = $_POST['total'];

    $query = "INSERT INTO prodotti (nome, totale) VALUES ('$name', '$total')";
    if ($conn->query($query) === TRUE) {
        header('Location: products.php');
    } else {
        $error = "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

<h2>Aggiungi Prodotto</h2>

<?php if (isset($error)) { echo '<div class="alert alert-danger">' . $error . '</div>'; } ?>

<form action="add_product.php" method="post">
    <div class="form-group">
        <label for="name">Nome</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="total">Totale</label>
        <input type="number" class="form-control" id="total" name="total" required>
    </div>
    <button type="submit" class="btn btn-primary">AGGIUNGI</button>
</form>

<?php include 'footer.php'; ?>
