<?php
class Contact {
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }
    
    public function addContact($data) {
        $this->db->query("INSERT INTO contatos (nome, email, telefone, mensagem) 
                         VALUES (:nome, :email, :telefone, :mensagem)");
        
        $this->db->bind(':nome', $data['nome']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telefone', $data['telefone']);
        $this->db->bind(':mensagem', $data['mensagem']);
        
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getContacts() {
        $this->db->query("SELECT * FROM contatos ORDER BY data_envio DESC");
        return $this->db->resultSet();
    }
    
    public function updateStatus($id, $status) {
        $this->db->query("UPDATE contatos SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        
        return $this->db->execute();
    }
}
?>