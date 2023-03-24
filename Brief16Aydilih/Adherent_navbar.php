<?php include("./cnx.php");
session_start();
if (isset($_SESSION["nikeN"])) {
$nikeN = $_SESSION["nikeN"];
}else {
  header("location:./index.php");
}
?>
<nav class="navbar navbar-expand-md navbar-light" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img  class="ms-1" src="./img/logo_ouvrage.png" ></a>
    <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./Adherent_Accueil.php"
                  >Accueil</a
                >
              </li>
            </ul>
            <?php echo "<span class='rounded-pill me-2 ps-2 pe-2'
              >Bonjour $nikeN"?>
             <?php echo "</span>"?>
            <a class="navbar-brand" href="./Adherent_Profil.php"
              >Profil</a>
            <a class="navbar-brand" href="./Adherent_deconnecter.php"
              >Déconnectez</a>
          </div>
        </div>
      </nav>
      