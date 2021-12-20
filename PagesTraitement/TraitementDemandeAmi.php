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
            $statut="non";
            $id1 = $_SESSION['id'];
            $id2 = $_GET['id'];
            $req = $bdd->prepare('INSERT INTO ami(Personne1,Personne2,Accepte) 
                                  VALUES(:personne1,:personne2,:accepte)');
             $req->execute([
                 'personne1' => $id1,
                 'personne2' => $id2,
                 'accepte' => $statut,
                ]);
            $req = $bdd->prepare('SELECT IdRelation FROM ami WHERE Personne1=:personne1 AND Personne2=:personne2 AND Accepte =:accepte' );
                $req->execute([
                    'personne1' => $id1,
                    'personne2' => $id2,
                    'accepte' => $statut,
                ]);
                $donnee =$req->fetch();
                $req = $bdd->prepare('INSERT INTO notifications (IdPersonne,IdRelation) 
                VALUES(:personne,:relation)');
                $req->execute([
                'personne' => $id2,
                'relation' => $donnee['IdRelation'],
                ]);
            
        
    ?>