<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../Styles/AfficherRecherche.css"/>
        <meta charset="utf-8" />
    </head>
    <body>
<?php $bdd = new PDO('mysql:host=localhost;dbname=projetevenement; charset=utf8;port=3307', 'root', ''); ?>
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
    <div class="tout">
                <h2 class="Evenement"> Evemenement </h2>
                <div class="block">
                        <?php
                        $critere1 = $_POST['terme'];
                        $critere2 = "%".$_POST['terme'];
                        $critere3 = $_POST['terme']."%";
                    $req = $bdd->prepare('SELECT images.LienImage as im, evenement.information as info, evenement.NomEvenement as nom, evenement.IdEvenement as id  FROM images JOIN evenement ON images.IdEvenement=evenement.IdEvenement WHERE evenement.NomEvenement LIKE :info1 or evenement.NomEvenement LIKE :info2 OR evenement.NomEvenement LIKE :info3 OR evenement.Information LIKE :info1 or evenement.Information LIKE :info2 OR evenement.Information LIKE :info3 ');
                    $req->execute(array('info1' => $critere1,
                                        'info2' => $critere2,
                                        'info3' => $critere3,
                                                ));
                    foreach ($req as $r) 
                    {
                        ?>
                        <div> <a href="../PagesPrincipales/PageEvenement.php?id=<?php echo$r['id']?> "><img src="<?php echo $r['im']?>" alt=""> <p><?php echo $r['nom']?></p></div></a>
                        <?php
                    }  
                    ?>
                </div>

            <h2 class="Evenement"> Profil </h2>
                    <div class="block">
                    <?php
                    $critere1 = $_POST['terme'];
                    $critere2 = "%".$_POST['terme'];
                    $critere3 = $_POST['terme']."%";
                $req = $bdd->prepare('SELECT imageProfil.LienImage as im, personne.Nom as nom, personne.Prenom as prenom, personne.IdPersonne as id FROM imageProfil JOIN personne ON imageProfil.IdPersonne=personne.IdPersonne WHERE personne.Nom LIKE :info1 or personne.Nom LIKE :info2 OR personne.Nom LIKE :info3 OR personne.Prenom LIKE :info1 or personne.Prenom LIKE :info2 OR personne.Prenom LIKE :info3 ');
                $req->execute(array('info1' => $critere1,
                                    'info2' => $critere2,
                                    'info3' => $critere3,
                                            ));
                foreach ($req as $r) 
                {
                    ?>
                    <div> <a href="../PagesPrincipales/profil.php?id=<?php echo$r['id']?> "><img src="<?php echo $r['im']?>" alt=""> <p><?php echo $r['nom']?></p></div></a>
                    <?php
                }  
                ?>
                </div>
    </div>
        
    </body>
    <script src = "../Scripts/AfficherEvenements.js">


    </script>

</html>