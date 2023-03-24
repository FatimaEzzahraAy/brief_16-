<?php 
session_start();
session_destroy();
header('location:./Biblio_connecter.php')
?>