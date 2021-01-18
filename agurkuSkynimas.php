<?php
// jeigu konstanta door bell define'inta.
defined('DOOR_BELL') || die('Iejimas tik uzsiregistravus');


include __DIR__ . '/vendor/autoload.php'; // <-------- autoloadiname vendoriaus faila, kuriame pagal psr4 standarta sudeti namespace

$store = new Main\Store('darzoves');

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $rawData = file_get_contents("php://input");
    $rawData = json_decode($rawData, 1);
    
    //listo scenarijus
    if (isset($rawData['listSkynimasA'])) {
            ob_start();
            include __DIR__.'/viewsSkynimas/listSkynimasA.php';
            $out = ob_get_contents();
            ob_end_clean();
            $json = ['listSkynimasA' => $out];
            $json = json_encode($json);
            header('Content-type: application/json');
            http_response_code(200);
            echo $json;
            die;
        
        }

        //listo scenarijus
    if (isset($rawData['listSkynimasM'])) {
        ob_start();
        include __DIR__.'/viewsSkynimas/listSkynimasM.php';
        $out = ob_get_contents();
        ob_end_clean();
        $json = ['listSkynimasM' => $out];
        $json = json_encode($json);
        header('Content-type: application/json');
        http_response_code(200);
        echo $json;
        die;
    
    }

// SKYNIMO SCENARIJUS AGURKO

if (isset($rawData['skintiA'])) {

    $store->skintiAgurka();
    Main\App::redirect(agurkuSkynimas);
}


if (isset($rawData['skintiVisusA'])) {

    $store->skintiVisusAgurkus();
    Main\App::redirect(agurkuSkynimas);
}

// SKYNIMO SCENARIJUS MOLIUGO

if (isset($rawData['skintiM'])) {

    $store->skintiMoliuga();
    Main\App::redirect(agurkuSkynimas);
}


if (isset($rawData['skintiVisusM'])) {

    $store->skintiVisusMoliugus();
    Main\App::redirect(agurkuSkynimas);
}

if (isset($rawData['skintiViska'])) {

    $store->visuAgurkuNuskynimas();
    Main\App::redirect(agurkuSkynimas);
}

if (isset($rawData['skintiViska'])) {

    $store->visuMoliuguNuskynimas();
    Main\App::redirect(agurkuSkynimas);
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" defer integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
    <script src="http://localhost/Projektas/Sodas/js/skynimas.js" defer></script>
    <script>const apiUrlS = "http://localhost/Projektas/Sodas/agurkuSkynimas";</script>
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
<h3>Skynimas</h3>
<div class="container"> 
    <div class="row">
        <button class="nuimti" type="submit" name="skintiViska">Nuimti visą derlių</button>
    </div>
    <div id="listSkynimasA" class="row"></div>
    <div id="listSkynimasM" class="row"></div>
</div>
</body>
</html>