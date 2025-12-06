# Programmation Web Backend

# Table des matières
  - [Objectifs pédagogiques](#objectifs-pédagogiques)
  - [Session 1 : Configuration et bases du protocole HTTP](#session-1--configuration-et-bases-du-protocole-http)
  - [Session 2 : Intégration de base de données](#session-2--intégration-de-base-de-données)
  - [Session 3 : Déploiement et concepts avancés](#session-3--déploiement-et-concepts-avancés)
  - [Évaluation](#évaluation)

## Objectifs pédagogiques
- Comprendre le fonctionnement d’un serveur web et du protocole HTTP
- Savoir créer et manipuler une base de données MySQL
- Être capable de réaliser des opérations CRUD en PHP
- Appréhender les concepts de sécurité liés aux applications web
- Être capable de déployer une application web simple
- Comprendre les bases de la consommation et de la création d'APIs

---

## Session 1 : Configuration et bases du protocole HTTP

**Support** : [Session 1](session_1.md)


**Objectifs pédagogiques** :
- Comprendre le rôle du serveur web (Apache)
- Maîtriser le cycle HTTP (requête/réponse)
- Manipuler les requêtes GET et POST en PHP

**Contenus** :
- Installation et configuration de **XAMPP** (Apache, MySQL, PHP)
- Vérification du fonctionnement des services via navigateur
- Présentation du protocole **HTTP** : 
  - Structure d’une requête
  - Structure d’une réponse
  - Codes de statut
- Méthodes **GET** et **POST** :
  - Exemple : formulaire de contact
  - Différences entre GET et POST
- Scripts PHP simples :
  - Récupération de données via `$_GET` et `$_POST`
  - Affichage de réponses conditionnelles

**Références au référentiel** :
- Tier de présentation (HTML, formulaire)
- Tier d'application (traitement PHP)
- Introduction au fonctionnement du backend (requêtes HTTP)
- Exposition de services simples via HTTP


---

## Session 2 : Intégration de base de données
**Support** : [Session 2](session_2.md)

**Objectifs pédagogiques** :
- Comprendre la structure d’une base de données relationnelle
- Savoir connecter un script PHP à MySQL
- Réaliser des opérations CRUD (Create, Read, Update, Delete)
- Introduire les notions de sécurité et validation

**Contenus** :
- Création d’une base de données **MySQL** via phpMyAdmin
- Connexion en PHP avec **mysqli** et **PDO**
- Introduction au langage **SQL** :
  - `SELECT`, `INSERT`, `UPDATE`, `DELETE`
- Démonstration :
  - Formulaire d’inscription
  - Insertion des données en base
  - Affichage dynamique
- **Injection SQL** :
  - Exemple d’attaque
  - Prévention avec requêtes préparées (`prepare`, `bind_param`)
- Validation des données (côté serveur)
- Gestion des erreurs de connexion et d’exécution SQL


**Références au référentiel** :
- SGBD relationnel (MySQL)
- Types de données (`int`, `varchar`, `date`, etc.)
- Bonnes pratiques : formes normales, validation
- Impact sur l’UX : fiabilité des données, sécurité

---

## Session 3 : Déploiement et concepts avancés

**Support** : [Session 3](session_3.md)

**Objectifs pédagogiques** :
- Mettre en ligne une application web
- Travailler avec des services et des données JSON
- Appréhender les bases de la sécurité côté client et serveur

**Contenus** :
- Déploiement web :
  - Transfert de fichiers par **FTP**
  - Gestion de domaine et configuration **DNS**
- Introduction aux **APIs JSON** :
  - Structure d’un objet JSON
  - Création d’une API en PHP
  - Consommation via **JavaScript (fetch)** ou **PHP (curl)**
- Sécurité :
  - Introduction aux attaques **XSS**
  - Bonnes pratiques pour se prémunir des injections dans les champs texte

**Références au référentiel** :
- Architecture SOA : définition de service, exposition via API
- Fonctionnement de l’appel à un service distant
- Protection des données utilisateur et impact sur l’expérience

---

## Évaluation

- **Modalité** : Examen final


# Meta
 **Créateur** : Dieleman Sammy
 **Création** : 2022
 **Version** : 2025-5.0
