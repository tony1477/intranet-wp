<?php

namespace App\Libraries;

trait DataTrait
{
    private array $array;
    public function storeData(array $array) :void {
        foreach($array as $key => $value):
            $this->array[$key] = $value;
        endforeach;
    }

    public function getValue(string $key) :string {
        return $this->array[$key];
    }
}
