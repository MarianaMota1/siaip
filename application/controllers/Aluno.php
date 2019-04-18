<?php

class Aluno extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('alunoModel');
        $this->load->model('turmaModel');
    }

    public function index()
    {

    }

    public function novo()
    {
        $turmas = ['' => ''];
        $turmasTemp = $this->turmaModel->all();
        foreach ($turmasTemp as $turma) {
            $turmas[$turma['id']] = $turma['nome'] . " - " . $turma['serie'];
        }
        $this->form_validation->set_rules('nome', 'Nome', 'required|max_length[100]');
        $this->form_validation->set_rules('datanascimento', 'Date de Nascimento', 'required');
        $this->form_validation->set_rules('numeromatricula', 'Número de Matrícula', 'required|max_length[100]');
        $this->form_validation->set_rules('pai', 'Pai', 'max_length[100]');
        $this->form_validation->set_rules('telefonepai', 'Telefone do Pai', 'max_length[25]');
        $this->form_validation->set_rules('mae', 'Mãe', 'max_length[100]');
        $this->form_validation->set_rules('telefonemae', 'Telefone da Mãe', 'max_length[100]');
        if ($this->form_validation->run() == TRUE) {
            $campos = $this->input->post();
            $dados = ['nome' => $_POST['nome'], 'datanascimento' => $_POST['datanascimento'], 'numeromatricula' => $_POST['numeromatricula'], 'pai' => $_POST['pai'], 'telefonepai' => $_POST['telefonepai'], 'mae' => $_POST['mae'], 'telefonemae' => $_POST['telefonemae'], 'turma' => $_POST['turma']];
            $this->alunoModel->insert($dados);
            $this->session->set_flashdata('success', 'REGISTRO REALIZADO COM SUCESSO.');
            redirect('aluno');
        }
        return $this->load->view('aluno/novo', ['turmas' => $turmas]);
    }

}