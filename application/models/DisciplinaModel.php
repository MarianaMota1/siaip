<?php

class DisciplinaModel extends CI_Model{
	
	public function all(){
		return $this->db->order_by('nome', 'ASC')->get('disciplina')->result_array();
	}
	
	public function insert($dados){
		$this->db->insert('disciplina', $dados);
	}
	
	public function getId($id){
        $this->db->where('id', $id);
        return $this->db->get('disciplina')->row_array();
    }
	
	public function update($id, $dados){
		$this->db->where('id', $id)->update('disciplina', $dados);
	}
	
	public function delete($id, $dados){
		$this->db->delete('disciplina', ['id' => $id]);
	}
}
