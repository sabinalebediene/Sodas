<?php foreach($store->getAllAgurkus() as $agurkas): ?>
   <div class="boxContent agurkas">
        <p>Agurkas nr. <?= $agurkas->id ?></p>
        <img src="<?= $agurkas->photo ?>" alt="agurkas">
        <p style="font-size: 18px;" >Agurkų kiekis: <?= $agurkas->count ?></p>
        <p style="font-size: 18px;" >Agurkų kaina: <?= round(($agurkas->price * $rate), 2) ?>USD/vnt.</p>
        <button class="btnRauti" type="button" name="rautiA" value="<?= $agurkas->id ?> ">IŠRAUTI</button>
    </div>              
<?php endforeach ?>

