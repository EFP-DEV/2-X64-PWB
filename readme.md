# Programmation Web : Backend
|    foo                 |                                     bar                |
|------------------------|--------------------------------------------------------|
| **Module**             | 5.8.9                                                  |
| **Niveau**             | 2e année                                               |
| **Durée**              | 16 heures                                              |
| **Référentiel**        | IFAPME-SFPME – UX/UI Designer                          |
| **Pré-requis**         | Connaissances de base en HTML/CSS et JavaScript        |
| **Public cible**       | Étudiants en UX/UI Design                              |
| **Formateur**          | Dieleman Sammy                                         |
| **Date de création**   | 2022                                                   |
| **Version**            | 2025-5.0                                               |

# Table des matières
- [Programmation Web : Backend](#programmation-web--backend)
  - [Table des matières](#table-des-matières)
  - [Objectifs pédagogiques](#objectifs-pédagogiques)
  - [Plan de cours](#plan-de-cours)
  - [Leçon 1 : Configuration et bases du protocole HTTP](#leçon-1--configuration-et-bases-du-protocole-http)
  - [Leçon 2 : Intégration de base de données](#leçon-2--intégration-de-base-de-données)
  - [Leçon 3 : Déploiement et concepts avancés](#leçon-3--déploiement-et-concepts-avancés)
  - [Évaluation](#évaluation)

## Objectifs pédagogiques
- Comprendre le fonctionnement d’un serveur web et du protocole HTTP
- Savoir créer et manipuler une base de données MySQL
- Être capable de réaliser des opérations CRUD en PHP
- Appréhender les concepts de sécurité liés aux applications web
- Être capable de déployer une application web simple
- Comprendre les bases de la consommation et de la création d'APIs

---

## Leçon 1 : Configuration et bases du protocole HTTP

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

## Leçon 2 : Intégration de base de données

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

## Leçon 3 : Déploiement et concepts avancés

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
- **Critères** :
  - Capacité à configurer un environnement backend (XAMPP, base de données)
  - Compréhension du protocole HTTP et des interactions client/serveur
  - Réalisation d’un CRUD complet en PHP/MySQL
  - Production ou consommation d’une API simple en JSON
  - Application des bonnes pratiques de sécurité et de validation

---

Souhaites-tu que je te propose une **fiche d'exercice corrigée**, un **schéma visuel d'une architecture 3 tiers**, ou un **template d'examen** ?