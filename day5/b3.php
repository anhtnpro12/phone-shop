<?php

class Math {
    public static function sum($a = 0, $b = 0) {
        return $a + $b;
    } 

    public static function sub($a = 0, $b = 0) {
        return $a - $b;
    }

    public static function multi($a = 0, $b = 0) {
        return $a * $b;
    }
}

$a = 5;
$b = 2;

echo $a.' + '.$b.' = '.Math::sum($a, $b).'<br>';
echo $a.' - '.$b.' = '.Math::sub($a, $b).'<br>';
echo $a.' * '.$b.' = '.Math::multi($a, $b).'<br>';