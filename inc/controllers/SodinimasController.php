<?php

namespace Main\Controllers;

use Main\Store;
use Cucumber\Agurkas;
use Pumpkin\Moliugas;

class SodinimasController {

    private $store, $rawData;

    public function __construct() 
    {
        if('POST' == $_SERVER['REQUEST_METHOD']) { // jei request metodas - POST, sodiname
            $this->store = new Store('darzoves');
            $this->rawData = file_get_contents("php://input");
            $this->rawData = json_decode($this->rawData, 1);
        
        }
    }

    
    // listAgurku sodinimo puslapio rodymo SCENARIJUS
    public function index() 
    {
        include DIR.'/viewsSodinimas/listAgurku.php';
        include DIR.'/viewsSodinimas/listMoliugu.php';
    }

    // listAgurku SCENARIJUS
    public function listAgurku() 
    {
        // kreipiames i views ir turime perduoti kintamuosius, tam kad jis galetu uzpildyti template
        $store = new Store('darzoves');
        ob_start();
        include DIR.'/viewsSodinimas/listAgurku.php';
        $out = ob_get_contents();
        ob_end_clean();
        $json = ['listAgurku' => $out];
        $json = json_encode($json);
        header('Content-type: application/json');
        http_response_code(200);
        echo $json;
        die;
    }

    // listAgurku SCENARIJUS
    public function listMoliugu() 
    {
        // kreipiames i views ir turime perduoti kintamuosius, tam kad jis galetu uzpildyti template
        $store = new Store('darzoves');
        ob_start();
        include DIR.'/viewsSodinimas/listMoliugu.php';
        $out = ob_get_contents();
        ob_end_clean();
        $json = ['listMoliugu' => $out];
        $json = json_encode($json);
        header('Content-type: application/json');
        http_response_code(200);
        echo $json;
        die;
    }

    // SODINIMO SCENARIJUS AGURKU
    public function sodintiA()
    {
        $kiekis = (int) $this->rawData['kiekis'];

        $kiekis = $kiekis ? $kiekis : 1;

        if (0 > $kiekis || 4 < $kiekis) { // <--- validacija
            if (0 > $kiekis) {
                $error = 1; // <-- neigiamas agurku kiekis
            }
            elseif(4 < $kiekis) {
                $error = 2; // <-- per daug
            }

            ob_start(); // <------kibiro pakisima po ciaupu, kad begtu i kibira
            include DIR.'/viewsSodinimas/error.php';
            $out = ob_get_contents();
            ob_end_clean(); // <------ narsykle kol kas nieko negauna, bet ta informacija yra susemta i vieta $out kintamaji
            $json = ['msg' => $out];
            $json = json_encode($json);
            header('Content-type: application/json');
            http_response_code(400);
            echo $json;
            die;
        }

        foreach(range(1, $kiekis) as $_) {
            $agurkoObj = new Agurkas($this->store->getNewId());
            $this->store->addNewAgurkas($agurkoObj);
        }
        ob_start();
        $store = $this->store;
        include DIR.'/viewsSodinimas/listAgurku.php'; // <---- liepiame listui sugeneruoti nauja sarasa
        $out = ob_get_contents();
        ob_end_clean(); // narsykle kol kas nieko negauna, bet ta informacija yra susemta ir vieta $out kintamaji
        $json = ['listAgurku' => $out];
        $json = json_encode($json);
        header('Content-type: application/json');
        http_response_code(201);
        echo $json; // yra kintamasis list, kuriame isgeneruotas agurku sarsas
        die;
    }

    // SODINIMO SCENARIJUS MOLIUGU
    public function sodintiM()
    {
        $kiekis = (int) $this->rawData['kiekis'];
        
        $kiekis = $kiekis ? $kiekis : 1;

        if (0 > $kiekis || 4 < $kiekis) { // <--- validacija
            if (0 > $kiekis) {
                $error = 1; // <-- neigiamas agurku kiekis
            }
            elseif(4 < $kiekis) {
                $error = 2; // <-- per daug
            }

            ob_start(); // <------kibiro pakisima po ciaupu, kad begtu i kibira
            include DIR.'/viewsSodinimas/error.php';
            $out = ob_get_contents();
            ob_end_clean(); // <------ narsykle kol kas nieko negauna, bet ta informacija yra susemta i vieta $out kintamaji
            $json = ['msg' => $out];
            $json = json_encode($json);
            header('Content-type: application/json');
            http_response_code(400);
            echo $json;
            die;
        }

        foreach(range(1, $kiekis) as $_) {
            $moliugoObj = new Moliugas($this->store->getNewId());
            $this->$store->addNewMoliugas($moliugoObj);
        }

        ob_start();
        $store = $this->store;
        include DIR.'/viewsSodinimas/listMoliugu.php'; // <---- liepiame listui sugeneruoti nauja sarasa
        $out = ob_get_contents();
        ob_end_clean(); // narsykle kol kas nieko negauna, bet ta informacija yra susemta ir vieta $out kintamaji
        $json = ['listMoliugu' => $out];
        $json = json_encode($json);
        header('Content-type: application/json');
        http_response_code(201);
        echo $json; // yra kintamasis list, kuriame isgeneruotas agurku sarsas
        die;
    }
    
    // ISROVIMO SCENARIJUS AGURKO
    public function rautiA()
    {
        $this->$store->removeAgurkus($this->rawData['id']);
        ob_start();
        $store = $this->store;
        include DIR.'/viewsSodinimas/listAgurku.php';
        $out = ob_get_contents();
        ob_end_clean();
        $json = ['listAgurku' => $out];
        $json = json_encode($json);
        header('Content-type: application/json');
        http_response_code(200);
        echo $json;
        die;

    }
    
    // ISROVIMO SCENARIJUS MOLIUGO
    public function rautiM()
    {
        $this->$store->removeMoliugus($this->rawData['id']);
        ob_start();
        $store = $this->store;
        include DIR.'/viewsSodinimas/listMoliugu.php';
        $out = ob_get_contents();
        ob_end_clean();
        $json = ['listMoliugu' => $out];
        $json = json_encode($json);
        header('Content-type: application/json');
        http_response_code(200);
        echo $json;
        die;
    } 
    
}
?>


