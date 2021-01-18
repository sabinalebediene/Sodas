<?php foreach($store->getAllAgurkus() as $agurkas): ?>
    <?php $kiekis = 0 ?>
        <div class="gardenContent">
            <div class="boxContentS">
                <p style="font-size: 20px;">Agurkas nr. <?= $agurkas->id ?></p>
                <img src="<?= $agurkas->photo ?>" alt="agurkas">
                <p class="galimaSkinti">Galima skinti: <?= $agurkas->count ?></p>
                <input name="kiekis[<?= $agurkas->id ?>]" value="<?= $kiekis ?>">
                <button class="skinti" type="submit" name="skintiA">SKINTI</button>
                <button class="btn-skinti" type="submit" name="skintiVisusA" value="<?= $agurkas->id ?>">SKINTI VISUS</button>
            </div>  
        </div>
    <?php endforeach ?>