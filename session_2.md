# Session 2 : Intégration d’une base de données avec PHP et phpMyAdmin

## Introduction – Du formulaire HTML à la base de données

Cette séance est organisée autour d’un **mini-projet concret** :
la création d’un **portfolio UX/UI dynamique**, capable de stocker et d’afficher des projets.

Avant de parler directement de bases de données, la leçon démarre volontairement par des éléments **déjà connus des apprenants**.

### 1. À quoi sert une base de données ?

Discussion collective / introduction :

* Pourquoi a-t-on besoin de bases de données ?
* Que se passe-t-il quand un site contient beaucoup de contenus ?
* Où sont stockées les données sur :

  * un site vitrine ?
  * un réseau social ?
  * une application “cloud” ?

👉 L’objectif est de comprendre qu’une base de données sert à :

* stocker des informations de manière structurée
* les retrouver, les modifier, les afficher
* rendre un site **dynamique**

---

### 2. Exercice de démarrage : réfléchir aux types de données

À partir d’un **exercice simple**, les apprenants listent les informations que l’on peut saisir dans un formulaire HTML :

* texte court
* texte long
* date
* URL
* nombre
* choix (catégories, outils, etc.)

On identifie ensemble :

* les champs `<input>`
* les `<textarea>`
* les différents `type` possibles (`text`, `date`, `url`, etc.)

👉 Transition pédagogique clé :
**Chaque champ de formulaire correspond à une information à stocker.**

---

### 3. Du formulaire vers la base de données

À partir de cette réflexion :

1. On imagine un **formulaire de projet UX/UI**
2. On liste les champs nécessaires
3. On transforme cette liste en **structure de base de données**
4. On comprend que :

   * le formulaire sert à **collecter**
   * la base de données sert à **stocker**
   * PHP sert à **faire le lien**

👉 C’est ce chemin que la séance va suivre, étape par étape.

---

## Objectifs pédagogiques

À l’issue de cette leçon, l’apprenant sera capable de :

* Concevoir une base de données adaptée à un **portfolio UX/UI designer**
* Créer et gérer une table contenant **des projets design illustrés**
* Se connecter à la base de données avec **PHP/PDO**
* Réaliser des opérations **CRUD** en toute sécurité
* Gérer l’**ajout d’images via des URL publiques**
* Sécuriser les formulaires avec des validations serveur

---

## Partie 1 : Conception de la base de données

### 1. Thème : Portfolio de projets UX/UI

Chaque projet contient :

* Un titre
* Une catégorie (UX, UI, Design System, etc.)
* Les outils utilisés (Figma, Adobe XD…)
* Une description
* Une date de création
* Une **image du projet** via une **URL publique**

### 2. Structure de la table `projets`

| Champ         | Type SQL                            | Description                                     |
| ------------- | ----------------------------------- | ----------------------------------------------- |
| id            | `INT` (AUTO_INCREMENT, PRIMARY KEY) | Identifiant unique du projet                    |
| titre         | `VARCHAR(255)`                      | Titre du projet                                 |
| categorie     | `VARCHAR(100)`                      | Type de projet (UX, UI…)                        |
| outils        | `VARCHAR(255)`                      | Outils utilisés                                 |
| description   | `TEXT`                              | Résumé du projet                                |
| date_creation | `DATE`                              | Date du projet ou mise en ligne                 |
| image_url     | `VARCHAR(500)`                      | Lien public vers une image illustrant le projet |

> 💡 Tu peux héberger les images sur **Imgur**, **Cloudinary**, ou directement dans un sous-dossier local, selon ton niveau.

---

## Partie 2 : Création de la base de données avec phpMyAdmin

1. Ouvrir [phpMyAdmin](http://localhost/phpmyadmin)  
2. Aller dans **Utilisateurs > Ajouter un utilisateur**
3. Renseigner :
   - Nom d’utilisateur : `ux_designer`
   - Hôte : `localhost`
   - Mot de passe : `portfolio2024`
4. Cocher **Créer une base de données du même nom**
5. Valider

La base `ux_designer` est créée avec tous les privilèges.

---

## Partie 3 : Création de la table `projets`

1. Aller sur la base `ux_designer`
2. Créer une table nommée `projets` avec 7 champs (voir tableau ci-dessus)
3. Définir `id` comme clé primaire, auto-incrémentée

---

## Partie 4 : Mise en place du projet PHP

### 1. Préparer le dossier dans `htdocs`

- Créer un dossier nommé `portfolio_php` dans :
  - `C:\xampp\htdocs\` (XAMPP)
  - `C:\wamp64\www\` (WAMP)

### 2. Ouvrir dans VS Code

- Fichier > Ouvrir un dossier…
- Choisir `portfolio_php`

---

## Partie 5 : Connexion PHP à MySQL

### `connexion.php`

```php
<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ux_designer", "ux_designer", "portfolio2024");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données.";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
```

---

## Partie 6 : Formulaire HTML avec champ image

### `ajouter_projet.html`

```html
<form action="ajouter_projet.php" method="post">
  Titre : <input type="text" name="titre"><br>
  Catégorie : <input type="text" name="categorie"><br>
  Outils : <input type="text" name="outils"><br>
  Description : <textarea name="description"></textarea><br>
  Date de création : <input type="date" name="date_creation"><br>
  URL de l'image : <input type="url" name="image_url" placeholder="https://..."><br>
  <input type="submit" value="Ajouter le projet">
</form>
```

> 🔗 On insère ici **une URL publique** de l’image, pas l’image elle-même.

---

## Partie 7 : Traitement PHP sécurisé avec image

### `ajouter_projet.php`

```php
<?php

// Validation basique
if (empty($_POST['titre']) || empty($_POST['image_url'])) {
    die("Titre et image sont obligatoires.");
}

require 'connexion.php';

$stmt = $pdo->prepare("
    INSERT INTO projets (titre, categorie, outils, description, date_creation, image_url)
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->execute([
    $_POST['titre'],
    $_POST['categorie'],
    $_POST['outils'],
    $_POST['description'],
    $_POST['date_creation'],
    $_POST['image_url']
]);

echo "Projet ajouté avec succès !";
?>
```

---

## Partie 8 : Affichage des projets avec image

### `index.php`

```php
<?php
require 'connexion.php';

$projets = $pdo->query("SELECT * FROM projets ORDER BY date_creation DESC")->fetchAll();
?>

<h1>Mes projets UX/UI</h1>

<?php foreach ($projets as $projet): ?>
  <div class="projet">
    <h2><?= htmlspecialchars($projet['titre']) ?></h2>
    <p><strong>Catégorie :</strong> <?= $projet['categorie'] ?></p>
    <p><strong>Outils :</strong> <?= $projet['outils'] ?></p>
    <p><?= nl2br(htmlspecialchars($projet['description'])) ?></p>
    <p><strong>Date :</strong> <?= $projet['date_creation'] ?></p>
    <img src="<?= htmlspecialchars($projet['image_url']) ?>" alt="Aperçu du projet" width="300">
  </div>
<?php endforeach; ?>
```
