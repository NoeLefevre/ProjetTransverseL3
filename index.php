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
                <form class = "Searchbox " action = "../PagesPrincipales/AfficherRecherche.php" method = "GET">
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
                    <div class="boutonevenement">
                        <a href="../PagesPrincipales/PageCreationEvenement.php">Créer un evenement</a>
                    </div>
                    <div class="boutongroupe">
                        <a href="../PagesPrincipales/PageCreationGroupe.php">Créer un groupe</a>
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
                            <a title="Accueil" href="PagesPrincipales/Groupe.php">Groupes</a>
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
                    <?php 
                    $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
                    $tendance = $bdd->prepare('SELECT images.LienImage as lien, evenement.NomEvenement as nom, evenement.IdEvenement as id FROM evenement JOIN images ON images.IdEvenement=evenement.IdEvenement ORDER BY NbrClick DESC LIMIT 4');
                    $tendance->execute();
                    $compt=0;
                    foreach ($tendance as $t) {
                        $compt = $compt + 1;
                        ?>
                    <div class = "exemple<?php echo $compt?>">
                    <a href="../PagesPrincipales/PageEvenement.php?id=<?php echo$t['id']?> ">
                        <img id = "minia<?php echo $compt?>" src = "<?php echo $t['lien']?>">
                        </a>
                        <p class="nomevenement"><?php echo $t['nom']?></p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <br>
                <b id = "titre">Interressant pour vous</b>
                <div class="rectangle2"> 
                    <?php 
                    $centreinteret = $bdd->prepare('SELECT ClassementEvenement.IdEvenement as id, ClassementEvenement.NomEvenement,ClassementEvenement.IdPersonne, SUM(ClassementEvenement.NbrClick) as sommeNbrClick from(SELECT evenement.IdEvenement, evenement.NomEvenement, evenement.NbrClick, centreinteret.Nom, possede.IdPersonne from evenement join possedeevenement on evenement.IdEvenement=possedeevenement.IdEvenement join centreinteret on centreinteret.IdInteret=possedeevenement.IdInteret join possede on possede.IdInteret=centreinteret.IdInteret where possede.IdPersonne=46) as ClassementEvenement GROUP BY ClassementEvenement.IdEvenement order by sommeNbrClick DESC LIMIT 4');
                    $centreinteret->execute();
                    $compt=0;
                    foreach ($centreinteret as $c) {
                        $compt = $compt + 1;
                        $centreinteret2 = $bdd->prepare('SELECT images.LienImage as lien, evenement.NomEvenement as nom FROM evenement JOIN images ON images.IdEvenement=evenement.IdEvenement WHERE evenement.IdEvenement=:id');
                        $centreinteret2->execute(array('id' => $c['id']));
                        $c2 = $centreinteret2->fetch();
                        ?>
                    <div class = "exemple<?php echo $compt?>">
                    <a href="../PagesPrincipales/PageEvenement.php?id=<?php echo$c['id']?> ">
                        <img id = "minia<?php echo $compt?>" src = "<?php echo $c2['lien']?>">
                        </a>
                        <p class="nomevenement"><?php echo $c2['nom']?></p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <br>
                <b id = "titre">Recemment consultés</b>
                <div class="rectangle3"> 
                    <?php
                    $historique = $bdd->prepare('SELECT evenement.NomEvenement as nom, images.LienImage as lien from HistoriqueEvenement join evenement on evenement.IdEvenement=HistoriqueEvenement.IdEvenement join images on images.IdEvenement=evenement.IdEvenement WHERE IdPersonne=:idp ORDER BY IdHistoriqueEvenement DESC LIMIT 4');
                    $historique->execute(array('idp' => $_SESSION['id']));
                    $compt=0;
                    foreach ($historique as $h) {
                        $compt = $compt + 1;
                        ?>
                    <div class = "exemple<?php echo $compt?>">
                    <a href="../PagesPrincipales/PageEvenement.php?id=<?php echo$c['id']?> ">
                        <img id = "minia<?php echo $compt?>" src = "<?php echo $h['lien']?>">
                        </a>
                        <p class="nomevenement"><?php echo $h['nom']?></p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
      
    </body>
    <script src = "../Scripts/PagePrincipale.js">


    </script>

</html>