<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test - Questions Bloc 2</title>
    <style>
        h1 {
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex-direction: column;
        }

        .memory-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 20px;
        }

        .timer{
            font-size: 1.2em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <form action="reponse2.php" method="post">
    </form>
    <div class="container">
        <div class="memory">
            <h2>Mémorisez ces mots, vous avez <span class="timer">1:00</span> :</h2>
            <div class="memory-grid">
                <div>Progression</div>
                <div>Armoire</div>
                <div>Ecrivain</div>
                <div>Commerce</div>
                <div>Machine</div>
                <div>Panneau</div>
                <div>Domaine</div>
                <div>Stand</div>
                <div>Téléphone</div>
                <div>Jeu</div>
                <div>Marcher</div>
                <div>Danse</div>
                <div>Arbre</div>
                <div>Route</div>
                <div>Tasse</div>
                <div>Ordinateur</div>
                <div>Maison</div>
                <div>Télévision</div>
                <div>Attendre</div>
                <div>Combat</div>
                <div>Fax</div>
                <div>Achat</div>
                <div>Dictionnaire</div>
                <div>Mars</div>
            </div>
        </div>
    </div>
    <script>

function redirectionToResponsesPage() {
    window.location.href = 'reponse2.php';
}

// Fonction pour mettre à jour le chrono
function updateTimer() {
    const timerElement = document.querySelector('.timer');
    let timeLeft;

    // Vérifie s'il y a une valeur dans le localStorage
    if (localStorage.getItem('timeLeft')) {
        timeLeft = parseInt(localStorage.getItem('timeLeft'));
        // Réinitialise le temps à 60 secondes si le décompte est terminé
        if (timeLeft === 0) {
            timeLeft = 60;
        }
    } else {
        timeLeft = 60; // Si aucune valeur n'est trouvée, définissez le temps par défaut à 60 secondes
    }

    const timerInterval = setInterval(() => {
        const minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        timerElement.textContent = minutes + ':' + seconds;
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            redirectionToResponsesPage();
        } else if (timeLeft <= 30) {
            timerElement.style.color = "red";
        }
        // Enregistrez le temps restant dans le localStorage à chaque itération
        localStorage.setItem('timeLeft', timeLeft);
        timeLeft--;
    }, 1000); // Mettre à jour toutes les secondes
}

function resetChrono() {
    // Réinitialiser le temps de départ à 1 min (1* 60 secondes)
    clearInterval(intervalId);
    localStorage.removeItem('chronoStartTime');
    startTime = Math.floor(Date.now() / 1000) + (1 * 60) + 20; // Utiliser la variable globale startTime
    localStorage.setItem('chronoStartTime', startTime);
}

// Démarrez le décompte du temps (1 minute)
updateTimer();

    </script>
</body>
</html>
