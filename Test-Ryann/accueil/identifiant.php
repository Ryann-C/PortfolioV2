<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si les champs nom et prénom ont été remplis
    if (isset($_POST['nom']) && isset($_POST['prenom'])) {
        // Récupère le nom et le prénom soumis dans le formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];

        try {
            // Connexion à la base de données
            $bdd = new PDO('mysql:host=localhost;dbname=test_t84_db', 'root', '');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour insérer le nom et le prénom dans la table "candidat"
            $query = $bdd->prepare('INSERT INTO candidat (nom, prenom) VALUES (:nom, :prenom)');
            $query->execute(array('nom' => $nom, 'prenom' => $prenom));

            // Redirige vers la page des questions
            header('Location: ../question/question.php');
            exit();
        } catch (PDOException $e) {
            // En cas d'erreur, affiche l'erreur
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        // Affiche un message si les champs ne sont pas remplis
        echo "Veuillez remplir tous les champs.";
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nom/Prénom - Test</title>
    <link rel="stylesheet" href="../css/identifiant.css">
</head>
<style>
    body {
    background-color: #0681c6;
    margin: 0;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: Arial, sans-serif;
}


.box {
    background-color: #fff;
    padding : 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba (0, 0, 0, 0.1);
    width: 300px;
}

label {
    display: block;
    margin-bottom: 8px;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #4caf50;
    color: #fff;
    padding: 10px;
    border:none;
    cursor: pointer;
    width: 100%
}

button:hover {
    background-color: #45a049; 
}
</style>

<body>
    <div class="box">
        <h1>Quel est votre nom et votre prénom ?</h1>
        <form action="identifiant.php" method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <button type="submit">Commencer</button>
        </form>
    </div>
</body>
</html>