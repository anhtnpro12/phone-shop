<?php

class Math
{
    function __call($name, $arguments)
    {
        if ($name === 'sum') {
            $result = 0;
            foreach ($arguments as $key => $value) {
                $result += $value;
            }
            return $result;
        }
    }
}

$a = new Math();
echo $a->sum(1, 2, 3, 4, 5);