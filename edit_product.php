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
<html>
<head>
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
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class = "container">
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
</div>
<?php include 'footer.php'; ?>
</html>
