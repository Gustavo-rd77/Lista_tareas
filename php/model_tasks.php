<?php
    require_once 'connection.php';
    class ModelTasks{
        private $id;
        private $name;
        private $description;
        private $db;
        
        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        
        public function getName()
        {
                return $this->name;
        }

    
        public function setName($name)
        {
                $this->name = $this->db->real_escape_string($name);

                return $this;
        }

      
        public function getDescription()
        {
                return $this->description;
        }

      
        public function setDescription($description)
        {
                $this->description = $this->db->real_escape_string($description);

                return $this;
        }

        function __construct(){
            $this->db=DataBase::connect();
        }

        public function search(){
            $sql = "SELECT * FROM tareas WHERE name LIKE '{$this->name}%' ";
            $query = $this->db->query($sql);
            return $query;
        }

        public function add_task(){
            $sql = "INSERT INTO tareas VALUES(NULL,'{$this->name}','{$this->description}')";
            $save = $this->db->query($sql);
            $result = false;
            if($save){
                $result = true;
            }
            return $result;
        }

        public function getAll(){
            $sql = "SELECT * FROM tareas";
            $query = $this->db->query($sql);
            return $query;
        }

        public function delete_task(){
            $sql = "DELETE FROM tareas WHERE id={$this->id}";
            $query=$this->db->query($sql);
            $result=false;
            if($query){
                $result = true;
            }
            return $result;
        }

        public function getOne(){
            $sql = "SELECT * FROM tareas WHERE id = {$this->id}";
            $query = $this->db->query($sql);
            return $query;
        }
        
        public function updateTask(){
            $sql = "UPDATE tareas SET name='{$this->getName()}', description='{$this->getDescription()}' WHERE id = {$this->id}";
            $save = $this->db->query($sql);
            $result=false;
            if($save){
                $result = true;
            }
            return $result;

        }
    }
?>