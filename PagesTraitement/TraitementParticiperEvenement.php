<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<?php
$bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
$req = $bdd->prepare('INSERT INTO appartientevenement(IdPersonne,IdEvenement) 
VALUES(:idp,:ide)');
$req->execute([
'idp' => $_GET['idp'],
'ide' => $_GET['ide'],
]);
ob_start();
header("Location: ../PagesPrincipales/PageEvenement.php?id=".$_GET['ide']);
exit();