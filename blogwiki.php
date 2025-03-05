<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Wiki</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
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

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 80%;
            overflow-y: auto;
        }

        h1, h2 {
            color: #333;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .image-container {
            margin-top: 20px;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="bgimg"></div>
    <div class="container">
        <h1>Blog Wiki de la Brasserie</h1>
        <form method="post">
            <button type="submit" name="redirect_wiki">Accéder au Wiki</button>
            <button type="submit" name="redirect_trello">Accéder au Trello</button>
        </form>

        <div class="image-container">
            <h2>Table contact</h2>
            <img src="TableContacts.png" alt="Table Contacts">
        </div>

        <div class="image-container">
            <h2>Table rôles</h2>
            <img src="TableRôles.png" alt="Table Rôles">
        </div>

        <div class="image-container">
            <h2>Table utilisateurs</h2>
            <img src="TableUtilisateurs.png" alt="Table Utilisateurs">
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['redirect_wiki'])) {
            header("Location: http://evan-epsi.rf.gd/");
            exit();
        } elseif (isset($_POST['redirect_trello'])) {
            header("Location: https://trello.com/b/TA6jc23j/brasserie");
            exit();
        }
    }
    ?>

</body>
</html>
