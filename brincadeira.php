<?php

function qualquer(): string
{
    return 'Olá Mundo!' . PHP_EOL;
}

function outra(callable $funcao): void
{
    echo 'Executando outra funcao: ';
    echo $funcao() . PHP_EOL;
}

outra('qualquer');

outra(function () {
    return 'Uma outra função';
});

$varFunc = function () {
    return 'Uma outra outra função';
};

outra($varFunc);
