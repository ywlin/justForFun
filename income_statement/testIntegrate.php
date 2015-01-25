<?php

$file_contents = file_get_contents('102-1.csv');
var_dump($file_contents);
class DeconstructureIncomeStatement
{

    public $raw;
    public function __construct(array $raw)
    {
        $this->raw = $raw;
    }
}
