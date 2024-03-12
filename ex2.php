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
<button value="Affciher" type="submit">Afficher les produits</button>
</form>
</body>
</html>
<?php
    include'connecte.php';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $sql="select * from Produits";
        $req=$conn->prepare($sql);
        if($req->execute()){
            $mes_Produits=$req->fetchAll(PDO::FETCH_ASSOC);
            foreach($mes_Produits as $r) {
                echo "<ul>";
                echo "<li>".$r["id"]."</li>";
                echo "<li>".$r["nom"]."</li>";
                echo "<li>".$r["description"]."</li>";
                echo "<li>".$r["prix"]."</li>";
                echo "</ul><br><br>";        
            }
        }
        else{
            echo "Erreur";
        }
    }
?>