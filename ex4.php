<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    id: <input type="text" name="id">
    <input type="submit" value="Envoyer">
</form>
<?php
if($_SERVER['REQUEST_METHOD']=='POST') {
    include 'connecte.php';
    if(isset($_POST['id']) && !empty($_POST['id'])){
            $sql2="delete from Produits where id=:id";  
            $req2=$conn->prepare($sql2);
            if($req2->execute([":id"=>$_POST['id']])){
                if($req2->rowCount()>0)
                echo "produit a ete bien supprimer";
                else
                echo "aucune suppression";
            }
            else{
                echo "probleme lors de suppression ";
            }
    }
    else{
        echo "remplir";
    }
}
?>
</body>
</html>