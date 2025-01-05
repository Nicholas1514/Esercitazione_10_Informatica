<?php
include 'header.php';
include 'connessione.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM prodotti WHERE ID = $id";
$result = $conn->query($query);
$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $total = $_POST['total'];

    $query = "UPDATE prodotti SET nome = '$name', totale = '$total' WHERE ID = $id";
    if ($conn->query($query) === TRUE) {
        header('Location: products.php');
    } else {
        $error = "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

<h2>Edit Product</h2>

<?php if (isset($error)) { echo '<div class="alert alert-danger">' . $error . '</div>'; } ?>

<form action="edit_product.php?id=<?php echo $id; ?>" method="post">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['nome']; ?>" required>
    </div>
    <div class="form-group">
        <label for="total">Total</label>
        <input type="number" class="form-control" id="total" name="total" value="<?php echo $product['totale']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<?php include 'footer.php'; ?>
