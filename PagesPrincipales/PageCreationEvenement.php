<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Formulaire inscription</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href = "../Styles/PageCreationEvenement.css"/>
    </head>
    <body>
        <p class="titre"> Création Evénement </p>
        <form enctype="multipart/form-data" action = "../PagesTraitement/TraitementCreationEvenement.php" method="post">
            <p class = "Nom">
                Nom évenement: <br>
                <input type="text" size="66"id="t" style="height:40px;" name="nom" />
            </p>
            <p class = "Lieu">
                Lieu : <br>
                <input type="text" size="66"id="t" style="height:40px;" name="lieu" />
            </p>
            <p class = "Date">
                Date du debut de l'évenement : <br>
                <input id="datedebut" type="datetime-local" name="datedebut">
            </p>
            <p class = "Date">
                Date de fin l'évenement : <br>
                <input id="datefin" type="datetime-local" name="datefin">
            </p>
            <p class = "Information">
                Informations sur l'évenement : <br>
                <textarea name="information" id="information"></textarea>
            </p>
            <p>
            Photo de l'évenement : <br>
            <input name="fic" size=50 type="file" />
            </p>
            <p>
                Type :<br />
                <input type="checkbox" name="Sport" id="Sport" /> <label for="Sport">Sport</label><br />
                <input type="checkbox" name="Musique" id="Musique" /> <label for="Musique">Musique</label><br />
                <input type="checkbox" name="TV" id="TV" /> <label for="TV">TV</label><br />
                <input type="checkbox" name="Soiree" id="Soiree" /> <label for="Soiree">Soiree</label><br/>
                <input type="checkbox" name="Conference" id="Conference" /> <label for="Conference">Conference</label>

            </p>
            <p id="textchoix"> Voulez vous créé l'évenement en tant que personne ou groupe ?<br />
            <select name="choix" class="choix">
           <option value="Personne">Personne</option>
           <option value="Groupe">Groupe</option>
       </select>
      </p>
       <?php
       $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
       $reponse = $bdd->prepare('SELECT Nom as n FROM groupe WHERE Leader=:pers '); 
       $reponse->execute(array('pers'=> $_SESSION['id']));
       ?>
       <p id="textchoixgrp">
        Selectionner le groupe<br />
            <select name="choix2" id="choix2">
            <?php
            foreach ($reponse as $r) {
                ?>
           <option value="<?php echo $r['n']?>"><?php echo $r['n']?></option>
           <?php
            }
            ?>
       </select>
       

            </p>
            <p class = 'inscription'> 
                <input type="image" id="image" alt=" inscription"
                src="../Ressources/Inscription.png" width = "100" height = "100">
            </p>
        </form>
    </body>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src = "../Scripts/CreationEvenement.js">
    </script>

</html>
