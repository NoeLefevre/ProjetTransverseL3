<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "Styles/PagePrincipale.css"/>
        <meta charset="utf-8" />
    </head>
    <body>
        <div class="Access">
            <header>
                <div class="menu">
                    <img id="Hamburger" src = "../Ressources/Hamburger_icon.png">
                    <img id="Hamburger2" src = "../Ressources/Hamburger_icon.png">
                    <p id="Nomdusite"><strong>Nom Du Site</strong></p>
                </div>
                <form class = "Searchbox " action = "../PagesPrincipales/AfficherRecherche.php" method = "post">
                    <input id = "searchbar" type = "search" name = "terme" placeholder ="Rechercher">
                    <img id ="loupe" src = "../Ressources/loupe_icone.png">
                </form>
                <div class="hautdroit">
                    <img id="notification" src = "../Ressources/notification_icone.png">
                    <img id="notification2" src = "../Ressources/notification_icone.png">
                    <img id ="profil" src="../Ressources/profile_icone.png">
                    <img id ="profil2" src="../Ressources/profile_icone.png">
                </div>
            </header>
            <nav id="menu_dynamique">
                <div class="nav">

                    <div id="Accueil">
                        <img id="accueil" src="Ressources/accueil_icone.png">
                        <a href ="index.php"><p class="liste">Accueil</p></a>
                    </div>
                    <div id="Amis">
                        <img id="amis" src="Ressources/amis_icone.png">
                        <a href ="PagesPrincipales/Ami.php"><p class="liste">Amis</p></a>
                    </div>
                    <div id="Evenements">
                        <img id="evenements" src="Ressources/evenements_icone.png">
                        <a href ="PagesPrincipales/AfficherEvenements.php"><p class="liste">Vos Evenements</p>
                    </div>
                </div>
            </nav>
            <div id="profil_dynamique">
                <ul class="menu2">
                <?php

                    if (!isset($_SESSION['log']))
                    {
                        ?>

                        <li>
                            <a title="Accueil" href="../PagesPrincipales/PageConnexion.php">Se Connecter</a>
                        </li>
                        <li>
                            <a title="Accueil" href="../PagesPrincipales/PageInscription.php">S'inscrire</a>
                        </li>
                        <?php
                    }
                    else{
                        ?>
                        <li>
                            <a title="Accueil" href="#">Message privé</a>
                        </li>
                        <li>
                            <a title="Accueil" href="PagesPrincipales/profil.php?id=<?php echo $_SESSION['id']?>">Modifier</a>
                        </li>
                        <li>
                            <a title="Accueil" href="../PagesTraitement/TraitementDeconnexion.php#">Se Deconnecter</a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div id="notification_dynamique">
                <ul class="menu2">
                     <?php 
                     if (isset($_SESSION['log']))
                     {
                    
                        
                        $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
                        $reponse = $bdd->prepare('SELECT a.IdRelation as id, p.Nom as nom, p.Prenom as prenom FROM notifications as n JOIN ami AS a ON a.IdRelation=n.IdRelation JOIN Personne as p ON a.Personne1=p.IdPersonne WHERE n.IdPersonne=:id1 AND a.Personne2=:id2'); 
                        $reponse->execute(array(
                            'id1' => $_SESSION['id'],
                            'id2' => $_SESSION['id'],
                        ));
                        $compt=0;
                        foreach ($reponse as $r) {
                            $compt = $compt + 1;
                        ?>
                    <li><?php echo $r['nom'],' ', $r['prenom'], ' ' ?><a href="../PagesTraitement/AccepteDemandeAmi.php?action=valide&id=<?php echo $r['id']?>"><img src="../Ressources/boutonaccepter.jpg" width="20px" height="20px" alt="d"></a><a href="../PagesTraitement/AccepteDemandeAmi.php?action=refuser&id=<?php echo $r['id']?>"><img src="../Ressources/refuser.jpg" width="20px" height="20px" alt="d"></a></li>

                    <?php 
                        }
                        if ($compt==0)
                        {
                            ?>
                            <li>Aucunes notifications</li>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <li>Veuillez vus connecter</li>
                        <?php
                    }

                ?>
                <ul class="menu2">
            </div>
        </div>
            <div class = "Barre_contenu">
                <br><br><br><br><br><br>
                <b class = "titre1">Tendances</b>
                <div class="rectangle"> 
                    <div class = "exemple1">
                        <img id = "minia1" src = "../Ressources/Exemple_img2.jpg">
                        <p>Tu es Délu</p>
                    </div>
                    <div class = "exemple2">
                        <img id = "minia2" src = "../Ressources/Exemple_img2.jpg">
                        <p>Description d'évènement 2</p>
                        
                    </div>
                    <div class = "exemple3">
                        <img id = "minia3" src = "../Ressources/Exemple_img3.jpg">
                        <p>Ouais c'est cool la vie</p>
                    </div>
                    <div class = "exemple4">
                        <img id = "minia4" src = "../Ressources/Exemple_img2.jpg">
                        <p>Ceci est un placeholder</p>
                    </div>
                </div>
                <br>
                <b id = "titre">Interressant pour utilisateur</b>
                <div class="rectangle2"> 
                    <div class = "exemple1">
                        <img id = "minia1" src = "../Ressources/Exemple_img2.jpg">
                        <p>Tu es Délu</p>
                    </div>
                    <div class = "exemple2">
                        <img id = "minia2" src = "../Ressources/Exemple_img2.jpg">
                        <p>Description d'évènement 2</p>
                    </div>
                    <div class = "exemple3">
                        <img id = "minia3" src = "../Ressources/Exemple_img3.jpg">
                        <p>Ouais c'est cool la vie</p>
                    </div>
                    <div class = "exemple4">
                        <img id = "minia4" src = "../Ressources/Exemple_img2.jpg">
                        <p>Ceci est un placeholder</p>
                    </div>
                </div>
                <br>
                <b id = "titre">Recemment consulté</b>
                <div class="rectangle3"> 
                    <div class = "exemple1">
                        <img id = "minia1" src = "../Ressources/Exemple_img2.jpg">
                        <p>Tu es Délu</p>
                    </div>
                    <div class = "exemple2">
                        <img id = "minia2" src = "../Ressources/Exemple_img2.jpg">
                        <p>Description d'évènement 2</p>
                    </div>
                    <div class = "exemple3">
                        <img id = "minia3" src = "../Ressources/Exemple_img3.jpg">
                        <p>Ouais c'est cool la vie</p>
                    </div>
                    <div class = "exemple4">
                        <img id = "minia4" src = "../Ressources/Exemple_img2.jpg">
                        <p>Ceci est un placeholder</p>
                    </div>
                </div>
            </div>
        </div>
      
    </body>
    <script src = "../Scripts/PagePrincipale.js">


    </script>

</html>
