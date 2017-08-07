<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=whereis', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}		

if (isset ($_POST['valider'])){
                $nom=$_POST['nom'];
                $prenom=$_POST['prenom'];
                $dbh->exec("INSERT INTO Scores(name,score,ts) VALUES('$nom','$prenom',CURRENT_TIMESTAMP)");
            }
			

?>