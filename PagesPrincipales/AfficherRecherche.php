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
<?php  $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab'); ?>
        <header>
            <div class="menu">
                <img id="Hamburger" src = "../Ressources/Hamburger_icon.png">
                <img id="Hamburger2" src = "../Ressources/Hamburger_icon.png">
                <p id="Nomdusite"><strong>Nom Du Site</strong></p>
            </div>
            <div class="bouton_filtre">Filtre</div>
            <div class="bouton_filtre2">Filtre</div>
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
            <div class="tout">
                <div class="filtre">
                    <div class="filtre_contenu">
                        <?php if (isset($_GET['Sport']))
                        {?>
                            <input type="checkbox" name="Sport" id="Sport" onclick="filtredynamique()" checked/> <label for="Sport">Sport</label><br />
                        <?php
                        }
                        else
                        {?>
                            <input type="checkbox" name="Sport" id="Sport" onclick="filtredynamique()"/> <label for="Sport">Sport</label><br />
                            <?php
                        }?>
                        <?php if (isset($_GET['Musique']))
                        {?>
                            <input type="checkbox" name="Musique" id="Musique" onclick="filtredynamique()" checked/> <label for="Musique">Musique</label><br />
                            <?php
                        }
                        else
                        {?>
                            <input type="checkbox" name="Musique" id="Musique" onclick="filtredynamique()"/> <label for="Musique">Musique</label><br />
                            <?php
                        }?>
                        <?php if (isset($_GET['TV']))
                        {?>
                            <input type="checkbox" name="TV" id="TV" onclick="filtredynamique()" checked /> <label for="TV" >TV</label><br />
                            <?php
                        }
                        else
                        {?>
                            <input type="checkbox" name="TV" id="TV" onclick="filtredynamique()"/> <label for="TV" >TV</label><br />
                            <?php
                        }?>
                        <?php if (isset($_GET['Soiree']))
                        {?>
                            <input type="checkbox" name="Soiree" id="Soiree" onclick="filtredynamique()" checked/> <label for="Soiree">Soiree</label><br/>
                            <?php
                        }
                        else
                        {?>
                            <input type="checkbox" name="Soiree" id="Soiree" onclick="filtredynamique()" /> <label for="Soiree">Soiree</label><br/>
                            <?php
                        }?>
                        <?php if (isset($_GET['Conference']))
                        {?>
                            <input type="checkbox" name="Conference" id="Conference" onclick="filtredynamique()" checked/> <label for="Conference">Conference</label>
                            <?php
                        }
                        else
                        {?>
                            <input type="checkbox" name="Conference" id="Conference" onclick="filtredynamique()" /> <label for="Conference">Conference</label>
                            <?php
                        }?>
                    </div>
                </div>
                <h2 class="Titre"> Evemenement </h2>
                    <div class="block">
                            <?php
                            $critere1 = $_GET['terme'];
                            $critere2 = "%".$_GET['terme'];
                            $critere3 = $_GET['terme']."%";
                            $critere4 = '';
                            if (isset($_GET['Sport']))
                            {
                                if ($critere4=='')
                                    $critere4 = ' AND (centreinteret.Nom=\'Sport\'';
                                else
                                    $critere4 = $critere4 . ' OR centreinteret.Nom=\'Sport\'';
                            }
                            if (isset($_GET['Musique']))
                            {
                                if ($critere4=='')
                                    $critere4 = ' AND (centreinteret.Nom=\'Musique\'';
                                else
                                    $critere4 = $critere4 . ' OR centreinteret.Nom=\'Musique\'';
                            }
                            if (isset($_GET['TV']))
                            {
                                if ($critere4=='')
                                    $critere4 = ' AND (centreinteret.Nom=\'TV\'';
                                else
                                    $critere4 = $critere4 . ' OR centreinteret.Nom=\'TV\'';
                            }
                            if (isset($_GET['Soiree']))
                            {
                                if ($critere4=='')
                                    $critere4 = ' AND (centreinteret.Nom=\'Soiree\'';
                                else
                                    $critere4 = $critere4 . ' OR centreinteret.Nom=\'Soiree\'';
                            }
                            if (isset($_GET['Conference']))
                            {
                                if ($critere4=='')
                                    $critere4 = ' AND (centreinteret.Nom=\'Conference\'';
                                else
                                    $critere4 = $critere4 . ' OR centreinteret.Nom=\'Conference\'';
                            }
                            if ($critere4 != '')
                                $critere4 = $critere4 . ')';
                        $req = $bdd->prepare('SELECT distinct(images.LienImage) as im, evenement.information as info, evenement.NomEvenement as nom, evenement.IdEvenement as id  FROM images JOIN evenement ON images.IdEvenement=evenement.IdEvenement JOIN possedeevenement ON evenement.IdEvenement=possedeevenement.IdEvenement JOIN centreinteret ON centreinteret.IdInteret = possedeevenement.IdInteret WHERE (evenement.NomEvenement LIKE :info1 or evenement.NomEvenement LIKE :info2 OR evenement.NomEvenement LIKE :info3 OR evenement.Information LIKE :info1 or evenement.Information LIKE :info2 OR evenement.Information LIKE :info3 )'.$critere4);
                        $req->execute(array('info1' => $critere1,
                                            'info2' => $critere2,
                                            'info3' => $critere3,
                                                    ));
                        if ($req->rowCount()!=0)
                        {
                            foreach ($req as $r) 
                            {
                                ?>
                                <div class="rectangle"> 
                                    <div clas="image"><a href="../PagesPrincipales/PageEvenement.php?id=<?php echo$r['id']?> "><img src="<?php echo $r['im']?>" alt=""></a></div>
                                    <div class="info">
                                        <div class="appelation"><p><?php echo $r['nom']?></p></div>
                                        <?php echo $r['info']?>
                                        <?php
                                        $reqavatar = $bdd->prepare('SELECT appartenance.IdPersonne as idp from evenement JOIN appartenance ON appartenance.IdAppartenance=evenement.IdAppartenance WHERE IdEvenement=:ide');
                                        $reqavatar->execute(array('ide' => $r['id']
                                                        ));
                                        $avatar = $reqavatar->fetch();
                                        $reqavatar2 = $bdd->prepare('SELECT appartenance.IdGroupe as idg from evenement JOIN appartenance ON appartenance.IdAppartenance=evenement.IdAppartenance WHERE IdEvenement=:ide');
                                        $reqavatar2->execute(array('ide' => $r['id']
                                                        ));
                                        $avatar2 = $reqavatar2->fetch();
                                        if(isset($avatar['idp']))
                                        {
                                            $selectavatar = $bdd->prepare('SELECT imageprofil.LienImage as lien, personne.nom as nom, personne.prenom as prenom from imageprofil join personne ON imageprofil.IdPersonne=personne.IdPersonne WHERE personne.IdPersonne=:idp;
                                            ');
                                            $selectavatar->execute(array('idp' => $avatar['idp']
                                                        ));
                                            $savatar = $selectavatar->fetch();
                                            ?>
                                            <div class="infoprofil">
                                                <p class="float"><img id="Avatar" src="<?php echo $savatar["lien"]?>"></p>
                                                <p class="txt"><?php echo $savatar["prenom"]?> <?php echo " "?> <?php echo $savatar["nom"]?></p>
                                            </div>
                                            <?php
                                        }
                                        else
                                        {
                                            $selectavatar = $bdd->prepare('SELECT imagegroupe.LienImage as lien, groupe.nom as nom from imagegroupe join groupe ON imagegroupe.IdGroupe=groupe.IdGroupe WHERE groupe.IdGroupe=:idg;
                                            ');
                                            $selectavatar->execute(array('idg' => $avatar2['idg']
                                                        ));
                                            $savatar = $selectavatar->fetch();
                                            ?>
                                            <div class="infoprofil">
                                                <p class="float"><img id="Avatar" src="<?php echo $savatar["lien"]?>"></p>
                                                <p class="txt"><?php echo $savatar["nom"]?></p>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }  
                        }
                        else 
                        {?>
                        <div class="Rien">
                            Aucuns évenements trouvés
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <hr/>
                <h2 class="Titre2"> Profil </h2>
                    <div class="block">
                        <?php
                        $critere1 = $_GET['terme'];
                        $critere2 = "%".$_GET['terme'];
                        $critere3 = $_GET['terme']."%";
                        $req = $bdd->prepare('SELECT distinct(imageprofil.LienImage) as im, personne.Nom as nom, personne.Prenom as prenom, personne.IdPersonne as id, personne.Bio as info FROM imageprofil JOIN personne ON imageprofil.IdPersonne=personne.IdPersonne JOIN possede ON personne.IdPersonne=possede.IdPersonne JOIN centreinteret ON centreinteret.IdInteret = possede.IdInteret WHERE (personne.Nom LIKE :info1 or personne.Nom LIKE :info2 OR personne.Nom LIKE :info3 OR personne.Prenom LIKE :info1 or personne.Prenom LIKE :info2 OR personne.Prenom LIKE :info3 )'.$critere4);
                        $req->execute(array('info1' => $critere1,
                                            'info2' => $critere2,
                                            'info3' => $critere3,
                                                        ));
                        if ($req->rowCount()!=0)
                        {                                
                            foreach ($req as $r) 
                            {
                                ?>
                                <div class="rectangle"> 
                                    <div clas="image"><a href="../PagesPrincipales/profil.php?id=<?php echo$r['id']?> "><img id="imageprof" src="<?php echo $r['im']?>" alt=""></a></div>
                                    <div class="info">
                                        <div class="appelation"><p><?php echo $r['nom']?></p></div>
                                        <div><?php echo $r['info']?></div>
                                    </div>
                                </div>    
                                <?php
                            } 
                        } 
                        else
                        {?>
                            <div class="Rien">
                                Aucuns profils trouvés
                            </div>
                            <?php
                            }
                            ?>
                    </div>
                <hr/>
                <h2 class="Titre2"> Groupe </h2>
                    <div class="block">
                        <?php
                        $critere1 = $_GET['terme'];
                        $critere2 = "%".$_GET['terme'];
                        $critere3 = $_GET['terme']."%";
                        $req = $bdd->prepare('SELECT distinct(imagegroupe.LienImage) as im, groupe.Nom as nom, groupe.IdGroupe as id, groupe.info as info FROM imagegroupe JOIN groupe ON imagegroupe.IdGroupe=groupe.IdGroupe JOIN PossedeGroupe ON groupe.IdGroupe=PossedeGroupe.IdGroupe JOIN centreinteret ON centreinteret.IdInteret = PossedeGroupe.IdInteret WHERE (groupe.Nom LIKE :info1 or groupe.Nom LIKE :info2 OR groupe.Nom LIKE :info3 OR groupe.Leader LIKE :info1 or groupe.Leader LIKE :info2 OR groupe.Leader LIKE :info3 )'.$critere4);
                        $req->execute(array('info1' => $critere1,
                                            'info2' => $critere2,
                                            'info3' => $critere3,
                                                    ));
                        if ($req->rowCount()!=0)
                        {   
                            foreach ($req as $r) 
                            {
                                ?>
                                <div class="rectangle"> 
                                    <div clas="image"><a href="../PagesPrincipales/AfficherGroupe.php?id=<?php echo$r['id']?> "><img id="imageprof" src="<?php echo $r['im']?>" alt=""></a></div>
                                    <div class="info"><p class="appelation"><?php echo $r['nom']?></p> <?php echo $r['info']?></div>
                                </div>
                                <?php
                            }  
                        } 
                        else
                        {?>
                            <div class="Rien">
                                Aucuns profils trouvés
                            </div>
                            <?php
                            }
                            ?>
                    </div>
             </div>
        
    </body>
    <script src = "../Scripts/AfficherRecherche.js">


    </script>

</html>