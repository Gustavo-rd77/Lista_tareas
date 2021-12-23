<?php 

    require_once 'controller_task.php';
    
    if(isset($_GET['action'])){
       
        $controller = new ControllerTask();
        $action = $_GET['action'];
        
        if(method_exists($controller,$action)){
           
            $controller->$action();
        }
    }

?>