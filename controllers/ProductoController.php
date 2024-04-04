<?php
require_once 'models/producto.php';

class productoController{
    public function index(){
        $producto = new Producto();
        $productos = $producto->getRandom(6);
        //renderizar vistas
        require_once 'views/producto/destacados.php';
    }

    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();
        }
        require_once 'views/producto/ver.php';
    }

    public function gestion(){
        Utils::isAdmin();
        $producto = new Producto();
        $productos = $producto->getAll();
        require_once 'views/producto/gestion.php';
    }

    public function crear(){
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function save(){
        Utils::isAdmin();
        if(isset($_POST)){
            $nombre = $_POST['nombre'] ?? false;
            $descripcion = $_POST['descripcion'] ?? false;
            $precio = $_POST['precio'] ?? false;
            $stock = $_POST['stock'] ?? false;
            $categoria = $_POST['categoria'] ?? false;
            //$imagen = $_POST['imagen'] ?? false;

            if($nombre && $descripcion && $precio && $stock && $categoria){
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);

                //guardar img
                if(isset($_FILES['imagen'])){
                    $file= $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];
    
                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif"){
                        if(!is_dir('uploads/images')){
                            mkdir('uploads/images', 0777, true);
                        }
                        $producto->setImagen($filename);
                        move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);  
                    }
                }

                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    $producto->setId($id);
                    $save =$producto->edit();
                }else{
                    $save = $producto->save();
                }
                if($save){
                    $_SESSION['producto_creado'] = "complete";
                }else{
                    $_SESSION['producto_creado'] = "failed";
                }
            }else{
                $_SESSION['producto_creado'] = "failed";
                $_SESSION['producto_error'] = "Error en los datos!!";
            }

        }else{
            $_SESSION['producto_creado'] = "failed";
            $_SESSION['error_producto'] = "Ningún campo puede estar vacio!";
        }

        header('Location:'.base_url.'producto/gestion');
    }//funcion save


    public function editar(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $edit = true;
            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();
            require_once 'views/producto/crear.php';
        }else{
            header('Location:'.base_url.'producto/gestion');
        }
        
    }//función editar

    public function eliminar(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);
            $delete = $producto->delete();

            if($delete){
                $_SESSION['producto_eliminado'] = 'complete';
            }else{
                $_SESSION['producto_eliminado'] = 'failed';
                $_SESSION['producto_error'] = 'No se pudo eliminar el producto';
            }
        }else{
            $_SESSION['producto_eliminado'] = 'failed';
            $_SESSION['producto_error'] = 'No existe el ID del producto a eliminar';
        }
        header('Location:'.base_url.'producto/gestion');
    }//función eliminar

}

?>