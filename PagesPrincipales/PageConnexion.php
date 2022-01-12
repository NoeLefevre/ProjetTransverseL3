<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href = "../Styles/PageConnexion.css"/>
        <meta charset="utf-8" />
        
    </head>
    <body>
        <p class="titre"> Connexion </p>
        <form class="Searchbox" action ="../PagesTraitement/TraitementConnexion.php" method="post">
            <div class="wrapper">
                <label for="text"></label>
                <p class = "marge">
                Adresse mail : <br>
                <input type="text" size="66"id="t" style="height:40px;" name="Email" />
            </p>
            <p class = "marge2">
                Mot de passe : <br>
                <input type="password" size= "66"id="t" style="height:40px;" name="MotDePasse" />
            </p>
            <p class = 'inscription'> 
                <input type="image" id="image" alt=" inscription"
                src="../Ressources/connexion.png" width = "100" height = "100">
            </p>
            </div>
        </form>

</body>
</html>