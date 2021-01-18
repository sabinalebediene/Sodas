<?php
namespace Main\Controllers;

use Main\Store;
use Main\App;
use Cucumber\Agurkas;
use Pumpkin\Moliugas;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class SkynimasController {

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
        include DIR.'/viewsSkynimas/index.php'; 
        $out = ob_get_contents(); // <----gauna info, kuria sius i narsykle
        ob_end_clean();
        
        
        $response->setContent($out);
        $response->prepare(App::$request);
        
        return $response; // <---iskviete route'is, route'is grazina response indexe
    }
    
    //listo scenarijus
    public function listSkynimasA() 
    {
        // kreipiames i views ir turime perduoti kintamuosius, tam kad jis galetu uzpildyti template
        $store =  $this->store;
        ob_start();
        include DIR.'/viewsSkynimas/listSkynimasA.php';
        $out = ob_get_contents();
        ob_end_clean();
        
        $json = ['listSkynimasA' => $out];
        
        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;

    }

    public function listSkynimasM() 
    {
        // kreipiames i views ir turime perduoti kintamuosius, tam kad jis galetu uzpildyti template
        $store =  $this->store;
        ob_start();
        include DIR.'/viewsSkynimas/listSkynimasM.php';
        $out = ob_get_contents();
        ob_end_clean();
        
        $json = ['listSkynimasM' => $out];
        
        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;

    }

    // SKYNIMO SCENARIJUS AGURKO
    public function skintiA()
    {
        $this->$store->skintiAgurka();
        ob_start();
        $store = $this->store;
        include DIR.'/viewsSkynimas/listSkynimasA.php';
        $out = ob_get_contents();
        ob_end_clean();

        $json = ['listSkynimasA' => $out];
        
        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;

    }

    public function skintiVisusA()
    {
        $this->$store->skintiVisusAgurkus();
        ob_start();
        $store = $this->store;
        include DIR.'/viewsSkynimas/listSkynimasA.php';
        $out = ob_get_contents();
        ob_end_clean();

        $json = ['listSkynimasA' => $out];
        
        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;

    }

    // SKYNIMO SCENARIJUS MOLIUGO

    public function skintiM()
    {
        $this->$store->skintiMoliuga();
        ob_start();
        $store = $this->store;
        include DIR.'/viewsSkynimas/listSkynimasM.php';
        $out = ob_get_contents();
        ob_end_clean();

        $json = ['listSkynimasM' => $out];
        
        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;

    }

    public function skintiVisusM()
    {
        $this->$store->skintiVisusMoliugus();
        ob_start();
        $store = $this->store;
        include DIR.'/viewsSkynimas/listSkynimasM.php';
        $out = ob_get_contents();
        ob_end_clean();

        $json = ['listSkynimasM' => $out];
        
        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;

    }

    public function skintiViska()
    {
        $this->$store->visuAgurkuNuskynimas();
        $this->$store->visuMoliuguNuskynimas();
        ob_start();
        $store = $this->store;
        include DIR.'/viewsSkynimas/listSkynimasA.php';
        include DIR.'/viewsSkynimas/listSkynimasM.php';
        $out = ob_get_contents();
        ob_end_clean();

        $json = ['listSkynimasA' => $out];
        
        $response = new JsonResponse($json); // <---JSON responsas

        $response->prepare(App::$request);

        return $response;

    }
}
?>
