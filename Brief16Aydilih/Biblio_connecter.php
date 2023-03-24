<?php include("./cnx.php"); 
session_start();
$PassVerf ="";
$loginVerf = "";
if (isset($_POST["connecter"])) {
    $login = $_POST["login"];
    $password = $_POST["pass"];

        $Rlogin = "SELECT * FROM bibliothécaire WHERE  Login = '$login'";
        $RPassword = "SELECT * FROM bibliothécaire WHERE Password_Biblio = '$password' and Login = '$login'";

        $RsultbiblioL = $cnx->prepare($Rlogin);
        $RsultbiblioL->execute();

        $RsultbiblioP = $cnx->prepare($RPassword);
        $RsultbiblioP->execute();

        $ligneL = $RsultbiblioL->fetch(PDO::FETCH_ASSOC);
        $ligneP = $RsultbiblioP->fetch(PDO::FETCH_ASSOC);

    if (empty($login)) {
        $loginVerf = "Veuillez saisir votre login";
    }elseif (empty($password)) {
        $PassVerf = "Veuillez saisir votre mot de passe";
    }elseif (!$ligneL) {
            $loginVerf = "le login saisi est un incorrect";
        }elseif (!$ligneP && !password_verify($password, $ligneL["Password_biblio"])) {
            $PassVerf = "Mot de passe saisi est un incorrect";
        }else{
            $_SESSION["Id"]= $ligneL["Id_biblio"];
            header("Location:./Biblio_Accueil.php");     
        }  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Bibliothécaire</title>
</head>
<body>
    <div class='container-fluid'>
        <div class='row d-flex mt-5 justify-content-center'>
        <h3 class="text-center text-success">Connecter</h3>
            <form method='post' class='border border-2 rounded border-success w-50'>
                       <div class='form-group mt-4 ms-1 '>
                               <input type='text' placeholder='Login' name='login' class='rounded-pill border-1 border-success form-control'>
                               <?php echo "<span class='ms-3 text-danger'>". $loginVerf; echo "</span>" ?>
                           </div>
                           <div class='form-group mt-2 ms-1 '>
                               <input type='password' placeholder='Mot de passe' name='pass' class='rounded-pill border-1 border-success form-control'>
                               <?php echo "<span class='ms-3 text-danger'>". $PassVerf; echo "</span>" ?>
                           </div>
                           <div class='form-group mt-2 mb-2 ms-1 text-center'>
                               <button type='submit' class='btn rounded-pill border-1 bg-success text-light'  name="connecter">connecter</button>
                           </div>
           </form>
</div>

</div>
</body>
</html>