## Session 3: Creation et mise en production d'un gestionnaire de tâches personnel

**Durée :** 4h 
**Modalité :** Individuel  (avec guidance pour la mise en production)
**Barème :** /20 points

### Objectif
Créer une application web complète de gestion de tâches personnelles intégrant BDD, PHP et sécurité, puis la déployer en production, reprenant ainsi tous les cours precedents. Vous trouverez [ici une version rudimentaire de l'application postit](./postit).

### Spécifications techniques

**Base de données `todo_app`**
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

### Fonctionnalités requises

#### 1. Interface principale (`index.php`) - 5 pts
- Affichage des tâches par statut (3 colonnes : À faire / En cours / Terminé)
- Possibilité de changer le statut (liens/boutons)
- Indicateur visuel pour priorité haute (0 bas, 5 haut)
- Bonus: tri par date d'échéance / priorité (javascript)

#### 2. Ajout de tâche (`ajouter.php`) - 4 pts
- Formulaire avec validation côté serveur
- Champs : titre (obligatoire), description, priorité, date d'échéance
- Gestion d'erreurs avec retour utilisateur

#### 3. API JSON (`api.php`) - 3 pts
```php
// GET uniquement : retourner toutes les tâches en JSON
// ?statut=todo pour filtrer par statut
// ?priorite=haute pour filtrer par priorité
```

#### 4. Sécurité - 3 pts
- Utilisation de requêtes préparées
- Protection XSS basique

#### 5. Mise en production - 5 pts
- **Déploiement sur serveur Gandi**
- Configuration BDD en ligne
- Transfert FTP via FileZilla
- Site fonctionnel accessible via URL fournie
- Documentation des identifiants de connexion

### Bonus - 2 pts
- **Modification de tâches** (`modifier.php`)
  - Formulaire pré-rempli
  - Update en base
  - Redirection après modification

### Fichiers attendus
```
/mon_todo/
├── index.php          # Interface principale
├── ajouter.php         # Formulaire d'ajout
├── modifier.php        # Modification de tâche (bonus)
├── traitement.php      # Traitement des actions
├── api.php            # API JSON (GET only)
├── connexion.php      # Connexion BDD
├── connexion_prod.php  # Connexion BDD production
└── style.css          # CSS basique (optionnel)
```

### Critères d'évaluation
- **Fonctionnalité** (7/20) : L'application fonctionne selon les specs
- **Code PHP** (5/20) : Structure, lisibilité, bonnes pratiques
- **Sécurité** (3/20) : Validation, requêtes préparées, XSS
- **Déploiement** (5/20) : Site en ligne, BDD configurée, accès fonctionnel

### Livrables
1. **GIT repo** : Le code complet + export SQL de la base
2. **URL production** : Lien vers le site déployé sur Gandi
3. **Documentation** : Fichier texte avec identifiants FTP/BDD utilisés

**Deadline :** Fin de séance

**Note :** Les identifiants de production seront fournis en fin de séance.
