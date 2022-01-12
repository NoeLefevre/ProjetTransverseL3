<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>
<?php
$bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
$req = $bdd->prepare('SELECT IdAppartenance as id FROM evenement WHERE IdEvenement=:ide');
$req->execute(array('ide' => $_GET['event'],
        ));
$rep = $req->fetch();
$saveid = $rep['id'];
$req1 = $bdd->prepare('DELETE FROM HistoriqueEvenement WHERE IdEvenement=:ide AND IdPersonne=:idp');
$req1->execute(array('ide' => $_GET['event'],
                    'idp' => $_SESSION['id'],
));


$req3 = $bdd->prepare('DELETE FROM appartenance WHERE IdAppartenance=:idap');
$req3->execute(array('idap' => $saveid,
        ));
$req3->execute();       
$req4 = $bdd->prepare('DELETE FROM images WHERE IdEvenement=:ide');
$req4->execute(array('ide' => $_GET['event'],
        ));
$req5 = $bdd->prepare('DELETE FROM appartientevenement WHERE IdEvenement=:ide AND IdPersonne=:idp');
$req5->execute(array('ide' => $_GET['event'],
                    'idp' => $_SESSION['id']
        ));
        echo "yes";
        $req2 = $bdd->prepare('DELETE FROM evenement WHERE IdEvenement=:ide');
        $req2->execute(array('ide' => $_GET['event'],
        ));
        header('Location: ../PagesPrincipales/AfficherEvenements.php');
        exit();