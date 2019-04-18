<?php

class TurmaModel extends CI_Model
{
    public function all()
    {
        return $this->db->order_by('nome', 'ASC')->get('turma')->result_array();
    }

    public function insert($dados)
    {
        $this->db->insert('turma', $dados);
    }

    public function getId($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('turma')->row_array();
    }

    public function update($id, $dados)
    {
        $this->db->where('id', $id)->update('turma', $dados);
    }

    public function delete($id, $dados)
    {
        $this->db->delete('turma', ['id' => $id]);
    }
}