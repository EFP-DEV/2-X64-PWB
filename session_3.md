# Session 3 : Gestionnaire de tâches

## 🔗 Lien avec la Session 2

Dans la **Session 2**, vous avez créé un portfolio UX/UI avec :
- Une base de données `ux_designer`
- Une table `projets`
- Des fichiers PHP (`connexion.php`, `ajouter_projet.php`, `index.php`)
- Vous savez déjà vous connecter à une base de données
- Vous savez déjà faire des INSERT et des SELECT

**Aujourd'hui (Session 3)**, vous allez créer une **application de gestion de tâches** dans la **même base de données**, en ajoutant simplement une **nouvelle table**.

---

## Note importante sur les noms

Vous allez **réutiliser** :
- ✅ La même base de données : `ux_designer`
- ✅ Le même utilisateur : `ux_designer` / `portfolio2024`
- ✅ Votre fichier `connexion.php` existant

Vous allez **ajouter** :
- ➕ Une nouvelle table : `taches`
- ➕ De nouveaux fichiers PHP dans un nouveau dossier

**Si votre base s'appelle autrement** (ex: `mon_portfolio`, `base_projets`...), pas de problème ! Utilisez juste le même nom partout.

---

## Étape 0 : Démarrage de l'environnement (5 min)

**Rappel Session 2 :** Vous savez déjà faire ça !

### Démarrer les services
- Ouvrir votre outil (XAMPP/MAMP/Laragon)
- Démarrer Apache et MySQL
- Vérifier que tout est bien en vert

### Accéder à phpMyAdmin
Aller sur phpMyAdmin comme en Session 2 :
- XAMPP : `http://localhost/phpmyadmin`
- MAMP : `http://localhost:8888/phpMyAdmin`
- Laragon : `http://localhost/phpmyadmin`

### Créer un nouveau dossier de projet
**Dans htdocs (ou www) :**
- Créer un nouveau dossier `mon_todo`
- **Différent** de votre dossier `portfolio_php` de la Session 2

**Ouvrir avec VSCode :**
- Clic droit sur `mon_todo` → "Ouvrir avec Code"

---

## Étape 1 : Ajouter une nouvelle table à votre base existante (10 min)

**Rappel Session 2 :** Vous aviez créé la base `ux_designer` avec la table `projets`.

**Aujourd'hui :** On va **ajouter** une deuxième table `taches` dans la **même base**.

### Dans phpMyAdmin

1. **Sélectionner votre base** dans la liste à gauche
   - Cliquer sur `ux_designer` (ou le nom de votre base)
   - Vous devriez voir votre table `projets` existante

2. **Créer une nouvelle table :**
   - Cliquer sur l'onglet **SQL** (en haut)
   - Copier-coller ce code :

```sql
CREATE TABLE taches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    statut ENUM('todo', 'progress', 'done') DEFAULT 'todo',
    priorite INT DEFAULT 0,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_echeance DATE
);
```

3. Cliquer "Exécuter"
4. **Vérifier** : Vous devriez maintenant voir **2 tables** :
   - `projets` (Session 2)
   - `taches` (Session 3)

**Différences avec la table `projets` :**
- Pas de champ `image_url` 
- Champ `statut` avec type `ENUM` (valeurs limitées)
- Champ `priorite` de type `INT` (0 à 5)
- `date_creation` automatique

### Ajouter des données de test

Dans l'onglet SQL :

```sql
INSERT INTO taches (titre, description, statut, priorite, date_echeance) VALUES
('Finir le TP de PHP', 'Compléter le gestionnaire de tâches', 'progress', 4, '2026-01-20'),
('Réviser SQL', 'Revoir les requêtes SELECT, INSERT, UPDATE', 'todo', 3, '2026-01-18'),
('Préparer la présentation', 'Créer les slides pour la démo', 'todo', 2, '2026-01-22');
```

Vérifier : Cliquer sur la table `taches` → onglet "Afficher" → voir vos 3 tâches.

---

## Étape 2 : Copier et adapter le fichier de connexion (5 min)

**Rappel Session 2 :** Vous avez déjà un fichier `connexion.php` dans `portfolio_php`.

**Aujourd'hui :** On va le **copier** dans le nouveau dossier.

### Copier le fichier

**Option 1 - Copier manuellement :**
1. Ouvrir votre dossier `portfolio_php`
2. Copier le fichier `connexion.php`
3. Le coller dans le dossier `mon_todo`

**Option 2 - Recréer dans VSCode :**
Dans VSCode (dossier `mon_todo` ouvert), créer `connexion.php` :

```php
<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ux_designer", "ux_designer", "portfolio2024");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
```

**Adaptez selon vos paramètres Session 2 :**
- Même nom de base
- Même utilisateur
- Même mot de passe

