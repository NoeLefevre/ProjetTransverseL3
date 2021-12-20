<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../Styles/Ami.css"/>
        <link rel="stylesheet" href = "../fullcalendar/lib/main.css"/>
        <meta charset="utf-8" />
    </head>
    <body>
        <?php
        if (isset($_SESSION['log']))
        {
        ?>
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
                        <a href ="../PagesPrincipales/AfficherEvenements"><p class="liste">Vos Evenements</p>
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
                <div id="trier_amis">
                <?php
            
        ?>
                     <form class = "friends_searchbox" action = "" method = "get">
                        <input id = "friends_searchbar" type = "search" name = "ID" placeholder ="Rechercher un ami">
                        <img id ="loupe2" src = "../Ressources/loupe_icone.png">
                    </form>
                    <div id="boutons_droite">
                    <input class="bouton_affichage" id="bcourt"  type="image" name="court" src="../Ressources/court_icone.png" >
                    <input class="bouton_affichage"  id="blong" type="image" name="long" src="../Ressources/long_icone.png" >
                    </div>

               </div>
            <div class="tous_les_amis">
                <?php 
                        $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
            $reponse = $bdd->prepare('SELECT p.Nom as nom, p.Prenom as prenom, p.IdPersonne as idp FROM ami as a JOIN personne AS p ON a.Personne1=p.IdPersonne  WHERE Personne2=:pers AND Accepte=\'oui\' UNION SELECT p.Nom as nom, p.Prenom as prenom, p.IdPersonne as idp  FROM ami as a JOIN personne AS p ON a.Personne2=p.IdPersonne  WHERE Personne1=:pers AND Accepte=\'oui\''); 
            $reponse->execute(array('pers'=> $_SESSION['id']));
            $compt = 0 ;
            $ListeEvenement = array();
            foreach ($reponse as $r) {
                $evenements = $bdd->prepare('SELECT NomEvenement as title, DatesDebut as start, DatesFin as end FROM evenement WHERE IdPersonne=?'); 
                $evenements->execute(array($r['idp']));
                $data = $evenements->fetchALL(PDO::FETCH_ASSOC);
                $ListeEvenement[$compt] = $data;
                ?>
                    <div class="contenu1">
                    <div id="photo">
                        <?php
                        $rep = $bdd->prepare('SELECT LienImage as lien  FROM imageprofil JOIN personne ON personne.IdPersonne=imageprofil.IdPersonne WHERE imageprofil.IdPersonne=?'); 
                        $rep->execute(array($r['idp']));
                        $contenu = $rep->fetch();
            ?>
                        <a href = "profil.php?id=<?php echo $r['idp']?>"> <img class="photo_profil" src="<?php echo $contenu["lien"]?>"></a>
                    </div>
                    <p class="Text2"><?php echo $r['nom'],' ', $r['prenom'], ' ' ?></p>
                    <div id="description_ami">
                        <div id="phrase_ami">
                        <p>C'est où qu'elle est ma bat-mobile ?</p>
                        </div>

                        <ul id="caracteristiques_ami">
                            <li id="carac"> Cinema </li>
                            <li id="carac"> Spectacles </li>
                            <li id="carac"> Sports </li>
                            <li id="carac"> Soirées </li>
                        </ul>
                  </div>
                  <div id="calendrier_ami">
                      <div id="calendar<?php echo $compt?>"></div>
                  </div>
                </div>
                    <?php
                    $compt = $compt + 1;
                    }
                    $ListeEvenement = json_encode($ListeEvenement);
                    
                  
                    
                    ?>

                <?php 
                        $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
                        $reponse = $bdd->prepare('SELECT p.Nom as nom, p.Prenom as prenom, p.IdPersonne as idp FROM ami as a JOIN personne AS p ON a.Personne1=p.IdPersonne  WHERE Personne2=:pers AND Accepte=\'oui\' UNION SELECT p.Nom as nom, p.Prenom as prenom, p.IdPersonne as idp  FROM ami as a JOIN personne AS p ON a.Personne2=p.IdPersonne  WHERE Personne1=:pers AND Accepte=\'oui\''); 
                        $reponse->execute(array('pers'=> $_SESSION['id']));
            foreach ($reponse as $r) {
                ?>
                    <div class="contenu2">
                    <div id="photo2">
                    <?php
                        $rep = $bdd->prepare('SELECT LienImage as lien  FROM imageprofil JOIN Personne ON Personne.IdPersonne=imageprofil.IdPersonne WHERE imageprofil.IdPersonne=?'); 
                        $rep->execute(array($r['idp']));
                        $contenu = $rep->fetch();
                    ?>
                         <a href = "profil.php?id=<?php echo $r['idp']?>"><img class="photo_profil2" src="<?php echo $contenu["lien"]?>" ></a>
                    </div>
                    <p class="Text"><?php echo $r['nom'],' ', $r['prenom'], ' ' ?></p>
                  <div id="calendrier_ami2">
                    <div id="calendar"></div>
                  </div>
                </div>  
                <?php
                }
            
        ?>
        

                  
            </div>
                

            </div>
        </div>
        </div>
        <div id ="hidden">
        <?php echo $compt ?>
        </div>
        <div id ="hidden2">
        <?php echo $ListeEvenement ?>
        </div>
        <?php
        }
        else
        {
            header('Location: ../PagesPrincipales/PageConnexion.php');
            exit();
        }
        ?>
    </body>
    <script src = "../Scripts/PagePrincipale.js">
    </script>
    <script src = "../fullcalendar/lib/main.js">
    </script>
    
    

</html>

