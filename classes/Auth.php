<?php
class Auth {
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }
    
    public function login($usuario, $senha) {
        $this->db->query("SELECT * FROM usuarios WHERE usuario = :usuario");
        $this->db->bind(':usuario', $usuario);
        
        $row = $this->db->single();
        
        if($row) {
            $hashed_password = $row->senha;
            if(md5($senha) == $hashed_password) {
                return $row;
            }
        }
        
        return false;
    }
    
    public function getUserById($id) {
        $this->db->query("SELECT * FROM usuarios WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
?>