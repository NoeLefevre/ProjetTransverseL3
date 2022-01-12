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
    include 'php_image_magician.php';
    try
    {
        $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
    }
    catch(Exception $e)
    {

            die('Erreur : '.$e->getMessage());
    }

    if ($_POST['choix']=='Personne')
    {
        $req = $bdd->prepare('INSERT INTO appartenance(IdPersonne) 
        VALUES(:idpersonne)');
            $req->execute([
            'idpersonne' => $_SESSION['id'],
            ]);
        $reponse = $bdd->query('SELECT MAX(IdAppartenance) as ida FROM appartenance');
        $donnee =$reponse->fetch();
        $req = $bdd->prepare('INSERT INTO evenement(Information,NomEvenement,IdAppartenance,DatesDebut,DatesFin) 
        VALUES(:information,:nomevenement,:idappartenance,:db,:df)');
            $req->execute([
            'information' => $_POST['information'],
            'nomevenement' => $_POST['nom'],
            'idappartenance' => $donnee['ida'],
            'db' => $_POST['datedebut'],
            'df' => $_POST['datefin']
            ]);
    }
    else
    {
        $reponse = $bdd->prepare('SELECT IdGroupe as idg FROM groupe WHERE Nom=?');
        $reponse->execute(array($_POST['choix2']));
        $donnee =$reponse->fetch();
        $req = $bdd->prepare('INSERT INTO appartenance(IdGroupe) 
        VALUES(:idgroupe)');
            $req->execute([
            'idgroupe' => $donnee['idg'],
            ]);
            $reponse = $bdd->query('SELECT MAX(IdAppartenance) as ida FROM appartenance');
        $donnee =$reponse->fetch();
        $req = $bdd->prepare('INSERT INTO evenement(Information,NomEvenement,IdAppartenance,DatesDebut,DatesFin) 
        VALUES(:information,:nomevenement,:idappartenance,:db,:df)');
            $req->execute([
            'information' => $_POST['information'],
            'nomevenement' => $_POST['nom'],
            'idappartenance' => $donnee['ida'],
            'db' => $_POST['datedebut'],
            'df' => $_POST['datefin']
            ]);
    }
    if (isset($_POST['Sport']))
            {
                $reponse = $bdd->query('SELECT MAX(IdEvenement) as ide FROM evenement');
                $donnee =$reponse->fetch();
                $reponse2 = $bdd->query('SELECT IdInteret as idi FROM centreinteret WHERE Nom=\'Sport\'');
                $donnee2 =$reponse2->fetch();
                $req = $bdd->prepare('INSERT INTO possedeevenement(IdEvenement,IdInteret) VALUES(:idevenement,:idinteret)');
                $req->execute(array('idevenement' => $donnee['ide'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }
            if (isset($_POST['Musique']))
            {
                $reponse = $bdd->query('SELECT MAX(IdEvenement) as ide FROM evenement');
                $donnee =$reponse->fetch();
                $reponse2 = $bdd->query('SELECT IdInteret as idi FROM centreinteret WHERE Nom=\'Musique\'');
                $donnee2 =$reponse2->fetch();
                $req = $bdd->prepare('INSERT INTO possedeevenement(IdEvenement,IdInteret) VALUES(:idevenement,:idinteret)');
                $req->execute(array('idevenement' => $donnee['ide'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }
            if (isset($_POST['TV']))
            {
                $reponse = $bdd->query('SELECT MAX(IdEvenement) as ide FROM evenement');
                $donnee =$reponse->fetch();
                $reponse2 = $bdd->query('SELECT IdInteret as idi FROM centreinteret WHERE Nom=\'TV\'');
                $donnee2 =$reponse2->fetch();
                $req = $bdd->prepare('INSERT INTO possedeevenement(IdEvenement,IdInteret) VALUES(:idevenement,:idinteret)');
                $req->execute(array('idevenement' => $donnee['ide'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }
            if (isset($_POST['Soiree']))
            {
                $reponse = $bdd->query('SELECT MAX(IdEvenement) as ide FROM evenement');
                $donnee =$reponse->fetch();
                $reponse2 = $bdd->query('SELECT IdInteret as idi FROM centreinteret WHERE Nom=\'Soiree\'');
                $donnee2 =$reponse2->fetch();
                $req = $bdd->prepare('INSERT INTO possedeevenement(IdEvenement,IdInteret) VALUES(:idevenement,:idinteret)');
                $req->execute(array('idevenement' => $donnee['ide'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }
            if (isset($_POST['Conference']))
            {
                $reponse = $bdd->query('SELECT MAX(IdEvenement) as ide FROM evenement');
                $donnee =$reponse->fetch();
                $reponse2 = $bdd->query('SELECT IdInteret as idi FROM centreinteret WHERE Nom=\'Conference\'');
                $donnee2 =$reponse2->fetch();
                $req = $bdd->prepare('INSERT INTO possedeevenement(IdEvenement,IdInteret) VALUES(:idevenement,:idinteret)');
                $req->execute(array('idevenement' => $donnee['ide'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }
            $reponseId = $bdd->query('SELECT MAX(IdEvenement) as ide FROM evenement');
            $donneeId =$reponseId->fetch();

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
    $newwidth = 1024;
    $newheight = 576;
    $img_type = $_FILES['fic']['type'];
    $img_nom  = $_FILES['fic']['name'];
    $img_blob = file_get_contents ($_FILES['fic']['tmp_name']);
    $reponse = $bdd->query('SELECT MAX(img_id) as id FROM images');
    $donnee =$reponse->fetch();
    $chemin = $donnee['id']+1;
    $cheminImage = "../image/photo$chemin.png";
    file_put_contents("../image/photo$chemin.png", $img_blob);
    $magicianObj = new imageLib("../image/photo$chemin.png");
    $magicianObj -> resizeImage($newwidth, $newheight, 'crop');
    $magicianObj -> saveImage("../image/photo$chemin.png");
    $req = $bdd->prepare('INSERT INTO images(img_nom,img_taille,img_type,IdEvenement,LienImage) 
    VALUES(:img_nom,:img_taille,:img_type,:IdEvenement,:LienImage)');
        $req->execute([
        'img_nom' => $img_nom,
        'img_taille' => $img_taille ,
        'img_type' => $img_type,
        'IdEvenement' =>$donneeId['ide'],
        'LienImage' => $cheminImage,
         ]);
    
    }
    header('Location: ../PagesPrincipales/AfficherEvenements.php');
    exit();

            
?>

</body>
</html>
