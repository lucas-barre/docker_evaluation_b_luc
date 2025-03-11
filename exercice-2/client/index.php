<?php
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = 'root';
$pass = getenv('DB_ROOT_PASSWORD');
$dbname = 'docker_doc_dev';

if (!$host || !$dbname || !$user || !$pass) {
    die("Erreur : une ou plusieurs variables d'environnement ne sont pas définies.");
}

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM article";
    $stmt = $conn->query($sql);

    $env = getenv('ENV');

    if ($env === 'dev') {
        echo "Environnement de développement";
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    } else {
        error_reporting(0);
        ini_set('display_errors', 0);
    }

    // Afficher les résultats dans une table HTML
    echo "<html><body><table border='1'><tr><th>ID</th><th>Title</th><th>Body</th></tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>" . htmlspecialchars($row['id']) . "</td><td>" . htmlspecialchars($row['title']) . "</td><td>" . htmlspecialchars($row['body']) . "</td></tr>";
    }
    echo "</table></body></html>";

    $conn = null; // Fermer la connexion
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
