# Codes de statut HTTP à connaître

### ✅ Codes 2xx – Succès

| Code | Nom       | Description                                | Exemple d’usage                               |
|------|-----------|--------------------------------------------|------------------------------------------------|
| 200  | OK        | Requête traitée avec succès                | Affichage d'une page HTML                     |
| 201  | Created   | Ressource créée avec succès                | Ajout d’un nouvel utilisateur via une API     |
| 202  | Accepted  | Requête acceptée mais traitement différé   | Requête de traitement en arrière-plan         |
| 204  | No Content| Réussite sans contenu dans la réponse      | Suppression d’une ressource                   |



### 🔁 Codes 3xx – Redirections

| Code | Nom             | Description                                       | Exemple d’usage                          |
|------|------------------|---------------------------------------------------|-------------------------------------------|
| 301  | Moved Permanently| L’URL demandée a changé de manière permanente     | Redirection vers une nouvelle page       |
| 302  | Found            | Redirection temporaire                            | Redirection après envoi de formulaire    |
| 303  | See Other        | La réponse est disponible sous une autre URL      | Redirection vers une page de confirmation|
| 304  | Not Modified     | La ressource n’a pas changé depuis la dernière requête | Optimisation du cache                |


### 🚫 Codes 4xx – Erreurs côté client

| Code | Nom          | Description                             | Exemple d’usage                                |
|------|---------------|-----------------------------------------|-------------------------------------------------|
| 400  | Bad Request   | La requête est mal formée              | Paramètre manquant dans un formulaire          |
| 401  | Unauthorized  | Authentification requise               | Accès à un espace protégé sans connexion       |
| 403  | Forbidden     | Accès refusé malgré l'identification   | Tentative d'accès sans droit d'accès           |
| 404  | Not Found     | Ressource introuvable                  | Page supprimée ou URL erronée                  |


### 💥 Codes 5xx – Erreurs côté serveur

| Code | Nom                  | Description                                      | Exemple d’usage                                 |
|------|-----------------------|--------------------------------------------------|--------------------------------------------------|
| 500  | Internal Server Error| Erreur interne du serveur                        | Erreur dans un script PHP                       |
| 501  | Not Implemented      | Fonction non supportée par le serveur           | Méthode HTTP inconnue                           |
| 502  | Bad Gateway          | Mauvaise réponse d’un autre serveur en cascade  | Problème entre proxy et serveur principal       |
| 503  | Service Unavailable  | Serveur temporairement indisponible             | Surcharge ou maintenance                        |


[Tous les codes de statut HTTP](https://developer.mozilla.org/fr/docs/Web/HTTP/Status) sont disponibles sur la [MDN Web Docs](https://developer.mozilla.org/fr/docs/Web/HTTP/Status).

---

### 🎲 **Mini-jeu express**

🕒 **Temps : 1 minute**  
🎯 **Mission :**  
> Rendez-vous sur la page des [codes de statut HTTP sur MDN](https://developer.mozilla.org/fr/docs/Web/HTTP/Status) et trouvez **le code le plus absurde ou drôle** mentionné.  
>  


