<?php
    namespace App\Http\Controllers;

    require_once $_ENV["APP_ROOT"]."/app/model/Entities/interfaces/ILogin.php";
    
    class Login implements ILogin {
        private string $name;
        private string $password;
        private string $rol;
        private $cursos = array();

        public function setName($name) { $this->name = $name;}
        public function setPassword($password) { 
            $this->password = $password;
        }

        public function getName() { return $this->name; }
        public function getPassword() { return $this->password; }

        public function getRol($name,$con) { 
            $filter = ['user' => $this->name];
            $options = [];
            $query = new \MongoDB\Driver\Query($filter,$options);
            $rows = $con->executeQuery('rubrica.usuaris',$query);

            return $rows->toArray()[0]->rol;
        }

        public function getCursos($name,$con) { 
            $filter = ['user' => $this->name];
            $options = [];
            $query = new \MongoDB\Driver\Query($filter,$options);
            $rows = $con->executeQuery('rubrica.usuaris',$query);

            return $rows->toArray()[0]->cursos;
        }


        public function getStudents($con) { 
            $filter = ['rol' => "student"];
            $options = [ 'projection' => ['password' => 0 , '_id' => 0]];
            $query = new \MongoDB\Driver\Query($filter,$options);
            $rows = $con->executeQuery('rubrica.usuaris',$query);

            return $rows->toArray();
        }

        public function getStudent($con,$user) { 
            $filter = ['rol' => "student",'user' => $user];
            $options = [ 'projection' => ['password' => 0 , '_id' => 0]];
            $query = new \MongoDB\Driver\Query($filter,$options);
            $rows = $con->executeQuery('rubrica.usuaris',$query);

            return $rows->toArray();
        }

        public function update($con,$userData) { 
            $bulk = new \MongoDB\Driver\BulkWrite(['ordered'=>true]);
            $user = json_decode($userData,false);
            $bulk->update(['user'=>$user->nom],['$set' => ['password'=>$user->password]]);
            $result = $con->executeBulkWrite('rubrica.usuaris', $bulk);
            return [$result];
        }


        public function sameName($name) { return $this->name == $name;}

        public function  autentificar($con) {
            $filter = ['user' => $this->name];
            $options = [];
            $query = new \MongoDB\Driver\Query($filter,$options);
            $rows = $con->executeQuery('rubrica.usuaris',$query);

            if (password_verify($this->password,$rows->toArray()[0]->password)) 
                return 1;
            else {
                return 0;
            }

            //return count($rows->toArray());
        }

        public function toString() {
            return "Usuari: {$this->name} Password: {$this->password} Rol: {$this->rol}";
        }
    }