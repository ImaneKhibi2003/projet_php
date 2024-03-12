<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.7.0.js" ></script>
    <title>Document</title>
</head>
<?php
include("connection TP3EX5.php");
?>
<body>
<?php
if($_SERVER["REQUEST_METHOD"]   == 'POST'){
    if ($_POST["list_id"] != "")
    {
        $sql_get_info = 'select nom,prenom,telephone from stagiaire where numero  = :numero';
        $req_get_info = $connection -> prepare($sql_get_info);
        if($req_get_info -> execute([":numero" => $_POST["list_id"]]) )
        {
            $resulted_info = $req_get_info ->fetchAll(PDO::FETCH_ASSOC);
            $nom = $resulted_info[0]["nom"];
            $prenom = $resulted_info[0]["prenom"];
            $telephone = $resulted_info[0]["telephone"];
        }
    }
}
?>
<section>
    <form action="" method="post" id="form">
        <div>
            <label>Stagiaire</label>
            <select name="list_id" id="list_id">
                <option value=""></option>
                <?php
                $sql_getIDs = 'select numero from stagiaire';
                $req_getIDs = $connection -> prepare($sql_getIDs);
                if($req_getIDs -> execute())
                {
                    $id_tab =  $req_getIDs -> fetchAll(PDO::FETCH_NUM);
                    foreach ($id_tab as $v)
                    {    
                        if(isset($_POST["list_id"]) && $v[0] == $_POST["list_id"] )
                        echo "<option value='$v[0]' selected> $v[0]</option>";
                        else
                        echo "<option value='$v[0]'> $v[0]</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div>
            <label for="nom">Nom:</label>
            <input type="text" name="nom"  id="nom" value="<?php echo (isset($nom)) ? $nom:''; ?>">
        </div>
        <div>
            <label for="prenom">Prenom:</label>
            <input type="text" name="prenom" id="prenom" value="<?php echo (isset($prenom)) ? $prenom:''; ?>">
        </div>

        <div>
            <label for="telephone">Telephone:</label>
            <input type="text" name="telephone" id="telephone" value="<?php echo (isset($telephone)) ? $telephone:''; ?>">
        </div>
    </form>
</section>
<script>
    $("#list_id").change(() => {$('form').submit();})
</script>
</body>
</html>


