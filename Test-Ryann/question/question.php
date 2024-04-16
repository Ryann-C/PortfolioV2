<?php

// Vérifier si des données ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs des réponses depuis $_POST
    $reponse_1 = isset($_POST["reponse_1"]) ? htmlspecialchars($_POST["reponse_1"]) : null;
    $reponse_2 = isset($_POST["reponse_2"]) ? htmlspecialchars($_POST["reponse_2"]) : null;
    $reponse_3 = isset($_POST["reponse_3"]) ? htmlspecialchars($_POST["reponse_3"]) : null;
    $reponse_4 = isset($_POST["reponse_4"]) ? htmlspecialchars($_POST["reponse_4"]) : null;
    $reponse_5 = isset($_POST["reponse_5"]) ? htmlspecialchars($_POST["reponse_5"]) : null;
    $reponse_6 = isset($_POST["reponse_6"]) ? htmlspecialchars($_POST["reponse_6"]) : null;
    $reponse_7 = isset($_POST["reponse_7"]) ? htmlspecialchars($_POST["reponse_7"]) : null;
    $reponse_8 = isset($_POST["reponse_8"]) ? htmlspecialchars($_POST["reponse_8"]) : null;
    $reponse_9 = isset($_POST["reponse_9"]) ? htmlspecialchars($_POST["reponse_9"]) : null;
    $reponse_10 = isset($_POST["reponse_10"]) ? htmlspecialchars($_POST["reponse_10"]) : null;
    $reponse_11 = isset($_POST["reponse_11"]) ? htmlspecialchars($_POST["reponse_11"]) : null;
    $reponse_12 = isset($_POST["reponse_12"]) ? htmlspecialchars($_POST["reponse_12"]) : null;
    $reponse_13 = isset($_POST["reponse_13"]) ? htmlspecialchars($_POST["reponse_13"]) : null;
    $reponse_14 = isset($_POST["reponse_14"]) ? htmlspecialchars($_POST["reponse_14"]) : null;
    $reponse_15 = isset($_POST["reponse_15"]) ? htmlspecialchars($_POST["reponse_15"]) : null;
    $reponse_16 = isset($_POST["reponse_16"]) ? htmlspecialchars($_POST["reponse_16"]) : null;
    $reponse_17 = isset($_POST["reponse_17"]) ? htmlspecialchars($_POST["reponse_17"]) : null;
    $reponse_18 = isset($_POST["reponse_18"]) ? htmlspecialchars($_POST["reponse_18"]) : null;
    $reponse_19 = isset($_POST["reponse_19"]) ? htmlspecialchars($_POST["reponse_19"]) : null;
    $reponse_20 = isset($_POST["reponse_20"]) ? htmlspecialchars($_POST["reponse_20"]) : null;

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_t84_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Récupérer l'ID du candidat
$candidat_id = null; // Initialiser à null par défaut

// Vous devez remplacer 'votre_condition_de_recherche' par votre condition appropriée pour récupérer l'ID du candidat
$sql = "SELECT id FROM candidat WHERE nom = '$nom' AND prenom = '$prenom'";
$candidat_id = $sql;
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $candidat_id = $row["id"];
} else {
    echo "Aucun candidat trouvé.";
}

