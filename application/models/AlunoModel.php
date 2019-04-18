<?php

class AlunoModel extends CI_Model{
	
	public function insert($dados){
		$this->db->insert('aluno', $dados);
	}
}
