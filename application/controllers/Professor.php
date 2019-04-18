<?php

class Professor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuarioModel');
        $this->load->model('disciplinaModel');
        $this->load->model('turmaProfessorModel');
        $this->load->model('turmaModel');
    }

    public function index()
    {
        $usuarios = $this->usuarioModel->allNivel('PROFESSOR');
        foreach ($usuarios as $value) {
            $disciplinas = $this->turmaProfessorModel->allOfProfessor($value->id);
            $disciplina_str = "";
            foreach ($disciplinas as $valueDisciplina) {
                $disciplina_str .= $valueDisciplina->disciplina_nome . " - " . $valueDisciplina->turma_nome . " - " . $valueDisciplina->turma_serie . "<br> ";
            }
            $value->disciplinas = $disciplinas;
            $value->disciplina_str = $disciplina_str;
        }
        $dados = ['usuarios' => $usuarios];
        return $this->load->view('professor/index', $dados);
    }

    public function novo()
    {
        $disciplinas = $this->disciplinaModel->all();
        $this->form_validation->set_rules('nome', 'Nome', 'required|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('confirmarsenha', 'Confirmar Senha', 'required|matches[senha]');
        if ($this->form_validation->run() == TRUE) {
            $campos = $this->input->post();
            $dados = ['nome' => $campos['nome'], 'email' => $campos['email'], 'senha' => md5($campos['senha']), 'nivel' => 'PROFESSOR'];
            $this->usuarioModel->insert($dados);
            $usuario = $this->usuarioModel->getEmailSenha($campos['email'], md5($campos['senha']));
            foreach ($disciplinas as $value) {
                if (isset($_POST['countTURMA' . $value['id']]) && !is_null($_POST['countTURMA' . $value['id']])) {
                    for ($ct = 0; $ct < $_POST['countTURMA' . $value['id']]; $ct++) {
                        $turmaID = $_POST['turmaID' . $value['id'] . $ct];
                        $dadosDisciplina = ['disciplina' => $value['id'], 'turma' => $turmaID, 'professor' => $usuario['id']];
                        $this->turmaProfessorModel->insert($dadosDisciplina);
                    }
                }
            }
            $this->session->set_flashdata('success', 'REGISTRO REALIZADO COM SUCESSO.');
            redirect('professor');
        }
        return $this->load->view('professor/novo', ['disciplinas' => $disciplinas]);
    }

    public function editar($id)
    {
        $professor = $this->usuarioModel->getId($id);
        $disciplinas = $this->disciplinaModel->all();
        for ($d = 0; $d < count($disciplinas); $d++) {
            $nomeNew = $disciplinas[$d]['nome'];
            $newNome = "";
            $disciplinas[$d]['turmaProfessor'] = $this->turmaProfessorModel->allDisciplinaProfessor($disciplinas[$d]['id'], $professor['id']);
            foreach ($disciplinas[$d]['turmaProfessor'] as $td){
                $turma = $this->turmaModel->getId($td->turma);
                $newNome .= $turma['nome'] . "; ";
            }
            if($newNome != null && strlen($newNome) > 0){
                $nomeNew .= " - " . $newNome;
            }
            $disciplinas[$d]['nomeNEW'] = $nomeNew;
        }

        $this->form_validation->set_rules('nome', 'Nome', 'required|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('confirmarsenha', 'Confirmar Senha', 'required|matches[senha]');
        if ($this->form_validation->run() == TRUE) {
            $campos = $this->input->post();
            $dados = ['nome' => $campos['nome'], 'email' => $campos['email'], 'senha' => md5($campos['senha'])];
            $this->usuarioModel->update($professor['id'], $dados);
            foreach ($disciplinas as $value) {
                $disciplinaProfessor = $this->turmaProfessorModel->allDisciplinaProfessor($value['id'], $professor['id']);
                foreach($disciplinaProfessor as $dp) {
                    $this->turmaProfessorModel->delete($dp->id);
                }
            }
            foreach ($disciplinas as $value) {
                if (isset($_POST['countTURMA' . $value['id']]) && !is_null($_POST['countTURMA' . $value['id']])) {
                    for ($ct = 0; $ct < $_POST['countTURMA' . $value['id']]; $ct++) {
                        $turmaID = $_POST['turmaID' . $value['id'] . $ct];
                        $dadosDisciplina = ['disciplina' => $value['id'], 'turma' => $turmaID, 'professor' => $professor['id']];
                        $this->turmaProfessorModel->insert($dadosDisciplina);
                    }
                }
            }
            $this->session->set_flashdata('success', 'REGISTRO REALIZADO COM SUCESSO.');
            redirect('professor/editar/' . $professor['id']);
        }
        return $this->load->view('professor/editar', ['professor' => $professor, 'disciplinas' => $disciplinas]);
    }

    public function apagar($id)
    {
        $this->usuarioModel->delete($id);
        $this->session->set_flashdata('success', 'REGISTRO APAGADO COM SUCESSO.');
        redirect('professor');
    }

    public function disciplina($id)
    {
        $professor = $this->usuarioModel->getId($id);
        $disciplinas = $this->disciplinaModel->all();
        for ($d = 0; $d < count($disciplinas); $d++) {
            $nomeNew = $disciplinas[$d]['nome'];
            $newNome = "";
            $disciplinas[$d]['turmaProfessor'] = $this->turmaProfessorModel->allDisciplinaProfessor($disciplinas[$d]['id'], $professor['id']);
            foreach ($disciplinas[$d]['turmaProfessor'] as $td){
                $turma = $this->turmaModel->getId($td->turma);
                $newNome .= $turma['nome'] . "; ";
            }
            if($newNome != null && strlen($newNome) > 0){
                $nomeNew .= " - " . $newNome;
            }
            $disciplinas[$d]['nomeNEW'] = $nomeNew;
        }

        $this->form_validation->set_rules('token', 'Token', 'required');
        if ($this->form_validation->run() == TRUE) {
            $campos = $this->input->post();
            foreach ($disciplinas as $value) {
                $disciplinaProfessor = $this->turmaProfessorModel->allDisciplinaProfessor($value['id'], $professor['id']);
                foreach($disciplinaProfessor as $dp) {
                    $this->turmaProfessorModel->delete($dp->id);
                }
            }
            foreach ($disciplinas as $value) {
                if (isset($_POST['countTURMA' . $value['id']]) && !is_null($_POST['countTURMA' . $value['id']])) {
                    for ($ct = 0; $ct < $_POST['countTURMA' . $value['id']]; $ct++) {
                        $turmaID = $_POST['turmaID' . $value['id'] . $ct];
                        $dadosDisciplina = ['disciplina' => $value['id'], 'turma' => $turmaID, 'professor' => $professor['id']];
                        $this->turmaProfessorModel->insert($dadosDisciplina);
                    }
                }
            }
            $this->session->set_flashdata('success', 'REGISTRO REALIZADO COM SUCESSO.');
            redirect('professor/disciplina/' . $professor['id']);
        }
        return $this->load->view('professor/editarDisciplina', ['professor' => $professor, 'disciplinas' => $disciplinas]);
    }
}
