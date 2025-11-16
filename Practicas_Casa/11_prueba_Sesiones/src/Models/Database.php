<?php

namespace App\Models;

class Database{
    private $filePath;

    public function __construct(){
            $this->filePath = __DIR__ . "/HeroesYVillanos.json";
    }

    public function loadPjs(){
        $pjs = json_decode(file_get_contents($this->filePath), true) ?? [];
        return $pjs;
    }
}
