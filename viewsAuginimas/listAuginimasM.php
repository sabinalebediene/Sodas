<?php foreach($store->getAllMoliugus() as $moliugas): ?>
        <?php $kiekis = rand(1, 3) ?>
            <div class="boxContentA">
                <h1 style="font-size: 20px;">Moliūgo nr. <?= $moliugas->id ?></h1>
                <img src="<?= $moliugas->photo ?>" alt="moliugas">
                <h1 style="display:inline;"><?= $moliugas->count ?></h1>
                <h3 style="display:inline;color:red;">+<?= $moliugas->auga() ?></h3>
                <input type="hidden" name="kiekis[<?= $moliugas->id ?>]" value="<?= $moliugas->auga() ?>">
            </div> 
    <?php endforeach ?>