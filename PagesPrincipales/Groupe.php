<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../Styles/groupe.css"/>
        <meta charset="utf-8" />
    </head>
    <body>
<?php  $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');?>
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
        <div class="corpus">
            <nav id="menu_dynamique">
                <div class="nav">

                    <div id="Accueil">
                        <img id="accueil" src="../Ressources/accueil_icone.png">
                        <a href ="../index.php"><p class="liste">Accueil</p></a>
                    </div>
                    <div id="Amis">
                        <img id="amis" src="../Ressources/amis_icone.png">
                        <a href ="../PagesPrincipales/Ami"><p class="liste">Amis</p></a>
                    </div>
                    <div id="Evenements">
                        <img id="evenements" src="../Ressources/evenements_icone.png">
                        <a href ="../PagesPrincipales/AfficherEvenements.php"><p class="liste">Vos Evenements</p>
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
                            <a title="Accueil" href="../PagesPrincipales/profil.php?id=<?php echo $_SESSION['id']?>">Modifier</a>
                        </li>
                        <li>
                            <a title="Accueil" href="Groupe.php">Groupes</a>
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
            <div class="tout">
                <?php
                try
                {
                    $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
                }
                catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
                $req = $bdd->prepare('SELECT imagegroupe.LienImage as im,groupe.Nom as nom, groupe.IdGroupe as id FROM imagegroupe JOIN groupe ON imagegroupe.IdGroupe=groupe.IdGroupe WHERE groupe.Leader=:idpersonne');
                $req->execute(array('idpersonne' => $_SESSION['id'],
                                                ));
                $req2 = $bdd->prepare('SELECT imagegroupe.LienImage as im,groupe.Nom as nom, groupe.IdGroupe as id FROM imagegroupe JOIN groupe ON imagegroupe.IdGroupe=groupe.IdGroupe JOIN appartient ON appartient.IdGroupe=groupe.IdGroupe WHERE appartient.IdPersonne=:idpersonne');
                $req2->execute(array('idpersonne' => $_SESSION['id'],
                                                ));
                ?>
                <h2 class="Groupe"> Groupes créés</h2>
                <div class="block">
                    <?php                            
                    foreach ($req as $r) 
                    {
                    ?>
                        <a href ="AfficherGroupe.php?id=<?php echo $r['id']?>"><div><img id="image" src="<?php echo $r['im']?>" alt=""> <p><?php echo $r['nom']?></p></div></a>
                    <?php
                    }   
                    ?>    
                    <hr/>                           
                </div>
                <h2 class="Groupe"> Groupes auxquels vous appartenez</h2>
                <div class="block">
                    <?php                            
                    foreach ($req2 as $r2) 
                    {   
                    ?>
                    <a href ="AfficherGroupe.php?id=<?php echo $r2['id']?>"><div><img id="image" src="<?php echo $r2['im']?>" alt=""> <p><?php echo $r2['nom']?></p></div></a>
                    <?php
                    }                               
?>              </div>
            </div>
    </body>
    <script src = "../Scripts/AfficherEvenements.js">


    </script>

</html>