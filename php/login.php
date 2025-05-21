<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login - SQLi Demo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

echo "<pre>DEBUG: Username = [$username]\nPassword = [$password]</pre>";

$query = "SELECT * FROM utenti WHERE username = '$username' AND password = '$password'";

echo "<pre>DEBUG: Query = [$query]</pre>";

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>Benvenuto, " . htmlspecialchars($row['username']) . "</h2>";
    echo "<p><a href='dashboard.php'>Vai alla dashboard</a></p>";
} else {
    echo "<h2>Login fallito</h2>";
    echo "<p><a href='login.html'>Riprova</a></p>";
}

$conn->close();
?>
</body>
</html>