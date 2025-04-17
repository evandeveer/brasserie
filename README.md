# 🍺 Brasserie Terroir & Saveurs

Projet de gestion d'une brasserie artisanale en PHP/MySQL.  
Ce dépôt contient le code source du site, l'architecture des pages, ainsi que la structure de la base de données utilisée.

## 🔗 Liens Utiles

- 🌐 Site : http://evan-epsi.rf.gd/  
- 📌 Trello : [Lien vers le Trello](https://trello.com/invite/b/67b482c7e2d7bd00ed8d61ba/ATTI356f235c4f3a28d8b89fcd92086fe6874A074E68/brasserie)  
- 💾 GitHub : https://github.com/evandeveer/brasserie

## 🔗 Technologies utilisées

- Langages : PHP, JavaScript, HTML, CSS (Template W3Schools)
- Base de données : MySQL (gestion via PhpMyAdmin)
- Hébergement : InfinityFree.com
- Transfert de fichiers : FileZilla
- Éditeur de code : VisualStudioCode
- Versioning : Github

  
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

# 📦 **Fonctionnalités de l'application**

---

## 📨 **Contact**

L'utilisateur remplit le formulaire de contact. Une fois soumis, les données sont enregistrées en base de données.

[Lien vers le code](https://github.com/evandeveer/brasserie/blob/main/index.php#L331)  
<img src="https://github.com/user-attachments/assets/b430a63d-eaf3-48c5-810e-569c5067490b" alt="Enregistrement Contact" width="400"/>

---

## 🔐 **Connexion**

L'utilisateur remplit le formulaire de connexion. Le mot de passe est hashé et comparé avec la base de données.  
Si les identifiants sont valides, l'ID utilisateur est stocké dans la session.

[Code du formulaire](https://github.com/evandeveer/brasserie/blob/main/connexion.php#L60) [Code redirection](https://github.com/evandeveer/brasserie/blob/main/connexion.php#L60)  

<img src="https://github.com/user-attachments/assets/08b3e02e-4e8a-47d6-b00a-e9fb36e9a3c9" alt="Vérification Session" width="500"/>

---

## 🍺 **Brasserie**

L'utilisateur rempli un formulaire, un calcul est ensuite effectué et les résultats sont affichés.

[Code du calcul](https://github.com/evandeveer/brasserie/blob/main/brasseur.php#L219)


<img src="https://github.com/user-attachments/assets/5237355e-3dc0-450a-8b5a-a88742a04d74" alt="Résultats Brassage" width="500"/>

### 📦 **Gestion des matières premières**

Le brasseur peut ajouter, modifier ou supprimer les stocks.

[Code](https://github.com/evandeveer/brasserie/blob/main/brasseur.php#L30)  

<img src="https://github.com/user-attachments/assets/53cbfb59-a5ef-4ee5-aa12-e05c0b6d0d23" alt="Gestion MP" width="500"/>

### 🛒 **Gestion des produits finis**

Le brasseur peut également gérer les produits finis prêts à la vente.

[Code](https://github.com/evandeveer/brasserie/blob/main/brasseur.php#L74)  

<img src="https://github.com/user-attachments/assets/bad84a5b-be7e-41c0-b827-95b69b3396c8" alt="Gestion Produits" width="500"/>

---

## ⚙️ **Admin**

L'administrateur peut ajouter un utilisateur. Le mot de passe par défaut est `1234` (hashé en MD5).

[Code pour ajouter un utilisateur](https://github.com/evandeveer/brasserie/blob/main/admin.php#L28)  

<img src="https://github.com/user-attachments/assets/5c7278ee-8070-4697-9f96-3b818529e373" alt="Utilisateur Créé" width="800"/>

Il peut également modifier ou supprimer les utilisateurs.

[Code pour modifier / supprimer un utilisateur](https://github.com/evandeveer/brasserie/blob/main/admin.php#L37)  
<img src="https://github.com/user-attachments/assets/f31cc96c-e57b-4fb3-bf4f-d7c90bb9fb4c" alt="Suppression Utilisateur" width="800"/>

---

## 📊 **Direction**

La direction peut consulter les achats de matières premières et les ventes de produits, avec filtres par date.

[Code pour lister les achats / depenses](https://github.com/evandeveer/brasserie/blob/main/direction.php#L31)  

<img src="https://github.com/user-attachments/assets/6a92e475-c306-473f-b41e-09d6bef2d75f" alt="Filtrage Date" width="600"/>

Un calcul des dépenses et bénéfices est également disponible.

[Code afficher le montant total des depenses / achats](https://github.com/evandeveer/brasserie/blob/main/direction.php#L48)  

<img src="https://github.com/user-attachments/assets/17e5ea00-18e7-4438-a320-98e3b4c79624" alt="Bilan Financier" width="400"/>

---

## 👤 **Client**

Le client peut consulter ses points de fidélité.

[Code recuperer les points de fidelité](https://github.com/evandeveer/brasserie/blob/main/client.php#L22)  
<img src="https://github.com/user-attachments/assets/0c5c59ad-d7db-4328-9113-c8fca16aca09" alt="Points Fidélité" width="600"/>

Voir les produits disponible.

[Code afficher les produits disponibles](https://github.com/evandeveer/brasserie/blob/main/client.php#L166)  
<img src="https://github.com/user-attachments/assets/2fe0374b-356d-4da3-b8a9-561cb6e56d93" alt="client" width="600"/>

Passer une reservation.

[Code pour inserer la reservation](https://github.com/evandeveer/brasserie/blob/main/client.php#L47)  
<img src="https://github.com/user-attachments/assets/2388b7ea-3480-4490-bcfd-bab3bd1eb030" alt="Points Fidélité" width="600"/>



---

## 💵 **Caissier**

Le caissier peut ajouter un utilisateur

[Code pour ajouter un client en bdd](https://github.com/evandeveer/brasserie/blob/main/caissier.php#L27)  

<img src="https://github.com/user-attachments/assets/5727a807-47d0-4654-af02-f1cde9f36fd2" alt="Réservations" width="600"/>


Le caissier peut confirmer une commande

[Systeme de radio valider / refuser](https://github.com/evandeveer/brasserie/blob/main/caissier.php#156)  

<img src="https://github.com/user-attachments/assets/25d9b6a4-68e7-4367-9085-89cb3372b921" alt="Réservations" width="600"/>

Et voir les réservations clients.

[Afficher les reservations](https://github.com/evandeveer/brasserie/blob/main/caissier.php#187)  

<img src="https://github.com/user-attachments/assets/7018a50b-a18a-457f-adf9-246b3d25d8c8" alt="Réservations" width="600"/>

---

## **Systeme de session**

Un visiteur du site ne peut pas acceder à une page s'il n'a pas le role (par exemple en tapant "/admin.php")
grace à la verification de l'id role de la session sur chaque page.
exemple admin : 

<img src="https://github.com/user-attachments/assets/6627643b-da35-45c5-8080-14bbff6e0981" alt="Ajout Utilisateur" width="600"/>

Une fois connecté le role a accès à un bouton special en fonction de son role qui le redirige vers la page de son role.

<img src="https://github.com/user-attachments/assets/82cb6378-a7b0-4d20-b3bb-7f7ae4b935bf" alt="Ajout Utilisateur" width="600"/>
<img src="https://github.com/user-attachments/assets/55e597e9-fb20-4a80-8c3a-89c4f4b3cff5" alt="Ajout Utilisateur" width="600"/>

---

## **Systeme de Logs**

Une fonction WriteLogs a été créée dans une classe Logs ce qui permet d'appeler la fonction dans n'importe quelle page.
Un affichage des logs et aussi present dans la page admin.

<img src="https://github.com/user-attachments/assets/58c88fa9-16c0-4b78-9576-6aa15122b86c" alt="Ajout Utilisateur" width="600"/>
<img src="https://github.com/user-attachments/assets/9e0a18bb-f598-494d-a9ab-e3a29756a6d6" alt="Ajout Utilisateur" width="600"/>


# 🔎 **Sources**

Documentation sessions : https://www.php.net/manual/fr/reserved.variables.session.php  
Documentation fichier txt : https://www.conseil-webmaster.com/formation/php/10-manipuler-fichier-php.php  
Template CSS : https://www.w3schools.com/w3css/tryw3css_templates_cafe.htm  
Les bases PHP et html : Cours Thibault Vinchent EPSI https://www.je-code.com/  
IA : https://chat.deepseek.com/ ou https://chatgpt.com/

# 📷 **Demo LIve**

Video de presentation : https://youtu.be/npuQpdc-QLU













