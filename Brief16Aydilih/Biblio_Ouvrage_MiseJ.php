<?php include("./cnx.php"); 
ob_start();
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
    <title>Mise à jour d'ouvrage</title>
</head>
<body>
<?php include("./Biblio_navbar.php"); 
?>
    <main>
    <div class='cards d-flex  align-items-center justify-content-around flex-wrap'>
            <?php 
                $ouvrage = "SELECT * FROM ouvrage";
                $ouvrageReslt = $cnx->prepare($ouvrage);
                $ouvrageReslt->execute();

                while ($ligneOR = $ouvrageReslt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='row'>
                    <div class='col-sm-6 mb-3 mb-sm-0'>
                        <div class='card  col-xs-12  col-md-5  col-xl-3 my-5 ' style='width:280px;height:fit-content'>
                            <img style='height: 250px;' src='./img/$ligneOR[Img_couv]'  alt='$ligneOR[Img_couv]' class='card-img w-100' >
                            <div class='card-body'>
                                <h6 class='card-title'>$ligneOR[Titre]</h6>
                                <h6 class='card-title text-success'>$ligneOR[Nom_aut]</h6>
                                <h6 class='card-title text-end'>$ligneOR[Etat]</h6>
                                <form method='GET' class='text-center'><a class='btn btn-success rounded-pill' name='modifierO' href='./Biblio_Mod_Ouvrage.php?Id_ouv=$ligneOR[Id_ouv]'> Modifier</a>
                                <button class='btn btn-success rounded-pill' name='SuprimerO' value='$ligneOR[Id_ouv]'> Suprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>";
                }
                // if (isset($_GET["modifierO"])) {
                //     // echo $_POST["modifierO"];
                //     // header("Location:./Biblio_Mod_Ouvrage.php");
                // }
                if (isset($_POST["SuprimerO"])) {
                    $IdsupOuv = $_POST["SuprimerO"];

                    $SupOuv = "DELETE FROM ouvrage WHERE `ouvrage`.`Id_ouv` = $IdsupOuv and `ouvrage`.`Etat` = 'Déchiré'";
                    $SupOuvR = $cnx->query($SupOuv);
                    header("Location:./Biblio_Accueil.php");
                }
                ob_end_flush();
                ?>
            </div>
        </div>
    </main>
</body>
</html>