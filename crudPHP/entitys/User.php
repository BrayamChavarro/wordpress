<?php

include_once("./model/conDB.php");
    class User{
        private string $email;
        private string $password;
        private  $_con;

        public function __construct(){
            $con_db = new conDB();
            $this->_con = $con_db->con;
           
            
        

        }

// getters and setters
//refractar

        public function registrarUsuario(string $correo,string $contrasena){
            $this-> email = $correo;
            $this-> password = $contrasena;
            $query = "INSERT INTO users VALUES('$this->email','$this->password');";
            echo $query;
            if(mysqli_query($this->_con,$query)){
                echo "Registardo";

            }else{
                echo"error";
            }

        }

        public function todosUsuarios(){
            $query = "SELECT * FROM users";
            $resultado = mysqli_query($this->_con,$query);
            $data =array();
            while($row = mysqli_fetch_assoc($resultado)){
                $arr = array();
                $arr ["correo"] = ($row["use_email"]);   
                $arr ["contrasena"] = ($row["use_password"]);  
                $data[] = $arr;

            }
            mysqli_free_result($resultado);
            mysqli_close($this->_con);
            return $data;
        }
    }
?>