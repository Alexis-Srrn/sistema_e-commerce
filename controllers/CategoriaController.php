<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';

class categoriaController{
    public function index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        require_once 'views/categoria/index.php';
    }

    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            //conseguir categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne();

            //conseguir productos
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
        }
        require_once 'views/categoria/ver.php';
    }

    public function crear(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function save(){
        Utils::isAdmin();
        if(isset($_POST) && isset($_POST['nombre'])){
            $_SESSION['categoria_creada'] = "complete";
            $categoria = new Categoria();
            $nombre = $_POST['nombre'];

            if(is_numeric($nombre) || preg_match("/[0-9]/",$nombre)){
                $_SESSION['categoria_creada'] = "failed";
                $_SESSION['categoria_error'] = "Ingrese una categoria valida";
            }
          
            if($_SESSION['categoria_creada'] != 'failed'){    
                $categoria->setNombre($nombre);
                $save = $categoria->save();
            }

            if($save){
                $_SESSION['categoria_creada'] = "complete";
            }else{
                $_SESSION['categoria_creada'] = "failed";
            }
        }else{
            $_SESSION['categoria_creada'] = "failed";
        }

   
        header("Location:".base_url."categoria/index");        
    }

    public function eliminar(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
        if(isset($_GET['id'])){
            $categoria = new Categoria();
            $categoria->setId($_GET['id']);
            $delete = $categoria->delete();
            
            if($delete){
                $_SESSION['categoria_eliminada'] = "complete";
            }else{
                $_SESSION['categoria_eliminada'] = "failed";
                $_SESSION['categoria_error'] = "Error en la consulta!!"; 
            }
        
        }else{
            $_SESSION['categoria_eliminada'] = "failed";
            $_SESSION['categoria_error'] = "No existe esa categoría!!!";  
        }
        header("Location:".base_url."categoria/index"); 
    }

}//fin de la clase categoriaController

?>