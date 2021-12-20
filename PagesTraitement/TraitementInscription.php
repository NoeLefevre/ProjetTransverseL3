<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
            <meta charset="utf-8" />
    </head>
    <body>
    <?php
            try
            {
                $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
            }
            catch(Exception $e)
            {
    
                    die('Erreur : '.$e->getMessage());
            }
            if (isset($_POST['MotDePasse']) && isset($_POST['Nom']) && isset($_POST['Prenom']) && isset($_POST['Email'])  && isset($_POST['DateNaissance']))
        {
            $password =  password_hash($_POST['MotDePasse'], PASSWORD_DEFAULT);;
            // Insertion
            $nom = $_POST['Nom'];
            $prenom = $_POST['Prenom'];
            $mail = $_POST['Email'];
            $datenaissance = $_POST['DateNaissance'];
            $req = $bdd->prepare('INSERT INTO personne(Nom,Prenom,MotDePasse,AdresseMail,DateDeNaissance) 
                                  VALUES(:nom,:prenom,:motdepasse,:adressemail,:datenaissance)');
            $req->execute([
                'prenom' => $prenom,
                'nom' => $nom,
                'motdepasse' => $password,
                'adressemail' => $mail,
                'datenaissance' => $datenaissance,
                            ]);
               
            $reponse = $bdd->query('SELECT MAX(IdPersonne) as idp FROM personne');
            $donnee =$reponse->fetch();
            $_SESSION['id'] = $donnee['idp'];
            $_SESSION['log'] = 'oui';
            $ret        = false;
            $img_blob   = '';
            $img_taille = 0;
            $img_type   = '';
            $img_nom    = '';
            $ret        = is_uploaded_file($_FILES['fic']['tmp_name']);

            if (!$ret) {
                echo "Problème de transfert";
                return false;
            } else {
                // Le fichier a bien été reçu
                $img_taille = $_FILES['fic']['size'];

                $img_type = $_FILES['fic']['type'];
                $img_nom  = $_FILES['fic']['name'];
                $img_blob = file_get_contents ($_FILES['fic']['tmp_name']);
                $reponse = $bdd->query('SELECT MAX(img_id) as id FROM imageprofil');
                $donnee =$reponse->fetch();
                $chemin = $donnee['id']+1;
                $cheminImage = "../imageProfil/photo$chemin.png";
                file_put_contents("../imageProfil/photo$chemin.png", $img_blob);
            $req = $bdd->prepare('INSERT INTO imageprofil(img_nom,img_taille,img_type,IdPersonne,LienImage) 
            VALUES(:img_nom,:img_taille,:img_type,:idpersonne,:LienImage)');
            $req->execute([
            'img_nom' => $img_nom,
            'img_taille' => $img_taille ,
            'img_type' => $img_type,
            'idpersonne' =>$_SESSION['id'],
            'LienImage' => $cheminImage,
                ]);
            }
            if (isset($_POST['Sport']))
            {
                $s = 'Sport';
                $reponse = $bdd->query('SELECT MAX(IdPersonne) as idp FROM personne');
                $donnee =$reponse->fetch();
                $reponse2 = $bdd->query('SELECT IdInteret as idi FROM centreinteret WHERE Nom=\'Sport\'');
                $donnee2 =$reponse2->fetch();
                $req2 = $bdd->prepare('INSERT INTO possede(IdPersonne,IdInteret) VALUES(:idpersonne,:idinteret)');
                $req2->execute(array('idpersonne' => $donnee['idp'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }
            if (isset($_POST['Musique']))
            {
                $s = 'Musique';
                $reponse = $bdd->query('SELECT MAX(IdPersonne) as idp FROM personne');
                $donnee =$reponse->fetch();
                $reponse2 = $bdd->query('SELECT IdInteret as idi FROM centreinteret WHERE Nom=\'Musique\'');
                $donnee2 =$reponse2->fetch();
                $req2 = $bdd->prepare('INSERT INTO possede(IdPersonne,IdInteret) VALUES(:idpersonne,:idinteret)');
                $req2->execute(array('idpersonne' => $donnee['idp'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }
            if (isset($_POST['TV']))
            {
                $s = 'TV';
                $reponse = $bdd->query('SELECT MAX(IdPersonne) as idp FROM personne');
                $donnee =$reponse->fetch();
                $reponse2 = $bdd->query('SELECT IdInteret as idi FROM centreinteret WHERE Nom=\'TV\'');
                $donnee2 =$reponse2->fetch();
                $req2 = $bdd->prepare('INSERT INTO possede(IdPersonne,IdInteret) VALUES(:idpersonne,:idinteret)');
                $req2->execute(array('idpersonne' => $donnee['idp'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }
            if (isset($_POST['Soiree']))
            {
                $s = 'Soiree';
                $reponse = $bdd->query('SELECT MAX(IdPersonne) as idp FROM personne');
                $donnee =$reponse->fetch();
                $reponse2 = $bdd->query('SELECT IdInteret as idi  FROM centreinteret WHERE Nom=\'Soiree\'');
                $donnee2 =$reponse2->fetch();
                $req2 = $bdd->prepare('INSERT INTO possede(IdPersonne,IdInteret) VALUES(:idpersonne,:idinteret)');
                $req2->execute(array('idpersonne' => $donnee['idp'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }
            if (isset($_POST['Conference']))
            {
                $s = 'Conference';
                $reponse = $bdd->query('SELECT MAX(IdPersonne) as idp FROM personne');
                $donnee =$reponse->fetch();
                $reponse2 = $bdd->query('SELECT IdInteret as idi FROM centreinteret WHERE Nom=\'Conference\'');
                $donnee2 =$reponse2->fetch();
                $req2 = $bdd->prepare('INSERT INTO possede(IdPersonne,IdInteret) VALUES(:idpersonne,:idinteret)');
                $req2->execute(array('idpersonne' => $donnee['idp'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }
            header('Location: ../PagesPrincipales/PagePrincipale.php');
            exit();
    }
    ?>
       
    </body>
