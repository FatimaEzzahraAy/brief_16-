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
    <title>Profil</title>
</head>
<body>
    <header>
        <?php include("./Adherent_navbar.php")?>
        <div class="d-flex justify-content-center align-items-center flex-wrap" style="background-color:rgb(62,171,154)">
            <form action="" method="post">
                <button class="btn rounded-pill  text-light"  name="reserverA">Les reservations</button>
                <button class="btn rounded-pill  text-light"  name="empruntA">Les empruntes</button>
                <button class="btn rounded-pill  text-light m-2" name="personnel">Les informations personnels
                </button>
            </form>
        </div>
    </header>
    <main>
    <?php 
    $IdAd = $_SESSION["IdAd"];
    $adherent = "SELECT * FROM `adherent` WHERE Id_ad =$IdAd";
    $adherentResult = $cnx -> prepare($adherent);
    $adherentResult->execute();
    $ligneAd = $adherentResult-> fetch(PDO::FETCH_ASSOC);
    // Btn Reserver: les reservations d'un adherent 
    if (isset($_POST["reserverA"])) {
        $reserv = "SELECT * FROM `reservation` INNER JOIN ouvrage on reservation.Id_ouv = ouvrage.Id_ouv AND Id_ad = $IdAd";
        $reservResult = $cnx->prepare($reserv);
        $reservResult->execute();

        echo "<div class='cards d-flex  align-items-center justify-content-around flex-wrap'>";

        while ($ligneReserv = $reservResult->fetch(PDO::FETCH_ASSOC)) {
        echo
        "<div class='row'>
        <div class='col-sm-6 mb-3 mb-sm-0'>
            <div class='card  col-xs-12  col-md-5  col-xl-3 my-5 ' style='width:280px;height:fit-content)'>
                <img style='height: 250px;' src='./img/$ligneReserv[Img_couv]'  alt='$ligneReserv[Img_couv]' class='card-img h- w-100' >
                <div class='card-body'>
                    <h6 class='card-title'>$ligneReserv[Titre]</h6>
                    <h6 class='card-title text-success'>$ligneReserv[Nom_aut]</h6>
                    <h6 class='card-title text-end'>$ligneReserv[Etat]</h6>
                </div>
            </div>
        </div>
    </div>
        ";
        }
        //Emprunt
    }elseif (isset($_POST["empruntA"])) {
        $Emp = "SELECT ouvrage.* FROM `emprunt` INNER JOIN reservation ON emprunt.Id_rev=reservation.Id_rev INNER JOIN ouvrage on ouvrage.Id_ouv =reservation.Id_ouv WHERE reservation.Id_ad = $IdAd";
        $EmpResult = $cnx->prepare($Emp);
        $EmpResult->execute();

        echo "<div class='cards d-flex  align-items-center justify-content-around flex-wrap'>";

        while ($ligneEmp = $EmpResult->fetch(PDO::FETCH_ASSOC)) {
        echo
        "<div class='row'>
        <div class='col-sm-6 mb-3 mb-sm-0'>
            <div class='card  col-xs-12  col-md-5  col-xl-3 my-5 ' style='width:280px;height:fit-content)'>
                <img style='height: 250px;' src='./img/$ligneEmp[Img_couv]'  alt='$ligneEmp[Img_couv]' class='card-img h- w-100' >
                <div class='card-body'>
                    <h6 class='card-title'>$ligneEmp[Titre]</h6>
                    <h6 class='card-title text-success'>$ligneEmp[Nom_aut]</h6>
                    <h6 class='card-title text-end'>$ligneEmp[Etat]</h6>
                </div>
            </div>
        </div>
    </div>
        ";
        }
    }
    //btn Personnel : form qui contient les infos personnels de l'adherent
    elseif(isset($_POST["personnel"])) {
        echo "<div class='container-fluid'>
        <div class='row d-flex mt-2 justify-content-center'>
        <form method='post' class='border border-2 border-success rounded text-center w-50'>
        <div class='form-group m-2 ms-1'>
            <input type='text' value='$ligneAd[Nom_ad]' name='nom' class='rounded-pill border-1 border-success form-control' id='nom' onkeyup='ValideNom();' >
            <span id='NomVerf' class='text-danger'></span>
        </div>
        <div class='form-group m-2 ms-1 '>
            <input type='Email' value='$ligneAd[Email_ad]' name='email' id='email' class='rounded-pill border-1 border-success form-control' onkeyup='ValideEmail();' >
            <span id='EmailVerf' class='text-danger'></span>
        </div>
        <div class='form-group m-2 ms-1 '>
            <input type='text' value='$ligneAd[Add_ad]' id='add' name='add' class='rounded-pill border-1 border-success form-control' onkeyup='ValideAdd();' >
            <span id='AddVerf' class='text-danger'></span>
        </div>
        <div class='form-group m-2 ms-1 '>
            <input type='tel' value='$ligneAd[Tel_ad]' name='tel' id='tel' class='rounded-pill border-1 border-success form-control' onkeyup='ValideTel();' >
            <span id='TelVerf' class='text-danger'></span>
        </div>
        <div class='form-group m-2 ms-1 '>
            <input type='text' value='$ligneAd[Cin_ad]' name='cin' id='cin' class='rounded-pill border-1 border-success form-control' onkeyup='ValideCin();' >
            <span id='CinVerf' class='text-danger'></span>
        </div>
        <div class='form-group m-2 ms-1 '>
            <input type='text' value='$ligneAd[DateN_ad]' name='datenais' id='datenais' class='rounded-pill border-1 border-success form-control'  onchange='ValideDateN();' onfocus='dateN()' >
            <span id='DateNVerf' class='text-danger'></span>
        </div>
        <div class='form-group m-2 ms-1 '>
            <select name='type' id='type' class='rounded-pill border-1 border-success form-control text-secondary' >
                <option value='Type' selected>$ligneAd[Type_ad]</option>
                <option value='Etudiant'>Etudiant</option>
                <option value='Fonctionnaire'>Fonctionnaire</option>
                <option value='Femme au foyer'>Femme au foyer</option>
            </select>
            <span id='TypeVerf' class='text-danger'></span>
        </div>
        <div class='form-group m-2 ms-1 '>
        <input type='password' placeholder='Nouveau mot de passe' id='pass' name='pass' class='rounded-pill border-1 border-success form-control' onkeyup='ValidePass();'>
        <span id='passVerf' class='text-danger'></span>
    </div>
    <div class='form-group m-2 ms-1 '>
        <input type='password' placeholder='Confirmez mot de passe' name='confpass' id='confpass' class='rounded-pill border-1 border-success form-control' onkeyup='ValideConfPass();'>
        <span id='ConfVerf' class='text-danger'></span>
    </div>
        <div class='form-group m-2 ms-1'>
            <button type='submit' class='btn rounded-pill bg-success text-light' name='mod'>Modifier</button>
        </div>
    </form>
    </div>
    </div>";
    }
    echo "</div>";
    //btn modifier pour modifier les champs souhaitez:
    if (isset($_POST["mod"])) {
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $tel = $_POST["tel"];
        $cin = $_POST["cin"];
        $add = $_POST["add"];
        $daten = $_POST["datenais"];
        $type = $_POST["type"];
        $dateAuj =date("y-m-d");
        $penalite = 0;

        //si on veut changer le mot de passe
            $pass = $_POST["pass"];
            $confpass = $_POST["confpass"];

                if (!empty( $pass && $confpass) && $pass == $confpass) {
                    $passhash = password_hash($pass, PASSWORD_DEFAULT);
                    $modifierP ="UPDATE `adherent` SET `Nom_ad` = '$nom', `Add_ad` = '$add', `Email_ad` = '$email', `Tel_ad` = '$tel', `Cin_ad` = '$cin', `DateN_ad` = '$daten', `Type_ad` = '$type' ,`Password` = '$passhash' WHERE `adherent`.`Id_ad` = $IdAd";
                    $RsultmodifierP = $cnx->prepare($modifierP);
                    $RsultmodifierP->execute();
                    header("Location:./index.php");
                 }else {
                    $modifier ="UPDATE `adherent` SET `Nom_ad` = '$nom', `Add_ad` = '$add', `Email_ad` = '$email', `Tel_ad` = '$tel', `Cin_ad` = '$cin', `DateN_ad` = '$daten', `Type_ad` = '$type' WHERE `adherent`.`Id_ad` = $IdAd";
                    $Rsultmodifier = $cnx->prepare($modifier);
                    $Rsultmodifier->execute();  
                }


                
          
            }

    ?>
    </main>
</body>
</html>
