<?php

namespace Main;

use Cucumber\Agurkas;
use Pumpkin\Moliugas;
use Main\Controllers\SodinimasController;

class App {

    public static function route(){
        // imu instaliacini forlderi ir issitrinu, ir kuriame nauja URI i kuri eisime
        $uri = str_replace(INSTALL_FOLDER, '', $_SERVER['REQUEST_URI']); // <----- pasaliname savo folderi is duomenu

        $uri = explode('/', $uri); // <------ duomenis paverciam i masyva, su kurio galiu dirbti.

        // Router
        // mapina  -ima is URI ir pagal salyga include'ina failus
        // patikriname ar tai tas pats failas
        if ('agurkuSodinimas' == $uri[0]) {
            if (!isset($uri[1])) {
                return (new SodinimasController)->index(); 
            }
            if ('listAgurku' == $uri[1]) {
                return (new SodinimasController)->listAgurku(); 
            }
            if ('listMoliugu' == $uri[1]) {
                return (new SodinimasController)->listMoliugu(); 
            }
            if ('sodintiA' == $uri[1]) {
                return (new SodinimasController)->sodintiA(); 
            }
            if ('sodintiM' == $uri[1]) {
                return (new SodinimasController)->sodintiM(); 
            }
            if ('remove' == $uri[1]) {
                return (new SodinimasController)->rautiA(); 
            }
            if ('remove' == $uri[1]) {
                return (new SodinimasController)->rautiM(); 
            }
            // gera vieta prideti 404 puslapi (jei neatitinka virsuje esanciu if, tada nera tokio psl
        } 
        elseif ('agurkuSkynimas' == $uri[0]) {
            include DIR. '/agurkuSkynimas.php';
        } 
        elseif ('agurkuAuginimas' == $uri[0]) {
            include DIR. '/agurkuAuginimas.php';
        }
    }

    public static function redirect($name)
    {
        header('Location: '.URL.$name);
        exit;
    }
}