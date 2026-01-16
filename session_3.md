# Session 3 : Création et mise en production d'un gestionnaire de tâches personnel

**Durée :** 4h  
**Modalité :** Individuel (avec guidance)  
**Barème :** /20 points

---

## 1. Objectif

Créer une application web complète de gestion de tâches personnelles intégrant BDD, PHP et sécurité, reprenant ainsi tous les cours précédents. Vous trouverez [ici une version rudimentaire de l'application postit](./postit).

---

## 2. Spécifications techniques

### 2.1 Base de données `todo_app`

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

---

## 3. Fonctionnalités requises

### 3.1 Interface principale (`index.php`) - 5 pts

- Affichage des tâches par statut (3 colonnes : À faire / En cours / Terminé)
- Possibilité de changer le statut (liens/boutons)
- Indicateur visuel pour priorité haute (0 bas, 5 haut)
- **Bonus :** tri par date d'échéance / priorité (JavaScript)

### 3.2 Ajout de tâche (`ajouter.php`) - 4 pts

- Formulaire avec validation côté serveur
- Champs : titre (obligatoire), description, priorité, date d'échéance
- Gestion d'erreurs avec retour utilisateur

### 3.3 API JSON (`api.php`) - 3 pts

```php
// GET uniquement : retourner toutes les tâches en JSON
// ?statut=todo pour filtrer par statut
// ?priorite=haute pour filtrer par priorité
```

---

## 4. Structure des fichiers attendus

```
/mon_todo/
├── index.php           # Interface principale
├── ajouter.php         # Formulaire d'ajout
├── modifier.php        # Modification de tâche (bonus)
├── traitement.php      # Traitement des actions
├── api.php             # API JSON (GET only)
├── connexion.php       # Connexion BDD
├── connexion_prod.php  # Connexion BDD production
└── style.css           # CSS basique (optionnel)
```

---

## 5. Critères d'évaluation

| Critère | Points | Détails |
|---------|--------|---------|
| **Fonctionnalité** | 5/20 | L'application fonctionne selon les spécifications |
| **Code PHP** | 5/20 | Structure, lisibilité, bonnes pratiques |
| **Interface** | 5/20 | Ergonomie, organisation visuelle, UX |
| **API JSON** | 3/20 | Conformité, filtres fonctionnels |
| **Base de données** | 2/20 | Structure, requêtes optimisées |

---

## 6. Livrables

- **Dépôt GIT :** Code complet + export SQL de la base
- **Deadline :** Fin de séance
