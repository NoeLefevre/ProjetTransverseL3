<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<?php
$DateEnvoi  = date('Y-m-d H:i:s');
$bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
$req = $bdd->prepare('INSERT INTO CommentaireEvenement(IdEvenement,IdPersonne,Commentaire,Dates,Titre) 
    VALUES(:ide,:idp,:com,:dates,:titre)');
        $req->execute([
        'ide' => $_GET['event'],
        'idp' => $_SESSION['id'],
        'com' => $_POST['information'],
        'dates' => $DateEnvoi,
        'titre' => $_POST['titre']
        ]);