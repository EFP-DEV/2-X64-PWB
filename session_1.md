# Session 1 : Configuration et bases du protocole HTTP

## Objectifs pédagogiques

- Comprendre le rôle du serveur web (Apache)
- Maîtriser le cycle HTTP (requête/réponse)
- Manipuler les requêtes GET et POST en PHP

---

## Étape 1 : Installer et configurer un environnement de développement local

### Objectif : Préparer un environnement complet pour exécuter du PHP et gérer une base de données.

### Démonstration 1 : Installation de XAMPP

1. Télécharger **XAMPP** : [https://www.apachefriends.org](https://www.apachefriends.org)
2. Lancer l’installation, cocher les composants **Apache**, **MySQL**, **PHP**
3. Démarrer **Apache** et **MySQL** via le **XAMPP Control Panel**
4. Ouvrir `http://localhost` dans le navigateur pour vérifier le bon fonctionnement

---

## Étape 2 : Comprendre le protocole HTTP

### Objectif : Comprendre comment le navigateur et le serveur communiquent.

### Théorie

- Le protocole **HTTP** permet la **communication entre un client (navigateur) et un serveur web**.
- Deux éléments clés :
  - **Requête HTTP** : envoyée par le navigateur
  - **Réponse HTTP** : renvoyée par le serveur

### Démonstration 2 : Inspecter une requête HTTP avec l’inspecteur web

1. Ouvrir Google Chrome ou Firefox
2. Aller sur un site simple comme `http://localhost`
3. Ouvrir l’outil développeur : clic droit > **Inspecter** > onglet **Network (Réseau)**
4. Rafraîchir la page

**Observer** :
- Méthode (`GET`)
- URL demandée
- Code de réponse (`200 OK`)
- Type de contenu (`text/html`)
- En-têtes de requête et de réponse

### Exemple : structure d’une requête et d’une réponse HTTP

```http
// Requête
GET /page.html HTTP/1.1
Host: localhost

// Réponse
HTTP/1.1 200 OK
Content-Type: text/html
```

### Codes de statut à connaître

| Code | Signification              |
|------|----------------------------|
| 200  | OK                         |
| 404  | Not Found (page absente)   |
| 500  | Internal Server Error      |

---

## Étape 3 : Comprendre les méthodes GET et POST

### Objectif : Comprendre les deux principales méthodes HTTP utilisées pour envoyer des données.

### Démonstration 3 : Création d’un formulaire GET

#### HTML – `form_get.html`

```html
<form action="traitement_get.php" method="GET">
  <label>Nom :</label>
  <input type="text" name="nom">
  <input type="submit" value="Envoyer">
</form>
```

#### PHP – `traitement_get.php`

```php
<?php
  echo "Bonjour, " . htmlspecialchars($_GET['nom']);
?>
```

### Démonstration 4 : Formulaire POST

#### HTML – `form_post.html`

```html
<form action="traitement_post.php" method="POST">
  <label>Email :</label>
  <input type="email" name="email">
  <input type="submit" value="Envoyer">
</form>
```

#### PHP – `traitement_post.php`

```php
<?php
  echo "Email reçu : " . htmlspecialchars($_POST['email']);
?>
```

### Démonstration 5 : Visualisation avec Inspecteur Web

1. Aller sur `form_post.html`
2. Remplir le formulaire et cliquer sur **Envoyer**
3. Aller dans l’onglet **Network**
4. Cliquer sur la requête `traitement_post.php`
5. Observer :
   - La méthode : **POST**
   - Les données envoyées dans l’onglet **Payload**
   - Le code de réponse

### Comparaison GET / POST

| Critère              | GET                          | POST                         |
|----------------------|------------------------------|-------------------------------|
| Données visibles     | Oui (dans l’URL)             | Non (dans le corps de la requête) |
| Sécurité             | Moins sécurisé               | Plus sécurisé pour des infos sensibles |
| Utilisation typique  | Recherches, navigation       | Formulaires de connexion, envoi de données |

---

## Étape 4 : Lien avec l’architecture en couches (3 tiers)

- **Tier de présentation** : formulaire HTML
- **Tier d'application** : script PHP (`traitement_post.php`)
- **Tier de données** : sera abordé dans la Leçon 2

---

## Étape 5 : Activité guidée

Créer un formulaire HTML avec les champs suivants :
- prénom
- nom
- message

Créer un script PHP qui récupère les données et les affiche avec un message personnalisé.

### Exemple attendu :
```php
<?php
echo "Bonjour " . htmlspecialchars($_POST['prenom']) . " " . htmlspecialchars($_POST['nom']) . "<br>";
echo "Votre message : " . nl2br(htmlspecialchars($_POST['message']));
?>
```

---

## Étape 6 : Évaluation formative

### Questionnaire de révision

1. Que signifie HTTP ?
2. Quelle différence entre GET et POST ?
3. Que fait `$_GET['nom']` ?
4. Comment voir une requête HTTP dans le navigateur ?
5. Que signifie le code HTTP 404 ?

---

Souhaites-tu que je complète avec un **corrigé pour l’activité guidée** ou une **fiche synthèse imprimable** ?