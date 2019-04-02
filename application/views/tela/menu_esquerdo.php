<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <?php if ($this->session->userdata('usuario') != null) { ?>
                    <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Aluno</a></li>
                    <li><a href="#">Professor</a></li>
                    <li><a href="#">Export</a></li>
                <?php } else { ?>
                    <li><?= anchor('/', 'ÁREA DE ACESSO') ?></li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">