<?php $this->load->view('tela/cabecalho'); ?>
<?php $this->load->view('tela/menu_superior'); ?>
<?php $this->load->view('tela/menu_esquerdo'); ?>
<div class="bs-callout">
    <div class="row">
        <div class="col-md-12">
            <h3>
                <b>EDITAR PROFESSOR #<?= $professor['id'] ?></b>
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
            <?= form_open('professor/editar/' . $professor['id']) ?>
            <div class='row'>
                <div class="col-md-7">
                    <div class="row">
                        <div class='col-md-12'>
                            <div class="form-group">
                                <?= form_label('NOME', 'nome') ?>
                                <?= form_input(['id' => 'nome', 'name' => 'nome', 'class' => 'form-control', 'placeholder' => 'NOME', 'autofocus' => true], set_value('nome', $professor['nome'])) ?>
                            </div>
                        </div>
                        <div class='col-md-12'>
                            <div class="form-group">
                                <?= form_label('EMAIL', 'email') ?>
                                <?= form_input(['id' => 'email', 'name' => 'email', 'class' => 'form-control', 'placeholder' => 'EMAIL'], set_value('email', $professor['email'])) ?>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group">
                                <?= form_label('SENHA', 'senha') ?>
                                <?= form_password(['id' => 'senha', 'name' => 'senha', 'class' => 'form-control', 'placeholder' => 'SENHA']) ?>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group">
                                <?= form_label('CONFIRMAR SENHA', 'confirmarsenha') ?>
                                <?= form_password(['id' => 'confirmarsenha', 'name' => 'confirmarsenha', 'class' => 'form-control', 'placeholder' => 'CONFIRMAR SENHA']) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <?= form_label('DISCIPLINA', 'disciplina') ?>
                        <br/>
                        <button class="btn btn-warning" onclick="listarDisciplina()" type="button">DISCIPLINAS</button>
                        <button class="btn btn-primary" onclick="listarTurma()" type="button">TURMAS</button>
                    </div>
                    <div class="form-group">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>NOME</th>
                                <th width="50px"></th>
                            </tr>
                            </thead>
                            <tbody id="tBODYDISCIPLINA">
                            <?php foreach ($disciplinas as $key => $value) { ?>
                                <tr>
                                    <td>
                                        <label id="disciplinaLABEL<?= $value['id'] ?>"><?= $value['nomeNEW'] ?></label>
                                        <input type="hidden" id="disciplinaNOME<?= $value['id'] ?>" value="<?= $value['nomeNEW'] ?>">
                                        <input type="hidden" id="disciplinaNOMEBEGIN<?= $value['id'] ?>" value="<?= $value['nome'] ?>">
                                    </td>
                                    <td align="center">
                                        <div id="turma<?= $value['id'] ?>">
                                            <?php for($tp=0; $tp < count($value['turmaProfessor']); $tp++){ ?>
                                                <?= "<input type='hidden' id='turmaID" . $value['id'] . $tp . "' name='turmaID" . $value['id'] . $tp . "' value='" . $value['turmaProfessor'][$tp]->turma . "'>" ?>
                                            <?php } ?>
                                        </div>
                                        <input type="hidden" id="countTURMA<?= $value['id'] ?>" name="countTURMA<?= $value['id'] ?>" value="<?= count($value['turmaProfessor']) ?>">
                                        <input type="checkbox" name="disciplina<?= $value['id'] ?>"
                                               id="disciplina<?= $value['id'] ?>"
                                               onclick="ckDisciplina('<?= $value['id'] ?>')" value="SIM" <?= count($value['turmaProfessor']) > 0 ? "checked" : "" ?>>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">SALVAR</button>
            <a href='<?= base_url('professor') ?>' class="btn btn-info">VOLTAR</a>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modaListaDisciplina" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">LISTA DE DISCIPLINA</h5>
            </div>
            <div class="modal-body">
                <h4 class="mt-0 header-title">
                    <button type="button" onclick="novaDisciplina()" class="btn btn-sm btn-success">NOVO CADASTRO
                    </button>
                </h4>
                <div class="table-responsive" id="listaDisciplinaTABLE">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRegistrarDisciplina" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleUpdateDisciplina"></h5>
            </div>
            <div class="modal-body">
                <input type='hidden' id='disciplina_id' name='disciplina_id' value=''>
                <div class="form-group">
                    <?= form_label('NOME', 'disciplina_nome') ?>
                    <?= form_input(['id' => 'disciplina_nome', 'name' => 'disciplina_nome', 'class' => 'form-control', 'placeholder' => 'NOME'], null) ?>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type='button' onclick='saveDisciplina()'>SALVAR</button>
                <button type="button" class="btn btn-primary" onclick='voltarDisciplina()'>VOLTAR</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modaListaTurma" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">LISTA DE TURMA</h5>
            </div>
            <div class="modal-body">
                <h4 class="mt-0 header-title">
                    <button type="button" onclick="novaTurma()" class="btn btn-sm btn-success">NOVO CADASTRO</button>
                </h4>
                <div class="table-responsive" id="listaTurmaTABLE">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRegistrarTurma" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleUpdateTurma"></h5>
            </div>
            <div class="modal-body">
                <input type='hidden' id='turma_id' name='turma_id' value=''>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= form_label('NOME', 'turma_nome') ?>
                            <?= form_input(['id' => 'turma_nome', 'name' => 'turma_nome', 'class' => 'form-control', 'placeholder' => 'NOME'], null) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= form_label('SÉRIE', 'turma_serie') ?>
                            <?= form_input(['id' => 'turma_serie', 'name' => 'turma_serie', 'class' => 'form-control', 'placeholder' => 'SÉRIE'], null) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" type='button' onclick='saveTurma()'>SALVAR</button>
                <button type="button" class="btn btn-primary" onclick='voltarTurma()'>VOLTAR</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTurmaDisciplina" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">LISTA DE TURMA</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="disciplinaTurmaID" name="disciplinaTurmaID" value="">
                <div class="table-responsive" id="listaTurmaDisciplinaTABLE">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="inserirTurma()">INSERIR</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">FECHAR</button>
            </div>
        </div>
    </div>
</div>
<script>
    function listarDisciplina() {
        $.ajax({
            type: "GET",
            url: "<?= base_url('disciplina/allAPI') ?>",
            async: false,
            success: function (data) {
                var tbody = '';
                var table = '<table class="table table-bordered table-hover"><thead><tr><th>NOME</th><th width="100px"></th><th width="100px"></th></tr></thead>';
                table += '<tbody>';
                for (var d = 0; d < data.length; d++) {

                    var check = $("#disciplina" + data[d].id).is(":checked");

                    var disciplinaNOME = $("#disciplinaNOME" + data[d].id).val();
                    var countTURMA = $("#countTURMA" + data[d].id).val();

                    disciplinaNOME = (disciplinaNOME != null && disciplinaNOME.length > 0) ? disciplinaNOME : data[d].nome;

                    tbody += '<tr>';
                    tbody += '<td>';
                    tbody += '<label id="disciplinaLABEL' + data[d].id + '">' + disciplinaNOME + '</label>';
                    tbody += '<input type="hidden" id="disciplinaNOME' + data[d].id + '" value="' + disciplinaNOME + '">';
                    tbody += '<input type="hidden" id="disciplinaNOMEBEGIN' + data[d].id + '" value="' + data[d].nome + '">';
                    tbody += '</td>';
                    tbody += '<td align="center">';
                    tbody += '<div id="turma' + data[d].id + '">';

                    for(var dd=0; dd<countTURMA; dd++){
                        var valueIDTURMA = $("#turmaID" + data[d].id + dd).val();
                        tbody += "<input type='hidden' id='turmaID" + data[d].id + dd + "' name='turmaID" + data[d].id + dd + "' value='" + valueIDTURMA + "'>";
                    }

                    tbody += '</div>';
                    tbody += '<input type="hidden" id="countTURMA' + data[d].id + '" name="countTURMA' + data[d].id + '" value="' + countTURMA + '">';
                    tbody += '<input type="checkbox" name="disciplina' + data[d].id + '" id="disciplina' + data[d].id + '" value="SIM" ' + (check ? "checked" : "") + ' onclick="ckDisciplina(' + data[d].id + ')" value="SIM">';
                    tbody += '</td>';
                    tbody += '</tr>';


                    table += '<tr>';
                    table += '<td>' + data[d].nome + '</td>';
                    table += '<td align="center">';
                    table += '<button class="btn btn-xs btn-info" onclick="editDisciplina(' + data[d].id + ')">EDITAR</button>';
                    table += '</td>';
                    table += '<td align="center">';
                    table += '<button class="btn btn-xs btn-danger" type="button" onclick="apagarDisciplina(' + data[d].id + ')">APAGAR</button>';
                    table += '</td>';
                    table += '</tr>';
                }
                table += '</tbody>';
                table += '</table>';
                $("#tBODYDISCIPLINA").html(tbody);
                $("#modaListaDisciplina #listaDisciplinaTABLE").html(table);
                $("#modaListaDisciplina").modal('show');
            }, error: function (data) {
                alert('ERROR SERVER')
            }
        });
    }

    function novaDisciplina() {
        $("#modaListaDisciplina").modal('hide');
        $("#modalRegistrarDisciplina").modal('show');
        $("#modalRegistrarDisciplina #titleUpdateDisciplina").html('REGISTRAR DISCIPLINA');
        $("#modalRegistrarDisciplina #disciplina_id").val('');
        $("#modalRegistrarDisciplina #disciplina_nome").val('');
    }

    function saveDisciplina() {
        var id = $("#modalRegistrarDisciplina #disciplina_id").val();
        var nome = $("#modalRegistrarDisciplina #disciplina_nome").val();
        if (nome != null && nome.length > 0) {
            if (id != null && id.length > 0) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('disciplina/alterarAPI') ?>/" + id,
                    async: false,
                    data: {nome: nome},
                    success: function (data) {
                        $("#modalRegistrarDisciplina").modal('hide');
                        listarDisciplina();
                    }, error: function (data) {
                        console.log("ERROR SERVER")
                    }
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('disciplina/inserirAPI') ?>",
                    async: false,
                    data: {nome: nome},
                    success: function (data) {
                        $("#modalRegistrarDisciplina").modal('hide');
                        listarDisciplina();
                    }, error: function (data) {
                        console.log("ERROR SERVER")
                    }
                });
            }
        } else {
            alert('PREENCHA O NOME!');
        }
    }

    function voltarDisciplina() {
        $("#modalRegistrarDisciplina").modal('hide');
        $("#modaListaDisciplina").modal('show');
    }

    function editDisciplina(id) {
        $.ajax({
            type: "GET",
            url: "<?= base_url('disciplina/show') ?>/" + id,
            async: false,
            success: function (data) {
                $("#modaListaDisciplina").modal('hide');
                $("#modalRegistrarDisciplina").modal('show');
                $("#modalRegistrarDisciplina #titleUpdateDisciplina").html('EDITAR DISCIPLINA #' + data.id);
                $("#modalRegistrarDisciplina #disciplina_id").val(data.id);
                $("#modalRegistrarDisciplina #disciplina_nome").val(data.nome);
            }, error: function (data) {
                alert('ERROR SERVER')
            }
        });
    }

    function apagarDisciplina(id) {
        $.ajax({
            type: "GET",
            url: "<?= base_url('disciplina/apagarAPI') ?>/" + id,
            async: false,
            success: function (data) {
                listarDisciplina();
            }, error: function (data) {
                alert('ERROR SERVER')
            }
        });
    }

    function listarTurma()  {
        $.ajax({
            type: "GET",
            url: "<?= base_url('turma/allAPI') ?>",
            async: false,
            success: function (data) {
                var table = '<table class="table table-bordered table-hover"><thead><tr><th>NOME</th><th>SÉRIE</th><th width="100px"></th><th width="100px"></th></tr></thead>';
                table += '<tbody>';
                for (var d = 0; d < data.length; d++) {
                    table += '<tr>';
                    table += '<td>' + data[d].nome + '</td>';
                    table += '<td>' + data[d].serie + '</td>';
                    table += '<td align="center">';
                    table += '<button class="btn btn-xs btn-info" onclick="editTurma(' + data[d].id + ')">EDITAR</button>';
                    table += '</td>';
                    table += '<td align="center">';
                    table += '<button class="btn btn-xs btn-danger" type="button" onclick="apagarTurma(' + data[d].id + ')">APAGAR</button>';
                    table += '</td>';
                    table += '</tr>';
                }
                table += '</tbody>';
                table += '</table>';
                $("#modaListaTurma #listaTurmaTABLE").html(table);
                $("#modaListaTurma").modal('show');
            }, error: function (data) {
                alert('ERROR SERVER')
            }
        });
    }

    function novaTurma() {
        $("#modaListaTurma").modal('hide');
        $("#modalRegistrarTurma").modal('show');
        $("#modalRegistrarTurma #titleUpdateTurma").html('REGISTRAR TURMA');
        $("#modalRegistrarTurma #turma_id").val('');
        $("#modalRegistrarTurma #turma_nome").val('');
        $("#modalRegistrarTurma #turma_serie").val('');
    }

    function saveTurma() {
        var id = $("#modalRegistrarTurma #turma_id").val();
        var nome = $("#modalRegistrarTurma #turma_nome").val();
        var serie = $("#modalRegistrarTurma #turma_serie").val();
        if (nome != null && nome.length > 0 && serie != null && serie.length > 0) {
            if (id != null && id.length > 0) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('turma/alterarAPI') ?>/" + id,
                    async: false,
                    data: {nome: nome, serie: serie},
                    success: function (data) {
                        $("#modalRegistrarTurma").modal('hide');
                        listarTurma();
                    }, error: function (data) {
                        console.log("ERROR SERVER")
                    }
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('turma/inserirAPI') ?>",
                    async: false,
                    data: {nome: nome, serie: serie},
                    success: function (data) {
                        $("#modalRegistrarTurma").modal('hide');
                        listarTurma();
                    }, error: function (data) {
                        console.log("ERROR SERVER")
                    }
                });
            }
        } else if(nome == null || nome.length == 0) {
            alert('PREENCHA O NOME!');
        } else if(serie == null || serie.length == 0) {
            alert('PREENCHA A SÉRIE!');
        }
    }

    function voltarTurma() {
        $("#modalRegistrarTurma").modal('hide');
        $("#modaListaTurma").modal('show');
    }

    function editTurma(id) {
        $.ajax({
            type: "GET",
            url: "<?= base_url('turma/show') ?>/" + id,
            async: false,
            success: function (data) {
                $("#modaListaTurma").modal('hide');
                $("#modalRegistrarTurma").modal('show');
                $("#modalRegistrarTurma #titleUpdateTurma").html('EDITAR TURMA #' + data.id);
                $("#modalRegistrarTurma #turma_id").val(data.id);
                $("#modalRegistrarTurma #turma_nome").val(data.nome);
                $("#modalRegistrarTurma #turma_serie").val(data.serie);
            }, error: function (data) {
                alert('ERROR SERVER')
            }
        });
    }

    function apagarTurma(id) {
        $.ajax({
            type: "GET",
            url: "<?= base_url('turma/apagarAPI') ?>/" + id,
            async: false,
            success: function (data) {
                listarTurma();
            }, error: function (data) {
                alert('ERROR SERVER')
            }
        });
    }

    function ckDisciplina(disciplinaID) {
        var check = $("#disciplina" + disciplinaID).is(":checked");
        if (check) {
            $.ajax({
                type: "GET",
                url: "<?= base_url('turma/allAPI') ?>",
                async: false,
                success: function (data) {
                    var table = '<table class="table table-bordered table-hover"><thead><tr><th>NOME</th><th>SÉRIE</th><th width="50px"></th></tr></thead>';
                    table += '<tbody>';
                    for (var d = 0; d < data.length; d++) {
                        table += '<tr>';
                        table += '<td>' + data[d].nome + '</td>';
                        table += '<td>' + data[d].serie + '</td>';
                        table += '<td align="center">';
                        table += '<input type="checkbox" id="turma' + disciplinaID + data[d].id + '" name="turma' + disciplinaID + data[d].id + '" value="SIM">';
                        table += '</td>';
                        table += '</tr>';
                    }
                    table += '</tbody>';
                    table += '</table>';

                    $("#modalTurmaDisciplina #listaTurmaDisciplinaTABLE").html(table);
                    $("#modalTurmaDisciplina #disciplinaTurmaID").val(disciplinaID);
                    $("#modalTurmaDisciplina").modal('show')
                }, error: function (data) {
                    alert('ERROR SERVER')
                }
            });
        } else {
            var disciplinaBEGIN = $("#disciplinaNOMEBEGIN" + disciplinaID).val();
            $("#disciplinaLABEL" + disciplinaID).html(disciplinaBEGIN)
            $("#disciplinaNOME" + disciplinaID).val(disciplinaBEGIN)
            $("#countTURMA" + disciplinaID).val('')
            $("#turma" + disciplinaID).val('')
        }
    }

    function inserirTurma(){
        var disciplinaID = $("#modalTurmaDisciplina #disciplinaTurmaID").val();
        $.ajax({
            type: "GET",
            url: "<?= base_url('turma/allAPI') ?>",
            async: false,
            success: function (data) {
                var nomeTURMA = "";
                var arrayTurma = "";
                var countTURMA = 0;
                for (var d = 0; d < data.length; d++) {
                    var check = $("#modalTurmaDisciplina #turma" + disciplinaID + data[d].id).is(":checked");
                    if(check){
                        nomeTURMA += data[d].nome + "; ";
                        arrayTurma += "<input type='hidden' id='turmaID" + disciplinaID + countTURMA + "' name='turmaID" + disciplinaID + countTURMA + "' value='" + data[d].id + "'>";
                        countTURMA ++;
                    }
                }

                var nomeDISCIPLINA = $("#disciplinaNOME" + disciplinaID).val();
                if(arrayTurma != null && arrayTurma.length > 0){
                    nomeDISCIPLINA += " - " + nomeTURMA;
                }

                $("#turma" + disciplinaID).html(arrayTurma)
                $("#countTURMA" + disciplinaID).val(countTURMA)
                $("#disciplinaLABEL" + disciplinaID).html(nomeDISCIPLINA)
                $("#disciplinaNOME" + disciplinaID).val(nomeDISCIPLINA)
                $("#modalTurmaDisciplina").modal('hide')
            }, error: function (data) {
                alert('ERROR SERVER')
            }
        });
    }
</script>
<?php $this->load->view('tela/rodape'); ?>
