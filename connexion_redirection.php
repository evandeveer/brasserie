<?php

$servername = "sql208.infinityfree.com";
$username = "if0_38342249"; 
$password = "8p8SMDlMUOmSd"; 
$dbname = "if0_38342249_brasserie";
date_default_timezone_set('Europe/Paris');

$bdd = new PDO('mysql:host=' . $servername . ';dbname=' . $dbname . ';charset=utf8', $username, $password);

if (isset($_POST['email']) and (isset($_POST['mdp']))) {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $result = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = :Email AND mdp = :Mdp');
    $result->execute([
        'Email' => $email,
        'Mdp' => $mdp
    ]);



    if ($result->rowCount() > 0) {
        $user = $result->fetch(PDO::FETCH_ASSOC);
        $nom = $user['nom'];

        $requete2 = $bdd->prepare('SELECT * FROM roles where id = :id_role_user ');
        $requete2->execute([
            'id_role_user' => $user['id_role'],
        ]);
        $role = $requete2->fetch(PDO::FETCH_ASSOC);
        
        if ($role['role'] == "admin"){
            header("Location: admin.php");
        }elseif($role['role'] == "brasseur"){
            header("Location: brasseur.php");
        }
        elseif($role['role'] == "client"){
            header("Location: client.php?id_client=" . $user['id']);
        }
        else {
            header("Location: index.php?message= Bienvenue ". $role['role'] . " " . $nom. " !&role=" . $role['role']);
        }
        
        
    } else {
        header("Location: connexion.php?errorConnexion=true");
    }
}
?>
