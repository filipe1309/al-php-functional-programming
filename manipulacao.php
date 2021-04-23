<?php

$dados = require 'dados.php';

$contador = 0;

// Imperative way
// foreach ($dados as $pais) {
//     $contador++;
// }

// Functional way
// array_walk($dados, function ($pais) use (&$contador) {
//     $contador++;
// });

// Another way v2
$contador = count($dados);

echo "Número de países: $contador\n";

# Class 2
function convertePaisPraLetraMaiuscula(array $pais)
{
    $pais['pais'] = mb_convert_case($pais['pais'], MB_CASE_UPPER);
    return $pais;
};

$arrayModificado = array_map('convertePaisPraLetraMaiuscula', $dados);

var_dump($arrayModificado);
