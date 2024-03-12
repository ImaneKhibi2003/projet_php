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
            <label class="Q3" for="examen">Examen</label>
            <select name="list_examen" id="list_examen">
                <option value="*">*</option>
                <?php
                $sql_get_examen = 'select distinct examen from notes';
                $req_get_examen = $connection -> prepare($sql_get_examen);

                if($req_get_examen -> execute())
                {
                    $result_get_examen = $req_get_examen->fetchAll(PDO::FETCH_NUM);

                    foreach ($result_get_examen as $v)
                    {
                        echo "<option>".$v[0]."</option>";
                    }
                }

                ?>
            </select>


            <label class="Q3"  for="stagiaire">Stagiaire</label>
            <select name="list_stagiaire" id="list_stagiaire">
                <option value="*">*</option>
                <?php
                $sql_get_stagiaire = 'select distinct stagiaire from notes';
                $req_get_stagiaire = $connection -> prepare($sql_get_stagiaire);

                if($req_get_stagiaire -> execute())
                {
                    $result_get_stagiaire = $req_get_stagiaire->fetchAll(PDO::FETCH_NUM);

                    foreach ($result_get_stagiaire as $v)
                    {
                        echo "<option>".$v[0]."</option>";
                    }
                }

                ?>
            </select>
        </div>

        <input type="submit" value="Recherche">
    </form>
</section>



<?php


       if ($_SERVER["REQUEST_METHOD"] == "POST")
       {

           $sql_get_info = "select * from notes ";

            $binding = [];
            if($_POST["list_examen"] != "*" && $_POST["list_stagiaire"] == "*")
           {
               $sql_get_info .= "where examen = :examen";
               $binding = [":examen" => $_POST["list_examen"]];

           }
           else if($_POST["list_examen"] == "*" && $_POST["list_stagiaire"] != "*")
           {
               $sql_get_info = "select * from notes where stagiaire = :stagiaire";
               $binding = [":stagiaire" => $_POST["list_stagiaire"]];
           }
           else if($_POST["list_examen"] != "*" && $_POST["list_stagiaire"] != "*")
           {

               $sql_get_info .= "where examen = :examen and stagiaire = :stagiaire";
               $binding = [":examen" => $_POST["list_examen"],":stagiaire" => $_POST["list_stagiaire"]];


           }


        $req_get_info = $connection ->prepare($sql_get_info);
        if($req_get_info -> execute($binding))
        {
            $result = $req_get_info -> fetchAll(PDO::FETCH_ASSOC);

            echo "<script> $('#list_examen').val('".$_POST['list_examen']."');
                           $('#list_stagiaire').val('".$_POST['list_stagiaire']."');
    
                    </script>";

            echo "<table class='Ex5_table' >";
            echo "<tr><th>Stagiaire</th><th>Examen</th><th>Note</th></tr>";

            foreach($result as $v)
            {
                echo "<tr>";
                echo "<td>".$v["Stagiaire"]."</td>";
                echo "<td>".$v["Examen"]."</td>";
                echo "<td>".$v["note"]."</td>";
                echo "</tr>";

            }
            echo "</table>";

        }




    }
?>
</body>
</html>



