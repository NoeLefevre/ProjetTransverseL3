<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="../Styles/profil.css">
    <link rel="stylesheet" href = "../fullcalendar/lib/main.css"/>
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
    

        <div class="informations-bar">

            <div> 
                <?php 
                $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
            $reponse = $bdd->prepare('SELECT LienImage as lien ,personne.Nom as nom, personne.Prenom as prenom FROM imageprofil JOIN personne ON personne.IdPersonne=imageprofil.IdPersonne WHERE imageprofil.IdPersonne=?'); 
            $reponse->execute(array($_GET['id']));
            $contenu = $reponse->fetch();
            ?>
                <img id="Avatar" src="<?php echo $contenu["lien"]?>"> 
             
            </div>
            
            <div class="profile-info">
                <div class="user-name">
                    <h1 class="first-name"><?php echo $contenu["prenom"]?></h1>
                    <h2 class="last-name"><?php echo $contenu["nom"]?></h2>
                </div>

                <div class="adresse"> 
                     
                    <p class="ville">Ville</p>
                </div>
            </div>

            
            <div>
                <textarea name="bio" id="bio" placeholder = "Votre bio" ></textarea>
            </div>
            <?php if($_SESSION['id']==$_GET['id'])
            {
                ?>
            <div class="open-btn">
                <button class="open-button" onclick="openForm()"><strong>Passions</strong></button>
            </div>

            <div class="interets-popup">
                <div class="form-popup" id="popupForm">
                  <form action="" class="form-container">

                    <h3>Choisisser vos centres d'intrérêt</h3>
                    
                    <div class = options>
                        <div>
                        <input type="checkbox" id="sport" name="sport">
                        <label for="sport">Sport</label>
                        </div>

                        <div>
                        <input type="checkbox" id="cinema" name="cinema">
                        <label for="cinema">Cinema</label>
                        </div>

                        <div>
                        <input type="checkbox" id="gaming" name="gaming">
                        <label for="gaming">Gaming</label>
                        </div>
                        
                        <div>
                        <input type="checkbox" id="lecture" name="lecture">
                        <label for="lecture">Lecture</label>
                        </div>

                        <div>
                        <input type="checkbox" id="musique" name="musique">
                        <label for="musique">Musique</label>
                        </div>

                        <div>
                        <input type="checkbox" id="voyages" name="voyages">
                        <label for="voyages">Voyages</label>
                        </div>

                        <div>
                        <input type="checkbox" id="benevolats" name="benevolats">
                        <label for="benevolats">Benevolats</label>
                        </div>

                    </div>

                    <button type="submit" class="btn">Modifier</button>
                    <button type="button" class="btn cancel" onclick="closeForm()">Annuler</button>
                  </form>
                </div>
              </div>
              <?php
            }
            ?>
            <div>
            <?php if($_SESSION['id']!=$_GET['id'])
            {
                ?>
                <a href="../PagesTraitement/TraitementDemandeAmi?id=<?php echo $_GET['id']?>"><img src="../Ressources/ajouterAmi.jpg" width= "40px" height= "40px"></a>
                <?php
            }
            ?>
                <?php if($_SESSION['id']==$_GET['id'])
            {
                ?>
                <button type="submit" id = "change">Modifier</button>
                <?php
            }
            ?>
            </div>
            
    
                       
        </div>

        <div id ="EvenementsPerso" >
        
                
        </div> 
        <div id= "calendar">
            </div>
    </div>




    
</body>
<script src = "../fullcalendar/lib/main.js">
    </script>
    <script src = "../Scripts/profil.js"> </script>
</html>