<?php
$servername = "sql208.infinityfree.com";
$username = "if0_38342249";
$password = "8p8SMDlMUOmSd";
$dbname = "if0_38342249_brasserie";

$bdd = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

if (isset($_GET['id_client'])) {
    $id_client = $_GET['id_client'];
} else {
    header("Location: index.php");
}



$requete_fidelite = $bdd->prepare("SELECT fidelite FROM utilisateurs WHERE id = :id_client");
$requete_fidelite->execute(['id_client' => $id_client]);
$fidelite = $requete_fidelite->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['ajouter_reservation'])) {
    $id_produit = $_POST['id_produit'];
    $quantite = $_POST['quantite'];

    $insert_resa = $bdd->prepare("INSERT INTO reservations (id_client, id_produit, quantite, date_resa, statut_resa) 
                            VALUES (:id_client, :id_produit, :quantite, :date_resa, 'en attente')");
    $insert_resa->execute([
        'id_client' => $id_client,
        'id_produit' => $id_produit,
        'date_resa' => date('Y-m-d H:i:s'),
        'quantite' => $quantite,
    ]);
}

$requete_reservations = $bdd->prepare("SELECT * FROM reservations WHERE id_client = :id_client");
$requete_reservations->execute(['id_client' => $id_client]);
$reservations = $requete_reservations->fetchAll(PDO::FETCH_ASSOC);

$nom_produit_resa = $bdd->prepare("SELECT nom FROM produits WHERE id = :id_produit");
$nom_produit_resa->execute(['id_produit' => $requete_reservations['id_produit']]);
$nom_produit_resa = $nom_produit_resa->fetch(PDO::FETCH_ASSOC);


$produits_query = $bdd->query("SELECT * FROM produits");
$produits = $produits_query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Système de Réservation</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
  <style>
    body, html {
      font-family: "Inconsolata", sans-serif;
    }
    .container {
      max-width: 900px;
      margin: 40px auto;
      padding: 30px;
      background: white;
      border-radius: 8px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
    }
    .form-group {
      margin-bottom: 15px;
    }
    .w3-input {
      width: 100%;
      padding: 10px;
    }
    .btn {
      background-color: #4CAF50;
      color: white;
      padding: 10px;
      border: none;
      cursor: pointer;
      width: 100%;
    }
    .btn:hover {
      background-color: #45a049;
    }
    .product-item {
      border: 1px solid #ccc;
      margin: 10px 0;
      padding: 10px;
      border-radius: 5px;
    }
    .product-item form {
      display: flex;
      gap: 10px;
    }
    .fidelite-section {
      margin-bottom: 20px;
      padding: 15px;
      background-color: #f4f4f4;
      border-radius: 8px;
      text-align: center;
    }
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

<br><br>

<div class="fidelite-section">
      <h2>Vos points de fidélité</h2>
      <p><strong>Points actuels :</strong> <?= isset($fidelite['fidelite']) ? $fidelite['fidelite'] : 0 ?> points</p>
    </div>

  <div class="container">
   
    
   
    <h2 class="w3-tag w3-wide">Produits Disponibles</h2>
    <?php foreach ($produits as $produit): ?>
      <div class="product-item">
        <h4><?= htmlspecialchars($produit['nom']); ?></h4>
        <img src=<?=htmlspecialchars($produit['image']);?> style="width:20%; height:auto; border-radius:8px;">
        <p><strong>Description :</strong> <?= htmlspecialchars($produit['description']); ?></p>
        <p><strong>Prix :</strong> <?= htmlspecialchars($produit['prix']); ?> €</p>
        <p><strong>Quantité disponible :</strong> <?= htmlspecialchars($produit['quantite']); ?></p>
      </div>
    <?php endforeach; ?>

    <h2 class="w3-tag w3-wide">Réservation de Produits</h2>
    
    <form method="post">
      <div class="form-group">
        <label for="id_produit">Choisir un produit :</label>
        <select name="id_produit" class="w3-input w3-padding-16 w3-border" required>
        
          <?php foreach ($produits as $produit): ?>
            <option value="<?= $produit['id']; ?>"><?= $produit['nom']; ?> (Quantité disponible: <?= $produit['quantite']; ?>)</option>
          <?php endforeach; ?>

        </select>
      </div>
      <div class="form-group">
        <label for="id_produit">Quantité :</label>
        <input class="w3-input w3-padding-16 w3-border" type="number" name="quantite" placeholder= "0" min="1" required>
      </div>
      <button type="submit" name="ajouter_reservation" class="w3-button w3-brown w3-block">Réserver</button>
    </form>

    <br><br>

    <h2 class="w3-tag w3-wide">Mes reservations Produits</h2>

    <?php foreach ($reservations as $reservation): ?>
      <div class="product-item">
        <h4><?= htmlspecialchars($reservation['id_produit']); ?></h4>
        <p><strong>Quantité :</strong> <?= htmlspecialchars($reservation['quantite']); ?></p>
        <p><strong>Date de réservation :</strong> <?= htmlspecialchars($reservation['date_resa']); ?></p>
        <p><strong>Statut :</strong> <?= htmlspecialchars($reservation['statut_resa']); ?></p>
      </div>
    <?php endforeach; ?>


  </div>

</body>
</html>
