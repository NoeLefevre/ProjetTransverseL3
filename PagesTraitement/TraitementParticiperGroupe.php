<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<?php
$bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
$req = $bdd->prepare('INSERT INTO appartient(IdPersonne,IdGroupe) 
VALUES(:idp,:idg)');
$req->execute([
'idp' => $_GET['idp'],
'idg' => $_GET['idg'],
]);
ob_start();
header("Location: ../PagesPrincipales/AfficherGroupe.php?id=".$_GET['idg']);
exit();