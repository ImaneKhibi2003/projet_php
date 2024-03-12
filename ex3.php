<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
if($_SERVER['REQUEST_METHOD']=='POST') {
    include 'connecte.php';
    if(isset($_POST['id'])&& isset($_POST['nom']) && isset($_POST['desc']) && isset($_POST['prix'])) { 
        if(!empty($_POST['id']) && !empty($_POST['nom']) && !empty($_POST['desc'] && !empty($_POST['prix']))) {
            $sql="update Produits set nom=:nom , description=:desc, prix=:prix where id=:id";
            $req=$conn->prepare($sql);
            if($req->execute([":id"=>$_POST['id'],":nom"=>$_POST['nom'],":desc"=>$_POST['desc'],":prix"=>$_POST['prix']])) {
                if($req->rowCount()>0)
                echo "produit bien modifiée";
                else
                echo "aucune modification";
            }
            else{
                echo "Erreur";
            }
        }
        else{
            echo "remplir les champs s'il vous plait!";
        }
    }
}
?>
<body>
    <h1>Changer les informations d'un produit</h1>
    <form action="" method="post" id="form1">
        id: <input type="text" name="id" id="code"><br>
        <span id="msg1"></span><br>
        Nom: <input type="text" name="nom" ><br>
        <span id="msg2"></span><br>
        Description: <input type="text" name="desc"><br>
        <span id="msg3"></span><br>
        Prix: <input type="text" name="prix"><br>
        <span id="msg4"></span><br>
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>