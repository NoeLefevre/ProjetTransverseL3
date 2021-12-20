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
    <?php

?>
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
                    <a title="Accueil" href="#">Modifier</a>
                </li>
            </ul>
        </div>
        <p> Liste profil :</p>
        <?php 
             $bdd = new PDO('mysql:host=localhost;dbname=projetevenement; charset=utf8;port=3307', 'root', '');

            $reponse = $bdd->query('SELECT* FROM personne'); 
            $donnee =$reponse->fetchALL();
            foreach ($donnee as $d) {
                if($d['IdPersonne']!=$_SESSION['id']){
                ?>
                    <p><?php echo $d['Nom'],' ', $d['Prenom'], ' ' ?><a href="AffichageProfil.php?nom=<?php echo $d['Nom'] ?>&prenom=<?php echo($d['Prenom'])  ?>&id=<?php echo($d['IdPersonne'])  ?> "><img src="../Ressources/boutonaccepter.jpg" width="20px" height="20px" alt="d"></a>
                </p>
                <?php
                }
            }   
        ?> 
        <p> Demande d'amis : </p>
        <?php 
        $reponse = $bdd->prepare('SELECT p.Nom as nom, p.Prenom as prenom, a.IdRelation as id FROM ami as a JOIN personne AS p ON a.Personne1=p.IdPersonne  WHERE Personne2=? AND Accepte=\'non\''); 
        $reponse->execute(array($_SESSION['id']));
        $donnee =$reponse->fetchALL();
        foreach ($donnee as $d) {
            ?>
                <p><?php echo $d['nom'],' ', $d['prenom']?><a href="../PagesTraitement/AccepteDemandeAmi.php?action=valide&id=<?php echo $d['id']?>"><img src="../Ressources/boutonaccepter.jpg" width="20px" height="20px" alt="d"></a><a href="../PagesTraitement/AccepteDemandeAmi.php?action=refuser&id=<?php echo $d['id']?>"><img src="../Ressources/refuser.jpg" width="20px" height="20px" alt="d"></a>
            </p>
            <?php
            }
        ?> 
         <p> Liste amis : </p>
         <?php 
            $reponse = $bdd->prepare('SELECT p.Nom as nom, p.Prenom as prenom FROM ami as a JOIN personne AS p ON a.Personne1=p.IdPersonne  WHERE Personne2=? AND Accepte=\'oui\''); 
            $reponse->execute(array($_SESSION['id']));
            foreach ($reponse as $r) {
                ?>
                    <p><?php echo $r['nom'],' ', $r['prenom']?>
                </p>
                <?php
                }
            $reponse = $bdd->prepare('SELECT p.Nom as nom, p.Prenom as prenom FROM ami as a JOIN personne AS p ON a.Personne2=p.IdPersonne  WHERE Personne1=? AND Accepte=\'oui\''); 
            $reponse->execute(array($_SESSION['id']));
            foreach ($reponse as $r) {
                ?>
                    <p><?php echo $r['nom'],' ', $r['prenom']?>
                    </p>
                    <?php
                    }
        ?>
    </body>
    <script src = "../Scripts/PagePrincipale.js">


    </script>

</html>