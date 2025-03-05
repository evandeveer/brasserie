<?php

$servername = "sql208.infinityfree.com";
$username = "if0_38342249";
$password = "8p8SMDlMUOmSd";
$dbname = "if0_38342249_brasserie";

$bdd = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);



##### MATIERES PREMIERES ########

if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $quantite = $_POST['quantite'];

    $stmt = $bdd->prepare("INSERT INTO matieres_premieres (nom, quantite) VALUES (:nom, :quantite)");
    $stmt->execute(
        [
            'nom' => $nom,
            'quantite' => $quantite,
        ]);
    }

if (isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $quantite = $_POST['quantite'];

    $requete = $bdd->prepare("UPDATE matieres_premieres SET nom = :nom, quantite = :quantite WHERE id = :id");
    $requete->execute(
        [
        'nom' => $nom,
        'quantite' => $quantite,
        'id' => $id
        ]);
    }

if (isset($_POST['supprimer'])) {
    $id = $_POST['id'];
    $requete = $bdd->prepare("DELETE FROM matieres_premieres WHERE id = :id");
    $requete->execute(
        [
        'id' => $id
        ]);
    }

######### PRODUITS FINIS ########

if (isset($_POST['ajouter_produits_finis'])) {
    $nom = $_POST['nom_produits_finis'];
    $quantite = $_POST['quantite_produits_finis'];

    $stmt = $bdd->prepare("INSERT INTO stock_produits (nom, quantite) VALUES (:nom, :quantite)");
    $stmt->execute(
        [
            'nom' => $nom,
            'quantite' => $quantite,
        ]);
    }

if (isset($_POST['modifier_produits_finis'])) {
    $id = $_POST['id_produits_finis'];
    $nom = $_POST['nom_produits_finis'];
    $quantite = $_POST['quantite_produits_finis'];

    $requete = $bdd->prepare("UPDATE stock_produits SET nom = :nom, quantite = :quantite WHERE id = :id");
    $requete->execute(
        [
        'nom' => $nom,
        'quantite' => $quantite,
        'id' => $id
        ]);
    }

if (isset($_POST['supprimer_produits_finis'])) {
    $id = $_POST['id_produits_finis'];
    $requete = $bdd->prepare("DELETE FROM stock_produits WHERE id = :id");
    $requete->execute(
        [
        'id' => $id
        ]);
    }

#### recup les infos ########

