<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../Styles/PagePrincipale.css"/>
        <meta charset="utf-8" />
    </head>
    <body>


        <header>
            <form class="Searchbox">
                <div class="wrapper">
                    <label for="text"></label>
                    <input type="text" id="text">
                    <input type = "submit" name = "s" value = "">
                </div>
            </form>
            <div class ="Bandeau">
                
            </div>
        </header>
        <div class="bouton-menu-deroulant">
            <img src = "../Ressources/Hamburger_icon.png">
        </div>
        <div class="bouton-menu-deroulant2">
            <img src = "../Ressources/Hamburger_icon.png">
        </div>
        <div class="bouton-profil-deroulant">
            <img src = "../Ressources/avatar.jpg">
        </div>
        <div class="bouton-profil-deroulant2">
            <img src = "../Ressources/avatar.jpg">
        </div>
        <nav>
            <div id="menu_dynamique">
                <ul id="menu-navigation-principale" class="menu">
                    <li id="menu-item-2800" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2800">
                        <a title="Accueil" href="#">Accueil</a>
                    </li>
                    <li id="menu-item-2800" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2800">
                        <a title="Accueil" href="#">Ami</a>
                    </li>
                    <li id="menu-item-2800" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2800">
                        <a title="Accueil" href="#">Groupe</a>
                    </li>
                    <li id="menu-item-2800" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-2800">
                        <a title="Accueil" href="#">Page Personnelle</a>
                    </li>
                </ul>
        </nav>
        <div id="profil_dynamique">
            <ul class="menu">
                <li>
                    <a title="Accueil" href="#">Message privé</a>
                </li>
                <li>
                            <a title="Accueil" href="Groupe.php">Groupes</a>
                        </li>
                <li>
                    <a title="Accueil" href="#">Modifier</a>
                </li>
            </ul>
        </div>
        <?php 
            echo$_GET['nom'],' ',$_GET['prenom'];
        ?>
        <p>
            Envoyer demande d'ami <a href="../PagesTraitement/TraitementDemandeAmi.php?id=<?php echo ($_GET['id']) ?>"> <img src="../Ressources/demande_ami.png" width="80px" height="40px" alt="d"></a>
        </p>
    </body>
    <script src = "../Scripts/PagePrincipale.js">


    </script>

</html>