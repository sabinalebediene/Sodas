<?php

namespace Main\Controllers;

use Main\Store;
use Main\App;
use Cucumber\Agurkas;
use Pumpkin\Moliugas;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class AuginimasController {

    private $store, $rawData;


    public function __construct() 
    {
        if('POST' == $_SERVER['REQUEST_METHOD']) { // jei request metodas - POST, sodiname
            $this->store = new Store('darzoves');
            $this->rawData = App::$request->getContent(); // <----SYMFONY
            $this->rawData = json_decode($this->rawData, 1);
        }
    }

    // auginimo puslapio rodymo SCENARIJUS
    public function index() 
    {
    
        $response = new Response( // <----atsakymas narsyklei
            'Content',
            200,
            ['content-type' => 'text/html']
        );

        ob_start();
        include DIR.'/viewsAuginimas/index.php'; 
        $out = ob_get_contents(); // <----gauna info, kuria sius i narsykle
        ob_end_clean();
    
    
        $response->setContent($out);
        $response->prepare(App::$request);
    
        return $response; // <---iskviete route'is, route'is grazina response indexe
    }
    

    //listo scenarijus

    public function listAuginimasA() 
    {
        // kreipiames i views ir turime perduoti kintamuosius, tam kad jis galetu uzpildyti template
        $store =  $this->store;
        ob_start();
        include DIR.'/viewsAuginimas/listAuginimasA.php';
        $out = ob_get_contents();
        ob_end_clean();
        
        $json = ['listAuginimasA' => $out];
        
        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;

    }

    public function listAuginimasM() 
    {
        // kreipiames i views ir turime perduoti kintamuosius, tam kad jis galetu uzpildyti template
        $store = $this->store;
        ob_start();
        include DIR.'/viewsAuginimas/listAuginimasM.php';
        $out = ob_get_contents();
        ob_end_clean();
        
        $json = ['listAuginimasM' => $out];
        
        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;

    }

    // AUGINIMO SCENARIJUS AGURKU
    public function augintiA()
    {
        $this->store->augintiAgurkus();
        ob_start();
        $store = $this->store;
        include DIR.'/viewsAuginimas/listAuginimasA.php';
        $out = ob_get_contents();
        ob_end_clean();

        $json = ['listAuginimasA' => $out];
        
        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;

    }

    // AUGINIMO SCENARIJUS MOLIUGU
    public function augintiM()
    {
        $this->store->augintiMoliugus();
        ob_start();
        $store = $this->store;
        include DIR.'/viewsAuginimas/listAuginimasM.php';
        $out = ob_get_contents();
        ob_end_clean();

        $json = ['listAuginimasM' => $out];
        
        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;


    }
}

?>
