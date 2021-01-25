<?php
namespace Main;

use Cucumber\Agurkas;
use Pumpkin\Moliugas;
use PDO;

class DbStore implements Store {

    private $pdo;


    public function __construct()
    {

        $host = '127.0.0.1'; // <----hostas
        $db   = 'darzoviu_baze'; // db pavadinimas
        $user = 'root';         // nereikia keisti
        $pass = '';            // nereikia keisti
        $charset = 'utf8mb4'; // nereikia keisti

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, $user, $pass, $options);

    }   
    
    public function getAllAgurkus()
    {
        //SKAITYMAS
        $sql = "SELECT * FROM darzove
        ;";
        $stmt = $this->pdo->query($sql); // <---saugi

        $agurkuMasyvas = [];
        while ($row = $stmt->fetch())
        {
            if ('agurkas' == $row['type']) {
                $objA = new Agurkas($row['id']);
                $objA->id = $row['id'];
                $objA->count = $row['count'];
                $objA->type = $row['type'];
                $objA->price = $row['price'];
                $agurkuMasyvas[] = $objA;
            }
        }
        return $agurkuMasyvas;

    }

    public function getAllMoliugus()
    {
        //SKAITYMAS
        $sql = "SELECT * FROM darzove
        ;";
        $stmt = $this->pdo->query($sql); // <---saugi

        $moliuguMasyvas = [];
        while ($row = $stmt->fetch())
        {
            if ('moliugas' == $row['type']) {
                $objM = new Moliugas($row['id']);
                $objM->id = $row['id'];
                $objM->count = $row['count'];
                $objM->type = $row['type'];
                $objM->price = $row['price'];
                $moliuguMasyvas[] = $objM;
            }
            
        }
        return $moliuguMasyvas;
    }

    public function getNewId()
    {
        return null;
    }

    public function addNewAgurkas(Agurkas $objA)
    {
        $sql = "INSERT INTO darzove (`count`, `type`, `price`)
        VALUES ('.$objA->count.', 'agurkas', '.$objA->price.');";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        // $this->pdo->query($sql); // <--- NESAUGU!!!!!!!!!
    }

    public function addNewMoliugas(Moliugas $objM)
    {
        $sql = "INSERT INTO darzove (`count`, `type`, `price`)
        VALUES ('.$objM->count.', 'moliugas', '.$objM->price.');";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        // $this->pdo->query($sql); // <--- NESAUGU!!!!!!!!!
    }

    public function removeAgurkus($id) {
        $sql = "DELETE FROM darzove
        WHERE id='".$id."';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        // $this->pdo->query($sql); // <--- NESAUGU!!!!!!!!!
    }

    public function removeMoliugus($id) {
        $sql = "DELETE FROM darzove
        WHERE id='".$id."';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        // $this->pdo->query($sql); // <--- NESAUGU!!!!!!!!!
    }

    public function augintiAgurkus()
    {
        foreach ($this->getAllAgurkus() as $k => $objA) {
            $objA->addDarzove($objA->auga());
            $sql = "UPDATE darzove
            SET `count` = $objA->count 
            WHERE `id` = $objA->id ; ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        }
    }

    public function  augintiMoliugus()
    {
        foreach ($this->getAllMoliugus() as $k => $objM) {
            $objM->addDarzove($objM->auga());
            $sql = "UPDATE darzove
            SET `count` = $objM->count 
            WHERE `id` = $objM->id ; ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
        }
    }

}