<?php include("./cnx.php"); 
    //reservation en cours
    $Reserv = "SELECT adherent.Cin_ad,ouvrage.Titre,reservation.Date_rev,reservation.Id_rev FROM adherent INNER join reservation on reservation.Id_ad = adherent.Id_ad INNER JOIN ouvrage on ouvrage.Id_ouv = reservation.Id_ouv where `reservation`.`Expire` = 'non'";
    $ReservR = $cnx->prepare($Reserv);
    $ReservR->execute();
    //reservations annulee
    $ReservAnnul = "SELECT adherent.Cin_ad,ouvrage.Titre,reservation.Date_rev,reservation.Id_rev FROM adherent INNER join reservation on reservation.Id_ad = adherent.Id_ad INNER JOIN ouvrage on ouvrage.Id_ouv = reservation.Id_ouv where `reservation`.`Expire` = 'oui'";
    $ReservAnnulR = $cnx->prepare($ReservAnnul);
    $ReservAnnulR->execute();
    //empruntes en cours
    $Emp = "SELECT adherent.Cin_ad,ouvrage.Titre,emprunt.Date_emp, emprunt.Id_emp FROM adherent INNER join reservation on reservation.Id_ad = adherent.Id_ad INNER JOIN ouvrage on ouvrage.Id_ouv = reservation.Id_ouv INNER JOIN emprunt on emprunt.Id_rev = reservation.Id_rev where emprunt.DateR is NULL AND emprunt.DateR_eff is NULL";
    $EmpR = $cnx->prepare($Emp);
    $EmpR->execute();
    //Emprunt expiré
    $EmpExpi = "SELECT adherent.Cin_ad,ouvrage.Titre,emprunt.* FROM adherent INNER join reservation on reservation.Id_ad = adherent.Id_ad INNER JOIN ouvrage on ouvrage.Id_ouv = reservation.Id_ouv INNER JOIN emprunt on emprunt.Id_rev = reservation.Id_rev where emprunt.DateR is NULL AND emprunt.DateR_eff is NOT NULL AND emprunt.DateR_eff < Now()";
    $EmpExpiR = $cnx->prepare($EmpExpi);
    $EmpExpiR->execute();

    
    if (isset($_POST["reserver"])) {
        $presv = '<table class="table table-striped">
            <thead>
              <tr>
              <th scope="col">Cin de l\'adhérent</th>
              <th scope="col">Titre</th>
              <th scope="col">Date reservation</th>
              <th scope="col">Operations</th>
              </tr>
            </thead>
            <tbody>';
        while ($ligneresv = $ReservR->fetch(PDO::FETCH_ASSOC)) {
            $presv .= '
            <tr>
            <td>'.$ligneresv["Cin_ad"].'</td>
              <td>'.$ligneresv["Titre"].'</td>
              <td>'.$ligneresv["Date_rev"].'</td>
              <td><form method="post"><button type="submit" name ="AjoutEmp"  class="btn rounded-pill text-light me-2" value = "'.$ligneresv["Id_rev"].'" style="background-color:rgb(27,171,162);">Emprunt</button> </form>
              </td>
            </tr>';
        }
        $presv .='</tbody></table>';
    }elseif (isset($_POST["reserverAnnul"])) {
        $presan = '<table class="table table-striped">
        <thead>
          <tr>
          <th scope="col">Cin de l\'adhérent</th>
          <th scope="col">Titre</th>
          <th scope="col">Date reservation</th>
          </tr>
        </thead>
        <tbody>';
        while ($ligneannul = $ReservAnnulR->fetch(PDO::FETCH_ASSOC)) {
            $presan .= '
            <tr>
            <td>'.$ligneannul["Cin_ad"].'</td>
              <td>'.$ligneannul["Titre"].'</td>
              <td>'.$ligneannul["Date_rev"].'</td>
            </tr>';
        }
        $presan .= '</tbody></table>';
    }elseif (isset($_POST["emprunt"])) {
        $presemp = '<table class="table table-striped">
            <thead>
            <tr>
            <th scope="col">Cin de l\'adhérent</th>
              <th scope="col">Titre</th>
              <th scope="col">Date emprunt</th>
              <th scope="col">Operations</th>
            </tr>
          </thead>
          <tbody>';
        while ($ligneEmp = $EmpR->fetch(PDO::FETCH_ASSOC)) {
            $presemp .= '
            <tr>
            <td>'.$ligneEmp["Cin_ad"].'</td>
              <td>'.$ligneEmp["Titre"].'</td>
              <td>'.$ligneEmp["Date_emp"].'</td>
              <td><form method="post"><button name="ModEmp" value="'.$ligneEmp["Id_emp"].'" class="btn rounded-pill text-light me-2" style="background-color:rgb(27,171,162);">Modifier</button></form>
              </td>
            </tr>';
        }
       $presemp .= '</tbody>
        </table>';
    }
      if (isset($_POST["AjoutEmp"])) {
        $idRev = $_POST["AjoutEmp"];
        $dateEmpAuj = date('d-m-y h:i:s');
        $dateREff = date('d-m-Y', strtotime('+15 days'));
        
        $selectEmp = "SELECT emprunt.Id_rev FROM reservation INNER JOIN emprunt on emprunt.Id_rev = reservation.Id_rev where emprunt.Id_rev = '$idRev'";
        $selectEmpR = $cnx->prepare($selectEmp);
        $selectEmpR->execute();
            if (!$ligneS =$selectEmpR->fetch(PDO::FETCH_ASSOC)) {
                $EmpAj = "INSERT INTO `emprunt` (`Date_emp`, `DateR`, `DateR_eff`, `Id_rev`) VALUES ('$dateEmpAuj', NULL, '$dateREff', '$idRev')";
                $EmpAjR = $cnx->prepare($EmpAj);
                $EmpAjR->execute();

                $divEmp = "L'emprunt est ajouté avec succés";
            }else {
                $divEmp = "l'emprunt est déjà ajouter";
            }
       
      }
      if (isset($_POST["ModEmp"])) {
        $modE = $_POST["ModEmp"];
        $Emp .= " AND  emprunt.Id_emp = '$modE'";
        $EmpRMod = $cnx->prepare($Emp);
        $EmpRMod->execute();
        if ($ligneEmpMod = $EmpRMod->fetch(PDO::FETCH_ASSOC)){

        $divEmpMIJ = "
        <form method='post' class='border border-3 border-success rounded text-center w-auto'>
        <div class='form-group m-1 ms-5 '>
            <label class='ms-3 text-success'>CIN:</label>
            <input type='text' value=".$ligneEmpMod['Cin_ad']." name='cin' id='cin' class='rounded-pill border-1 border-success form-control' >
        </div>
        <div class='form-group m-1 ms-5 '>
            <label class='ms-3 text-success'>Titre d'ouvrage:</label>
            <input type='text' value='$ligneEmpMod[Titre]' name='titre' class='rounded-pill border-1 border-success form-control' >
            <span id='AddVerf' class='text-danger'></span>
        </div>
        <div class='form-group m-1 ms-5 '>
            <label class='ms-3 text-success'>La date d'emprunt:</label>
            <input type='date' value='$ligneEmpMod[Date_emp]' name='DateEmp'  class='rounded-pill border-1 border-success form-control'>
        </div>
        <div class='form-group m-1 ms-5 '>
            <label class='ms-3 text-success'>La date de retour:</label>
            <input type='date' name='DateEmp'  class='rounded-pill border-1 border-success form-control'>
        </div>
        <div class='form-group m-1 ms-5 text-center'>
            <button type='submit' class='btn rounded-pill bg-success text-light' name='mod'>Modifier</button>
        </div>
        </form>";
    
        }
     }elseif (isset($_POST["EmpExpire"])) {
        $empExp = '<table class="table table-striped">
        <thead>
        <tr>
        <th scope="col">Cin de l\'adhérent</th>
          <th scope="col">Titre</th>
          <th scope="col">Date emprunt</th>
          <th scope="col">Date retour effective</th>
          <th scope="col">Date retour</th>
          <th scope="col">Operations</th>
        </tr>
      </thead>
      <tbody>';
        while ($ligneEmpExp = $EmpExpiR->fetch(PDO::FETCH_ASSOC)) {
        $empExp .= '<tr>
        <td>'.$ligneEmpExp["Cin_ad"].'</td>
          <td>'.$ligneEmpExp["Titre"].'</td>
          <td>'.$ligneEmpExp["Date_emp"].'</td>
          <td>'.$ligneEmpExp["DateR_eff"].'</td>
          <td>'.$ligneEmpExp["DateR"].'</td>
          <td><form method="post"><button name="ModEmpExp" value="'.$ligneEmpExp["Id_emp"].'" class="btn rounded-pill text-light me-2" style="background-color:rgb(27,171,162);">Modifier</button></form>
          </td>
        </tr>';
        }
        $empExp .= '</tbody></table>';
    }
    if (isset($_POST["ModEmpExp"])) {
        $Idemp = $_POST["ModEmpExp"];
        
        $adCin = "SELECT adherent.Cin_ad,adherent.Penalite_ad FROM adherent INNER join reservation on reservation.Id_ad = adherent.Id_ad INNER JOIN emprunt on emprunt.Id_rev = reservation.Id_rev where emprunt.Id_emp = $Idemp";
        $adCinR = $cnx->prepare($adCin);
        $adCinR->execute();
        $ligneempExpAd = $adCinR->fetch(PDO::FETCH_ASSOC);

        $penalite = 1+$ligneempExpAd["Penalite_ad"];

        $EpExpAd = "UPDATE `adherent` SET `Penalite_ad` = '$penalite' WHERE `adherent`.`Cin_ad` = '$ligneempExpAd[Cin_ad]'";
        $EpExpAdR = $cnx->prepare($EpExpAd);
        $EpExpAdR->execute();

        $divExp = "Le $ligneempExpAd[Cin_ad] a eu $penalite penalité";    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" ></script>
     <script defer src="./javascript.js"></script>
    <title>Accueil</title>
</head>
<body>
    <header><?php include("./Biblio_navbar.php") ?>
    </header>
    <main >
            <form method="post">
                <button class="btn rounded-pill  text-light mb-1"  name="reserver" style="background-color:rgb(62,171,154)">Les reservations en cours</button>
                <div class="m-1"><?php if(isset($divEmp))echo $divEmp ?></div>
                <div class="m-3"><?php if(isset($presv))echo $presv ?></div>
            </form>
            <form method="post">
                <button class="btn rounded-pill  text-light mb-1"  name="reserverAnnul" style="background-color:rgb(62,171,154)">Les reservations annulées</button>
                <div class="m-3"><?php if(isset($presan))echo $presan ?></div>
            </form>
            <form method="post">
                <button class="btn rounded-pill  text-light"  name="emprunt" style="background-color:rgb(62,171,154)">Les empruntes en cours</button>
                <div class="m-3">
                    <div class='container'>
                    <div class='row d-flex mt-1 justify-content-center w-50'>
                    <?php if(isset($divEmpMIJ))echo $divEmpMIJ ?>
                    </div>
                    </div>
                </div>
                <div class="m-3"><?php if(isset($presemp))echo $presemp ?></div>
            </form>
            <form method="post">
                <button class="btn rounded-pill  text-light mb-1"  name="EmpExpire" style="background-color:rgb(62,171,154)">Les empruntes expirés</button>
                <div class="m-3"><?php if(isset($empExp))echo $empExp ?></div>
                <div class="m-3"><?php if(isset($divExp))echo $divExp ?></div>
            </form>
    </main>

</body>
</html>