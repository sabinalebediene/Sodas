<?php

namespace Pumpkin;

use Vegetables\Darzoves;

class Moliugas extends Darzoves {


    public function __construct($lastId) 
    {
        $this->id = $lastId + 1;
        $this->count = 0;
        $this->price = 0.1;
        $photos = [
            "./img/Moliugai/moliugas1.jpg", 
            "./img/Moliugai/moliugas2.jpg", 
            "./img/Moliugai/moliugas3.jpg",  
            "./img/Moliugai/moliugas4.jpg", 
            "./img/Moliugai/moliugas5.jpg", 
            "./img/Moliugai/moliugas6.jpg", 
    ];
        $this->photo = $photos[array_rand($photos)];
    }

    public function auga()
    {
        return rand(1, 3);
    }

}