 <?php
             //  Conect To DataBase

             
 $dsn ='mysql:host=localhost;dbname=shop';
 $user ='root';
 $pass ='';
 $option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
 );
 try {
    $con = new PDO ($dsn, $user, $pass, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   //  echo 'You Are Connected Welcome TO';
 }
 catch(PDOException $e) {
    echo 'Faild To Conect ' .$e->getMessage();
 }


 ?>