<?php include("./cnx.php"); 
if (isset($_POST["ajouter"])) {
    $titre = $_POST["Titre"];
    $NomAut = $_POST["NomAut"];
    $Type = $_POST["type"];
    $etat = $_POST["etat"];
    $dateEd = $_POST["dateEd"];
    $dateA = $_POST["dateA"];
    $nbrP = $_POST["nbrP"];

    //image
    $img = $_FILES["image"]["name"];
    $fileExtension = explode('.', $img);     
    $fileExtension = end($fileExtension);     
    $allowedExtensions = array('jpg', 'png', 'jpeg','jfif');
    $img = uniqid('', true). ".$fileExtension"; 
    $tempname = $_FILES['image']['tmp_name'];
    $folder = "./img/" . $img;
    move_uploaded_file($tempname, $folder);

    $Ouvrage ="INSERT INTO `ouvrage` (`Titre`, `Nom_aut`, `Img_couv`, `Etat`, `Type_ouv`, `Date_adit`, `Date_ach`, `Nbr_page`) VALUES ('$titre', '$NomAut', '$img', '$etat', '$Type', '$dateEd', '$dateA', '$nbrP')";
    $RsultOuvrage = $cnx->prepare($Ouvrage);
    $RsultOuvrage->execute();
    echo "l'ajout est fait avec succés";
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
     <script defer src="./Biblio_js.js"></script>
    <title>Ajouter un ouvrage</title>
</head>
<body>
    <header>
    <?php include("./Biblio_navbar.php") ?>
    </header>
    <main>
    <div class='container-fluid'>
        <div class='row d-flex mt-2 justify-content-center'>
                    <form method='POST' enctype='multipart/form-data' class='border border-2 rounded border-success w-50'>
                        <div class='form-group mt-1 ms-1'>
                            <input type="text" placeholder="Titre" name="Titre" class="rounded-pill border-1 border-success form-control" id="ntitre" onkeyup="ValideTitre();" required>
                            <span id="titreVerf" class="ms-3 text-danger"></span>
                        </div>
                        <div class='form-group mt-1 ms-1 '>
                            <input type="text" placeholder="Nom auteur" name="NomAut" class="rounded-pill border-1 border-success form-control" onkeyup="ValideAut();" required>
                            <span id="nomautverif" class="ms-3 text-danger"></span>
                        </div>
                        <div class='form-group mt-1 ms-1 '>
                            <select name="type" id="type" class="rounded-pill border-1 border-success form-control text-secondary" required>
                                <option value="Type" selected>Type</option>
                                <option value="Livre">Livre</option>
                                <option value="Roman">Roman</option>
                                <option value="DVD">DVD</option>
                                <option value="Mémoire de recherche">Mémoire de recherche</option>
                                <option value="Magazine">Magazine</option>
                            </select>
                            <span id="typeverif" class="ms-3 text-danger"></span>
                        </div>
                        <div class='form-group mt-1 ms-1 '>
                            <select name="etat" id="etat" class="rounded-pill border-1 border-success form-control text-secondary" required>
                                <option value="Etat" selected>Etat</option>
                                <option value="Neuf">Neuf</option>
                                <option value="Bon état">Bon état</option>
                                <option value="Acceptable">Acceptable</option>
                                <option value="Assez usé">Assez usé</option>
                                <option value="Déchiré">Déchiré</option>
                                
                            </select>
                            <span id="etatverif" class="ms-3 text-danger"></span>
                        </div>
                        <div class='form-group mt-1 ms-1 '>
                            <input type="text" placeholder="Date édition" name="dateEd" id="dateEd" class="rounded-pill border-1 border-success form-control" onchange="ValideDateEd();" onfocus="dateDateAd()" required>
                            <span id="dateVerf" class="ms-3 text-danger"></span>
                        </div>
                        <div class='form-group mt-1 ms-1 '>
                            <input type="text" placeholder="Date d'achat" name="dateA" id="dateA" class="rounded-pill border-1 border-success form-control"  onchange="ValideDateAch();" onfocus="dateDateA()" required>
                            <span id="DateAchVerf" class="ms-3 text-danger"></span>
                        </div>
                        <div class='form-group mt-1 ms-1 '>
                            <input type="nombre" placeholder="Nombre de pages" name="nbrP" id="nbrP" class="rounded-pill border-1 border-success form-control"  onkeyup="ValidenbrP();" required>
                            <span id="nbrPVerf" class="ms-3 text-danger"></span>
                        </div>
                        <div class='form-group mt-1 ms-1 '>
                            <input type="file" id="image" name="image" class="rounded-pill border-1 border-success form-control" required>
                            <span id="imgCVerf" class="ms-3 text-danger"></span>
                        </div>
                        <div class='form-group mt-1 ms-1 text-center'>
                            <button type='submit' class='btn rounded-pill border-1 bg-success text-light' name="ajouter">Ajouter</button>
                        </div>
                    </form>
        </div>
    </div> 
    </main>
</body>
</html>