<?php
session_start(); // Démarrer la session

try {
    // Connexion à la base de données
    $bdd = new PDO('mysql:host=localhost;dbname=test_t84_db', 'root', '');

    // Configuration pour afficher les exceptions en cas d'erreur
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifier si les champs nom d'utilisateur et mot de passe ont été remplis
        if (isset($_POST['user']) && isset($_POST['password'])) {
            $user = $_POST['user'];
            $password = $_POST['password'];

            // Requête SQL pour récupérer l'utilisateur correspondant au nom d'utilisateur entré
            $query = $bdd->prepare('SELECT * FROM utilisateurs WHERE nom_utilisateur = :user');
            $query->execute(array('user' => $user));
            $result = $query->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Vérifier si le mot de passe est correct
                if (password_verify($password, $result['mot_de_passe'])) {
                    // Les informations de connexion sont correctes, rediriger vers question.php
                    header('Location: identifiant.php');
                    exit();
                } else {
                    // Mot de passe incorrect
                    echo "Mot de passe incorrect.";
                }
            } else {
                // Nom d'utilisateur incorrect
                echo "Nom d'utilisateur incorrect.";
            }
        } else {
            // Afficher un message si les champs ne sont pas remplis
            echo "Veuillez remplir tous les champs.";
        }
    }
} catch (PDOException $e) {
    // En cas d'erreur, afficher l'erreur
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Tremplin 84</title>
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


form {
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
    width: 100%;
}

button:hover {
    background-color: #45a049; 
}
</style>
<body>
    <form action="connexion.php" method="post">
        <h2>Connexion</h2>
        <label for="user">Nom d'utilisateur :</label>
        <input type="text" id="user" name="user" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>

