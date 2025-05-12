<?php
session_start();
session_unset();
session_destroy();
header("Location: ../index.php"); // Redirection vers la page d'accueil
exit();
?>

<!--?php
session_start();
session_unset();
session_destroy();
header("Location: ../config/login.php?redirect=veterinaire");
exit();
?> -->

<!--?php
session_start();
session_destroy();
header("Location: ../login.php");
//header("Location: ../index.php"); // Redirection vers la page d'accueil
exit;
?>--> 
