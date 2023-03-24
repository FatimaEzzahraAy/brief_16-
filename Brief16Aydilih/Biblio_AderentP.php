<?php include("./cnx.php"); 
    $Ad = "SELECT * FROM adherent where Penalite_ad = 3 and Desactiver ='non'";
    $AdR = $cnx->prepare($Ad);
    $AdR->execute();

    if (isset($_POST["AdherentB"])) {
        $divAd = '<table class="table table-striped">
            <thead>
              <tr>
              <th scope="col">CIN</th>
              <th scope="col">Nom</th>
              <th scope="col">Email</th>
              <th scope="col">Penalite</th>
              <th scope="col">Operations</th>
              </tr>
            </thead>
            <tbody>';
        while ($ligneAd = $AdR->fetch(PDO::FETCH_ASSOC)) {
            $divAd .= '
            <tr>
            <td>'.$ligneAd["Cin_ad"].'</td>
              <td>'.$ligneAd["Nom_ad"].'</td>
              <td>'.$ligneAd["Email_ad"].'</td>
              <td>'.$ligneAd["Penalite_ad"].'</td>
              <td><form method="post"><button type="submit" name ="SupAd"  class="btn rounded-pill text-light me-2" value = "'.$ligneAd["Id_ad"].'" style="background-color:rgb(27,171,162);">Supprimer</button> </form>
              </td>
            </tr>';
        }
        $divAd .='</tbody></table>';
    }
    if(isset($_POST["SupAd"])){
        $idAd = $_POST["SupAd"];
        $SupAd = "UPDATE `adherent` SET `Desactiver` = 'oui' WHERE `Id_ad` ='$idAd'";
        $SupAdR = $cnx->query($SupAd);
        header("Location:./Biblio_Accueil.php");
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
    <title>Adhérent</title>
</head>
<body>
    <header>
    <?php include("./Biblio_navbar.php"); ?>
    </header>
    <main>
    <form method="post">
                <button class="btn rounded-pill  text-light mb-1"  name="AdherentB" style="background-color:rgb(62,171,154)">Les adhérents qui ont 3 penalites</button>
                <div class="m-3"><?php if(isset($divAd))echo $divAd ?></div>
                <div class="m-3"><?php if(isset($divAdSup))echo $divAdSup ?></div>      
            </form>
    </main>
</body>
</html>