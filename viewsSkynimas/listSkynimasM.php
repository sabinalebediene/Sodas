<?php foreach($store->getAllMoliugus() as $moliugas): ?>
    <?php $kiekis = 0 ?>
            <div class="boxContentS moliugas">
                <p style="font-size: 20px;">Moliūgas nr. <?= $moliugas->id ?></p>
                <img src="<?= $moliugas->photo ?>" alt="moliugas">
                <p class="galimaSkinti">Galima skinti: <?= $moliugas->count ?></p>
                <input name="kiekis[<?= $moliugas->id ?>]" value="<?= $kiekis ?>">
                <button class="skinti" type="button" name="skintiM">SKINTI</button>
                <button class="btn-skinti" type="button" name="skintiVisusM" value="<?= $moliugas->id ?>">SKINTI VISUS</button>
            </div>  
        <?php endforeach ?>