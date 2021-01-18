<?php

// jeigu konstanta door bell define'inta.
defined('DOOR_BELL') || die('Iejimas tik uzsiregistravus');


include __DIR__ . '/vendor/autoload.php'; // <-------- autoloadiname vendoriaus faila, kuriame pagal psr4 standarta sudeti namespace

$store = new Main\Store('darzoves');

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $rawData = file_get_contents("php://input");
    $rawData = json_decode($rawData, 1);
    
    //listo scenarijus
    if (isset($rawData['listAuginimasA'])) {
            ob_start();
            include __DIR__.'/viewsAuginimas/listAuginimasA.php';
            $out = ob_get_contents();
            ob_end_clean();
            $json = ['listAuginimasA' => $out];
            $json = json_encode($json);
            header('Content-type: application/json');
            http_response_code(200);
            echo $json;
            die;
        
        }

        //listo scenarijus
    if (isset($rawData['listAuginimasM'])) {
        ob_start();
        include __DIR__.'/viewsAuginimas/listAuginimasM.php';
        $out = ob_get_contents();
        ob_end_clean();
        $json = ['listAuginimasM' => $out];
        $json = json_encode($json);
        header('Content-type: application/json');
        http_response_code(200);
        echo $json;
        die;
    
    }

// AUGINIMO SCENARIJUS AGURKU
if (isset($rawData['augintiA'])) {

    $store->augintiAgurkus();
    Main\App::redirect(agurkuAuginimas);
}

// AUGINIMO SCENARIJUS MOLIUGU
if (isset($rawData['augintiM'])) {

    $store->augintiMoliugus();
    Main\App::redirect(agurkuAuginimas);
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" defer integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
    <script src="http://localhost/Projektas/Sodas/js/auginimas.js" defer></script>
    <script>const apiUrlA = "http://localhost/Projektas/Sodas/agurkuAuginimas";</script>
    <title>Auginimas</title>
</head>
<style>
<?php include __DIR__.'/css/layout.css'; ?>
<?php include __DIR__.'/css/style.css'; ?>
</style>
<body>
<header class="menu">
    <a href="<?= URL.'agurkuSkynimas' ?>">Daržovių skynimas</a>
    <a href="<?= URL.'agurkuAuginimas' ?>">Daržovių auginimas</a>
    <a href="<?= URL.'agurkuSodinimas' ?>">Daržovių sodinimas</a>
</header>
<h1>Daržovių sodas</h1>
<h3>Auginimas</h3>
<div class="container">  
    <div class="row"> 
        <button class="auginti" type="submit" name="augintiA">Auginti Agurkus</button>
        <button class="auginti" type="submit" name="augintiM">Auginti Moliūgus</button>
    </div>  
    <div id="listAuginimasA" class="row"></div>
    <div id="listAuginimasM" class="row"></div>
    </div> 
</body>
</html>