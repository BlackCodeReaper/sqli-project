<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login - SQLi Project</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include 'db.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $query = "SELECT nome, cognome, email, telefono, ruolo FROM utenti WHERE email LIKE '%$email%'";

    echo "<pre>DEBUG QUERY: $query</pre>"; // utile per debugging

    if ($conn->multi_query($query)) {
        do {
            if ($result = $conn->store_result()) {
                echo "<h2>Risultati:</h2>";
                echo "<table border='1' cellpadding='5'>";
                echo "<tr><th>Nome</th><th>Cognome</th><th>Email</th><th>Telefono</th><th>Ruolo</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cognome']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['telefono']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['ruolo']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                $result->free();
            }
        } while ($conn->more_results() && $conn->next_result());
    } else {
        echo "<p>Errore nella query: " . $conn->error . "</p>";
    }
}

$conn->close();
?>
</body>
</html>