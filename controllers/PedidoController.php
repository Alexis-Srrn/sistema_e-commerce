<?php
require_once 'models/pedido.php';

class pedidoController{
    
    public function hacer(){
        
        include_once 'views/pedido/hacer.php';
    }

    public function add(){
        if(isset($_SESSION['identity'])){
            $usuario_id = $_SESSION['identity']->id;
            $provincia = $_POST['provincia'] ?? false;
            $localidad = $_POST['localidad'] ?? false;
            $direccion = $_POST['direccion'] ?? false; 
            $stats = Utils::statsCarrito();
            $coste = $stats['total'];

            if($provincia && $localidad && $direccion){
                $pedido = new Pedido();

                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                $save = $pedido->save();

                //guardar linea pedido
                $save_linea = $pedido->save_linea();
                
                if($save && $save_linea){
                    $_SESSION['pedido'] = "complete";
                }else{
                    $_SESSION['pedido'] = "failed";
                }
            
            }else{
                $_SESSION['pedido'] = "failed";
            }
        }else{
            header("Location:".base_url.'pedido/confirmado');
        }
        header("Location:".base_url.'pedido/confirmado');
    }//function add

    public function confirmado(){
        if(isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuario_id($identity->id);
            $pedido = $pedido->getOneByUser();

            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductsByPedido($pedido->id);
        }
        require_once 'views/pedido/confirmado.php';
    }//function confirmado

    public function mis_pedidos(){
        Utils::isIdentity();

        $pedido = new Pedido();
        $usuario_id = $_SESSION['identity']->id;

        //sacar todos los pedidos del usuario
        $pedido->setUsuario_id($usuario_id);
        $pedidos = $pedido->getAllByUser();
        require_once 'views/pedido/mis_pedidos.php';
    }//function mis pedidos

    public function detalle(){
        Utils::isIdentity();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            //obtener los datos del pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();

            //obtener los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductsByPedido($id);

            require_once 'views/pedido/detalle.php';
        }else{
            header('Location:'.base_url.'pedido/mis_pedidos');
        }
    }//function detalle


    public function gestion(){
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        require_once 'views/pedido/mis_pedidos.php';
    }

    public function estado(){
        Utils::isAdmin();
        if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
            
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];

            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);
            $pedido->edit();

            header("Location:".base_url.'pedido/detalle&id='.$id);
        }else{
            header("Location:".base_url);
        }
    }




    
}

?>