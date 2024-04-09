<?php
function getPage($db){
    $lesPages['accueil'] = "accueilControleur";
    $lesPages['contact'] = "contactControleur";
    $lesPages['mentionlegales'] = "mentionlegalesControleur";
    $lesPages['apropos'] = "aproposControleur";
    $lesPages['inscrire'] ="inscrireControleur";
    $lesPages['maintenance']="maintenanceControleur";
    $lesPages['connexion']="connexionControleur";
    $lesPages['deconnexion']="deconnexionControleur";
    $lesPages['utilisateur']='utilisateurControleur';
    $lesPages['utilisateurModif']="utilisateurModifControleur";
    $lesPages['type'] = "typeControleur";
    $lesPages['addproduit'] = 'addproduitControleur';
    if($db!=null){
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 'accueil';
        }
    if (!isset($lesPages[$page])){
        $page = 'accueil';
    }
    $contenu = $lesPages[$page];
}
else{
    $contenu = $lesPages['maintenance'];
}
return $contenu;
}
?>