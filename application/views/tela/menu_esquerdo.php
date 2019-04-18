<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <?php if ($this->session->userdata('usuario') != null) { ?>
                    <li><?= anchor('dashboard', 'INÍCIO') ?></li>
                    <?php if ($this->session->userdata('usuario')['nivel'] == "ADMINISTRADOR") { ?>
                        <li><?= anchor('usuario', 'USUÁRIOS') ?></li>
                        <li><a href="#">Export</a></li>
                    <?php } else if ($this->session->userdata('usuario')['nivel'] == "NÚCLEO") { ?>
						<li><?= anchor('professor', 'PROFESSORES') ?></li>
						<li><?= anchor('aluno', 'ALUNOS') ?></li>
					<?php } ?>
                <?php } else { ?>
                    <li><?= anchor('/', 'ÁREA DE ACESSO') ?></li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
