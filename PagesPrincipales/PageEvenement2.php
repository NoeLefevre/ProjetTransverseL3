<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../Styles/PageEvenement2.css"/>
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
            <?php 
            if (isset($_SESSION['id']))
            {
                $req = $bdd->prepare('INSERT INTO HistoriqueEvenement(IdEvenement,IdPersonne) VALUES(:ide,:idp)');
                $req->execute(array('ide' => $_GET['id'],
                                    'idp' => $_SESSION['id'],
            ));
            }
            ?>
        <div class="ensembles">
            <div class="contenu">
                <?php
                    if (isset($_GET['reset'])){
                        $_COOKIE['note'] = 0;
                    }
                    
                   $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
                    $req = $bdd->prepare('SELECT images.LienImage as im, evenement.information as info, evenement.NomEvenement as nom, evenement.DatesDebut as debut, evenement.DatesFin as fin, evenement.IdEvenement as id, appartenance.IdPersonne as idp FROM images JOIN evenement ON images.IdEvenement=evenement.IdEvenement JOIN appartenance ON appartenance.IdAppartenance=evenement.IdAppartenance WHERE evenement.IdEvenement=:idevenement');
                    $req->execute(array('idevenement' => $_GET['id'],
                                    ));
                    $contenu = $req->fetch();
                    $req2 = $bdd->prepare('SELECT * FROM appartientevenement WHERE IdPersonne=:idpersonne AND IdEvenement=:idevenement');
                    $req2->execute(array('idpersonne' => $_SESSION['id'],
                                         'idevenement' => $_GET['id'],
                                                        ));
                    $contenu2 = $req2->fetch();  
                ?>
               <div class = "font">
                    <img id = "minia1" src = "<?php echo $contenu['im'] ?>" alt="Ceci est un placeholder">
                    <div class = "notes">
                        <p>Notes de l'évènement :</p>
                        <?php
                        $reponse = $bdd->prepare('SELECT MoyNote as moynote from evenement WHERE IdEvenement=?');
                        $reponse->execute(array($_GET['id']));
                        $donnee =$reponse->fetch();
                        if (empty($donnee['moynote']))
                        {
                        ?>
                        <div class = "pas_etoiles">
                            Evenement pas encore noté
                        </div>
                        <?php
                        }
                        else if ($donnee['moynote']==0)
                        {
                            ?>
                        <div class = "box_etoiles">
                            <img class = "etoile" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note.png" alt = "étoile note">
                        </div>
                        <?php
                        }
                        else if ($donnee['moynote']==1)
                        {
                            ?>
                        <div class = "box_etoile1">
                            <img class = "etoile" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note.png" alt = "étoile note">
                        </div>
                        <?php
                        }
                        else if ($donnee['moynote']==2)
                        {
                            ?>
                        <div class = "box_etoile2">
                            <img class = "etoile" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note.png" alt = "étoile note">
                        </div>
                        <?php
                        }
                        else if ($donnee['moynote']==3)
                        {
                            ?>
                        <div class = "box_etoile3">
                            <img class = "etoile" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note.png" alt = "étoile note">
                        </div>
                        <?php
                        }
                        else if ($donnee['moynote']==4)
                        {
                            ?>
                        <div class = "box_etoile4">
                            <img class = "etoile" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note.png" alt = "étoile note">
                        </div>
                        <?php
                        }
                        else if ($donnee['moynote']==5)
                        {
                            ?>
                        <div class = "box_etoile5">
                            <img class = "etoile" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class = "Description">
                    <h1 class = "Titre"><?php echo $contenu['nom'] ?></h1>
                    <p id = "place">&#9906 Lieu de l'évènement : </p>
                    <p id = "desc_titre">Description de l'évènement : </p>
                    <textarea readonly="readonly", id = "infos"><?php echo $contenu['info'] ?></textarea>
                    <p>Date de début : <?php echo $contenu['debut'] ?> </p>
                    <p>Date de fin : <?php echo $contenu['fin'] ?></p>
                    <?php
                    if ($contenu['idp']==$_SESSION['id'] || isset($contenu2['IdPersonne']))
                        {?>
                            <button class="participer" >Vous participez deja à cet evenement</button>
                        <?php
                        }
                        else
                        {?>
                            <p><a href = "../PagesTraitement/TraitementParticiperEvenement?idp=<?php echo $_SESSION['id']?>&ide=<?php echo $_GET['id']?>"><button type="submit" class="btn">Participer à cet evenement</button></a>
                        <?php
                        }
                        ?>
                        <p><button type="submit" class="btnnoter">Noter cet evenement</button></p>
                        <p><button type="submit" class="btnnoter2">Noter cet evenement</button></p>
            <div class="interets-popup">
                <div class="form-popup" id="popupForm">
                <?php if (isset($_COOKIE['note']))
                {?>
                  <form action="../PagesTraitement/TraitementNoterEvenement.php?event=<?php echo $_GET['id']?>&note=<?php echo $_COOKIE['note']?>" class="form-container" method = "POST">
         <?php }?>
                    <h3 id = "titre-pop">Renseignez votre note</h3>
                    <?php if (isset($_GET['false']))
                            {?>
                                <p class="erreur">Vous n'avez pas rentré de note</p>
                                <?php
                                echo $_COOKIE['note'];
                            }
                    
                    ?>
                    <div class = "notation">
                        <div class = "box_etoile">
                            <img class = "etoile1" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile2" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile3" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile4" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile5" src = "../Ressources/note.png" alt = "étoile note">
                        </div>
                        <div class = "box_etoiles1">
                            <img class = "etoile1j" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile2" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile3" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile4" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile5" src = "../Ressources/note.png" alt = "étoile note">
                        </div>
                        <div class = "box_etoiles2">
                            <img class = "etoile1j" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile2j" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile3" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile4" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile5" src = "../Ressources/note.png" alt = "étoile note">
                        </div>
                        <div class = "box_etoiles3">
                            <img class = "etoile1j" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile2j" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile3j" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile4" src = "../Ressources/note.png" alt = "étoile note">
                            <img class = "etoile5" src = "../Ressources/note.png" alt = "étoile note">
                        </div>
                        <div class = "box_etoiles4">
                            <img class = "etoile1j" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile2j" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile3j" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile4j" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile5" src = "../Ressources/note.png" alt = "étoile note">
                        </div>
                        <div class = "box_etoiles5">
                            <img class = "etoile1j" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile2j" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile3j" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile4j" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                            <img class = "etoile5j" src = "../Ressources/note_jaune2.png" alt = "étoile note">
                        </div>
                    </div>
                    <button type="button" class="btnmodif">Modifier</button>
                    <button type="submit" class="btn valide" >Valider</button>
                  </form>
                </div>
              </div>
            </div>
        </div>

        <!--
        <div class="commentaire">
            <h2 class="titrecommentaire">Espace Commentaire</h2>
            <button type="button" class="btncom">Commenter cet evenement</button>
            <div class="txtcommentaire">
                <form action = "../PagesTraitement/TraitementCreationEvenement.php" method="post">
                    <p class = "Information">
                        Informations sur l'évenement : <br>
                    <textarea name="information" id="information"></textarea>
                    </p>
            </div>
        </div>
                        -->


        <div class = 'form'>
            <h1>Commentaires </h1>
            <p>Titre</p>
            <input type ="text" id = "name">
            <p>Commetaire</p>
            <textarea cols="60" rows="5" id = "bodyText"></textarea>
            <input type="button" id = "addComent" value = "Ajouter un commentaire">
        </div>

        <div id ="container">
        </div>

    </div>
    </body>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src = "../Scripts/PageEvenement2.js"></script>

</html>