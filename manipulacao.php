<?php

$dados = require 'dados.php';

# Class 2
$brasil = $dados[0];

function somaMedalhas($acc, $actual)
{
    return $acc + $actual;
}

$numMedadalhas = array_reduce($brasil['medalhas'], 'somaMedalhas');

echo $numMedadalhas . PHP_EOL;

// exit();
# End Class 2


# Class 1
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
# End Class 1

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


// function medalhasTotaisAcumuladas($acc, array $pais): int
// {
//     return $acc + array_reduce($pais['medalhas'], 'somaMedalhas');
// }

// echo array_reduce($dados, 'medalhasTotaisAcumuladas')  . PHP_EOL;

$medalhas  = array_reduce(
    array_map(function (array $medalhas) {
        return array_reduce($medalhas, 'somaMedalhas');
    }, array_column($dados, 'medalhas')),
    'somaMedalhas'
);

usort($dados, function (array $pais1, array $pais2) {
    $medalhasPais1 = $pais1['medalhas'];
    $medalhasPais2 = $pais2['medalhas'];

    $comparacaoOuro = $medalhasPais2['ouro'] <=> $medalhasPais1['ouro'];
    $comparacaoPrata = $medalhasPais2['prata'] <=> $medalhasPais1['prata'];
    $comparacaoBronze = $medalhasPais2['bronze'] <=> $medalhasPais1['bronze'];
    return $comparacaoOuro !== 0 ? $comparacaoOuro
        : ($comparacaoPrata !== 0 ? $comparacaoPrata
            : $comparacaoBronze);
});

var_dump($dados);

echo $medalhas;

# End Class 2
