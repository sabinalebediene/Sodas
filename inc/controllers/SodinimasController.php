<?php

namespace Main\Controllers;

use Main\Store;
use Main\App;
use Main\Catche;
use Cucumber\Agurkas;
use Pumpkin\Moliugas;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class SodinimasController {

    private $store, $rawData, $DATA, $rate;

    public function __construct() 
    {
       if('POST' == $_SERVER['REQUEST_METHOD']) { // jei request metodas - POST, sodiname
            $this->store = App::store('darzoves');
            $this->DATA = new Catche;
            $this->rate = App::getRate($this->DATA);
            $this->rawData = App::$request->getContent(); // <----SYMFONY
            $this->rawData = json_decode($this->rawData, 1);
        
       }
    }

    
    // listAgurku sodinimo puslapio rodymo SCENARIJUS
    public function index() 
    {

        $response = new Response( // <----atsakymas narsyklei
            'Content',
            200,
            ['content-type' => 'text/html']
        );

        // $store =  new Store('darzoves');
        ob_start();
        include DIR.'/viewsSodinimas/index.php'; 
        $out = ob_get_contents(); // <----gauna info, kuria sius i narsykle
        ob_end_clean();


        $response->setContent($out);
        $response->prepare(App::$request);

        return $response; // <---iskviete route'is, route'is grazina response indexe    

    }

    // listAgurku SCENARIJUS
    public function listAgurku() 
    {
        // kreipiames i views ir turime perduoti kintamuosius, tam kad jis galetu uzpildyti template
        
        ob_start();
        $store = App::store('darzoves');
        $rate = $this->rate;
        include DIR.'/viewsSodinimas/listAgurku.php';
        $out = ob_get_contents();
        ob_end_clean();
        
        $json = ['listAgurku' => $out];
        
        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;

    }

    // listAgurku SCENARIJUS
    public function listMoliugu() 
    {
        // kreipiames i views ir turime perduoti kintamuosius, tam kad jis galetu uzpildyti template
        $store = App::store('darzoves');
        $rate = $this->rate;
        ob_start();
        include DIR.'/viewsSodinimas/listMoliugu.php';
        $out = ob_get_contents();
        ob_end_clean();
        $json = ['listMoliugu' => $out];
        
        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;
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
        $rate = $this->rate;
        include DIR.'/viewsSodinimas/listAgurku.php'; // <---- liepiame listui sugeneruoti nauja sarasa
        $out = ob_get_contents();
        ob_end_clean(); // narsykle kol kas nieko negauna, bet ta informacija yra susemta ir vieta $out kintamaji
        $json = ['listAgurku' => $out];

        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;
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
            $this->store->addNewMoliugas($moliugoObj);
        }

        ob_start();
        $store = $this->store;
        $rate = $this->rate;
        include DIR.'/viewsSodinimas/listMoliugu.php'; // <---- liepiame listui sugeneruoti nauja sarasa
        $out = ob_get_contents();
        ob_end_clean(); // narsykle kol kas nieko negauna, bet ta informacija yra susemta ir vieta $out kintamaji
        $json = ['listMoliugu' => $out];

        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;
    }
    
    // ISROVIMO SCENARIJUS AGURKO
    public function rautiA()
    {
        $this->store->removeAgurkus($this->rawData['id']);

        $store = $this->store;
        $rate = $this->rate;
        ob_start();
        include DIR.'/viewsSodinimas/listAgurku.php';
        $out = ob_get_contents();
        ob_end_clean();
        $json = ['listAgurku' => $out];
        
        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;
    }
    
    // ISROVIMO SCENARIJUS MOLIUGO
    public function rautiM()
    {
        $this->store->removeMoliugus($this->rawData['id']);

        $store = $this->store;
        $rate = $this->rate;
        ob_start();
        include DIR.'/viewsSodinimas/listMoliugu.php';
        $out = ob_get_contents();
        ob_end_clean();
        $json = ['listMoliugu' => $out];
        
        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;
    } 
    
}
?>


