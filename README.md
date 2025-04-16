# 🍺 Brasserie Terroir & Saveurs

Projet de gestion d'une brasserie artisanale en PHP/MySQL.  
Ce dépôt contient le code source du site, l'architecture des pages, ainsi que la structure de la base de données utilisée.

## 🔗 Liens Utiles

- 🌐 Site : http://evan-epsi.rf.gd/  
- 📌 Trello : [Lien vers le Trello](https://trello.com/invite/b/67b482c7e2d7bd00ed8d61ba/ATTI356f235c4f3a28d8b89fcd92086fe6874A074E68/brasserie)  
- 💾 GitHub : https://github.com/evandeveer/brasserie

## 🔗 Technologies utilisées

- PHP
- HTML / CSS TEMPLATE w3School 
- javascript


## 🔐 Accès de test

| Rôle       | Email                    | Mot de passe |
|------------|--------------------------|--------------|
| Admin      | admin@gmail.com          | 1234         |
| Brasseur   | brasseur@gmail.com       | 1234         |
| Direction  | direction@gmail.com      | 1234         |
| Caissier   | caissier@gmail.com          | 1234            |
| Client     | jean@gmail.com          | 1234         |

---

## 🧱 Base de Données

### `contacts`

| Champ      | Type         | Description             |
|------------|--------------|-------------------------|
| id         | int          | Identifiant unique      |
| nom        | varchar(25)  | Nom                     |
| prenom     | varchar(25)  | Prénom                  |
| email      | varchar(50)  | Email                   |
| telephone  | varchar(20)  | Téléphone               |
| date       | datetime     | Date de contact         |
| message    | varchar(500) | Message envoyé          |

---

### `matieres_premieres`

| Champ    | Type           | Description                   |
|----------|----------------|-------------------------------|
| id       | int UNSIGNED   | Identifiant unique            |
| nom      | varchar(25)    | Nom de la matière première    |
| quantite | decimal(10,2)  | Quantité disponible           |
| date_achat | datetime  | Date d'achat du stock           |

---

### `produits`

| Champ      | Type          | Description                   |
|------------|---------------|-------------------------------|
| id         | int           | Identifiant produit           |
| nom        | varchar(25)   | Nom du produit                |
| description| varchar(500)  | Description                   |
| prix       | float         | Prix                          |
| quantite   | int           | Quantité en stock             |
| image      | varchar(200)  | Chemin de l'image             |

---

### `reservations`

| Champ       | Type                          | Description                         |
|-------------|-------------------------------|-------------------------------------|
| id          | int                           | ID de réservation                   |
| id_client   | int                           | ID du client                        |
| id_produit  | int                           | ID du produit                       |
| quantite    | int                           | Quantité réservée                   |
| date_resa   | datetime                      | Date de réservation                 |
| statut_resa | enum('en attente','validée','refusée','') | Statut de la réservation   |
| prix_resa   | int(5)                        | Prix total                          |

---

### `roles`

| Champ | Type         | Description     |
|-------|--------------|-----------------|
| id    | int          | ID du rôle      |
| role  | varchar(50)  | Nom du rôle     |

---

### `utilisateurs`

| Champ     | Type         | Description                |
|-----------|--------------|----------------------------|
| id        | int          | ID utilisateur             |
| nom       | varchar(50)  | Nom                        |
| prenom    | varchar(50)  | Prénom                     |
| email     | varchar(50)  | Email                      |
| telephone | varchar(50)  | Numéro de téléphone        |
| mdp       | varchar(50)  | Mot de passe (hash)        |
| id_role   | int(1)       | Rôle associé               |
| fidelite  | int(7)       | Points de fidélité         |


## 🔗 Relations Clés Étrangères   

- **`utilisateurs.id_role`** → `roles.id`  


- **`reservations.id_client`** → `utilisateurs.id`  


- **`reservations.id_produit`** → `produits.id`

### `Structure du site :`


├── admin.php  
├── brasseur.php  
├── caissier.php  
├── client.php  
├── connexion.php  
├── connexion_redirection.php  
├── contact_redirection.php  
├── deconnexion.php  
├── direction.php  
├── index.php  
└── Logs.php  

Fonctionnalités : 
## Contact : 
l'utilisateur remplis le formulaire puis l'envoie, les données sont enregistrer en base de donnée
<div align="center">
  <div style="display: inline-block; margin: 10px;">
    <img src="https://github.com/user-attachments/assets/6b10ec47-3b53-43ef-8a98-80b889121000" alt="Description de l'image"/>
    </div>
</div>

## Connexion : 
l'utilisateur remplis le formulaire puis l'envoie. Le mdp hashé ainsi que l'email est comparé avec les données de la table utilisateur pour en trouver un sinon la connexion echoue. Autrement on stock l'id user dans la session utilisateur
<div align="center">
  <div style="display: inline-block; margin: 10px;">
    <img src="https://github.com/user-attachments/assets/67e756e2-4994-4c7e-a80f-9d3f618205ae" alt="Description de l'image"/>
    <img src="https://github.com/user-attachments/assets/0fe2a821-5cc4-458b-9860-4305cde83d8c" alt="Description de l'image"/>
    </div>
</div>



## Brasserie : 

l'utilisateur remplis le formulaire puis l'envoie. Un calcul est ensuite fait puis affiche les differents resultats.
<div align="center">
  <div style="display: inline-block; margin: 10px;">
    <img src="https://github.com/user-attachments/assets/49c2a146-6a10-41c8-8827-3e923c2ba097" alt="Description de l'image"/>
    </div>
</div>

l'utilisateur remplis le formulaire puis l'envoie. Un calcul est ensuite fait puis affiche les differents resultats.
<div align="center">
  <div style="display: inline-block; margin: 10px;">
    <img src="https://github.com/user-attachments/assets/49c2a146-6a10-41c8-8827-3e923c2ba097" alt="Description de l'image"/>
    </div>
</div>

Le brasseur peut gerer les stocks des matières premieres. Il peut en ajouter, modifier ou supprimer.
  <div style="display: inline-block; margin: 10px;">
    <img src="https://github.com/user-attachments/assets/c3b7a3dd-65d0-4a4d-9ac8-1b6b6699aa17" alt="Description de l'image"/>
    </div>
</div>

Le brasseur peut gerer les stocks des produits finis pret à la vente. Il peut en ajouter, modifier ou supprimer.
  <div style="display: inline-block; margin: 10px;">
    <img src="https://github.com/user-attachments/assets/87a8c611-8293-4265-9b4b-e14450b91de3" alt="Description de l'image"/>
    </div>
</div>











