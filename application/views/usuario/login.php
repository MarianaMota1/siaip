<?php $this->load->view('tela/cabecalho'); ?>
<?php $this->load->view('tela/menu_superior'); ?>
<?php $this->load->view('tela/menu_esquerdo'); ?>
    <h2 class="page-header"><b>SISTEMA DE INFORMAÇÃO DE APOIO A INTERVENÇÃO PEDAGÓGICA</b></h2>
    <div class="bs-callout">
        <div class="row">
            <div class="col-md-6">
                <h3><b>ÁREA DE ACESSO</b></h3>
                <?php if (validation_errors() != NULL) { ?>
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <?= validation_errors() ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('danger') != null) { ?>
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <b><?= $this->session->flashdata('danger') ?></b>
                    </div>
                <?php } ?>
                <?= form_open("usuario/login") ?>
                <div class="form-group">
                    <?= form_label('EMAIL', 'email') ?>
                    <?= form_input(['id' => 'email', 'name' => 'email', 'class' => 'form-control', 'placeholder' => 'EMAIL', 'autofocus' => true], set_value('email')) ?>
                </div>
                <div class="form-group">
                    <?= form_label('SENHA', 'senha') ?>
                    <?= form_password(['id' => 'senha', 'name' => 'senha', 'class' => 'form-control', 'placeholder' => 'SENHA']) ?>
                </div>
                <button type="submit" class="btn btn-success">ENTRAR</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?php $this->load->view('tela/rodape'); ?>