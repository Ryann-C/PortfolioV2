<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen - Visionnage d'image</title>
    <style>
        h2 {
            text-align: center;
        }

        body {
            background-color: #0681c6;
            margin: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; /* Pour aligner les éléments verticalement */
        }

        .instruction-box {
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px; /* Espacement entre la boîte de texte et l'image */
        }

        .container {
            max-width: 60%;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .chrono-container {
            position: absolute;
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
    </style>
</head>
<body>
    <div class="instruction-box">
        <p><b>Mémorisez les images, vous avez 1 minute</b></p>
    </div>

    <div class="container">
        <img src="Test.png" alt="Image à visionner">
    </div>

    <div class="chrono-container">
        <div id="chrono"></div>
    </div>
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
            const savedTime = localStorage.getItem('chronoStartTime_question3.php');

            if (savedTime) {
                startTime = parseInt(savedTime);
            } else {
                startTime = Math.floor(Date.now() / 1000) + 60;
                localStorage.setItem('chronoStartTime_question3.php', startTime);
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
                    localStorage.removeItem('chronoStartTime_question3.php');
                    window.location.href = 'reponse3.php';
                }   
            }

            const intervalId = setInterval(updateChrono, 1000);
            updateChrono();
        }

        startChrono();
    </script>
</body>
</html>
