<?php

class TurmaProfessorModel extends CI_Model
{

    public function insert($dados)
    {
        $this->db->insert('turma_professor', $dados);
    }

    public function allOfProfessor($professor)
    {
        $this->db->select('turma_professor.*, disciplina.nome as disciplina_nome, turma.nome as turma_nome, turma.serie as turma_serie');
        $this->db->join('disciplina', 'disciplina.id = turma_professor.disciplina');
        $this->db->join('turma', 'turma.id = turma_professor.turma');
        $this->db->where('turma_professor.professor', $professor);
        return $this->db->order_by('turma.nome', 'ASC')->order_by('disciplina.nome', 'ASC')->get('turma_professor')->result();
    }

    public function allDisciplinaProfessor($disciplina, $professor)
    {
        $this->db->where('disciplina', $disciplina)->where('professor', $professor);
        return $this->db->get('turma_professor')->result();
    }

    public function delete($id)
    {
        $this->db->delete('turma_professor', ['id' => $id]);
    }
}