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

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $query = "SELECT id, email, ruolo FROM utenti WHERE email LIKE '%$email%'";

    echo "<pre>DEBUG QUERY: $query</pre>"; // utile per debugging

    if ($conn->multi_query($query)) {
        do {
            if ($result = $conn->store_result()) {
                echo "<h2>Risultati:</h2>";
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