<?php foreach($store->getAllAgurkus() as $agurkas): ?>
            <div class="boxContentA">
                <h1 style="font-size: 20px;">Agurkas nr. <?= $agurkas->id ?></h1>
                <img src="<?= $agurkas->photo ?>" alt="agurkas">
                <h1 style="display:inline;"><?= $agurkas->count ?></h1>
                <h3 style="display:inline;color:red;">+<?= $agurkas->auga() ?></h3>
                <input type="hidden" name="kiekis[<?= $agurkas->id ?>]" value="<?= $agurkas->auga() ?>">
            </div> 
    <?php endforeach ?>