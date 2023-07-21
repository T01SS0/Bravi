<?php



if ($_POST['auth'] == '123') {

    require_once('Class.php');

    $vd = new ServerMethods();

    try {
        $retorno = $vd->validar($_POST['campo']);

        $ret = array(
            'status' => 200,
            'conteudo' => $retorno
        );
    } catch (\Throwable $th) {

        $ret = array(
            'status' => 200,
            'conteudo' => $th->getMessage()
        );
    }

    echo json_encode($ret);
} else {
    header('HTTP/1.0 401 Unauthorized');
}