$requete = $bdd->query("SELECT * FROM matieres_premieres");
$requete2 = $bdd->query("SELECT * FROM stock_produits");
$stock_matieres_premieres = $requete->fetchAll(PDO::FETCH_ASSOC);
$stock_produits_finis = $requete2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Brasseur</title>
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

    h5 {
      text-align: center;
      font-size: 22px;
      margin-bottom: 20px;
    }
    .stock-item {
      margin: 10px 0;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 10px;
      justify-content: center;
    }
    .stock-item form {
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }
    .stock-item input {
      padding: 4px;
      width: auto;
    }
    .stock-item button {
      padding: 4px 8px;
    }

    .add-form input {
      margin-bottom: 10px;
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

  <div class="container">
    <h5 class="w3-tag w3-wide">Calculs du Brasseur</h5>
    <form method="post">
      <p><input class="w3-input w3-padding-16 w3-border" type="number" name="volume" step="0.1" required placeholder="Volume de bière (L)"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="number" name="degre" step="0.1" required placeholder="Degré d'alcool (%)"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="number" name="malt1" step="0.01" required placeholder="Moyenne EBC des Grains"></p>
    
      <p><button class="w3-button w3-brown w3-block" type="submit" name="calculer">Calculer</button></p>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calculer'])) {
      $volume = $_POST['volume'];
      $degre = $_POST['degre'];
      $malt1 = $_POST['malt1'];


      $malt_kg = ($volume * $degre) / 20;
      $eau_braassage = $malt_kg * 2.8;
      $eau_rincage = ($volume * 1.25) - ($eau_braassage * 0.7);
      $houblon_americain = $volume * 3;
      $houblon_aromatique = $volume * 1;
      $levure = $volume / 2;

      echo "
      <div class='w3-panel w3-light-grey w3-margin-top'>
          <p><strong>Quantité de malt (kg) :</strong> " . round($malt_kg, 2) . " kg</p>
          <p><strong>Quantité d'eau de brassage (L) :</strong> " . round($eau_braassage, 2) . " L</p>
          <p><strong>Quantité d'eau de rinçage (L) :</strong> " . round($eau_rincage, 2) . " L</p>
          <p><strong>MCU (Malt Color Units) :</strong> " . round($mcu, 4) . "</p>
          <p><strong>Quantité de houblon amérisant (g) :</strong> " . round($houblon_americain, 2) . " g</p>
          <p><strong>Quantité de houblon aromatique (g) :</strong> " . round($houblon_aromatique, 2) . " g</p>
          <p><strong>Quantité de levure (g) :</strong> " . round($levure, 2) . " g</p>
      </div>";
    }
    ?>
  </div>


  <div class="container">
    <h5 class="w3-tag w3-wide">Gestion des Stocks</h5><br>
    <h6 class="w3-tag w3-wide">Matieres premieres</h5>
    <form method="post" class="add-form">
      <p><input class="w3-input w3-padding-16 w3-border" type="text" name="nom" required placeholder="Nom"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="number" name="quantite" required placeholder="Quantité"></p>

      <p><button class="w3-button w3-brown w3-block" type="submit" name="ajouter">Ajouter au stock</button></p>
    </form>

    <br>


    <?php

      foreach ($stock_matieres_premieres as $matieres) {
        echo "
        <div class='stock-item'>
            <span>" . htmlspecialchars($matieres['id']) . "</span>
        
            <form method='post' class='inline-form'>
                <input type='hidden' name='id' value='" . $matieres['id'] . "'>
                <input type='text' name='nom' value='" . htmlspecialchars($matieres['nom']) . "' required placeholder='Nom'>
                <input type='number' name='quantite' value='" . htmlspecialchars($matieres['quantite']) . "' step='any' required placeholder='Quantité'>
                <button class='w3-button w3-brown' type='submit' name='modifier'>Modifier</button>
            </form>
        
            <form method='post' class='inline-form'>
                <input type='hidden' name='id' value='" . $matieres['id'] . "'>
                <button class='w3-button w3-grey' type='submit' name='supprimer'>Supprimer</button>
            </form>
        </div>";
      }
    
    ?>

  </div>


  
  <div class="container">
    <h5 class="w3-tag w3-wide">Gestion des Stocks</h5><br>
    <h6 class="w3-tag w3-wide">Produits finis</h5>
    <form method="post" class="add-form">
      <p><input class="w3-input w3-padding-16 w3-border" type="text" name="nom_produits_finis" required placeholder="Nom"></p>
      <p><input class="w3-input w3-padding-16 w3-border" type="number" name="quantite_produits_finis" required placeholder="Quantité"></p>

      <p><button class="w3-button w3-brown w3-block" type="submit" name="ajouter_produits_finis">Ajouter au stock</button></p>
    </form>

    <br>


    <?php

      foreach ($stock_produits_finis as $produits_finis) {
        echo "
        <div class='stock-item'>
            <span>" . htmlspecialchars($produits_finis['id']) . "</span>
        
            <form method='post' class='inline-form'>
                <input type='hidden' name='id_produits_finis' value='" . $produits_finis['id'] . "'>
                <input type='text' name='nom_produits_finis' value='" . htmlspecialchars($produits_finis['nom']) . "' required placeholder='Nom'>
                <input type='number' name='quantite_produits_finis' value='" . htmlspecialchars($produits_finis['quantite']) . "' step='any' required placeholder='Quantité'>
                <button class='w3-button w3-brown' type='submit' name='modifier_produits_finis'>Modifier</button>
            </form>
        
            <form method='post' class='inline-form'>
                <input type='hidden' name='id_produits_finis' value='" . $produits_finis['id'] . "'>
                <button class='w3-button w3-grey' type='submit' name='supprimer_produits_finis'>Supprimer</button>
            </form>
        </div>";
        
      }
    
    ?>

  </div>

</body>
</html>
