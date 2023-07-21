<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.min.css" rel="stylesheet">
    <title>Teste</title>
</head>

<body>
    <div class="container">
        <div class="row p-5">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Validação: Suportes balanceados</h4>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="campoTeste" placeholder="Ex: [][())]" value="">
                                    <label for="campoTeste">Insira o valor</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-end">
                                <button class="btn btn-primary" id="testar">Testar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js"></script>


    <script>
        var project = function() {

            var handleValidacao = function() {
                $("#testar").on('click', function() {

                    let valorCampo = $("#campoTeste").val();

                    if (valorCampo != "") {
                        validarCampo(valorCampo);
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'Ops!',
                            text: 'Não esqueça de informar o valor que deseja testar!',
                        })
                    }


                })

                function validarCampo(valorCampo) {
                    $.ajax({
                        url: "ajaxValidar.php",
                        method: 'POST',
                        data: {
                            'auth':'123',
                            'campo': valorCampo
                        },
                        success: function(ret) {
                            let retorno = JSON.parse(ret);

                            if (retorno.status == 200) {

                                if (retorno.conteudo == 1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'A resposta é:',
                                        text: 'Valido! o campo "' + valorCampo + '" é valido!',
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'A resposta é:',
                                        text: 'Inválido! o campo "' + valorCampo + '" não é valido!',
                                    })
                                }

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ops',
                                    text: 'Problemas no paraiso, já estamos tratando!',
                                })
                            }
                        }
                    })
                }
            }

            return {
                init: function() {
                    handleValidacao();
                }
            }
        }

        project().init();
    </script>
</body>

</html>