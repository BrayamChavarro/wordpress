<?php
require_once("./util/config.php");

class conDb{

    //propiedad
    public $con = null;
    //constructores
    public function __construct(){
        try{
            $this->con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

            if(mysqli_connect_error()){
                echo"error". mysqli_connect_error();
            }else {
                echo"conectado con exito";
            }
        }catch(Exeptions $e){
            var_dump($e);
            echo"error en conexion". mysqli_connect_error();

        }
    }
}
?>