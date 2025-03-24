<?php

require '../../vendor/autoload.php';

$s = "Hello World!";

function encode(string $s)
{
    $alphabet = range('a', 'z'); // Создаем массив букв алфавита
    $s = strtolower($s); // Преобразуем строку в нижний регистр
    $result = '';

    for ($i = 0; $i < strlen($s); $i++) {
        if (in_array($s[$i], $alphabet)) {
            if (array_search($s[$i], $alphabet) % 2 === 0) {
                $result .= "1";
            } else {
                $result .= "0";
            }
        } else {
            $result .= "0";
        }
    }
    $resultWithSpaces = implode(' ', str_split($result, 5));

    return $resultWithSpaces . '!';
}

print_r(encode($s));
