<?php

class Disciplina extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('disciplinaModel');
    }

    public function allAPI()
    {
        header('Content-Type: application/json');
        $disciplinas = $this->disciplinaModel->all();
        echo json_encode($disciplinas);
    }

    public function inserirAPI()
    {
        $this->disciplinaModel->insert(['nome' => $_POST['nome']]);
    }

    public function show($id)
    {
        header('Content-Type: application/json');
        $disciplina = $this->disciplinaModel->getId($id);
        echo json_encode($disciplina);
    }

    public function alterarAPI($id)
    {
        $this->disciplinaModel->update($id, ['nome' => $_POST['nome']]);
    }

    public function apagarAPI($id)
    {
        $this->disciplinaModel->delete($id);
    }

}
