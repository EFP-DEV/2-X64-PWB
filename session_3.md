# Session 3 : Création d'un gestionnaire de tâches personnel

**Durée :** 4h  
**Modalité :** Individuel (avec guidance)  
**Barème :** /20 points

---

## 1. Objectif

Créer une application web complète de gestion de tâches personnelles intégrant BDD, PHP et sécurité, reprenant ainsi tous les cours précédents. Vous trouverez [ici une version rudimentaire de l'application postit](./postit).

## Note importante sur les noms dans la base de données

⚠️ **ATTENTION** : Dans les spécifications du TP, la base de données s'appelle `todo_app` et la table s'appelle `taches` avec des champs précis (id, titre, description, statut, priorite, date_creation, date_echeance).

**MAIS** si vous avez déjà créé une base de données avec un autre nom (par exemple `gestionnaire_taches`, `mes_taches`, ou même `postit`), **ce n'est pas grave !**

### Ce qui est important :

1. **Cohérence** : Utilisez toujours le même nom partout
   - Si votre base s'appelle `mes_taches` → mettez `mes_taches` dans `connexion.php`
   - Si votre table s'appelle `tasks` → utilisez `tasks` dans vos requêtes SQL

2. **Structure** : Votre table doit avoir les mêmes **types** de champs :
   - Un identifiant unique (peu importe si ça s'appelle `id`, `task_id`, ou `identifiant`)
   - Un titre (peut s'appeler `titre`, `title`, `nom_tache`...)
   - Une description (`description`, `contenu`, `details`...)
   - Un statut (`statut`, `status`, `etat`...)
   - Une priorité (`priorite`, `priority`, `niveau`...)
   - Etc.

### Exemple concret :

**Si vos noms sont différents des spécifications :**

```sql
-- Au lieu de :
CREATE TABLE taches (...);

-- Vous avez peut-être créé :
CREATE TABLE tasks (...);
-- ou
CREATE TABLE mes_taches (...);
```

**Adaptez votre code PHP en conséquence :**

```php
// Dans connexion.php
$dbname = 'mes_taches';  // Votre nom à vous

// Dans vos requêtes
$stmt = $pdo->query("SELECT * FROM tasks");  // Votre nom de table
// Au lieu de
$stmt = $pdo->query("SELECT * FROM taches");
```

### Comment vérifier vos noms actuels ?

1. Ouvrir phpMyAdmin
2. Regarder la liste des bases de données à gauche
3. Cliquer sur votre base
4. Voir le nom exact de votre table
5. Cliquer sur la table → onglet "Structure" → voir les noms exacts des colonnes

### Règle d'or :

**Notez quelque part vos noms exacts** et utilisez-les partout de manière cohérente. L'important n'est pas le nom, mais que tout soit synchronisé entre :
- Votre base de données réelle
- Le fichier `connexion.php`
- Toutes vos requêtes SQL dans PHP

---

## Étape 0 : Démarrage de l'environnement (5 min)

### Démarrer les services
**XAMPP :**
- Ouvrir XAMPP Control Panel
- Démarrer Apache et MySQL (boutons "Start")
- Vérifier que les deux sont bien en vert

**MAMP :**
- Ouvrir MAMP
- Cliquer sur "Start Servers"
- Attendre que les voyants deviennent verts

**Laragon :**
- Ouvrir Laragon
- Cliquer sur "Start All"
- Vérifier que Apache et MySQL sont démarrés

### Accéder à phpMyAdmin
**XAMPP :** `http://localhost/phpmyadmin`
**MAMP :** `http://localhost:8888/phpMyAdmin` (ou via le bouton dans MAMP)
**Laragon :** `http://localhost/phpmyadmin` (ou clic droit sur Laragon → Database)

### Ouvrir VSCode dans le bon dossier
**XAMPP :**
- Aller dans `C:\xampp\htdocs`
- Créer un dossier `mon_todo`
- Clic droit → "Ouvrir avec Code"

**MAMP :**
- Aller dans `/Applications/MAMP/htdocs` (Mac) ou `C:\MAMP\htdocs` (Windows)
- Créer un dossier `mon_todo`
- Clic droit → "Ouvrir avec Code"

**Laragon :**
- Aller dans `C:\laragon\www`
- Créer un dossier `mon_todo`
- Clic droit → "Ouvrir avec Code"

---

## Étape 1 : Créer la base de données (10 min)

### Dans phpMyAdmin
1. Cliquer sur "Nouvelle base de données" (à gauche)
2. Nom : `todo_app` (ou un autre nom de votre choix - **notez-le !**)
3. Interclassement : `utf8mb4_general_ci` (recommandé)
4. Cliquer "Créer"

### Créer la table
1. Sélectionner votre base dans la liste à gauche
2. Cliquer sur l'onglet **SQL** (en haut)
3. Copier-coller le code SQL fourni dans les spécifications
   - ⚠️ Si vous changez le nom de la table ou des champs, **notez vos noms exacts**
4. Cliquer "Exécuter"
5. Vérifier que la table apparaît sous votre base à gauche

### Ajouter des données de test
1. Rester dans l'onglet SQL
2. Utiliser des INSERT pour créer 3-4 tâches d'exemple
   - ⚠️ Utilisez les mêmes noms de champs que dans votre CREATE TABLE
3. Varier les statuts (todo, progress, done) et priorités (0 à 5)
4. Cliquer "Exécuter"
5. Aller dans l'onglet "Afficher" pour voir vos données

---

## Étape 2 : Fichier de connexion (10 min)

### Dans VSCode, créer `connexion.php`

Ce fichier va :
- Définir les paramètres de connexion (host, base, user, password)
- Créer un objet PDO pour se connecter à MySQL
- Gérer les erreurs de connexion

**Paramètres selon votre environnement :**

**XAMPP :**
- Host : `localhost`
- Database : **le nom exact que vous avez créé** (ex: `todo_app`)
- User : `root`
- Password : `''` (vide)

**MAMP :**
- Host : `localhost`
- Database : **le nom exact que vous avez créé**
- User : `root`
- Password : `root`
- Port : ajouter `;port=8889` après le host si nécessaire

**Laragon :**
- Host : `localhost`
- Database : **le nom exact que vous avez créé**
- User : `root`
- Password : `''` (vide)

Utiliser `PDO` avec gestion d'erreurs en `try/catch`.

---

## Étape 3 : API JSON simple (15 min)

### Créer `api.php`

Ce fichier doit :
1. Définir le header `Content-Type: application/json`
2. Inclure la connexion
3. Préparer une requête SELECT de base
   - ⚠️ Utilisez le nom exact de **votre** table
   - ⚠️ Utilisez les noms exacts de **vos** champs
4. Gérer les filtres optionnels via `$_GET` :
   - `?statut=todo` → filtrer par statut (ou `?status=todo` si votre champ s'appelle `status`)
   - `?priorite=haute` → filtrer les priorités >= 4 (adaptez au nom de votre champ priorité)
5. Exécuter la requête
6. Récupérer les résultats avec `fetchAll()`
7. Les convertir en JSON avec `json_encode()`

**Tester dans le navigateur :**
- URL de base pour toutes les tâches
- URL avec paramètre statut
- URL avec paramètre priorite

---

## Étape 4 : Page d'affichage (30 min)

### Créer `index.php`

Cette page doit :
1. Inclure la connexion
2. Récupérer toutes les tâches de la BDD
   - ⚠️ `SELECT * FROM votre_nom_de_table`
3. Les regrouper dans 3 tableaux selon leur statut (todo, progress, done)
   - ⚠️ Utilisez le nom exact de votre champ statut : `$tache['statut']` ou `$tache['status']`
4. Afficher 3 colonnes HTML (une par statut)
5. Pour chaque tâche, afficher :
   - Titre → `$tache['titre']` ou `$tache['title']` selon votre champ
   - Description → `$tache['description']` ou autre
   - Date d'échéance → `$tache['date_echeance']` ou autre
   - Priorité → `$tache['priorite']` ou `$tache['priority']`
   - Indicateur visuel selon priorité (couleur, bordure...)
   - Protéger avec `htmlspecialchars()`
6. Ajouter des liens pour changer le statut (vers `traitement.php`)

**CSS à prévoir :**
- Layout en 3 colonnes (flexbox ou grid)
- Styles pour les cartes de tâches
- Code couleur pour les priorités (rouge/orange/vert)
- Marges et espacements

**URL de test :** `http://localhost/mon_todo/index.php` (ou `:8888` pour MAMP)

---

## Étape 5 : Formulaire d'ajout (25 min)

### Créer `ajouter.php`

Ce fichier combine formulaire HTML et traitement PHP :

**Partie PHP (en haut) :**
1. Vérifier si le formulaire est soumis (`$_SERVER['REQUEST_METHOD'] === 'POST'`)
2. Récupérer les données POST
   - ⚠️ Les noms dans `$_POST['...']` doivent correspondre aux attributs `name` de vos inputs
3. Valider :
   - Titre obligatoire et non vide
   - Priorité entre 0 et 5
   - Date au bon format (optionnel)
4. Si erreurs : les stocker dans un tableau
5. Si pas d'erreurs : INSERT dans la BDD avec requête préparée
   - ⚠️ `INSERT INTO votre_table (vos_champs) VALUES (:placeholders)`
   - Adaptez les noms de colonnes à votre structure
6. Afficher un message de succès

**Partie HTML (en bas) :**
1. Afficher les erreurs si présentes
2. Formulaire avec méthode POST :
   - Input text pour titre (required)
   - Textarea pour description
   - Select pour priorité (0 à 5)
   - Input date pour échéance
   - Bouton submit
   - ⚠️ Les attributs `name` des inputs doivent correspondre à vos noms de champs
3. Lien retour vers index.php

**Sécurité :**
- Toujours utiliser `htmlspecialchars()` pour afficher les données
- Utiliser des requêtes préparées (`:titre`, `:description`... adaptez les noms)
- Valider côté serveur, pas seulement côté client

---

## Étape 6 : Traitement des actions (15 min)

### Créer `traitement.php`

Ce fichier ne contient **que du PHP** (pas d'affichage) :

1. Inclure la connexion
2. Récupérer l'action via `$_GET['action']`
3. Selon l'action "changer_statut" :
   - Récupérer l'ID de la tâche
   - Récupérer le nouveau statut
   - Valider que le statut est valide (todo, progress, done)
   - Faire un UPDATE dans la BDD
     - ⚠️ `UPDATE votre_table SET votre_champ_statut = :statut WHERE votre_champ_id = :id`
4. Rediriger vers `index.php` avec `header('Location: ...')`
5. Toujours terminer par `exit;` après une redirection

**Sécurité :**
- Convertir l'ID en entier avec `intval()`
- Vérifier que le statut est dans la liste autorisée avec `in_array()`
- Utiliser des requêtes préparées

---

## Points de contrôle

### Vérifications essentielles

**1. Serveurs actifs ?**
- Vérifier dans votre outil (XAMPP/MAMP/Laragon) que Apache et MySQL sont démarrés

**2. Base de données créée ?**
- Dans phpMyAdmin, voir votre base dans la liste de gauche
- Cliquer dessus, voir votre table
- Onglet "Afficher" : voir vos données de test
- Onglet "Structure" : **noter les noms exacts de vos colonnes**

**3. Fichiers au bon endroit ?**
- XAMPP : `C:\xampp\htdocs\mon_todo\`
- MAMP : `/Applications/MAMP/htdocs/mon_todo/` ou `C:\MAMP\htdocs\mon_todo\`
- Laragon : `C:\laragon\www\mon_todo\`

**4. Noms cohérents partout ?**
- Le nom dans `connexion.php` = le nom réel de votre base
- Les noms de table dans vos requêtes = le nom réel de votre table
- Les noms de colonnes dans `$row['colonne']` = les noms réels de vos colonnes

**5. Tests à effectuer :**
- Accéder à index.php → voir les tâches en 3 colonnes
- Cliquer sur un lien de changement de statut → la tâche change de colonne
- Aller sur ajouter.php → soumettre une nouvelle tâche
- Accéder à api.php → voir du JSON s'afficher
- Tester api.php avec des paramètres → voir le filtrage fonctionner

---

## Erreurs fréquentes et diagnostic

| Symptôme | Cause probable | Où vérifier |
|----------|---------------|-------------|
| "Page introuvable" | Serveur pas démarré | Panel XAMPP/MAMP/Laragon |
| "Access denied for user" | Mauvais identifiants BDD | `connexion.php` - vérifier user/password |
| "Unknown database" | Nom de base incorrect | `connexion.php` - vérifier que `$dbname` = nom réel |
| "Table doesn't exist" | Nom de table incorrect | Vos requêtes SQL - vérifier le nom de table |
| "Unknown column" | Nom de colonne incorrect | phpMyAdmin Structure - vérifier les noms exacts |
| Page blanche | Erreur PHP non affichée | Ajouter `error_reporting(E_ALL); ini_set('display_errors', 1);` |
| "Headers already sent" | `header()` après du HTML | Vérifier qu'il n'y a pas d'espace/echo avant `header()` |
| Données non insérées | Erreur SQL silencieuse | Vérifier avec `PDO::ATTR_ERRMODE` en mode EXCEPTION |
| "Undefined index" | Nom de champ incorrect | Vérifier `$row['champ']` correspond au nom réel |

---

## Structure finale attendue

```
/mon_todo/
├── connexion.php       # Connexion BDD avec PDO (nom de BDD adapté)
├── index.php           # Affichage 3 colonnes (noms de champs adaptés)
├── ajouter.php         # Formulaire + validation (noms de champs adaptés)
├── traitement.php      # UPDATE statut (noms de champs adaptés)
├── api.php             # SELECT + filtres + JSON (noms adaptés)
└── (style.css)         # CSS optionnel
```

Chaque fichier a un rôle précis : séparation des responsabilités.

**L'essentiel : COHÉRENCE des noms entre votre base de données réelle et votre code PHP.**
