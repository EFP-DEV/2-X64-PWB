<?php
// Affichage des données envoyées via POST pour le débogage
echo "<h2>Contenu de \$_POST :</h2>";
var_dump($_POST);

// Affichage des données envoyées via GET pour le débogage
echo "<h2>Contenu de \$_GET :</h2>";
var_dump($_GET);

// Paramètres de connexion à la base de données
$host = 'localhost';
$db   = 'CHANGE_WITH_DB_NAME';
$user = 'CHANGE_WITH_DB_USER';
$pass = 'CHANGE_WITH_DB_PASS';
$charset = 'utf8mb4';

// Construction du DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Options de configuration pour PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Affiche les erreurs PDO
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Résultats en tableaux associatifs
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Désactive l'émulation des requêtes préparées
];

try {
    // Connexion à la base de données
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Vérifie que le champ 'nom' a été soumis et n'est pas vide
    if (!empty($_POST['nom'])) {
        $texte = trim($_POST['nom']); // Nettoyage de l'entrée utilisateur

        // Requête préparée pour insérer les données en toute sécurité
        $stmt = $pdo->prepare(
            'INSERT INTO `post-it` (`texte`, `creation`, `modification`) 
             VALUES (?, current_timestamp(), NULL)'
        );
        $stmt->execute([$texte]);

        echo "<p>Post-it ajouté avec succès !</p>";
    } else {
        echo "<p>Erreur : le champ 'nom' est vide.</p>";
    }

} catch (PDOException $e) {
    // Gestion des erreurs de connexion ou d'exécution SQL
    echo "<p>Erreur de base de données : " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
