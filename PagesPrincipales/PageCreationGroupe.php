<!DOCTYPE html>

<html>
    <head>
        <title>Formulaire inscription</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href = "../Styles/PageCreationGroupe.css"/>
    </head>
    <body>
        <p class="titre"> Création Groupe </p>
        <form enctype="multipart/form-data" action = "../PagesTraitement/TraitementCreationGroupe.php" method="post">
            <p class = "Nom">
                Nom Groupe: <br>
                <input type="text" size="66"id="t" style="height:40px;" name="nom" />
            </p>
            <p class = "RIB">
                RIB : <br>
                <input type="text" size="66"id="t" style="height:40px;" name="Rib" />
            </p>
            <p class = "Adresse">
                Adresse : <br>
                <input type="text" size="66"id="t" style="height:40px;" name="adresse" />
            </p>
            <p>
                Type :<br />
                <input type="checkbox" name="Sport" id="Sport" /> <label for="Sport">Sport</label><br />
                <input type="checkbox" name="Musique" id="Musique" /> <label for="Musique">Musique</label><br />
                <input type="checkbox" name="TV" id="TV" /> <label for="TV">TV</label><br />
                <input type="checkbox" name="Soiree" id="Soiree" /> <label for="Soiree">Soiree</label><br/>
                <input type="checkbox" name="Conference" id="Conference" /> <label for="Conference">Conference</label>

            </p>
            <p>
            Photo du groupe : <br>
            <input name="fic" size=50 type="file" />
            </p>
            <p class = 'inscription'> 
                <input type="image" id="image" alt=" inscription"
                src="../Ressources/Inscription.png" width = "100" height = "100">
            </p>
        </form>
    </body>

</html>
