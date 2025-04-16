# 🍺 Brasserie Terroir & Saveurs

Projet de gestion d'une brasserie artisanale en PHP/MySQL.  
Ce dépôt contient le code source du site, l'architecture des pages, ainsi que la structure de la base de données utilisée.

## 🔗 Liens Utiles

- 🌐 Site : http://evan-epsi.rf.gd/  
- 📌 Trello : [Lien vers le Trello](https://trello.com/invite/b/67b482c7e2d7bd00ed8d61ba/ATTI356f235c4f3a28d8b89fcd92086fe6874A074E68/brasserie)  
- 💾 GitHub : https://github.com/evandeveer/brasserie

## 🔗 Technologies utilisées

- PHP - javascript
- HTML / CSS TEMPLATE w3School 
- MySQl / PhpMyAdmin


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
l'utilisateur rempli le formulaire puis l'envoie, les données sont enregistrées en base de donnée
<div>
  <div style="display: inline-block;">
    <img src="https://github.com/user-attachments/assets/6b10ec47-3b53-43ef-8a98-80b889121000" alt="Description de l'image"/>
    <img src="https://github.com/user-attachments/assets/b430a63d-eaf3-48c5-810e-569c5067490b" alt="Description de l'image" width="400"/>
    </div>
</div>

## Connexion : 
l'utilisateur rempli le formulaire puis l'envoie. Le mdp hashé ainsi que l'email est comparé avec les données de la table utilisateur pour en trouver un sinon la connexion echoue. Autrement on stock l'id user dans la session utilisateur
<div>
  <div style="display: inline-block;">
    <img src="https://github.com/user-attachments/assets/67e756e2-4994-4c7e-a80f-9d3f618205ae" alt="Description de l'image"/>
    <img src="https://github.com/user-attachments/assets/0fe2a821-5cc4-458b-9860-4305cde83d8c" alt="Description de l'image"/>
      <img src="https://github.com/user-attachments/assets/08b3e02e-4e8a-47d6-b00a-e9fb36e9a3c9" alt="Description de l'image" width="500"/>
    </div>
</div>



## Brasserie : 

l'utilisateur rempli le formulaire puis l'envoie. Un calcul est ensuite fait puis affiche les differents resultats.
<div>
  <div style="display: inline-block;">
    <img src="https://github.com/user-attachments/assets/49c2a146-6a10-41c8-8827-3e923c2ba097" alt="Description de l'image"  width="600"/>
        <img src="https://github.com/user-attachments/assets/5237355e-3dc0-450a-8b5a-a88742a04d74" alt="Description de l'image" width="500"/>
    </div>
</div>

Le brasseur peut gerer les stocks des matières premieres. Il peut en ajouter, modifier ou supprimer.
  <div style="display: inline-block;">
    <img src="https://github.com/user-attachments/assets/c3b7a3dd-65d0-4a4d-9ac8-1b6b6699aa17" alt="Description de l'image" width="600"/>
     <img src="https://github.com/user-attachments/assets/53cbfb59-a5ef-4ee5-aa12-e05c0b6d0d23" alt="Description de l'image" width="500"/>
    </div>
</div>

Le brasseur peut gerer les stocks des produits finis pret à la vente. Il peut en ajouter, modifier ou supprimer.
  <div style="display: inline-block;">
    <img src="https://github.com/user-attachments/assets/87a8c611-8293-4265-9b4b-e14450b91de3" alt="Description de l'image"  width="600"/>
    <img src="https://github.com/user-attachments/assets/bad84a5b-be7e-41c0-b827-95b69b3396c8" alt="Description de l'image" width="500"/>
    </div>
</div>


## Admin : 

Nous pouvons ajouter un utilisateur, dont le mot de pass sera par default 1234 mais hashé (md5) en base de donnée
  <div style="display: inline-block;">
    <img src="https://github.com/user-attachments/assets/11af3073-f3ff-4009-8fe2-bfb0589b2b39" alt="Description de l'image" width="800"/>
    <img src="https://github.com/user-attachments/assets/5c7278ee-8070-4697-9f96-3b818529e373" alt="Description de l'image"  width="800"/>
    </div>
</div>

Ainsi que gerer un utilisateur en modifiant des données ou en supprimant le compte.
  <div style="display: inline-block;">
    <img src="https://github.com/user-attachments/assets/0d5bfd2c-612b-4960-bd37-2464b248259f" alt="Description de l'image" width="800"/>
    <img src="https://github.com/user-attachments/assets/f31cc96c-e57b-4fb3-bf4f-d7c90bb9fb4c" alt="Description de l'image"  width="800"/>
    </div>
</div>


## Direction :

La direction peut voir les achats de matieres premieres, les ventes de ses produits, les filtrer en fonction de la date.
<div>
  <div style="display: inline-block;">
    <img src="https://github.com/user-attachments/assets/2e875e72-d99b-4f7d-855c-3b47b4e02b01" alt="Description de l'image"/>
    <img src="https://github.com/user-attachments/assets/6a92e475-c306-473f-b41e-09d6bef2d75f" alt="Description de l'image" width="400/>
    </div>
</div>

Un calcul des depenses et des achats et fait et est affiché pour la direction.
<div>
  <div style="display: inline-block;">
    <img src="https://github.com/user-attachments/assets/ddbda3c8-1fa5-405f-b9f2-aa27c464c033" alt="Description de l'image"/>
    <img src="https://github.com/user-attachments/assets/17e5ea00-18e7-4438-a320-98e3b4c79624" alt="Description de l'image" width="400/>
    </div>
</div>


## Client :

Le client peut voir ses points de fidelité
<div>
  <div style="display: inline-block;">
    <img src="https://github.com/user-attachments/assets/eafe207f-bf11-415d-bd68-a7be0cf878a8" alt="Description de l'image" width="800/>
    <img src="https://github.com/user-attachments/assets/0c5c59ad-d7db-4328-9113-c8fca16aca09" alt="Description de l'image" width="800/>
  </div>
</div>




## Caissier :

Le caissier peut ajouter un utilisateur, peut confirmer une commande et voir les réservation des clients en attente.
  <div style="display: inline-block;">
    <img src="https://github.com/user-attachments/assets/9881eb4e-d4ac-4a23-a3e4-0fe8e8bac6d3" alt="Description de l'image" width="600/>
    <img src="https://github.com/user-attachments/assets/6dfadde7-a4a0-4ad7-a675-fdbe7a5807e4" alt="Description de l'image" width="600/>
    <img src="https://github.com/user-attachments/assets/318e4f44-b6e3-4b54-8662-dcc9abdc83cd" alt="Description de l'image" width="600/>
  </div>
</div>














