<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?= anchor('/', 'SIAIP', ['class' => 'navbar-brand']) ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <?php if ($this->session->userdata('usuario') != NULL) { ?>
                <ul class="nav navbar-nav navbar-right">
					<li><?= anchor('usuario/edit', 'MEUS DADOS') ?></li>
                    <li><a href="#" onclick="logout()">SAIR</a></li>
                </ul>
            <?php } ?>
        </div>
    </div>
</nav>
