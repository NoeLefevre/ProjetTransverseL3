<?php
try
    {
        $bdd = new PDO('mysql:host=35.240.56.92;dbname=projetevenement; charset=utf8;port=3306', 'root', 'fbq6dwab');
    }
    catch(Exception $e)
    {

            die('Erreur : '.$e->getMessage());
           
    }
    ?>