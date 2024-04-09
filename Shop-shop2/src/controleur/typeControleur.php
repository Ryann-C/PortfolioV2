<?php
function typeControleur($twig, $db){
 $form = array();
 $type = new Type($db);

if (isset($_POST["btAjouter"])){

    $inputType = $_POST['inputType']; 
    $exec = $type->insert($inputType);
    
}
$liste = $type->select();
echo $twig->render('type.html.twig', array('form'=>$form,'liste'=>$liste));

}
?>