<?php 

try{
    $cnx = new PDO("mysql:host=127.0.0.1;dbname=gestion_bibliotheque","root","");
//    echo "cnx";
//    $RAdherentS = "SELECT * FROM Adherent";
//    $RsultAdherentS = $cnx->prepare($RAdherentS);
//    $RsultAdherentS->execute();

//    $RS = "SELECT * FROM ";
//    $RsultS = $cnx->prepare($RS);
//    $RsultS->execute();

//    $RS = "SELECT * FROM";
//    $RsultS = $cnx->prepare($RS);
//    $RsultS->execute(); 

}
catch(PDOException $e){
  echo 'Erreur : ' . $e->getMessage();
}

?>