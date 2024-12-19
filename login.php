<?php
include 'connessione.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM clienti WHERE nome = '$username' AND cognome = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<?php include 'header.php'; ?>

<h2>Login</h2>

<?php if (isset($error)) { echo '<div class="alert alert-danger">' . $error . '</div>'; } ?>

<form action="login.php" method="post">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>

<?php include 'footer.php'; ?>
