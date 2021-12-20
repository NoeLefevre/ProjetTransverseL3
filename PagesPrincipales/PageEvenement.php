<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../Styles/PageEvenement.css"/>
        <meta charset="utf-8" />
    </head>
    <body>
        <header>
            <div class="menu">
                <img id="Hamburger" src = "../Ressources/Hamburger_icon.png">
                <img id="Hamburger2" src = "../Ressources/Hamburger_icon.png">
                <p id="Nomdusite"><strong>Nom Du Site</strong></p>
            </div>
            <form class = "Searchbox " action = "" method = "get">
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
        <div class="corpus">
            <nav id="menu_dynamique">
                <div class="nav">

                    <div id="Accueil">
                        <img id="accueil" src="../Ressources/accueil_icone.png">
                        <a href ="../PagesPrincipales/PagePrincipale"><p class="liste">Accueil</p></a>
                    </div>
                    <div id="Amis">
                        <img id="amis" src="../Ressources/amis_icone.png">
                        <a href ="../PagesPrincipales/Ami"><p class="liste">Amis</p></a>
                    </div>
                    <div id="Evenements">
                        <img id="evenements" src="../Ressources/evenements_icone.png">
                        <p class="liste">Vos Evenements</p>
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
                            <a title="Accueil" href="../PagesPrincipales/PageConnexion">Se Connecter</a>
                        </li>
                        <li>
                            <a title="Accueil" href="../PagesPrincipales/PageInscription">S'inscrire</a>
                        </li>
                        <?php
                    }
                    else{
                        ?>
                        <li>
                            <a title="Accueil" href="#">Message privé</a>
                        </li>
                        <li>
                            <a title="Accueil" href="#">Modifier</a>
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
            <div class="contenu">
                <?php
                    $bdd = new PDO('mysql:host=localhost;dbname=projetevenement; charset=utf8;port=3307', 'root', '');
                    $req = $bdd->prepare('SELECT images.LienImage as im, evenement.information as info, evenement.NomEvenement as nom, evenement.IdEvenement as id  FROM images JOIN evenement ON images.IdEvenement=evenement.IdEvenement WHERE evenement.IdEvenement=:idevenement');
                    $req->execute(array('idevenement' => $_GET['id'],
                                    ));
                    $contenu = $req->fetch();
                ?>
               <div class = "font">
                    <img id = "minia1" src = "<?php echo $contenu['im'] ?>" alt="Ceci est un placeholder">
                    <div class = "notes">
                        <p>Notes de l'évènement</p>
                        <div class = "box_étoiles">
                            <img class = "étoile" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "étoile" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "étoile" src = "../Ressources/note.png" alt = "étoile note">
                        </div>
                    </div>
                </div>
                <div class = "Description">
                    <h1 class = "Titre"><?php echo $contenu['nom'] ?></h1>
                    <p>Lieu de l'évènement</p>
                    <p><?php echo $contenu['info'] ?></p>
                </div>
            </div>
        
    </body>
    <script src = "../Scripts/AfficherEvenements.js">


    </script>

</html>