// Préparer la requête d'insertion avec l'ID du candidat
$stmt = $conn->prepare("INSERT INTO reponses_bloc1 (reponse_1, reponse_2, reponse_3, reponse_4, reponse_5, reponse_6, reponse_7, reponse_8, reponse_9, reponse_10, reponse_11, reponse_12, reponse_13, reponse_14, reponse_15, reponse_16, reponse_17, reponse_18, reponse_19, reponse_20) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Vérifier si la préparation de la requête a échoué
if (!$stmt) {
    die("Erreur de préparation de la requête : " . $conn->error);
}

// Liaison des paramètres
$stmt->bind_param("isssssssssssssisssss", $reponse_1, $reponse_2, $reponse_3, $reponse_4, $reponse_5, $reponse_6, $reponse_7, $reponse_8, $reponse_9, $reponse_10, $reponse_11, $reponse_12, $reponse_13, $reponse_14, $reponse_15, $reponse_16, $reponse_17, $reponse_18, $reponse_19, $reponse_20);

// Exécuter la requête
$conn->begin_transaction();
if ($stmt->execute()) {
    $conn->commit();
    echo "Les réponses ont été envoyées avec succès dans la base de données.";
} else {
    $conn->rollback();
    echo "Erreur lors de l'envoi des réponses : " . $conn->error;
}

header('Location:question2.php');
exit();

// Fermer la connexion
$conn->close();
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test - Questions Bloc 1</title>
    <style>
    h1 {
    text-align: center;
}

body {
    background-color: #0681c6;
    margin: 0;
    height: 648vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: Arial, sans-serif;
}

.box {
    max-width: 600px;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.chrono-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1000;
    background-color: #fff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

#chrono {
    font-size: 1.5em;
    font-weight: bold;
}

.radio-options, .radio-option, .radio {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 10px;
}

.radio-options div, .radio-option div, .radio div {
    margin-bottom: 10px;
}

textarea {
    width: 100%;
    padding: 5px;
    margin-top: 5px;
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
<form id="form" action="question.php" method="post">
    <div class="box">
        <div class="chrono-container">
            <div id="chrono">12:00</div>
        </div>
        <h1>Question 1</h1>
        <p><b><u>En quelle année a débuté la construction de la Tour Eiffel ?</u></b></p>
        <div class="radio-options">
            <div>
                <input type="radio" id="choix1_1" name="reponse_1" value="1887"/>
                <label for="choix1_1">1887</label>
            </div>
            <div>
                <input type="radio" id="choix1_2" name="reponse_1" value="1889"/>
                <label for="choix1_2">1889</label>
            </div>
            <div>
                <input type="radio" id="choix1_3" name="reponse_1" value="1899"/>
                <label for="choix1_3">1899</label>
            </div>
        </div>

        <h1>Question 2</h1>
        <p><u><b>Quels frères français ont présenté pour la première fois à l’exposition universelle de 1900 leur invention ?</u></b></p>
        <div class="radio-options">
            <div>
                <input type ='radio' id='choix2_1' name='reponse_2' value='Lumière (le cinéma)'/>
                <label for='choix2_1'>Lumière (le cinéma)</label>
            </div>
            <div>
                <input type="radio" id="choix2_2" name="reponse_2" value="Michelin (le pneu démontable)"/>
                <label for='choix2_2'>Michelin (le pneu démontable)</label>
            </div>
            <div>
                <input type="radio" id="choix2_3" name="reponse_2" value="Panhard (le moteur à essence)"/>
                <label for='choix2_3'>Panhard (le moteur à essence)</label>
            </div>
        </div>

        <h1>Question 3</h1>
        <p><u><b>Comment s’appelaient les révolutionnaires russes conduits par Lénine ?</u></b></p>
        <div class="radio-options">
            <div>
                <input type="radio" id="choix3_1" name="reponse_3" value="Les mencheviks"/>
                <label for="choix3_1">Les mencheviks</label>
            </div>
            <div>
                <input type="radio" id="choix3_2" name="reponse_3" value="Les bolcheviks"/>
                <label for="choix3_2">Les bolcheviks</label>
            </div>
            <div>
                <input type="radio" id="choix3_3" name="reponse_3" value="Les nihilistes"/>
                <label for="choix3_3">Les nihilistes</label>
            </div>
        </div>

        <h1>Question 4</h1>
        <p><u><b>Quelle est la capitale du Brésil ?</u></b></p>
        <div class="radio-option">
            <div>
                <input type="radio" id="choix4_1" name="reponse_4" value="Rio de Janeiro"/>
                <label for="choix4_1">Rio de Janeiro</label>
            </div>
            <div>
                <input type="radio" id="choix4_2" name="reponse_4" value="Sao Paulo"/>
                <label for="choix4_2">Sao Paulo </label>
            </div>
            <div>
            <input type="radio" id="choix4_3" name="reponse_4" value="Brasilia"/>
            <label for="choix4_3">Brasilia</label>
            </div>
        </div>

        <h1>Question 5</h1>
        <p><u><b>Comment s’appelle le bâtiment qui abrite le Congrès à Washington ?</u></b></p>
        <div class="radio-option">
            <div>
                <input type="radio" id="choix5_1" name="reponse_5" value="La Maison-Blanche"/>
                <label for="choix5_1">La Maison-Blanche</label>
            </div>
            <div>
                <input type="radio" id="choix5_2" name="reponse_5" value="Le Congress Hall"/>
                <label for="choix5_2">Le Congress Hall</label>
            </div>
            <div>
                <input type="radio" id="choix5_3" name="reponse_5" value="Le Capitole"/>
                <label for="choix5_3">Le Capitole</label>
            </div>
        </div>
       
        <h1>Question 6</h1>
        <p><u><b>Quelle machine, redoutée par les automobilistes, a été inventée en 1935 par l’Américain Magee ?</u></b></p>
        <div class="radio-option">
            <div>
                <input type="radio" id="choix6_1" name="reponse_6" value="Le radar"/>
                <label for="choix6_1">Le radar</label>
            </div>
            <div>
                <input type="radio" id="choix6_2" name="reponse_6" value="L'alcootest"/>
                <label for="choix6_2">L'alcootest</label>
            </div>
            <div>
                <input type="radio" id="choix6_3" name="reponse_6" value="Le parcmètre"/>
                <label for="choix6_3">Le parcmètre</label>
            </div>
        </div>

        <h1>Question 7</h1>
        <p><u><b>Qui est le chef des armées en France ?</u></b></p>
        <div class="radio-option">
            <div>
                <input type="radio" id="choix7_1" name="reponse_7" value="Le Chef d'Etat-Major"/>
                <label for="choix7_1">Le Chef d'Etat-Major</label>
            </div>
            <div>
                <input type="radio" id="choix7_2" name="reponse_7" value="Le Président de la République"/>
                <label for="choix7_2">Le Président de la République</label>
            </div>
            <div>
                <input type="radio" id="choix7_3" name="reponse_7" value="Le Ministre de la Défense"/>
                <label for="choix7_3">Le Ministre de la Défense</label>
            </div>
        </div>
        
        <h1>Question 8</h1>
        <p><u><b>Doit-on écrire :</p></u></b>
        <div class="radio-option">
            <div>
                <input type="radio" id="choix8_1" name="reponse_8" value="Les chariots en feu"/>
                <label for="choix8_1">Les chariots en feu</label>
            </div>
            <div>
                <input type="radio" id="choix8_2" name="reponse_8" value="Les charriots en feu"/>
                <label for="choix8_2">Les charriots en feu</label>
            </div>
        </div>
       
        <h1>Question 9</h1>
        <p><u><b>Quelle firme réalisa les premiers stylos à Bille ?</u></b></p>
        <div class="radio-option">
            <div>
                <input type="radio" id="choix9_1" name="reponse_9" value="BIC"/>
                <label for ="choix9_1">BIC</label>
            </div>
            <div>
                <input type="radio" id="choix9_2" name="reponse_9" value="Reynolds"/>
                <label for="choix9_2">Reynolds</label>
            </div>
            <div>
                <input type="radio" id="choix9_3" name="reponse_9" value="Pentel"/>
                <label for="choix9_3">Pentel</label>
            </div>
        </div>
        
        <h1>Question 10</h1>
        <p><u><b>Quand fut inventé le stéthoscope ?</u></b></p>
        <div class="radio-option">
            <div>
                <input type="radio" id="choix10_1" name="reponse_10" value="1732"/>
                <label for ="choix10_1">1732</label>
            </div>
            <div>
                <input type="radio" id="choix10_2" name="reponse_10" value="1816"/>
                <label for="choix10_2">1816</label>
            </div>
            <div>
                <input type="radio" id="choix10_3" name="reponse_10" value="1898"/>
                <label for="choix10_3">1898</label>
            </div>
        </div>

        <h1>Question 11</h1>
        <p><u><b>Trouver le mot manquant qui est le même pour chacune des trois phrases.</u></b></p>
        <div class="textarea">
            <label for="reponse_11">Mot manquant :</label>
            <textarea id="reponse_11" name="reponse_11" rows="1" cols="10"></textarea>
        </div>

        <p>De tous ces souvenirs, il a fait ... rase.</p>
        <p>La majeure partie de son salaire est consacrée à la ... et au logement.</p>
        <p>Il doit réviser sa ... de multiplication.</p>

        <h1>Question 12</h1>
        <p><u><b>Sous quel président de la République l’âge de la majorité électorale a-t-il été abaissé à 18 ans ? </u></b></p>
        <div class="radio-option">
            <div>
               <input type="radio" id="choix12_1" name="reponse_12" value="De Gaulle"/>
               <label for ="choix12_1">De Gaulle</label>
            </div>
            <div>
                <input type="radio" id="choix12_2" name="reponse_12" value="Pompidou"/>
                <label for="choix12_2">Pompidou</label>
            </div>
            <div>
                <input type="radio" id="choix12_3" name="reponse_12" value="Valéry Giscard d'Estaing"/>
                <label for="choix12_3">Valéry Giscard d'Estaing</label>
            </div>
        </div>

        <h1>Question 13</h1>
        <p><u><b>Inscrivez les deux chiffres devant figurer sous le dernier mot.</u></b></p>
        <p>Camion : 3+3</p>
        <p>Hélicoptère : 5+6</p>
        <p>Arithmétique : 6+6</p>
        <p>Avion : 3+2</p>
        <label for="reponse_13">Lire :</label>
        <textarea id="reponse_13" name="reponse_13" rows ="1" cols="6"></textarea>

        <h1>Question 14</h1>
        <p><u><b>Quel verbe est utilisé pour désigner le cri des dauphins ?</u></b></p>
        <div class="radio-option">
            <div>
                <input type="radio" id="choix14_1" name="reponse_14" value="Gazouiller"/>
                <label for ="choix14_1">Gazouiller</label>
            </div>
            <div>
                <input type="radio" id="choix14_2" name="reponse_14" value="Glapir"/>
                <label for="choix14_2">Glapir</label>
            </div>
            <div>
                <input type="radio" id="choix14_3" name="reponse_14" value="Siffler"/>
                <label for="choix14_3">Siffler</label>
            </div>
            <div>
                <input type="radio" id="choix14_4" name="reponse_14" value="Chanter"/>
                <label for="choix14_4">Chanter</label>
            </div>
        </div>
    
        <h1>Question 15</h1>
        <p><u><b>De quel pays Tirana est-elle la capitale ?</u></b></p>
        <div class="radio-option">
            <div>
                <input type="radio" id="choix15_1" name="reponse_15" value="Thaïlande"/>
                <label for="choix15_1">Thaïlande</label>
            </div>
            <div>
                <input type="radio" id="choix15_2" name="reponse_15" value="Mexique"/>
                <label for="choix15_2">Mexique</label>
            </div>
            <div>
                <input type="radio" id="choix15_3" name="reponse_15" value="Albanie"/>
                <label for="choix15_3">Albanie</label>
            </div>
            <div>
                <input type="radio" id="choix15_4" name="reponse_15" value="Madagascar"/>
                <label for="choix15_4">Madagascar</label>
            </div>
        </div>
    
        <h1>Question 16</h1>
        <p><u><b>À quel écrivain doit-on le livre "Mémoires d'outre-tombe" ?</u></b></p>
        <div class="radio-option">
            <div>
                <input type="radio" id="choix16_1" name="reponse_16" value="Jean-Jacques Rousseau"/>
                <label for="choix16_1">Jean-Jacques Rousseau</label>
            </div>
            <div>
                <input type="radio" id="choix16_2" name="reponse_16" value="François-René de Chateaubriand"/>
                <label for="choix16_2">François-René de Chateaubriand</label>
            </div>
            <div>
                <input type="radio" id="choix16_3" name="reponse_16" value="William Shakespeare"/>
                <label for="choix16_3">William Shakespeare</label>
            </div>
            <div>
                <input type="radio" id="choix16_4" name="reponse_16" value="Victor Hugo"/>
                <label for="choix16_4">Victor Hugo</label>
            </div>
        </div>
    

        <h1>Question 17</h1>
        <p><u><b>Qui a été le premier président de la Vème République à être réélu au suffrage universel ?</u></b></p>
        <div class="radio">
            <div>
                <input type="radio" id="choix17_1" name="reponse_17" value="François Mitterand"/>
                <label for="choix17_1">François Mitterand</label>
            </div>
            <div>
                <input type="radio" id="choix17_2" name="reponse_17" value="Charles De Gaulle"/>
                <label for="choix17_2">Charles De Gaulle</label>
            </div>
            <div>
                <input type="radio" id="choix17_3" name="reponse_17" value="Georges Pompidou"/>
                <label for="choix17_3">Georges Pompidou</label>
            </div>
        </div>
        
        <h1>Question 18</h1>
        <p><u><b>Par quoi commencent les événements de mai 1968 en France ?</p></u></b>
        <div class="radio">
            <div>
                <input type="radio" id="choix18_1" name="reponse_18" value="Un mouvement étudiant"/>
                <label for="choix18_1">Un mouvement étudiant</label>
            </div>
            <div>
                <input type="radio" id="choix18_2" name="reponse_18" value="Un mouvement ouvrier"/>
            <label for="choix18_2">Un mouvement ouvrier</label>
            </div>
            <div>
                <input type="radio" id="choix18_3" name="reponse_18" value="Une crise politique"/>
                <label for="choix18_3">Une crise politique</label>
            </div>
            <div>
                <input type="radio" id="choix18_4" name="reponse_18" value="Les résultats aux élections"/>
                <label for="choix18_4">Les résultats aux élections</label>
            </div>
        </div>

        <h1>Question 19</h1>
        <p><u><b>Quelle est la date de l'abolition de l'esclavage aux États-Unis ?</p></u></b>
        <div class="radio-option">
            <div>
                <input type="radio" id="choix19_1" name="reponse_19" value="1865"/>
                <label for="choix19_1">1865</label>
            </div>
            <div>
                <input type="radio" id="choix19_2" name="reponse_19" value="1820"/>
                <label for="choix19_2">1820</label>
            </div>
            <div>
                <input type="radio" id="choix19_3" name="reponse_19" value="1923"/>
                <label for="choix19_3">1923</label>
            </div>
            <div>
                <input type="radio" id="choix19_4" name="reponse_19" value="1900"/>
                <label for="choix19_4">1900</label>
            </div>
        </div>

        <h1>Question 20</h1>
        <p><u><b>Quel pays est surnommé “L’empire du Milieu" ?</p></u></b>
        <div class="radio-option">
            <div>
                <input type="radio" id="choix20_1" name="reponse_20" value="La Chine"/>
                <label for="choix20_1">La Chine</label>
            </div>
            <div>
                <input type="radio" id="choix20_2" name="reponse_20" value="La Mongolie"/>
                <label for="choix20_2">La Mongolie</label>
            </div>
            <div>
                <input type="radio" id="choix20_3" name="reponse_20" value="Le Japon"/>
                <label for="choix20_3">Le Japon</label>
            </div>
        </div>
        <button type="submit">Suivant</button>
    </div>
</form>

<script>

    let IntervalId;
    let startTime = localStorage.getItem('chronoStartTime') ? parseInt(localStorage.getItem('chronoStartTime')) : Math.floor(Date.now() / 1000) + (12 * 60);
    
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
                localStorage.removeItem('chronoStartTime');
                window.location.href = 'question2.php'; // Rediriger vers la page question2.php
            }
        }


    function startChrono() {
    const savedTime = localStorage.getItem('chronoStartTime');

    if (!savedTime) {
        // Définir la durée du chrono à 12 minutes et 20 secondes (12 * 60 + 20 secondes)
        startTime = Math.floor(Date.now() / 1000) + (12 * 60) + 20;
        localStorage.setItem('chronoStartTime', startTime);
    } else {
        startTime = parseInt(savedTime);
    }
}

    // Gestionnaire d'événements lorsque la page est rechargée
    window.addEventListener('load', function() {
        startChrono(); // Démarrer le chrono lors du rechargement de la page
        startChronoIfActive(); // Vérifier si le chrono doit être démarré lorsque la page est rechargée
    });
    if (!localStorage.getItem('chronoStartTime')){
        startChrono();
    }
    const intervalId = setInterval(updateChrono, 1000);
    updateChrono();

    // Fonction pour réinitialiser le chronomètre
    function resetChrono() {
    // Réinitialiser le temps de départ à 12 minutes 20s (12 * 60 secondes) + 20s
    clearInterval(intervalId);
    localStorage.removeItem('chronoStartTime');
    startTime = Math.floor(Date.now() / 1000) + (12 * 60) + 20; // Utiliser la variable globale startTime
    localStorage.setItem('chronoStartTime', startTime);
}

// Modifier la fonction startChronoIfActive pour vérifier si la visibilité est 'visible' avant de démarrer le chrono
function startChronoIfActive() {
    if (document.visibilityState === 'visible') {
        startChrono();
    } else {
        clearInterval(intervalId); // Arrêter le chronomètre lorsque la page devient inactive
    }
}

// Gestionnaire d'événements pour le bouton "Suivant"
document.querySelector('button[type="submit"]').addEventListener('click', function() {
    resetChrono();
});

    // Gestionnaire d'événements pour détecter lorsque la fenêtre est en premier plan
    document.addEventListener('visibilitychange', startChronoIfActive);

    // Gestionaire d'événements lorsque la page est rechargée
    window.addEventListener('load', startChronoIfActive);

    // Ajouter un gestionnaire d'événements de clic au bouton "Suivant"
    document.querySelector('button[type="submit"]').addEventListener('click', resetChrono);

</script>
</body>
</html>
