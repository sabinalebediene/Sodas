<?php

namespace Vegetables;

use Greenhouse\Siltnamis;

abstract class Darzoves implements Siltnamis {

    private $id, $count, $photo;

    // public static function nuimtiDerliu($visosDarzoves) // <----- $visiAgurkai = $_SESSION['obj']
    // {
    //     foreach($visosDarzoves as $index => $darzoves) { // <---- serializuotas stringas
    //         $darzoves = unserialize($darzoves); // <----- agurko objektas
    //         $darzoves->nuskintiVisus();
    //         $darzoves = serialize($darzoves); // <------ vel stringas
    //         $visosDarzoves[$index] = $darzoves; // <----- uzsaugom agurkus
    //     }
    //     return $visosDarzoves;
    // }

    public function __construct($lastId) 
    {

    }

    public function __get($propertyName) 
    {
        return $this->$propertyName;
    }

    public function __set($propertyName, $value) 
    {
        $this->$propertyName = $value;
    }

    public function addDarzove($darzoves)
    {
        $this->count = $this->count + $darzoves;
    }

    public function removeVegatable($darzoves)
    {
        if($darzoves < 0){
            $_SESSION['err'] = 1; 
        }
        elseif($darzoves > $this->count ){
            $_SESSION['err'] = 3;  
        } else{

        $this->count -= $darzoves;
        }
    }

    public function removeAllVegatable($darzoves)
    {
        if($darzoves == $this->id) {
            $this->count = 0;
            }
    }

    public function nuskintiVisus()
    {
        $this->count = 0;
    }

    abstract public function auga();

    // Visai nebutina
    // public function __serialize() // <---- ivyksta kai objektas yra serializuojamas
    // {

    // }



}