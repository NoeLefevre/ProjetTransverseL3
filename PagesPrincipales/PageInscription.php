<!DOCTYPE html>

<html>
    <head>
        <title>Formulaire inscription</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href = "../Styles/PageInscription.css"/>
    </head>
    <body>
        <p class="titre"> Inscription </p>
        <form enctype="multipart/form-data" action = "../PagesTraitement/TraitementInscription.php" method="post">
            <p class = "Nom">
                Nom : <br>
                <input type="text" size="66"id="t" style="height:40px;" name="Nom" />
            </p>
            <p class = "Prenom">
                Prénom : <br>
                <input type="text" size="66"id="t" style="height:40px;" name="Prenom" />
            </p>
            <p class = "marge">
                Adresse mail : <br>
                <input type="text" size="66"id="t" style="height:40px;" name="Email" />
            </p>
            <p class = "marge2">
                Mot de passe : <br>
                <input type="password" size= "66"id="t" style="height:40px;" name="MotDePasse" />
            </p>
            <p class = "Date">
                Date de naissance : <br>
                <input id="date" type="date" value="2017-06-01" name="DateNaissance">
            </p>
            <p>
                Centres d'intérêt :<br />
                <input type="checkbox" name="Sport" id="Sport" /> <label for="Sport">Sport</label><br />
                <input type="checkbox" name="Musique" id="Musique" /> <label for="Musique">Musique</label><br />
                <input type="checkbox" name="TV" id="TV" /> <label for="TV">TV</label><br />
                <input type="checkbox" name="Soiree" id="Soiree" /> <label for="Soiree">Soiree</label><br/>
                <input type="checkbox" name="Conference" id="Conference" /> <label for="Conference">Conference</label>

            </p>
            <p>
            Photo de profil : <br>
            <input name="fic" size=50 type="file" />
            </p>
            <p class = 'inscription'> 
                <input type="image" id="image" alt=" inscription"
                src="../Ressources/Inscription.png" width = "100" height = "100">
            </p>
        </form>
    </body>

</html>
