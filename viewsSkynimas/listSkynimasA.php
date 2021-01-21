<?php foreach($store->getAllAgurkus() as $agurkas): ?>
    <?php $kiekis = 0 ?>
        <div class="boxContentS agurkas">
            <p style="font-size: 20px;">Agurkas nr. <?= $agurkas->id ?></p>
            <img src="<?= $agurkas->photo ?>" alt="agurkas">
            <p class="galimaSkinti">Galima skinti: <?= $agurkas->count ?></p>
            <input name="kiekisA[<?= $agurkas->id ?>]" value="<?= $kiekis ?>">
            <button class="skinti" type="button" name="skintiA">SKINTI</button>
            <button class="btn-skinti" type="button" name="skintiVisusA" value="<?= $agurkas->id ?>">SKINTI VISUS</button>
        </div>  
    <?php endforeach ?>