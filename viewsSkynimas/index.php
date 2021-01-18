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