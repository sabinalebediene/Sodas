<?php foreach($store->getAllMoliugus() as $moliugas): ?>
    <div class="boxContent moliugas">
        <p>Moliūgas nr. <?= $moliugas->id ?></p>
        <img src="<?= $moliugas->photo ?>" alt="moliugas">
        <p style="font-size: 18px;" >Moliūgų kiekis: <?= $moliugas->count ?></p>
        <p style="font-size: 18px;" >Moliūgų kaina: <?= round(($moliugas->price * $rate), 2) ?>USD/vnt.</p>
        <button class="btnRauti" type="button" name="rautiM" value="<?= $moliugas->id ?> ">IŠRAUTI</button>
    </div>            
<?php endforeach ?>