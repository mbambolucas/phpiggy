<?php

declare(strict_types=1);

class Test
{
    public function __construct()
    {
    }
    public function simpleArray(): array
    {
        $data = ["Name" => "Lucas", "Age" => "28"];

        return $data;
    }

    public function listArray(): array
    {
        $data = ['red', 'blue', 'black'];

        return $data;
    }

    public function display(array $array)
    {
        print_r($array);
    }

    public function add(array $array)
    {
        $array[] = [18, 'Abba', 'Siya'];
        print_r($array);
    }

    public function delete(array $array)
    {
        unset($array[0]);
        print_r($array);
    }

    public function multiDimensionalArray(): array
    {
        $data = [
            [28, 'Lucas', 'siya'],
            [29, 'Selma', 'Elombe'],
            [18, 'Abba', 'Siya']
        ];

        return $data;
    }

    public function foreachArray(array $array)
    {
        foreach ($array as $key => $value) {

            //echo "What is Age = {$key} and Name = {$value}<br/>";


            echo $array[2];
        }
        # code...
    }
}

/*
$test = new Test();

echo "<pre>";
$test->add($test->listArray());
echo "<pre>";

*/

$function = [
    function ($next) {
        echo "A <br/>";
        $next();
        echo "After the main content";
    },

    function ($next) {
        echo "B <br/>";
        $next();
    },

    function ($next) {
        echo "C <br/>";
        $next();
    },
];

$a = function () {
    echo "Main content <br/>";
};

foreach ($function as $function) {
    $a = fn () => $function($a);
}

$a();
