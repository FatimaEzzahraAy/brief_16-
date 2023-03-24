<?php
    include("./cnx.php");

    $ouvrage = "SELECT ouvrage.* FROM ouvrage LEFT JOIN reservation ON ouvrage.Id_ouv = reservation.Id_ouv WHERE reservation.Id_ouv IS NULL GROUP BY ouvrage.Titre ORDER BY ouvrage.Id_ouv";
   $ouvrageReslt = $cnx->prepare($ouvrage);
   $ouvrageReslt->execute();


   $ouvrageRes = "SELECT * FROM ouvrage JOIN reservation ON ouvrage.Id_ouv = reservation.Id_ouv";
   $ouvrageResReslt = $cnx->prepare($ouvrageRes);
   $ouvrageResReslt->execute();


   while ($ligneOR = $ouvrageResReslt->fetch(PDO::FETCH_ASSOC)) {
    echo
    "<div class='row'>
        <div class='col-sm-6 mb-3 mb-sm-0'>
            <div class='card  col-xs-12  col-md-5  col-xl-3 my-5 ' style='width:280px;height:fit-content)'>
                <img style='height: 250px;' src='./img/$ligneOR[Img_couv]'  alt='$ligneOR[Img_couv]' class='card-img h- w-100' >
                <div class='card-body'>
                    <h6 class='card-title'>$ligneOR[Titre]</h6>
                    <h6 class='card-title text-success'>$ligneOR[Nom_aut]</h6>
                    <h6 class='card-title text-end'>$ligneOR[Etat]</h6>
                    <span class='visually-hidden'>$ligneOR[Type_ouv]</span>
                </div>
            </div>
        </div>
    </div> ";}
    while ($ligneO = $ouvrageReslt->fetch(PDO::FETCH_ASSOC) ) {
        
        echo
            "<div class='row'>
                <div class='col-sm-6 mb-3 mb-sm-0'>
                    <div class='card  col-md-5  col-xl-3 my-5 ' style='width:280px;height:fit-content'>
                        <img style='height: 250px;' src='./img/$ligneO[Img_couv]'  alt='$ligneO[Img_couv]' class='card-img h- w-100' >
                        <div class='card-body'>
                            <h6 class='card-title'>$ligneO[Titre]</h6>
                            <h6 class='card-title text-success'>$ligneO[Nom_aut]</h6>
                            <h6 class='card-title text-end'>$ligneO[Etat]</h6>
                            <span class='visually-hidden'>$ligneO[Type_ouv]</span>
                            <form method='post'><button class='btn btn-danger rounded-pill' name='reserver' value=$ligneO[Id_ouv]>Rerserver</button></form>
                            
                        </div>
                    </div>
                </div>
            </div> 
            ";
   }



?>
