<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src=""></script>
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    nom: <input type="text" name="nom"><br>
    description: <input type="text" name="description"><br>
    prix: <input type="text" name="prix"><br>
    <input type="submit" value="Envoyer">
</form>
<script>
</script>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $servername="localhost";
    $databasename="ex1";
    $user="root";
    $pass="";
    try {
        $conn=new PDO("mysql:host=$servername;dbname=$databasename",$user,$pass);
    }
    catch(PDOException $e) {
        echo $e->getMessage();
        exit();
    }
    try {
        if(isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['prix'])) {
            $nom=$_POST['nom'];
            $desc=$_POST['description'];
            $prix=$_POST['prix'];
            $sql="insert into Produits (nom,description,prix) values (:nom,:desc,:prix)";
            $req=$conn->prepare($sql);
            if($req->execute([":nom"=>$nom,":desc"=>$desc,":prix"=>$prix])) {
                echo "produit bien ajouté";
            }
            else {
                echo "Erreur";
            }
        }
    }
    catch(PDOException $e)
    {
        echo " erreur lors de l'insertion";
    }
}
?>
</body>
</html>