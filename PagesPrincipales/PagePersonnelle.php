<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../Styles/PageInscription.css"/>
        <meta charset="utf-8" />
        
    </head>
    <body>
        <form class="Searchbox" action ="../PagesTraitement/TraitementInscription.php" method="post">
            <div class="wrapper">
                <label for="text"></label>
                <input type="text" id="text" name="Nom" placeholder ="Nom">
                <input type="text" id="text" name="Prenom" placeholder ="Prenom">
                <input type="email" id="text" name="Email" placeholder ="Email">
                <input type="text" id="text" name="Adresse" placeholder ="Adresse">
                <input type="text" id="text" name="Age" placeholder ="Age">
                <input type="password" id="text" name="MotDePasse" placeholder ="MotDePasse">
                <input type="date" id="text" name="DateNaissance" placeholder ="DateNaissance">
            </div>
                <H2> Centre d'intéret </h2>
                <input type="checkbox" name="Sport" id="sport" /> <label for="sport">Sport</label><br />
                <input type="checkbox" name="Musique" id="musique" /> <label for="musique">Musique</label><br />
                <input type="checkbox" name="TV" id="tv" /> <label for="tv">TV</label><br />
                <input type="checkbox" name="Soiree" id="soiree" /> <label for="soiree">Soiree</label><br />
                <input type="checkbox" name="Conference" id="conference" /> <label for="conference">Conference</label><br />
            <div class="wrapper">
                <input type = "submit" name = "s" value = "valider">
            </div>
        </form>

</body>
</html>