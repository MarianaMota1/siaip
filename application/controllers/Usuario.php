<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Mary
 */
class Usuario extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function login(){
        return $this->load->view('usuario/login');
    }
    
}