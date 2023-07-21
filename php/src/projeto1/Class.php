<?php

class ServerMethods
{
    function validar($entrada)
    {
        $tipoAbertos = ['[', '{', '('];
        $tiposFechados = [']', '}', ')'];
        $array = [];

        foreach (str_split($entrada) as $posicaoLetra) {
            if (in_array($posicaoLetra, $tipoAbertos)) {
                array_push($array, $posicaoLetra);
            } elseif (in_array($posicaoLetra, $tiposFechados)) {
                $indice = array_search($posicaoLetra, $tiposFechados);
                if (count($array) === 0 || $array[count($array) - 1] !== $tipoAbertos[$indice]) {
                    return false; // Parêntese, colchete ou chave fechado sem abertura correspondente
                }
                array_pop($array);
            }
        }
        if (count($array) === 0) // Se o array estiver vazio - ok
        {
            return true;
        } else {
            return false;
        }
    }
}

?>