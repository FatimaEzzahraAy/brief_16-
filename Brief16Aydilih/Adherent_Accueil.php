<?php include("./cnx.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="./javascript.js"></script>
    <title>Accueil</title>

</head>
<body>
    <header >
        <?php include("./Adherent_navbar.php")?>
        <div class="d-flex justify-content-center align-items-center flex-wrap" style="background-color:rgb(62,171,154)">
        
            <!-- Rechere Form -->
            <form method="POST" class="w-100  m-1">
               
                <div class="d-flex flex-wrap justify-content-center align-items-center mx-1 w-100">
                    <!-- rechercher -->
                    <div class="form-group col-12 col-sm-6 col-md-4 col-lg-3 m-1 ">
                        <input type="text" class="form-control w-100 rounded-pill" name="ville" placeholder="Rechercher" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <!-- Type -->
                    <div class="form-group col-12 col-sm-6 col-md-4 col-lg-3 m-3">
                        <select class="form-select w-100 rounded-pill" name="type" aria-label=".form-select example">
                        <option value="tout_type">Tout Type :</option>
                        <option value="Roman">Roman</option>
                        <option value="Memoire de recherche">Memoire de recherche</option>
                        <option value="Magazine">Magazine</option>
                        <option value="DVD">DVD</option>
                        </select>
                    </div>
                    <!-- categorie -->
                    <div class="form-group col-12 col-sm-6 col-md-4 col-lg-3 m-3">
                        <select class="form-select w-100 rounded-pill" name="type" aria-label=".form-select example">
                        <option value="tout_categorie">Tout categorie :</option>
                        <option value="Titre">Titre</option>
                        <option value="Nom de auteur">Nom de auteur</option>
                        <option value="Nom de auteur">Date d'adition</option>
                        <option value="Nom de auteur">Nombres de pages</option>
                        </select>
                    </div>
                    <div class="form-group col-6 col-md-2 col-lg-2 m-3">
                        <button name="submit_search" type="submit" class="btn rounded-pill  w-100 bg-light" style="color:rgb(27,171,162);">Rechercher</button>
                    </div> 
                </div>
            </form>  
        <!-- Filtres Form -->
        <form method="POST" class="w-100  m-1">
            <div class="d-flex flex-wrap justify-content-center align-items-center mx-1">
                    <button name="roman" type="submit" class="btn rounded-pill bg-light me-2" style="color:rgb(27,171,162);">Roman</button>
                    <button name="revue" type="submit" class="btn rounded-pill bg-light me-2" style="color:rgb(27,171,162);">Revue</button>
                    <button name="magazine" type="submit" class="btn rounded-pill bg-light me-2" style="color:rgb(27,171,162);">Magazine</button>
                    <button name="cd" type="submit" class="btn rounded-pill bg-light me-2" style="color:rgb(27,171,162);">CD ou DVD</button>
                    <button name="cassette" type="submit" class="btn rounded-pill bg-light" style="color:rgb(27,171,162);">Cassette vidéo</button>   
            </div>
        </form>
    </div>
    </header>
    <main>
      <div class='cards d-flex  align-items-center justify-content-around flex-wrap'>
        
        <?php include("./Adherent_carte.php");
        // inserer une reservation
        if (isset($_POST["reserver"])) {
            $IdOuvrage =  $_POST["reserver"];
            $IdAd = $_SESSION["IdAd"];
            $dateAuj = date('d-m-y h:i:s');
            $expire ="non";

            $countReser = "SELECT COUNT(Id_ad) FROM `reservation` WHERE Id_ad = '$IdAd'";
            $countReserReslt =  $cnx->prepare($countReser);
            $countReserReslt->execute();
            $ligneC = $countReserReslt->fetch(PDO::FETCH_ASSOC);
            
            $emprunt = "SELECT count(reservation.Id_rev) FROM ouvrage INNER JOIN reservation ON ouvrage.Id_ouv = reservation.Id_ouv  AND ouvrage.Id_ouv='$IdOuvrage' INNER JOIN emprunt ON reservation.Id_rev = emprunt.Id_rev and reservation.Id_ad =$IdAd AND emprunt.DateR is NULL";
            $CountEmp =  $cnx->prepare($emprunt);
            $CountEmp->execute();
            $ligneEmp = $CountEmp->fetch(PDO::FETCH_ASSOC);

            $sommeL = $ligneC["COUNT(Id_ad)"] + $ligneEmp["count(reservation.Id_rev)"];
            
            if ($sommeL < 3) {
                $Reservation ="INSERT INTO `reservation` (`Date_rev`, `Id_ad`, `Id_ouv`,`Expire`) VALUES ('$dateAuj', '$IdAd', '$IdOuvrage','$expire')";
                $ReservationReslt = $cnx->prepare($Reservation);
                $ReservationReslt->execute();
                echo "<div ><h3>Votre réservation a été insérée avec succès.</h3>
                <h4>vous avez déjà $sommeL reservations</h4></div>";
            }else {
                echo "<div ><h3>vous avez déjà 3 reservations</h3></div>";
            }
           }
        //    filtres:
           if(isset($_POST["roman"])){
            echo "ddd";
           }
          ?>
      </div>
    </main>
    
</body>
</html>