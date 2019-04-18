<?php

class Turma extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('turmaModel');
    }

    public function allAPI()
    {
        header('Content-Type: application/json');
        $turmas = $this->turmaModel->all();
        echo json_encode($turmas);
    }

    public function inserirAPI()
    {
        $this->turmaModel->insert(['nome' => $_POST['nome'], 'serie' => $_POST['serie']]);
    }

    public function show($id)
    {
        header('Content-Type: application/json');
        $turma = $this->turmaModel->getId($id);
        echo json_encode($turma);
    }

    public function alterarAPI($id)
    {
        $this->turmaModel->update($id, ['nome' => $_POST['nome'], 'serie' => $_POST['serie']]);
    }

    public function apagarAPI($id)
    {
        $this->turmaModel->delete($id);
    }
}