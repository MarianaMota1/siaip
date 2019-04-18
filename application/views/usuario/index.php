<?php $this->load->view('tela/cabecalho'); ?>
<?php $this->load->view('tela/menu_superior'); ?>
<?php $this->load->view('tela/menu_esquerdo'); ?>
    <div class="bs-callout">
        <div class="row">
            <div class="col-md-9">
                <h3>
					<b>LISTA DE USUÁRIOS</b>
                </h3>
                <h3>
					<a href='<?= base_url('usuario/novo') ?>' class='btn btn-success btn-sm'>NOVO CADASTRO</a>
                </h3>
                <?php if ($this->session->flashdata('success') != null) { ?>
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <b><?= $this->session->flashdata('success') ?></b>
                    </div>
                <?php } ?>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>NOME</th>
                        <th>EMAIL</th>
                        <th width="150px">NÍVEL</th>
                        <th width="75px"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($usuarios as $key => $value) { ?>
                        <tr>
                            <td><?= $value->nome ?></td>
                            <td><?= $value->email ?></td>
                            <td><?= $value->nivel ?></td>
                            <td align="center"><button onclick="apagar('<?= base_url('usuario/apagar/' . $value->id) ?>')" class="btn btn-danger btn-xs" <?= ($this->session->userdata('usuario')['id'] == $value->id) ? "disabled" : "" ?>>APAGAR</button></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $this->load->view('tela/rodape'); ?>
