<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" defer integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
    <script src="http://localhost/Projektas/Sodas/js/sodinimasApp.js" defer></script>
    <script>const apiUrl = "http://localhost/Projektas/Sodas/agurkuSodinimas";</script>
    <title>Sodinimas</title>
</head>
<style>
<?php include DIR.'/css/layout.css'; ?>
<?php include DIR.'/css/style.css'; ?>
</style>
<body>
    <header class="menu">
        <a href="<?= URL.'agurkuSkynimas' ?>">Daržovių skynimas</a>
        <a href="<?= URL.'agurkuAuginimas' ?>">Daržovių auginimas</a>
        <a href="<?= URL.'agurkuSodinimas' ?>">Daržovių sodinimas</a>
    </header>
    <h1>Daržovių sodas</h1>
    <h3>Sodinimas</h3>
    <div id="error"></div>
    <div class="container">  
        <div class="row">  
            <input type="text" name="kiekisA" id="cucumber">
            <button class="sodinti" type="button" name="sodintiA" id="sodintiAgurka">Sodinti Agurkus</button> 
            <input type="text" name="kiekisM" id="pumpkin">
            <button class="sodinti" type="button" name="sodintiM" id="sodintiMoliuga">Sodinti Moliūgus</button>
        </div>  
        <div id="listAgurku" class="row"></div>
        <div id="listMoliugu" class="row"></div> 
    </div> 
</body>
</html>