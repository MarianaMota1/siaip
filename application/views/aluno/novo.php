<?php $this->load->view('tela/cabecalho'); ?>
<?php $this->load->view('tela/menu_superior'); ?>
<?php $this->load->view('tela/menu_esquerdo'); ?>
<div class="bs-callout">
    <div class="row">
        <div class="col-md-12">
            <h3>
                <b>REGISTRAR ALUNO</b>
            </h3>
            <?php if ($this->session->flashdata('success') != null) { ?>
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <b><?= $this->session->flashdata('success') ?></b>
                </div>
            <?php } ?>
            <?php if (validation_errors() != NULL) { ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <?= validation_errors() ?>
                </div>
            <?php } ?>
            <?= form_open('aluno/novo') ?>
            <div class='row'>
                <div class='col-md-6'>
                    <div class="form-group">
                        <?= form_label('NOME', 'nome') ?>
                        <?= form_input(['id' => 'nome', 'name' => 'nome', 'class' => 'form-control', 'placeholder' => 'NOME', 'autofocus' => true], set_value('nome')) ?>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class="form-group">
                        <?= form_label('DATA DE NASCIMENTO', 'datanascimento') ?>
                        <?= form_input(['id' => 'datanascimento', 'type' => 'date', 'name' => 'datanascimento', 'class' => 'form-control'], set_value('datanascimento')) ?>
                    </div>
                </div>
                <div class='col-md-3'>
                    <div class="form-group">
                        <?= form_label('NÚMERO DE MATRÍCULA', 'numeromatricula') ?>
                        <?= form_input(['id' => 'numeromatricula', 'name' => 'numeromatricula', 'class' => 'form-control'], set_value('numeromatricula')) ?>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class="form-group">
                        <?= form_label('PAI', 'pai') ?>
                        <?= form_input(['id' => 'pai', 'name' => 'pai', 'class' => 'form-control'], set_value('pai')) ?>
                    </div>
                </div>
                <div class='col-md-2'>
                    <div class="form-group">
                        <?= form_label('TELEFONE DO PAI', 'telefonepai') ?>
                        <?= form_input(['id' => 'telefonepai', 'name' => 'telefonepai', 'class' => 'form-control'], set_value('telefonepai')) ?>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class="form-group">
                        <?= form_label('MÃE', 'mae') ?>
                        <?= form_input(['id' => 'mae', 'name' => 'mae', 'class' => 'form-control'], set_value('mae')) ?>
                    </div>
                </div>
                <div class='col-md-2'>
                    <div class="form-group">
                        <?= form_label('TELEFONE DA MÃE', 'telefonemae') ?>
                        <?= form_input(['id' => 'telefonemae', 'name' => 'telefonemae', 'class' => 'form-control'], set_value('telefonemae')) ?>
                    </div>
                </div>
                <div class='col-md-12'>
                    <div class="form-group">
                        <?= form_label('TURMA', 'turma') ?>
                        <?= form_dropdown('turma', $turmas, set_value('turma'), ['id' => 'turma', 'class' => 'form-control']) ?>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">SALVAR</button>
            <a href='<?= base_url('aluno') ?>' class="btn btn-info">VOLTAR</a>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?php $this->load->view('tela/rodape'); ?>
