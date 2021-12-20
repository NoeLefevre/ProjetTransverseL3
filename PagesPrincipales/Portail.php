<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Formulaire inscription</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href = "../Styles/portail.css"/>
    </head>
    <body>
    <?php

    if (isset($_SESSION['log']))
    {
        header('Location: ../PagesPrincipales/PagePrincipale.php');
        exit();
    }
?>
    <p class="titre"> Portail Réseau Evenemenementiel </p>
    <div class="block">
        <div class="inscription">
            <a href="../PagesPrincipales/PageInscription.php"><img src="../Ressources/inscrire.png"  width="280px" height= "50px" alt="d">
        </div>
        <div class="connexion">
            <a href="../PagesPrincipales/PageConnexion.php"><img src="../Ressources/connecte.jpg"  width="280px" height= "50px" alt="d">
        </div>
    </div>




    </body>

</html>
