<?php

namespace Main;

use Cucumber\Agurkas;
use Pumpkin\Moliugas;
use Main\Controllers\SodinimasController;
use Main\Controllers\AuginimasController;
use Main\Controllers\SkynimasController;
use Symfony\Component\HttpFoundation\Request;

class App {

    public static $request;

    private static $storeSetting = 'db'; // json OR DB

    public static function start()
    {
        self::$request = Request::createFromGlobals();

        return self::route();
    }

    // factory-gamins objektus json arba DB
    public static function store($type) 
    {
        if ('json' == self::$storeSetting) {
            return new JsonStore($type);
        }
        if ('db' == self::$storeSetting) {
            return new DbStore($type);
        }
    }

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
            if ('removeA' == $uri[1]) {
                return (new SodinimasController)->rautiA(); 
            }
            if ('removeM' == $uri[1]) {
                return (new SodinimasController)->rautiM(); 
            }
            // gera vieta prideti 404 puslapi (jei neatitinka virsuje esanciu if, tada nera tokio psl
        } 
        elseif ('agurkuSkynimas' == $uri[0]) {
            if (!isset($uri[1])) {
                
                return (new SkynimasController)->index(); 
            }
            if ('listSkynimasA' == $uri[1]) {
            
                return (new SkynimasController)->listSkynimasA(); 
            }
            if ('listSkynimasM' == $uri[1]) {
                return (new SkynimasController)->listSkynimasM(); 
            }
            if ('skintiA' == $uri[1]) {
                return (new SkynimasController)->skintiA(); 
            }
            if ('skintiVisusA' == $uri[1]) {
                return (new SkynimasController)->skintiVisusA(); 
            }
            if ('skintiM' == $uri[1]) {
                return (new SkynimasController)->skintiM(); 
            }
            if ('skintiVisusM' == $uri[1]) {
                return (new SkynimasController)->skintiVisusM(); 
            }
            if ('skintiViska' == $uri[1]) {
                return (new SkynimasController)->skintiViska(); 
            }
            if ('skintiViska' == $uri[1]) {
                return (new SkynimasController)->skintiViska(); 
            }
            // gera vieta prideti 404 puslapi (jei neatitinka virsuje esanciu if, tada nera tokio psl
        } 
        elseif ('agurkuAuginimas' == $uri[0]) {
            if (!isset($uri[1])) {
                
                return (new AuginimasController)->index(); 
            }
            if ('listAuginimasA' == $uri[1]) {
            
                return (new AuginimasController)->listAuginimasA(); 
            }
            if ('listAuginimasM' == $uri[1]) {
                return (new AuginimasController)->listAuginimasM(); 
            }
            if ('augintiA' == $uri[1]) {
                return (new AuginimasController)->augintiA(); 
            }
            if ('augintiM' == $uri[1]) {
                return (new AuginimasController)->augintiM(); 
            }
            // gera vieta prideti 404 puslapi (jei neatitinka virsuje esanciu if, tada nera tokio psl
        }
    }

    public static function redirect($name)
    {
        header('Location: '.URL.$name);
        exit;
    }
}