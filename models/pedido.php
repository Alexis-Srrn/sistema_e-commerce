<?php

class Pedido{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    /**---CONEXION A LA BASE DE DATOS---*/
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }


    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getUsuario_id(){
        return $this->usuario_id;
    }


    public function setUsuario_id($usuario_id){
        $this->usuario_id = $usuario_id;
        return $this;
    }
    

    public function getProvincia(){
        return $this->provincia;
    }


    public function setProvincia($provincia){
        $this->provincia = $this->db->real_escape_string($provincia);
        return $this;
    }


    public function getLocalidad(){
        return $this->localidad;
    }


    public function setLocalidad($localidad){
        $this->localidad = $this->db->real_escape_string($localidad);
        return $this;
    }

    public function getDireccion(){
        return $this->direccion;
    }


    public function setDireccion($direccion)
    {
        $this->direccion =  $this->db->real_escape_string($direccion);
        return $this;
    }


    public function getCoste(){
        return $this->coste;
    }


    public function setCoste($coste){
        $this->coste = $coste;
        return $this;
    }

    public function getEstado(){
        return $this->estado;
    }


    public function setEstado($estado){
        $this->estado = $estado;
        return $this;
    }


    public function getFecha(){
        return $this->fecha;
    }


    public function setFecha($fecha){
        $this->fecha = $fecha;
        return $this;
    }


    public function getHora(){
        return $this->hora;
    }


    public function setHora($hora){
        $this->hora = $hora;
        return $this;
    }

    public function getAll(){
        $pedidos = $this->db->query("SELECT * FROM pedidos ORDER BY id DESC");
        return $pedidos;
    }

    public function getOne(){
        $pedidos = $this->db->query("SELECT * FROM pedidos WHERE id = {$this->getId()}");
        return $pedidos->fetch_object();
    }

    public function getOneByUser(){
        $sql = "SELECT p.id, p.coste FROM pedidos p " 
                ."WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC LIMIT 1";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }


    public function getAllByUser(){
        $sql = "SELECT p.* FROM pedidos p " 
                ."WHERE p.usuario_id = {$this->getUsuario_id()} ORDER BY id DESC";
        $pedido = $this->db->query($sql);
        return $pedido;
    }

    public function getProductsByPedido($id){
        //$sql = "SELECT * FROM productos WHERE id IN "
        //."(SELECT producto_id FROM lineas_pedidos WHERE pedido_id={$id})";

        $sql = "SELECT pr.*, lp.unidades FROM productos pr "
                . "INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id  "
                . "WHERE lp.pedido_id={$id}";

        $productos = $this->db->query($sql);
        return  $productos;
    }

    public function save(){
        $sql = "INSERT INTO pedidos VALUES(NULL,{$this->getUsuario_id()},'{$this->getProvincia()}', '{$this->getLocalidad()}','{$this->getDireccion()}', {$this->getCoste()}, 'confirm', CURDATE(), CURTIME());";

        try{
        $save = $this->db->query($sql);
        }catch(exception $e){
            echo "Error: " . $e->getMessage();
        }
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function save_linea(){
        $sql = "SELECT LAST_INSERT_ID() as 'pedido'";
        try{
            $save = $this->db->query($sql);
            $pedido_id = $save->fetch_object()->pedido;
            foreach($_SESSION['carrito'] as $elemento){
                $producto = $elemento['producto'];
                
                $insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$producto->id},{$elemento['unidades']})";
                $save = $this->db->query($insert);

            }

            }catch(exception $e){
                echo "Error: " . $e->getMessage();
            }
            $result = false;
            if($save){
                $result = true;
            }
            return $result;
    }


    public function edit(){
        $sql = "UPDATE pedidos SET estado='{$this->getEstado()}' WHERE id={$this->getId()}";
        
        try{
        $save = $this->db->query($sql);
        }catch(exception $e){
            echo "Error: " . $e->getMessage();
        }
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }
    /*

    public function getAll(){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
        return $productos;
    }

    public function getAllCategory(){
        $sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
        . "INNER JOIN categorias c ON c.id = p.categoria_id "
        . "WHERE p.categoria_id = {$this->getCategoria_id()} "
        . "ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getOne(){
        $productos = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");
        return $productos->fetch_object();
    }

    public function getRandom($limit){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
        return $productos;
    }

    public function save(){
        $sql = "INSERT INTO productos VALUES(NULL,{$this->getCategoria_id()},'{$this->getNombre()}', '{$this->getDescripcion()}',{$this->getPrecio()}, {$this->getStock()}, NULL, CURDATE(), '{$this->getImagen()}')";

        try{
        $save = $this->db->query($sql);
        }catch(exception $e){
            echo "Error: " . $e->getMessage();
        }
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function edit(){
        $sql = "UPDATE productos SET nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()}, categoria_id={$this->getCategoria_id()} ";
        if($this->getImagen() !=null){
            $sql .= ", imagen='{$this->getImagen()}'";
        }

        $sql .= "WHERE id={$this->getId()}";
        try{
        $save = $this->db->query($sql);
        }catch(exception $e){
            echo "Error: " . $e->getMessage();
        }
        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function delete(){
        $sql = "DELETE FROM productos WHERE id={$this->id}";
        try{
            $delete = $this->db->query($sql);
        }catch(exception $e){
            echo "Error: " . $e->getMessage();
        }
        $result = false;
        if($delete){
            $result = true;
        }
        return $result;

    }
*/

}//fin de la clase Producto


?>