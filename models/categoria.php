<?php
class Categoria{
    private $id;
    private $nombre;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;        
    }


    public function setId($id){
        $this->id = $id;
    }

    public function setNombre($nombre){
        $this->nombre =  mysqli_real_escape_string($this->db, $nombre);
    }

    public function getAll(){
        $sql = "SELECT * FROM categorias ORDER BY id DESC";
        $categorias = $this->db->query($sql);
        return $categorias;
    }

    public function getOne(){
        $sql = "SELECT * FROM categorias WHERE id={$this->getId()}";
        $categoria = $this->db->query($sql);
        return $categoria->fetch_object();
    }

    public function save(){
        $sql = "INSERT INTO categorias VALUES(null,'{$this->getNombre()}')";
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
        $comprobar = $this->comprobarCategoria();

        if($comprobar){
            $sql = "DELETE FROM categorias WHERE id='{$this->getId()}'";
            try{
                $delete = $this->db->query($sql);
            }catch(exception $e){
                echo "Error: " . $e->getMessage();
            }
            $result = false;
            if($delete){
                $result = true;
            }
        }else{
            $result = false;
        }
        
        return $result;
    }


    public function comprobarCategoria(){
        $sql = "SELECT * FROM categorias WHERE id='{$this->getId()}'";
        try{
            $search = $this->db->query($sql);
        }catch(exception $e){
            echo "Error: " . $e->getMessage();
        }
        $result = false;
        $categoria_encontrada = mysqli_num_rows($search);
        if($categoria_encontrada > 0){
            $result = true;
        }
        return $result;
    }

}//fin de la clase

?>