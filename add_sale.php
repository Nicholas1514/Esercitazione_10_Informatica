<?php
include 'header.php';
include 'connessione.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_POST['client_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $ingredient_id = $_POST['ingredient_id'];
    $ingredient_quantity = $_POST['ingredient_quantity'];

    // Inserisci la vendita nella tabella vendite
    $query = "INSERT INTO vendite (ID_cliente, ID_prodotto, data) VALUES ('$client_id', '$product_id', '$date')";
    if ($conn->query($query) === TRUE) {
        $sale_id = $conn->insert_id; // Ottieni l'ID della vendita appena inserita

        // Inserisci l'ingrediente nella tabella vendite_ingredienti
        $ingredient_query = "INSERT INTO vendite_ingredienti (ID_vendita, ID_ingrediente, quantità) VALUES ('$sale_id', '$ingredient_id', '$ingredient_quantity')";
        $conn->query($ingredient_query);

        // Aggiorna il totale del prodotto
        $update_query = "UPDATE prodotti SET totale = totale - $quantity WHERE ID = $product_id";
        $conn->query($update_query);

        // Aggiorna il totale dell'ingrediente
        $update_ingredient_query = "UPDATE ingredienti_prodotti SET quantita = quantita - $ingredient_quantity WHERE ID = $ingredient_id";
        $conn->query($update_ingredient_query);

        header('Location: sales.php');
    } else {
        $error = "Errore: " . $query . "<br>" . $conn->error;
    }
}

// Recupera i prodotti disponibili
$products_query = "SELECT * FROM prodotti";
$products_result = $conn->query($products_query);

// Recupera i clienti disponibili
$clients_query = "SELECT * FROM clienti";
$clients_result = $conn->query($clients_query);

// Recupera gli ingredienti disponibili
$ingredients_query = "SELECT * FROM ingredienti";
$ingredients_result = $conn->query($ingredients_query);
?>

<h2>Aggiungi Vendita</h2>

<?php if (isset($error)) { echo '<div class="alert alert-danger">' . $error . '</div>'; } ?>

<form action="add_sale.php" method="post">
    <div class="form-group">
        <label for="client_id">Cliente</label>
        <select class="form-control" id="client_id" name="client_id" required>
            <?php while ($client = $clients_result->fetch_assoc()) { ?>
                <option value="<?php echo $client['ID']; ?>"><?php echo $client['nome']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="product_id">Prodotto</label>
        <select class="form-control" id="product_id" name="product_id" required>
            <?php while ($product = $products_result->fetch_assoc()) { ?>
                <option value="<?php echo $product['ID']; ?>"><?php echo $product['nome']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="quantity">Quantità</label>
        <input type="number" class="form-control" id="quantity" name="quantity" required>
    </div>
    <div class="form-group">
        <label for="ingredient_id">Ingrediente</label>
        <select class="form-control" id="ingredient_id" name="ingredient_id" required>
            <?php while ($ingredient = $ingredients_result->fetch_assoc()) { ?>
                <option value="<?php echo $ingredient['ID']; ?>"><?php echo $ingredient['nome']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="ingredient_quantity">Quantità Ingrediente</label>
        <input type="number" class="form-control" id="ingredient_quantity" name="ingredient_quantity" required>
    </div>
     <div class="form-group">
        <label for="date">Data</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>
    <button type="submit" class="btn btn-primary">Aggiungi Vendita</button>
</form>

<?php include 'footer.php'; ?>
