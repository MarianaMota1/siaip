<?php $this->load->view('tela/cabecalho'); ?>
<?php $this->load->view('tela/menu_superior'); ?>
<?php $this->load->view('tela/menu_esquerdo'); ?>
    <div class="bs-callout">
        <div class="row">
            <div class="col-md-8">
                <h3>
					<b>REGISTRAR USUÁRIO</b>
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
                <?= form_open('usuario/novo') ?>
                <div class='row'>
					<div class='col-md-12'>
						<div class="form-group">
							<?= form_label('NOME', 'nome') ?>
							<?= form_input(['id' => 'nome', 'name' => 'nome', 'class' => 'form-control', 'placeholder' => 'NOME', 'autofocus' => true], set_value('nome')) ?>
						</div>
					</div>
					<div class='col-md-12'>
						<div class="form-group">
							<?= form_label('EMAIL', 'email') ?>
							<?= form_input(['id' => 'email', 'name' => 'email', 'class' => 'form-control', 'placeholder' => 'EMAIL'], set_value('email')) ?>
						</div>
					</div>
					<div class='col-md-4'>
						<div class="form-group">
							<?= form_label('NÍVEL', 'nivel') ?>
							<?= form_dropdown('nivel', ['' => '', 'ADMINISTRADOR' => 'ADMINISTRADOR', 'PROFESSOR' => 'PROFESSOR', 'NÚCLEO' => 'NÚCLEO'], set_value('nivel'), ['id' => 'nivel', 'class' => 'form-control']) ?>
						</div>
					</div>
					<div class='col-md-4'>
						<div class="form-group">
							<?= form_label('SENHA', 'senha') ?>
							<?= form_password(['id' => 'senha', 'name' => 'senha', 'class' => 'form-control', 'placeholder' => 'SENHA']) ?>
						</div>
					</div>
					<div class='col-md-4'>
						<div class="form-group">
							<?= form_label('CONFIRMAR SENHA', 'confirmarsenha') ?>
							<?= form_password(['id' => 'confirmarsenha', 'name' => 'confirmarsenha', 'class' => 'form-control', 'placeholder' => 'CONFIRMAR SENHA']) ?>
						</div>
					</div>
				</div>
                <button type="submit" class="btn btn-success">SALVAR</button>
                <a href='<?= base_url('usuario') ?>' class="btn btn-info">VOLTAR</a>
                <?= form_close() ?>
			</div>
        </div>
    </div>
<?php $this->load->view('tela/rodape'); ?>
