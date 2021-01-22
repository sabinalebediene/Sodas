<?php
namespace Main;

use Cucumber\Agurkas;
use Pumpkin\Moliugas;

// interface reikajau f-jos getData ir is Json ir is DBStore
// tam kad apjungtumeme 2 skirtingas klases.
// viduje jos dirba skirtingai, o getData daro vienoda f-ja, todel turime interface.
interface Store 
{
    // function getData();
    // function setData($data);
    function getNewId();
    function addNewAgurkas(Agurkas $objA);
    function addNewMoliugas(Moliugas $objM);
    function getAllAgurkus();
    function getAllMoliugus(); 
    function removeAgurkus($id);
    function removeMoliugus($id);

}