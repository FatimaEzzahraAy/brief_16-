<?php include("./cnx.php"); 
session_start();

$PassVerf ="";
$surnomVerf = "";
if (isset($_POST["connecter"])) {
    $surnom = $_POST["surnom"];
    $password = $_POST["pass"];

        $Rsurnom = "SELECT * FROM Adherent WHERE  Surnom_ad = '$surnom'";
        $RPassword = "SELECT * FROM Adherent WHERE Password = '$password' and Surnom_ad = '$surnom'";

        $RsultAdherentS = $cnx->prepare($Rsurnom);
        $RsultAdherentS->execute();

        $RsultAdherentP = $cnx->prepare($RPassword);
        $RsultAdherentP->execute();

        $ligneS = $RsultAdherentS->fetch(PDO::FETCH_ASSOC);
        $ligneP = $RsultAdherentP->fetch(PDO::FETCH_ASSOC);

    if (empty($surnom)) {
        $surnomVerf = "Veuillez saisir votre surnom";
    }elseif (empty($password)) {
        $PassVerf = "Veuillez saisir votre mot de passe";
    }elseif (!$ligneS) {
            $surnomVerf = "le surnom saisi est un incorrect";
        }elseif (!$ligneP && !password_verify($password, $ligneS["Password"])) {
            $PassVerf = "Mot de passe saisi est un incorrect";
        }else{
            $_SESSION["nikeN"]= $surnom;
            $_SESSION["IdAd"]= $ligneS["Id_ad"];
            header("Location:./Adherent_Accueil.php");     
        }  
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

    <title>Adhérent</title>
</head>
<body >
<main >
    <div class='container-fluid'>
        <div class='row d-flex mt-5 justify-content-center'>
            <h3 class="text-center text-success">Connecter</h3>
<form method='post' class='border border-2 border-success rounded w-50 bg-light'>
                       
                       <div class='form-group m-2  mt-5'>
                               <input type='text' placeholder='Surnom' name='surnom' class='rounded-pill border-1 border-success form-control'>
                               <?php echo "<span class='ms-3 text-danger'>". $surnomVerf; echo "</span>" ?>
                            </div>
                           <div class='form-group m-2  mt-3'>
                               <input type='password' placeholder='Mot de passe' name='pass' class='rounded-pill border-1 border-success form-control'>
                               <?php echo "<span class='ms-3 text-danger'>". $PassVerf; echo "</span>" ?>
                            </div>
                           <div class='form-group m-2 mb-4 text-center '>
                               <button type='submit' class='btn rounded-pill btn-success text-light me-2' name="connecter">connecter</button>
                               <a href='./Adherent__Sinscrire.php'>S'inscrire</a>
                           </div>
           </form>
</div>
</div>
</main>
</body>
</html>