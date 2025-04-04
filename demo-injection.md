
# Demo Injection SQL

## 1. Création de la base de données

### 1.1 Créer une table `users`

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);
```

### 1.2 Insérer des utilisateurs fictifs

```sql
INSERT INTO users (username, password) VALUES
('admin', 'admin123'),
('alice', 'alicepass'),
('bob', 'bobpass');
```

---

## 2. Création du formulaire HTML

```html
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion utilisateur</h2>
    <form action="login.php" method="GET">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
```

---

## 3. Script PHP vulnérable (`login.php`)

```php
<?php

// Connexion à la base de données
require 'connexion.php';

// Entrées utilisateur
$username = $_GET['username'];
$password = $_GET['password'];

// Requête vulnérable
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $pdo->query($sql);

if ($result->rowCount() > 0) {
    echo "✅ Accès autorisé";
} else {
    echo "⛔ Accès refusé";
}
?>
```

---

## 4. 💀 Exemple d'injection SQL

### 4.1 Données saisies

- **Username** : `' OR 1=1 --`
- **Password** : *(vide)*

### 4.2 Requête générée

```sql
SELECT * FROM users WHERE username = '' OR 1=1 --' AND password = '';
```

> Résultat : l'authentification est contournée.

---

## 5. ✅ Version sécurisée avec requêtes préparées

```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
$stmt->execute([
    ':username' => $username,
    ':password' => $password
]);

if ($stmt->rowCount() > 0) {
    echo "✅ Accès autorisé";
} else {
    echo "⛔ Accès refusé";
}
```

---

## 6. 🔎 Analyse des erreurs de sécurité

### 6.1 Concaténation directe dans SQL

```php
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
```

- ❌ Injection SQL possible.

### 6.2 Utilisation de `GET` au lieu de `POST`

```html
<form action="login.php" method="get">
```

- ❌ Exposition des identifiants dans l’URL.

### 6.3 Aucune validation des entrées

```php
$username = $_GET['username'];
```

- ❌ Pas de filtrage ni de contrôle.

### 6.4 Absence de requêtes préparées

- ❌ Vulnérabilité à l’injection SQL.

### 6.5 Stockage des mots de passe en clair

```sql
password VARCHAR(100)
```

- ❌ Aucun chiffrement.

### 6.6 Authentification rudimentaire

- ❌ Pas de sessions ni de protection contre les attaques.

### 6.7 Mauvaise conception de la base

- ❌ `VARCHAR(100)` inadapté pour des hash sécurisés.

### 6.8 Absence de séparation des responsabilités

- ❌ Connexion + traitement + affichage mélangés.

---

## 7. 🧾 Résumé des erreurs

| N° | Erreur                                | Gravité  | Détail                            |
|----|----------------------------------------|----------|-----------------------------------|
| 1  | Concaténation de données non filtrées  | Critique | Injection SQL directe             |
| 2  | Utilisation de GET au lieu de POST     | Moyenne  | Identifiants exposés              |
| 3  | Pas de validation côté serveur         | Critique | Entrées malveillantes possibles   |
| 4  | Requêtes non préparées                 | Critique | Aucun mécanisme anti-injection    |
| 5  | Mots de passe en clair                 | Critique | Compromission en cas de fuite     |
| 6  | Authentification simpliste             | Moyenne  | Pas de sécurité ou sessions       |
| 7  | Schéma de table non adapté             | Faible   | Problèmes de cohérence            |
| 8  | Code spaghetti                         | Faible   | Difficile à maintenir             |
