<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<?php
try
    {
        $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
    }
    catch(Exception $e)
    {

            die('Erreur : '.$e->getMessage());
    }

    $req = $bdd->prepare('INSERT INTO groupe(Nom,RIB,Adresse,Leader) 
    VALUES(:nom,:rib,:adresse,:leader)');
        $req->execute([
        'nom' => $_POST['nom'],
        'rib' => $_POST['Rib'],
        'adresse' => $_POST['adresse'],
        'leader' => $_SESSION['id']
        ]);
        if (isset($_POST['Sport']))
            {
                $reponse = $bdd->query('SELECT MAX(IdGroupe) as idg FROM groupe');
                $donnee =$reponse->fetch();
                $reponse2 = $bdd->query('SELECT IdInteret as idi FROM centreinteret WHERE Nom=\'Sport\'');
                $donnee2 =$reponse2->fetch();
                $req = $bdd->prepare('INSERT INTO PossedeGroupe(IdGroupe,IdInteret) VALUES(:IdGroupe,:idinteret)');
                $req->execute(array('IdGroupe' => $donnee['idg'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }
            if (isset($_POST['Musique']))
            {
                $reponse = $bdd->query('SELECT MAX(IdGroupe) as idg FROM groupe');
                $donnee =$reponse->fetch();
                $reponse2 = $bdd->query('SELECT IdInteret as idi FROM centreinteret WHERE Nom=\'Musique\'');
                $donnee2 =$reponse2->fetch();
                $req = $bdd->prepare('INSERT INTO PossedeGroupe(IdGroupe,IdInteret) VALUES(:IdGroupe,:idinteret)');
                $req->execute(array('IdGroupe' => $donnee['idg'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }
            if (isset($_POST['TV']))
            {
                $reponse = $bdd->query('SELECT MAX(IdGroupe) as idg FROM groupe');
                $donnee =$reponse->fetch();
                $reponse2 = $bdd->query('SELECT IdInteret as idi FROM centreinteret WHERE Nom=\'TV\'');
                $donnee2 =$reponse2->fetch();
                $req = $bdd->prepare('INSERT INTO PossedeGroupe(IdGroupe,IdInteret) VALUES(:IdGroupe,:idinteret)');
                $req->execute(array('IdGroupe' => $donnee['idg'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }
            if (isset($_POST['Soiree']))
            {
                $reponse = $bdd->query('SELECT MAX(IdGroupe) as idg FROM groupe');
                $donnee =$reponse->fetch();
                $reponse2 = $bdd->query('SELECT IdInteret as idi FROM centreinteret WHERE Nom=\'Soiree\'');
                $donnee2 =$reponse2->fetch();
                $req = $bdd->prepare('INSERT INTO PossedeGroupe(IdGroupe,IdInteret) VALUES(:IdGroupe,:idinteret)');
                $req->execute(array('IdGroupe' => $donnee['idg'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }
            if (isset($_POST['Conference']))
            {
                $reponse = $bdd->query('SELECT MAX(IdGroupe) as idg FROM groupe');
                $donnee =$reponse->fetch();
                $reponse2 = $bdd->query('SELECT IdInteret as idi FROM centreinteret WHERE Nom=\'Conference\'');
                $donnee2 =$reponse2->fetch();
                $req = $bdd->prepare('INSERT INTO PossedeGroupe(IdGroupe,IdInteret) VALUES(:IdGroupe,:idinteret)');
                $req->execute(array('IdGroupe' => $donnee['idg'],
                                    'idinteret' => $donnee2['idi'],
                                    ));
            }

        $reponseId = $bdd->query('SELECT MAX(IdGroupe) as idg FROM groupe');
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

$img_type = $_FILES['fic']['type'];
$img_nom  = $_FILES['fic']['name'];
$img_blob = file_get_contents ($_FILES['fic']['tmp_name']);
$reponse = $bdd->query('SELECT MAX(img_id) as id FROM imagegroupe');
$donnee =$reponse->fetch();
$chemin = $donnee['id']+1;
$cheminImage = "../imagegroupe/photo$chemin.png";
file_put_contents("../imagegroupe/photo$chemin.png", $img_blob);
$req = $bdd->prepare('INSERT INTO imagegroupe(img_nom,img_taille,img_type,IdGroupe,LienImage) 
VALUES(:img_nom,:img_taille,:img_type,:IdGroupe,:LienImage)');
    $req->execute([
    'img_nom' => $img_nom,
    'img_taille' => $img_taille ,
    'img_type' => $img_type,
    'IdGroupe' =>$donneeId['idg'],
    'LienImage' => $cheminImage,
     ]);

}
    header('Location: ../PagesPrincipales/Groupe.php');
    exit();