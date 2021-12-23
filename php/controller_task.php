<?php
require_once 'model_tasks.php';
class ControllerTask{
    
    public function taskSearch(){
        if(isset($_POST['search'])){
            $task = new ModelTasks();
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
    }

    public function saveTask(){
        if(isset($_POST)){
            $name = isset($_POST['name'])?$_POST['name']:false;
            $description = isset($_POST['description'])?$_POST['description']:false;
            if($name && $description){
            
                $task = new ModelTasks();
                $task->setName($name);
                $task->setDescription($description);
                $task->add_task();
            }
        }
    }

    public function tasksAll(){
        $task = new ModelTasks();
        $result = $task->getAll();
        if($result->num_rows > 0){
            $json = array();
            while($obj = $result->fetch_object()){
                $json[] = array('id'=>$obj->id,'name'=>$obj->name,'description'=>$obj->description); 
            }
            echo json_encode($json);
        }
    }

    public function delete(){
        if(isset($_GET['id'])){
            $task = new ModelTasks();
            $id= intval($_GET['id']);
            $task->setId($id);
            $delete = $task->delete_task(); 
            if($delete){
                echo "Elemento borrado";
            }
            
        }
        

    }

    public function getOneTask(){
        if(isset($_GET['id'])){
            $task = new ModelTasks();
            $id= intval($_GET['id']);
            $task->setId($id);
            $result = $task->getOne(); 
            $dato = $result->fetch_object();
            $json = array('id'=>$dato->id,'name'=>$dato->name,'description'=>$dato->description);
            echo json_encode($json);
            
        }
    }

    public function upDateTask(){
        if(isset($_POST)){
            $name = isset($_POST['name'])?$_POST['name']:false;
            $description = isset($_POST['description'])?$_POST['description']:false;
            $id = isset($_POST['id'])?$_POST['id']:false;
            if($name && $description && $id){
            
                $task = new ModelTasks();
                $id = intval($id);
                $task->setId($id);
                $task->setName($name);
                $task->setDescription($description);
               
                $task->updateTask();
            }
        }
    }

    
}

?>