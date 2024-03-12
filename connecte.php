<?php
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
?>