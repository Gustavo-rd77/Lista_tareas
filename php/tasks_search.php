<?php 
   require_once 'model_tasks.php';
   $task = new ModelTasks();
    if(isset($_POST['search']) && isset($_GET['id'])){
        $task->setName($_POST['search']);
        $task_search = $task->search();
        $json = array();
        if($task_search->num_rows > 0){
            while($result = $task_search->fetch_object()){
                $json[]= array("name"=>$result->name,"description"=>$result->description);
            }
            
            echo json_encode($json);
        }
    }
