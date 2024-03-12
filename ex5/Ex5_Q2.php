<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php include("connection TP3EX5.php"); ?>
    <script src="jquery-3.7.0.js" ></script>
    <title>Document</title>
</head>
<body>
<section>
    <form action="" method="post">
        <div>
            <label>Salle:</label>
            <select name="list_salle" id="list_salle">
                <?php
                include ("connection TP3EX5.php");
                $sql = 'SELECT DISTINCT salle FROM examen';
                $req = $connection -> prepare($sql);

                if($req -> execute())
                {
                    $result = $req -> fetchAll(PDO::FETCH_NUM);
                    foreach($result as $v)
                    {
                        echo "<option>$v[0]</option>";
                    }
                }
                ?>

            </select>
        </div>

        <input type="submit" name="" value="Recherche">

    </form>
</section>



<?php


if($_SERVER["REQUEST_METHOD"]   == 'POST')
{
    $sql_salle_info  = "SELECT id,date,type FROM `examen` WHERE salle like :salle";

    $req_salle_info = $connection -> prepare($sql_salle_info);


    if($req_salle_info->execute([":salle"=>$_POST['list_salle']]))
    {
        $salle_info = $req_salle_info ->fetchAll(PDO::FETCH_ASSOC);


        echo "<script> $('#list_salle').val('".$_POST['list_salle']."') </script>";

        echo "<table class='Ex5_table' >";
        echo "<tr><th>Examen</th><th>Date</th><th>Type</th></tr>";

        foreach($salle_info as $v)
        {
            echo "<tr>";
            echo "<td>".$v["id"]."</td>";
            echo "<td>".$v["date"]."</td>";
            echo "<td>".$v["type"]."</td>";
            echo "</tr>";

        }

        echo "</table>";
    }       







 
}

?>
</body>
</html>


