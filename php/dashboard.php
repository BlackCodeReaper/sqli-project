<?php
include 'db.php';

$query = "SELECT id, email, ruolo FROM utenti";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - SQLi Demo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Lista utenti (dati pubblici)</h1>

    <?php
    if ($result && $result->num_rows > 0) {
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>ID</th><th>Email</th><th>Ruolo</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ruolo']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Nessun utente trovato.</p>";
    }
    ?>

    <hr>

    <hr>
    <h2>Cerca utenti per email</h2>
    <form method="POST" action="search.php">
        <input type="text" name="email" placeholder="es. @gmail.com">
        <button type="submit">Cerca</button>
    </form>

</body>
</html>

<?php
$conn->close();
?>