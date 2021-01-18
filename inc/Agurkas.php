<?php

namespace Cucumber;

use Vegetables\Darzoves;

class Agurkas extends Darzoves {

    

    public function __construct($lastId) 
    {
        $this->id = $lastId + 1;
        $this->count = 0;
        $photos = [
            "./img/Agurkai/agurkas1.jpg", 
            "./img/Agurkai/agurkas2.jpg", 
            "./img/Agurkai/agurkas3.jpg", 
            "./img/Agurkai/agurkas4.jpg",
            "./img/Agurkai/agurkas5.jpg",
    ];
        $this->photo = $photos[array_rand($photos)];
    }

    public function auga()
    {
        return rand(2, 9);
    }

}