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
        $sql = "INSERT INTO reponses_bloc2 (reponse) VALUES (?)";
        
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
    header('Location:question3.php');
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
    <title>Test - Réponse Bloc 2</title>
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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
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
    <form id="form" action="reponse2.php" method="post">
        <div class="chrono-container">
            <div id="chrono"></div>
        </div>
        <div class="box">
            <div class="container">
                <h2>Veuillez cocher les réponses :</h2>
                <div class="checkbox-container">
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="Achat">Achat</label>
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="Télévision">Télévision</label>
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="Jouer">Jouer</label>
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="Clavier">Clavier</label>
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="Baisse">Baisse</label>
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="Répondeur">Répondeur</label>
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="Imprimante">Imprimante</label>
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="Ecrivain">Ecrivain</label>
                    <label class="checkbox-label"><input type="checkbox" name="reponse[]" value="Dossier">Dossier</label>
                </div>
                <button type="submit">Suivant</button>
            </div>
        </div>
    </form>
    <script>
    
    let IntervalId;
    let startTime = localStorage.getItem('chronoStartTime_reponse2') ? parseInt(localStorage.getItem('chronoStartTime_reponse2')) : Math.floor(Date.now() / 1000) + (12 * 60);
    
    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        const formattedMinutes = minutes < 10 ? `0${minutes}` : `${minutes}`;
        const formattedSeconds = remainingSeconds < 10 ? `0${remainingSeconds}` : `${remainingSeconds}`;
        return `${formattedMinutes}:${formattedSeconds}`;
    }

    function updateChrono() {
            const currentTime = Math.floor(Date.now() / 1000);
            const remainingTime = Math.max(0, startTime - currentTime);
            const chronoElement = document.getElementById('chrono');
            chronoElement.innerText = formatTime(remainingTime);

            // Si le temps restant est inférieur ou égal à 30 secondes, changer la couleur en rouge
            if (remainingTime <= 30) {
                chronoElement.style.color = 'red';
            }

            // Si le temps restant est écoulé
            if (remainingTime === 0) {
                clearInterval(intervalId);
                localStorage.removeItem('chronoStartTime_reponse2');
                window.location.href = 'question3.php'; // Rediriger vers la page question2.php
            }
        }


    function startChrono() {
    const savedTime = localStorage.getItem('chronoStartTime_reponse2');

    if (!savedTime) {
        // Définir la durée du chrono à 1 min
        startTime = Math.floor(Date.now() / 1000) + (1 * 60)
        localStorage.setItem('chronoStartTime_reponse2', startTime);
    } else {
        startTime = parseInt(savedTime);
    }
}

    // Gestionnaire d'événements lorsque la page est rechargée
    window.addEventListener('load', function() {
        startChrono(); // Démarrer le chrono lors du rechargement de la page
        startChronoIfActive(); // Vérifier si le chrono doit être démarré lorsque la page est rechargée
    });
    if (!localStorage.getItem('chronoStartTime_reponse2')){
        startChrono();
    }
    const intervalId = setInterval(updateChrono, 1000);
    updateChrono();

    // Fonction pour réinitialiser le chronomètre
    function resetChrono() {
    // Réinitialiser le temps de départ à 1 min 
    clearInterval(intervalId);
    localStorage.removeItem('chronoStartTime_reponse2');
    startTime = Math.floor(Date.now() / 1000) + (1 * 60); // Utiliser la variable globale startTime
    localStorage.setItem('chronoStartTime_reponse2', startTime);
}

// Modifier la fonction startChronoIfActive pour vérifier si la visibilité est 'visible' et que la page est active avant de démarrer le chrono
function startChronoIfActive() {
    if (document.visibilityState === 'visible' && document.hasFocus()) {
        startChrono();
    } else {
        clearInterval(intervalId); // Arrêter le chronomètre lorsque la page devient inactive ou non visible
    }
}

// Gestionnaire d'événements pour détecter lorsque la fenêtre est en premier plan ou lorsque la visibilité de la page change
document.addEventListener('visibilitychange', startChronoIfActive);
window.addEventListener('focus', startChronoIfActive);

// Gestionnaire d'événements pour le bouton "Suivant"
document.querySelector('button[type="submit"]').addEventListener('click', function(event) {
    event.preventDefault(); // Empêcher la soumission du formulaire
    resetChrono(); // Réinitialiser le chronomètre
    document.getElementById('form').submit(); // Soumettre le formulaire
});
</script>
</body>
</html>