**XAMPP par défaut (si pas d'utilisateur créé) :**
```php
$pdo = new PDO("mysql:host=localhost;dbname=ux_designer", "root", "");
```

**MAMP par défaut :**
```php
$pdo = new PDO("mysql:host=localhost;dbname=ux_designer", "root", "root");
```

**Important :** C'est le **même fichier** que Session 2, car on utilise la **même base de données**.

---

## Étape 3 : API JSON (15 min)

**Nouveau concept** par rapport à Session 2 : créer une **API** qui retourne du JSON.

**Différence avec Session 2 :**
- Session 2 : Affichage HTML direct
- Session 3 : On va aussi créer une API pour avoir les données en JSON

### Créer `api.php`

```php
<?php
header('Content-Type: application/json');
require_once 'connexion.php';

$sql = "SELECT * FROM taches";

// ... ici du code viendra pour filtrer

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$taches = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($taches, JSON_PRETTY_PRINT);
?>
```

**Explications :**
- `header()` : Dit au navigateur que c'est du JSON
- `SELECT * FROM taches` : Récupère les tâches (pas les projets !)
- Filtres optionnels avec `$_GET`
- `json_encode()` : Convertit en JSON

**Tester dans le navigateur :**
- `http://localhost/mon_todo/api.php` → toutes les tâches
- `http://localhost/mon_todo/api.php?statut=todo` → filtrer
- `http://localhost/mon_todo/api.php?priorite=haute` → priorité >= 4

---

## Étape 4 : Page d'affichage (30 min)

**Rappel Session 2 :** Vous aviez `index.php` qui affichait les projets.

**Aujourd'hui :** Nouveau `index.php` qui affiche les tâches en **3 colonnes**.

### Créer `index.php`

**Logique similaire à Session 2**, mais avec des différences :

```php
<?php
require_once 'connexion.php';

// Récupérer toutes les tâches (comme les projets en Session 2)
$stmt = $pdo->query("SELECT * FROM taches ORDER BY priorite DESC, date_echeance ASC");
$taches = $stmt->fetchAll(PDO::FETCH_ASSOC);

// NOUVEAU : Regrouper par statut
$groupes = [
    'todo' => [],
    'progress' => [],
    'done' => []
];

foreach($taches as $tache) {
    $groupes[$tache['statut']][] = $tache;
}
?>

// ici HTML
```

**Différences avec Session 2 :**
- Layout en 3 colonnes (au lieu d'une liste)
- Groupement par statut
- Liens pour changer de statut
- Indicateurs de priorité (couleurs)
- Pas d'images

**Tester :** `http://localhost/mon_todo/index.php`

---

## Étape 5 : Formulaire d'ajout (25 min)

**Rappel Session 2 :** Vous aviez `ajouter_projet.html` et `ajouter_projet.php`.

**Aujourd'hui :** Un seul fichier `ajouter.php` qui combine formulaire ET traitement.

### Créer `ajouter.php`

**Structure similaire à Session 2**, mais dans un seul fichier :

```php
<?php
require_once 'connexion.php';

$erreurs = [];
$success = false;

// Traitement du formulaire (comme ajouter_projet.php)
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ici le code d'ajout 
}
?>

// ici HTML

```

**Différences avec Session 2 :**
- Formulaire ET traitement dans le même fichier
- Pas de champ image_url
- Champ priorité avec select (0 à 5)
- Validation côté serveur
- Messages d'erreur affichés

---

## Étape 6 : Traitement des actions (15 min)

**Nouveau** : Fichier pour modifier le statut des tâches.

### Créer `traitement.php`

```php
<?php
require_once 'connexion.php';

$action = $_GET['action'] ?? '';

if($action === 'changer_statut') {
    $id = intval($_GET['id'] ?? 0);
    $nouveau = $_GET['nouveau'] ?? '';
    
    $statuts_valides = ['todo', 'progress', 'done'];
    
    if($id > 0 && in_array($nouveau, $statuts_valides)) {
        $stmt = $pdo->prepare("UPDATE taches SET statut = :statut WHERE id = :id");
        $stmt->execute(['statut' => $nouveau, 'id' => $id]);
    }
}

header('Location: index.php');
exit;
?>
```

**Logique :**
- Récupère l'action, l'ID et le nouveau statut
- Valide que le statut est autorisé
- Fait un UPDATE (comme en Session 2, mais pour le statut)
- Redirige vers index.php

---

## Points de contrôle

### Vérifications essentielles

**1. Même base que Session 2 ?**
- Dans phpMyAdmin, voir votre base `ux_designer`
- Vérifier qu'elle contient **2 tables** : `projets` ET `taches`

**2. Applications séparées ?**
- Dossier `portfolio_php` : application Session 2
- Dossier `mon_todo` : application Session 3
- Chacun a son propre `connexion.php` (même contenu)

**3. Tests à effectuer :**
- `http://localhost/mon_todo/index.php` → voir les tâches en 3 colonnes
- Changer le statut → la tâche change de colonne
- `http://localhost/mon_todo/ajouter.php` → ajouter une tâche
- `http://localhost/mon_todo/api.php` → voir du JSON

**4. Session 2 toujours fonctionnelle ?**
- `http://localhost/portfolio_php/index.php` → voir vos projets
- Les deux applications utilisent la même base mais des tables différentes

---

## Erreurs fréquentes

| Symptôme | Cause probable | Solution |
|----------|---------------|----------|
| "Table doesn't exist" | Mauvais nom de table | Vérifier que vous utilisez `taches` (pas `projets`) |
| "Unknown column" | Mauvais nom de champ | Les tâches n'ont pas `image_url`, mais `statut` et `priorite` |
| Projets affichés au lieu de tâches | Mauvaise requête | Vérifier `SELECT * FROM taches` (pas `projets`) |
| Page blanche | Erreur PHP | Ajouter `error_reporting(E_ALL);` en haut |

---

## Structure finale

```
C:\xampp\htdocs\
├── portfolio_php\          # Session 2 (toujours là)
│   ├── connexion.php
│   ├── index.php
│   └── ajouter_projet.php
│
└── mon_todo\               # Session 3 (nouveau)
    ├── connexion.php       # Copie de Session 2
    ├── index.php           # Affichage 3 colonnes
    ├── ajouter.php         # Formulaire + traitement
    ├── traitement.php      # Changement de statut
    └── api.php             # API JSON
```

**Base de données `ux_designer` :**
- Table `projets` (Session 2)
- Table `taches` (Session 3)

**L'essentiel : Une base, deux tables, deux applications !**
