<?php

class Usuario extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuarioModel');
    }

    public function login()
    {
        if ($this->session->userdata('usuario') != NULL) {
            redirect('dashboard');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[3]|max_length[12]');
        if ($this->form_validation->run() == TRUE) {
            $campos = $this->input->post();
            $usuario = $this->usuarioModel->getEmailSenha($campos['email'], md5($campos['senha']));
            if (!is_null($usuario)) {
                $this->session->set_userdata(['usuario' => $usuario]);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('danger', 'EMAIL OU SENHA INVÁLIDO!');
            }
        }
        return $this->load->view('usuario/login');
    }

    public function sair()
    {
        $this->session->sess_destroy();
        redirect('/');
    }

    public function index()
    {
        $usuarios = $this->usuarioModel->all();
        $dados = ['usuarios' => $usuarios];
        return $this->load->view('usuario/index', $dados);
    }

    public function apagar($id)
    {
        $this->usuarioModel->delete($id);
        $this->session->set_flashdata('success', 'REGISTRO APAGADO COM SUCESSO.');
        redirect('usuario');
    }

    public function novo()
    {
        $this->form_validation->set_rules('nome', 'Nome', 'required|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('nivel', 'Nível', 'required');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('confirmarsenha', 'Confirmar Senha', 'required|matches[senha]');
        if ($this->form_validation->run() == TRUE) {
            $dados = ['nome' => $_POST['nome'], 'email' => $_POST['email'], 'senha' => md5($_POST['senha']), 'nivel' => $_POST['nivel']];
            $this->usuarioModel->insert($dados);
            $this->session->set_flashdata('success', 'REGISTRO REALIZADO COM SUCESSO.');
            redirect('usuario');
        }
        return $this->load->view('usuario/novo');
    }

    public function edit()
    {
        $usuario = $this->usuarioModel->getId($this->session->userdata('usuario')['id']);
        $this->form_validation->set_rules('nome', 'Nome', 'required|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[3]|max_length[12]');
        $this->form_validation->set_rules('confirmarsenha', 'Confirmar Senha', 'required|matches[senha]');
        if ($this->form_validation->run() == TRUE) {
            $dados = ['nome' => $_POST['nome'], 'email' => $_POST['email'], 'senha' => md5($_POST['senha'])];
            $this->usuarioModel->update($id, $dados);
            $this->session->set_flashdata('success', 'REGISTRO REALIZADO COM SUCESSO.');
            redirect('usuario/edit');
        }
        $dados = ['usuario' => $usuario];
        return $this->load->view('usuario/edit', $dados);
    }
}
