<?php include("./cnx.php");
 if (isset($_GET["modifierO"])) {
    echo $_GET["modifierO"];
}
// $ouvrage = "SELECT * FROM ouvrage";
// $ouvrageReslt = $cnx->prepare($ouvrage);
// $ouvrageReslt->execute();
// if (isset($_POST["modifierO"])) {
   
    // $idmodouv = $_POST["modifierO"];
    // $divMod = "
    // <form method='post' class='border border-2 rounded border-success w-50'>
    //     <div class='form-group mt-1 ms-1'>
    //         <input type='text' value='Titre' name='Titre' class='rounded-pill border-1 border-success form-control' id='ntitre' onkeyup='ValideTitre();' required>
    //         <span id='titreVerf' class='ms-3 text-danger'></span>
    //     </div>
    //     <div class='form-group mt-1 ms-1 '>
    //         <input type='text' value='Nom auteur' name='NomAut' class='rounded-pill border-1 border-success form-control' onkeyup='ValideAut();' required>
    //         <span id='nomautverif' class='ms-3 text-danger'></span>
    //     </div>
    //     <div class='form-group mt-1 ms-1 '>
    //         <select name='type' id='type' class='rounded-pill border-1 border-success form-control text-secondary' required>
    //             <option value='Type' selected>Type</option>
    //             <option value='Livre'>Livre</option>
    //             <option value='Roman'>Roman</option>
    //             <option value='DVD'>DVD</option>
    //             <option value='Mémoire de recherche'>Mémoire de recherche</option>
    //             <option value='Magazine'>Magazine</option>
    //         </select>
    //         <span id='typeverif' class='ms-3 text-danger'></span>
    //     </div>
    //     <div class='form-group mt-1 ms-1 '>
    //         <select name='etat' id='etat' class='rounded-pill border-1 border-success form-control text-secondary' required>
    //             <option value='Etat' selected>Etat</option>
    //             <option value='Neuf'>Neuf</option>
    //             <option value='Bon état'>Bon état</option>
    //             <option value='Acceptable'>Acceptable</option>
    //             <option value='Assez usé'>Assez usé</option>
    //             <option value='Déchiré'>Déchiré</option>
    //             <option value='Magazine'>Magazine</option>
    //         </select>
    //         <span id='etatverif' class='ms-3 text-danger'></span>
    //     </div>
    //     <div class='form-group mt-1 ms-1 '>
    //         <input type='text' value='Date édition' name='dateEd' id='dateEd' class='rounded-pill border-1 border-success form-control' onchange='ValideDateEd();' onfocus='dateDateAd()' required>
    //         <span id='dateVerf' class='ms-3 text-danger'></span>
    //     </div>
    //     <div class='form-group mt-1 ms-1 '>
    //         <input type='text' value='Date d'achat' name='dateA' id='dateA' class='rounded-pill border-1 border-success form-control'  onchange='ValideDateAch();' onfocus='dateDateA()' required>
    //         <span id='DateAchVerf' class='ms-3 text-danger'></span>
    //     </div>
    //     <div class='form-group mt-1 ms-1 '>
    //         <input type='nombre' value='Nombre de pages' name='nbrP' id='nbrP' class='rounded-pill border-1 border-success form-control'  onkeyup='ValidenbrP();' required>
    //         <span id='nbrPVerf' class='ms-3 text-danger'></span>
    //     </div>
    //     <div class='form-group mt-1 ms-1 '>
    //         <input type='file' accept='.jpg, .jpeg, .png, .jfif' name='imgC' id='imgC' class='rounded-pill border-1 border-success form-control' required>
    //         <span id='imgCVerf' class='ms-3 text-danger'></span>
    //     </div>
    //     <div class='form-group mt-1 ms-1 text-center'>
    //         <button type='submit' class='btn rounded-pill border-1 bg-success text-light' name='modO'>Modier</button>
    //     </div>
    // </form>";
?>
