<?php

$dados = require 'dados.php';

# Class 2
$brasil = $dados[0];

$somaMedalhas = fn ($acc, $actual) => $acc + $actual;

$numMedadalhas = array_reduce($brasil['medalhas'], $somaMedalhas);

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

$verificaSePaisTemEspacoNoNome = fn (array $pais): bool => str_contains($pais['pais'], ' ');
// PHP 8+
//return strpos($pais['pais'], ' ') !== false; // PHP 7.4

$nomeDePaisesEmMaiusculo = fn ($dados) => array_map('convertePaisPraLetraMaiuscula', $dados);
$filtraPaisesSemEspacoNoNome = fn ($dados) => array_filter($dados, $verificaSePaisTemEspacoNoNome);

$dados = $filtraPaisesSemEspacoNoNome($nomeDePaisesEmMaiusculo($dados));

// function medalhasTotaisAcumuladas($acc, array $pais): int
// {
//     return $acc + array_reduce($pais['medalhas'], $somaMedalhas);
// }

// echo array_reduce($dados, 'medalhasTotaisAcumuladas')  . PHP_EOL;

$medalhas  = array_reduce(
    array_map(fn (array $medalhas) => array_reduce($medalhas, $somaMedalhas), array_column($dados, 'medalhas')),
    $somaMedalhas
);

$comparaMedalhas = fn (array $medalhasPais1, array $medalhasPais2): callable
=> fn ($modalidade): int => $medalhasPais2[$modalidade] <=> $medalhasPais1[$modalidade];

usort($dados, function (array $pais1, array $pais2) use ($comparaMedalhas) {
    $medalhasPais1 = $pais1['medalhas'];
    $medalhasPais2 = $pais2['medalhas'];
    $comparador = $comparaMedalhas($medalhasPais1, $medalhasPais2);

    // return $comparador('ouro') !== 0 ?? ($comparador('prata') !== 0 ?? $comparador('bronze'));
    return $comparador('ouro') !== 0 ? $comparador('ouro')
        : ($comparador('prata') !== 0 ? $comparador('prata')
            : $comparador('bronze'));
});

var_dump($dados);

echo $medalhas . PHP_EOL;

# End Class 2
