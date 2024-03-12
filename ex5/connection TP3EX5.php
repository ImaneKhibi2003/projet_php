<?php

      try
      {
        $server_name = "localhost";
        $db_name = "ecole";
        $login = "root";
        $password = "";
        $connection = new PDO("mysql:host=$server_name;dbname=$db_name",$login,$password);

      }
      catch(PDOException $ex)
      {
        echo $ex->getMessage();
      }


        
       ?>