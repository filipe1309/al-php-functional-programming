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
function convertePaisPraLetraMaiuscula(array $pais): array
{
    $pais['pais'] = mb_convert_case($pais['pais'], MB_CASE_UPPER);
    return $pais;
}

function verificaSePaisTemEspacoNoNome(array $pais): bool
{
    return str_contains($pais['pais'], ' '); // PHP 8+
    //return strpos($pais['pais'], ' ') !== false; // PHP 7.4
}

$dados = array_map('convertePaisPraLetraMaiuscula', $dados);
$dados = array_filter($dados, 'verificaSePaisTemEspacoNoNome');

var_dump($dados);
