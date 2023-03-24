<?php include("./cnx.php"); 
session_start();
    if (isset($_POST["valider"])) {
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $tel = $_POST["tel"];
        $cin = $_POST["cin"];
        $add = $_POST["add"];
        $daten = $_POST["datenais"];
        $type = $_POST["type"];
        $surnom = $_POST["surnom"];
        $pass = $_POST["pass"];
        $confpass = $_POST["confpass"];
        $dateAuj =date("y-m-d");
        $penalite = 0;

        $passCrypte = password_hash($pass, PASSWORD_DEFAULT);

        $Adherent ="INSERT INTO `adherent` (`Nom_ad`, `Add_ad`, `Email_ad`, `Tel_ad`, `Cin_ad`, `DateN_ad`, `Type_ad`, `Surnom_ad`, `Password`, `DateO_cpt_ad`, `Penalite_ad`) VALUES ('$nom', '$add', '$email', '$tel', '$cin', '$daten', '$type', '$surnom', '$passCrypte', '$dateAuj', '$penalite')";
        $RsultAdherent = $cnx->prepare($Adherent);
        $RsultAdherent->execute();
        $_SESSION["nikeN"] = $surnom;
        header("location:./index.php"); 
    }
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
    <title>Inscription</title>
</head>
<body>
    <div class='container-fluid'>
        <div class='row d-flex mt-2 justify-content-center'>
                    <form method="post" class='border border-2  border-success rounded text-start w-auto'>
                        <div class='form-group m-2 ms-1'>
                            <input type="text" placeholder="Nom et prénom" name="nom" class= " border-success rounded-pill border-1 form-control" id="nom" onkeyup="ValideNom();" required>
                            <span id="NomVerf" class="text-danger"></span>
                        </div>
                        <div class='form-group m-2 ms-1 '>
                            <input type="Email" placeholder="Exemple@email.com" name="email" id="email" class= " border-success rounded-pill border-1 form-control" onkeyup="ValideEmail();" required>
                            <span id="EmailVerf" class="text-danger"></span>
                        </div>
                        <div class='form-group m-2 ms-1 '>
                            <input type="text" placeholder="Addresse" id="add" name="add" class= " border-success rounded-pill border-1 form-control" onkeyup="ValideAdd();" required>
                            <span id="AddVerf" class="text-danger"></span>
                        </div>
                        <div class='form-group m-2 ms-1 '>
                            <input type="tel" placeholder="Telephone" name="tel" id="tel" class= " border-success rounded-pill border-1 form-control" onkeyup="ValideTel();" required>
                            <span id="TelVerf" class="text-danger"></span>
                        </div>
                        <div class='form-group m-2 ms-1 '>
                            <input type="text" placeholder="CIN" name="cin" id="cin" class= " border-success rounded-pill border-1 form-control" onkeyup="ValideCin();" required>
                            <span id="CinVerf" class="text-danger"></span>
                        </div>
                        <div class='form-group m-2 ms-1 '>
                            <input type="text" placeholder="Date de naissance" name="datenais" id="datenais" class= " border-success rounded-pill border-1 form-control"  onchange="ValideDateN();" onfocus="dateN()" required>
                            <span id="DateNVerf" class="text-danger"></span>
                        </div>
                        <div class='form-group m-2 ms-1 '>
                            <select name="type" id="type" class= " border-success rounded-pill border-1 form-control text-secondary" required>
                                <option value="Type" selected>Type</option>
                                <option value="Etudiant">Etudiant</option>
                                <option value="Fonctionnaire">Fonctionnaire</option>
                                <option value="Femme au foyer">Femme au foyer</option>
                            </select>
                            <span id="TypeVerf" class="text-danger"></span>
                        </div>
                        <div class='form-group m-2 ms-1 '>
                            <input type="text" placeholder="Surnom" name="surnom" id="surnom" class= " border-success rounded-pill border-1 form-control" onkeyup="ValideSurnom();" required>
                            <span id="SurnomVerf" class="text-danger"></span>
                        </div>
                        <div class='form-group m-2 ms-1 '>
                            <input type="password" placeholder="Mot de passe" id="pass" name="pass" class= " border-success rounded-pill border-1 form-control" onkeyup="ValidePass();" required>
                            <span id="passVerf" class="text-danger"></span>
                        </div>
                        <div class='form-group m-2 ms-1 '>
                            <input type="password" placeholder="Confirmez mot de passe" name="confpass" id="confpass" class= " border-success rounded-pill border-1 form-control" onkeyup="ValideConfPass();" required>
                            <span id="ConfVerf" class="text-danger"></span>
                        </div>
                        <div class='form-group m-2 ms-1 '>
                            <input type="checkbox" required>
                            <a id="reglement" href="#">J'accepte les conditions</a>
                        </div>
                        <div class='form-group m-2 ms-1 '>
                            <button type='submit' class='btn bg-success rounded-pill border-1 text-light me-2' name="valider">S'inscrire</button>
                            <a href='./index.php'>Vous êtes déjà membre?</a>
                        </div>
                    </form>
        </div>
    </div>  

</body>
</html>