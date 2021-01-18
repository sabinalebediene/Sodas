<?php
define('DOOR_BELL', 'ring'); // konstanta door bell yra define'inta. Durys
// kuriame kaip konstanta. Dedame instaliacini folderi. Jei butu www.bla..., tada nereikia daryti
define('INSTALL_FOLDER','/Projektas/Sodas/'); // <----- apsisprendziame, kur esam isiinstaliave savo aplikacija 
define('URL','http://localhost/Projektas/Sodas/');
define('DIR', __DIR__);


include __DIR__ . '/bootstrap.php'; // <----- include'iname koridoriu

Main\App::route();




