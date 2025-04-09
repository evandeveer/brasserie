<?php
$servername = "sql208.infinityfree.com";
$username = "if0_38342249";
$password = "8p8SMDlMUOmSd";
$dbname = "if0_38342249_brasserie";
date_default_timezone_set('Europe/Paris'); 

$bdd = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ajouter_client'])) {

        $requete = $bdd->prepare('INSERT INTO utilisateurs (nom, prenom, email, telephone, mdp) VALUES (:nom, :prenom, :email, :telephone, :mdp)');
        $requete->execute([
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'telephone' => $_POST['telephone'],
            'mdp' => password_hash("1234", PASSWORD_DEFAULT),
        ]);
    }
    elseif (isset($_POST['gestion_reservation'])) {
        
        $requete = $bdd->prepare('UPDATE reservation SET statut_resa = :statut_resa WHERE id = :id');
        $requete->execute([
            'id' => $_POST['id_resa'],
            'statut_resa' => $_POST['statut_resa']
        ]);

    }
}

$requete_reservations = $bdd->query("SELECT * FROM reservations");
$reservations = $requete_reservations->fetchAll(PDO::FETCH_ASSOC);

$clients = $bdd->query("SELECT * FROM utilisateurs WHERE id_role = 1");
$clients = $clients->fetchAll(PDO::FETCH_ASSOC);

$produits = $bdd->query("SELECT * FROM produits");
$produits = $produits->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">

    <style>
        .bgimg {
            background-position: center;
            background-size: cover;
            background-image: url("https://www.maison-michard.fr/wp-content/uploads/2022/11/MICHARD-photo-158A5184.jpg");
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            filter: blur(5px);
            z-index: -1;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
    }
    </style>
</head>
<body>

<div class="bgimg"></div>

<div class="w3-top">
    <div class="w3-row w3-padding w3-black">
        <div class="w3-col s3">
            <a href="index.php" class="w3-button w3-block w3-black">RETOUR</a>
        </div>
    </div>
</div>


<!-- Ajouter un client -->
<div class="container">

    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">Créer un compte utilisateur</span></h5>
        <form method="post">
            <input class="w3-input w3-border" type="text" name="nom" placeholder="Nom" required>
            <input class="w3-input w3-border" type="text" name="prenom" placeholder="Prénom" required>
            <input class="w3-input w3-border" type="email" name="email" placeholder="Email" required>
            <input class="w3-input w3-border" type="text" name="telephone" placeholder="Téléphone" required>
            <button class="w3-button w3-black w3-block" type="submit" name="ajouter">Créer le compte</button>
        </form>
        
</div>


<div class="container">

    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">Confirmer une reservation</span></h5>
        <form method="post">

        <!-- Menu deroulant reservation -->

        <select class="w3-select w3-border" name="id_resa" required>
        <?php foreach ($reservations as $reservation) : ?>
            <option value="<?= $reservation['id'] ?>"><?= htmlspecialchars($reservation['id'])?></option>
        <?php endforeach; ?>
        

        </select>
        
            <input class="w3-radio" type="radio" name="statut_resa" value="validée" required>
            <span>Validé</span>
        
        
            <input class="w3-radio" type="radio" name="statut_resa" value="refusée" required>
            <span>Refusé</span>
        
        

        <button class="w3-button w3-black w3-block" type="submit" name="gestion_reservation">Enregister</button>
        </form>

</div>

<div class="container">
  
    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide">Réservations Produits Clients</span></h5>

    <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
        <thead>
            <tr style="background: grey;">
                <th >ID</th>
                <th >Nom</th>
                <th >Client</th>
                <th >Quantité</th>
                <th >Date</th>
                <th >Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservations as $reservation): 
            // recuperation du nom du produit a partir de l'id 
                $nom_produit_resa = $bdd->prepare("SELECT nom FROM produits WHERE id = :id_produit");
                $nom_produit_resa->execute(['id_produit' => $reservation['id_produit']]);
                $nom_produit_resa = $nom_produit_resa->fetch(PDO::FETCH_ASSOC);

                $produit_client = $bdd->prepare("SELECT nom, prenom FROM utilisateurs WHERE id = :id_client");
                $produit_client->execute(['id_client' => $reservation['id_client']]);
                $produit_client = $produit_client->fetch(PDO::FETCH_ASSOC);
            ?>
            <tr>
                <td style="border: 1px solid #ccc; text-align: center;"><?= htmlspecialchars($reservation['id']); ?></td>
                <td style="border: 1px solid #ccc;"><?= htmlspecialchars($nom_produit_resa['nom']); ?></td>
                <td style="border: 1px solid #ccc;"><?= htmlspecialchars($produit_client['nom']) . " " . htmlspecialchars($produit_client['prenom']); ?></td>
                <td style="border: 1px solid #ccc; text-align: center;"><?= htmlspecialchars($reservation['quantite']); ?></td>
                <td style="border: 1px solid #ccc;"><?= htmlspecialchars($reservation['date_resa']); ?></td>
                <td style="border: 1px solid #ccc; text-align: center;"><?= htmlspecialchars($reservation['statut_resa']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>



</body>
</html>




