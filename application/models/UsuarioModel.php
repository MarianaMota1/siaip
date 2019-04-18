<?php

class UsuarioModel extends CI_Model
{
    public function getEmailSenha($email, $senha){
        $this->db->where('email', $email);
        $this->db->where('senha', $senha);
        return $this->db->get('usuario')->row_array();
    }

    public function all(){
        return $this->db->order_by('nome', 'ASC')->get('usuario')->result();
    }
    
    public function delete($id){
		$this->db->delete('usuario', ['id' => $id]);
	}
    
    public function insert($dados){
		$this->db->insert('usuario', $dados);
	}
	
	public function getId($id){
        $this->db->where('id', $id);
        return $this->db->get('usuario')->row_array();
    }
    
    public function update($id, $dados){
		$this->db->where('id', $id);
		$this->db->update('usuario', $dados);
	}
	
	public function allNivel($nivel){
        return $this->db->where('nivel', $nivel)->order_by('nome', 'ASC')->get('usuario')->result();
    }
}
