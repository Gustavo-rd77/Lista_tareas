<?php 
   class DataBase{
         static function connect(){
            $connection = new mysqli("localhost","root","","tasks-app");
            if($connection->connect_errno){
               echo "Error de conección";
               exit();
           }
           return $connection;
         }
   }

  

?>