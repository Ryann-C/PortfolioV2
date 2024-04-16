<?php
// Établir une connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "test_t84_db";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupérer les noms et prénoms uniques pour le menu déroulant
$sql_dropdown = "SELECT DISTINCT nom, prenom FROM candidat";
$result_dropdown = $conn->query($sql_dropdown);

// Récupérer les réponses depuis la base de données
$sql = "SELECT c.nom, c.prenom, 
               GROUP_CONCAT(b1.reponse_1 SEPARATOR ', ') AS reponses_bloc1,
               GROUP_CONCAT(b2.reponse SEPARATOR ', ') AS reponses_bloc2,
               GROUP_CONCAT(b3.reponse SEPARATOR ', ') AS reponses_bloc3
        FROM candidat c
        LEFT JOIN reponses_bloc1 b1 ON c.id = b1.candidat_id
        LEFT JOIN reponses_bloc2 b2 ON c.id = b2.candidat_id
        LEFT JOIN reponses_bloc3 b3 ON c.id = b3.candidat_id
        GROUP BY c.nom, c.prenom";

$result = $conn->query($sql);

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats des Réponses</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h2>Résultats des Réponses</h2>
    <form action="" method="post">
        <label for="nom">Nom:</label>
        <select name="nom" id="nom">
            <?php
            if ($result_dropdown->num_rows > 0) {
                while($row = $result_dropdown->fetch_assoc()) {
                    echo "<option value='" . $row["nom"] . "'>" . $row["nom"] . "</option>";
                }
            }
            ?>
        </select>
        <label for="prenom">Prénom:</label>
        <select name="prenom" id="prenom">
            <?php
            if ($result_dropdown->num_rows > 0) {
                $result_dropdown->data_seek(0);
                while($row = $result_dropdown->fetch_assoc()) {
                    echo "<option value='" . $row["prenom"] . "'>" . $row["prenom"] . "</option>";
                }
            }
            ?>
        </select>
        <button type="submit">Rechercher</button>
    </form>
    <br>
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Réponses Bloc 1</th>
            <th>Réponses Bloc 2</th>
            <th>Réponses Bloc 3</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["nom"] . "</td><td>" . $row["prenom"] . "</td><td>" . $row["reponses_bloc1"] . "</td><td>" . $row["reponses_bloc2"] . "</td><td>" . $row["reponses_bloc3"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Aucune réponse trouvée.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
