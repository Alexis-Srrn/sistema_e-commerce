<?php
require_once 'models/usuario.php';

class usuarioController{
    public function index(){
        echo "Controlador Usuarios, Acción index";
    }

    public function registro(){
        require_once'views/usuario/registro.php';
    }

    public function save(){
        
        if(isset($_POST)){
            $usuario = new Usuario();
            $nombre = $_POST['nombre'] ?? null;
            $apellidos = $_POST['apellidos'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            $email_exist = false;


            if(!$nombre || is_numeric($nombre) || preg_match("/[0-9]/",$nombre)){
                $_SESSION['register'] = "failed";
                $_SESSION['error'] = "Ingrese un nombre valido!!!";
            }


            if(!$apellidos || is_numeric($apellidos) || preg_match("/[0-9]/",$apellidos)){
                $_SESSION['register'] = "failed";
                $_SESSION['error'] = "Ingrese apellidos validos!!";
            }

            if(!$email){
                $_SESSION['register'] = "failed";
                $_SESSION['error'] = "Ingrese un email valido";
            }
            $email_exist = $usuario->searchEmail($email);
            if($email_exist){
                $_SESSION['register'] = "failed";
                $_SESSION['error'] = "El email ya está registrado en el sistema!!!";
            }


            
            if(!$password){
                $_SESSION['register'] = "failed";
                $_SESSION['error'] = "Campo password vacio";
            }




            if($_SESSION['register'] != "failed"){               
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $save = $usuario->save();
            }
            if($save){
                $_SESSION['register'] = "complete";
            }else{
                $_SESSION['register'] = "failed";
            }
        }else{
            $_SESSION['register'] = "failed";
        }
        header("Location:".base_url.'usuario/registro');

    }

    public function login(){
        if(isset($_POST)){
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            
            $identity = $usuario->Login();
            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;
                
                if($identity->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
                
            }else{
                $_SESSION['error_login'] = "Identificación fallida!!";
            }
        }
        header("Location:".base_url);
    }


    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
            unset($_SESSION['error_login']);
        }
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }

        header("Location:".base_url);

    }


    




}//Fin de la clase

?>