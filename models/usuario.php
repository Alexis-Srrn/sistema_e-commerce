<?php



class Usuario
{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    /**---CONEXION A LA BASE DE DATOS---*/
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    /**-----GETTERS*** */
    public function getId(){
        return $this->id;
    }

    public function getNombre(){
        return  $this->nombre;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 4]);
    }

    public function getRol(){
        return $this->rol;
    }

    public function getImagen(){
        return $this->imagen;
    }

    /***----SETTERS-.** */

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    public function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
        return $this;
    }

    public function setPassword($password){
        $this->password =  $this->db->real_escape_string($password);
        return $this;
    }

    public function setRol($rol){
        $this->rol = $rol;
        return $this;
    }

    public function setImagen($imagen){
        $this->imagen = $imagen;
        return $this;
    }

    public function save(){
        $sql = "INSERT INTO usuarios VALUES(NULL,'{$this->getNombre()}','{$this->getApellidos()}', '{$this->getEmail()}','{$this->getPassword()}', 'user', NULL)";
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

    public function searchEmail($email){
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $search = $this->db->query($sql);
        $email_encontrado = mysqli_num_rows($search);
        $result = false;
        if($email_encontrado > 0){
            $result = true;    
        }
        return $result;
    }

    public function Login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;
        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        $login = $this->db->query($sql);
        if($login->num_rows){
            $usuario = $login->fetch_object();
            $verify = password_verify($password, $usuario->password);
            if($verify){
                $result = $usuario;
            }
            return $result;
        }

    }





} //clase Usuario
