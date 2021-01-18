<?php
namespace Main;

use Cucumber\Agurkas;
use Pumpkin\Moliugas;

// atsakinga vien tik uz irasima ir nuskaityma is failo

class Store {

    // konstanta - kelias i ta vieta kur gules json failas
    private const PATH = DIR.'/data/';

    private $fileName = 'sodas';
    private $data; //<----- duomenis nuskaitome per privatu kintamaji

    // gauna $file is kurio skaito duomenis arba raso
    public function __construct($file)
    {
        $this->fileName = $file;
        if (!file_exists(self::PATH.$this->fileName.'.json')) {
            file_put_contents(self::PATH.$this->fileName.'.json', json_encode(['objA' => [], 'objM' => [],'ID' => 0, 'photo' => '' ])); // pradinis masyvas
            $this->data = ['objA' => [], 'objM' => [],'ID' => 0, 'photo' => '' ];
        }
        else {
            $this->data = file_get_contents(self::PATH.$this->fileName.'.json'); // nuskaitom faila
            $this->data = json_decode($this->data, 1); // paverciam masyvu
        }
    }

    // kad galetume irasyti i faila atgal. PO pakeitimo, automatiskai pasileis destructorius ir viska issaugos i faila
    // tokiu atveju nereikia tureti metodo save();
    public function __destruct()
    {
        file_put_contents(self::PATH.$this->fileName.'.json', json_encode($this->data)); // viska vel uzsaugom faile
    }

    public function getData()
    {
        return $this->data;
    }

    // iraso duomenis
    public function setData($data)
    {
        $this->data = $data;
    }

    public function getNewId() 
    {
        $id = $this->data['ID'];
        $this->data['ID']++;
        return $id;
    }

    public function addNewAgurkas(Agurkas $objA) 
    {
        $this->data['objA'][] = serialize($objA);
    }

    public function addNewMoliugas(Moliugas $objM) 
    {
        $this->data['objM'][] = serialize($objM);
    }

    public function getAllAgurkus() 
    {
        $allAgurkai = [];
        foreach($this->data['objA'] as $obj) {
            $allAgurkai[] = unserialize($obj);
        }
        return $allAgurkai;
    }
    public function getAllMoliugus() 
    {
        $allMoliugai = [];
        foreach($this->data['objM'] as $obj) {
            $allMoliugai[] = unserialize($obj);
        }
        return $allMoliugai;
    }

    public function removeAgurkus($id) 
    {
        foreach($this->data['objA'] as $index => $obj) {
            $obj = unserialize($obj);
            if ($obj->id == $id) {
                unset($this->data['$objA'][$index]); //rauti, ar to objekto ID, taip
            }
        }
    }

    public function removeMoliugus($id) 
    {
        foreach($this->data['objM'] as $index => $obj) {
            $obj = unserialize($obj);
            if ($obj->id == $id) {
                unset($this->data['$objM'][$index]); //rauti, ar to objekto ID, taip
            }
        }
    }

    public function augintiAgurkus()
    {
        foreach($this->data['objA'] as $index => $obj)
        {
            $obj = unserialize($obj); 
            $obj->addDarzove($_POST['kiekis'][$obj->id]);
            $obj = serialize($obj); 
            $this->data['objA'][$index] = $obj;
        }
    }

    public function augintiMoliugus()
    {
        foreach($this->data['objM'] as $index => $obj)
        {
            $obj = unserialize($obj); 
            $obj->addDarzove($_POST['kiekis'][$obj->id]);
            $obj = serialize($obj); 
            $this->data['objM'][$index] = $obj;
        }
    }

    public function skintiAgurkus()
    {
        foreach($this->data['objA'] as $index => $obj){
            $obj = unserialize($obj); 
            $obj->removeVegatable($_POST['kiekis'][$obj->id]);
            $obj = serialize($obj); 
            $this->data['objA'][$index] = $obj;
        }
    }

    public function skintiMoliuga()
    {
        foreach($this->data['objM'] as $index => $obj){
            $obj = unserialize($obj); 
            $obj->removeVegatable($_POST['kiekis'][$obj->id]);
            $obj = serialize($obj); 
            $this->data['objM'][$index] = $obj;
        }
    }

    public function skintiVisusAgurkus(){
        foreach($this->data['objA'] as $index => $obj){
            $obj = unserialize($obj); 
            if ($_POST['skintiVisusA'] == $obj->id) {
                $obj->removeAllVegatable($_POST['skintiVisusA'][$obj->id]);
                $obj = serialize($obj); 
                $this->data['objA'][$index] = $obj; 
            }
        }
    }

    public function skintiVisusMoliugus(){
        foreach($this->data['objM'] as $index => $obj){
            $obj = unserialize($obj); 
            if ($_POST['skintiVisusA'] == $obj->id) {
                $obj->removeAllVegatable($_POST['skintiVisusA'][$obj->id]);
                $obj = serialize($obj); 
                $this->data['objM'][$index] = $obj; 
            }
        }
    }

    public function visuAgurkuNuskynimas(){
        foreach($this->data['objA'] as $index => $obj){
            $obj = unserialize($obj); 
            $obj->nuskintiVisus($_POST['skintiViska'][$obj->id]);// atimam agurka
            $obj = serialize($obj); // vel stringas
            $this->data['objM'][$index] = $obj; // uzsaugom agurkus
        }
    }

    public function visuMoliuguNuskynimas(){
        foreach($this->data['objM'] as $index => $obj){
            $obj = unserialize($obj); 
            $obj->nuskintiVisus($_POST['skintiViska'][$obj->id]);// atimam agurka
            $obj = serialize($obj); // vel stringas
            $this->data['objM'][$index] = $obj; // uzsaugom agurkus
        }
    }

}