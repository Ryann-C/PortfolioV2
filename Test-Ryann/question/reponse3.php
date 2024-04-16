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

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si des réponses ont été sélectionnées
    if (isset($_POST["reponse"]) && !empty($_POST["reponse"])) {
        // Récupérer les réponses sélectionnées
        $reponses = $_POST["reponse"];
        
        // Préparer la requête d'insertion
        $sql = "INSERT INTO reponses_bloc3 (reponse) VALUES (?)";
        
        // Préparer l'instruction SQL
        $stmt = $conn->prepare($sql);
        
        // Liaison des paramètres et exécution de la requête pour chaque réponse
        foreach ($reponses as $reponse) {
            $stmt->bind_param("s", $reponse);
            $stmt->execute();
        }
        
        // Fermer la déclaration
        $stmt->close();
        
        echo "Les réponses ont été enregistrées avec succès.";
    } else {
        echo "Veuillez sélectionner au moins une réponse.";
    }
    header('Location:fin.php');
        exit();
}
    
// Fermer la connexion à la base de données
$conn->close();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test - Réponse Bloc 3</title>
    <style>
        h2 {
            text-align: center;
        }

        body {
            background-color: #0681c6;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            height: 100vh;
        }

        .container {
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba (0,0,0,0.1);
            text-align: center;
        }

        .checkbox-container {
            word-spacing: 20px;
        }

        .chrono-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        #chrono {
            font-size: 1.5em;
            font-weight: bold;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form id="form" action="reponse3.php" method="post">
        <div class="chrono-container">
            <div id="chrono"></div>
        </div>
        <div class="box">
            <div class="container">
                <h2><b>Veuillez cocher les images correspondant aux images visualisés :</b></h2>
                <div class="checkbox-container">
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="img1"><img src="Test1.png" alt="Image1"></label>
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="img2"><img src="Test2.png" alt="Image2"></label>
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="img3"><img src="Test3.png" alt="Image3"></label>
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="img4"><img src="Test4.png" alt="Image4"></label>
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="img5"><img src="Test5.png" alt="Image5"></label>
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="img6"><img src="Test6.png" alt="Image6"></label>
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="img7"><img src="Test7.png" alt="Image7"></label>
                </div>
                <button type="submit">Suivant</button>
            </div>
        </div>
    </form>

    <script>
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            const formattedMinutes = minutes < 10 ? `0${minutes}` : `${minutes}`;
            const formattedSeconds = remainingSeconds < 10 ? `0${remainingSeconds}` : `${remainingSeconds}`;
            return `${formattedMinutes}:${formattedSeconds}`;
        }

        function startChrono() {
            let startTime;
            const savedTime = localStorage.getItem('chronoStartTime_reponse3');

            if (savedTime) {
                startTime = parseInt(savedTime);
            } else {
                startTime = Math.floor(Date.now() / 1000) + 60;
                localStorage.setItem('chronoStartTime_reponse3', startTime);
            }

            function updateChrono() {
                const currentTime = Math.floor(Date.now() / 1000);
                const remainingTime = Math.max(0, startTime - currentTime);
                const chronoElement = document.getElementById('chrono');
                chronoElement.innerText = formatTime(remainingTime);

                if (remainingTime <= 15) {
                    chronoElement.style.color = 'red';
                }

                if (remainingTime === 0) {
                    clearInterval(intervalId);
                    localStorage.removeItem('chronoStartTime_reponse3');
                    window.location.href = 'fin.php';
                }
            }

            const intervalId = setInterval(updateChrono, 1000);
            updateChrono();
        }

        startChrono();
    </script>
</body>
</html>
