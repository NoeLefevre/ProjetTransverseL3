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
            if (isset($_SESSION['Sport']))
            {
                $s = 'Sport';
                $reponse = $bdd->query('SELECT MAX(IdPersonne) as idp FROM personne');
                $donnee =$reponse->fetch();
                $req = $bdd->prepare('INSERT INTO centreinteret(Nom) 
                VALUES(:nom)');
                $req->execute(array('nom' => $s));
                $reponse2 = $bdd->query('SELECT MAX(IdInteret) as idi FROM centreinteret');
                $donnee2 =$reponse2->fetch();
                $req2 = $bdd->prepare('INSERT INTO possede(IdPersonne,IdInteret) VALUES(:idpersonne,:idinteret)');
                $req2->execute(array('idpersonne' => $donnee['idp'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }




