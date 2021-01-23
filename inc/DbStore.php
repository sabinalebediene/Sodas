<?php
namespace Main;

use Cucumber\Agurkas;
use Pumpkin\Moliugas;
use PDO;

class DbStore implements Store {

    private $pdo;
    private $agurkuMasyvas;
    private $moliuguMasyvas;

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
        $sql = "INSERT INTO darzove (`count`, `type`)
        VALUES ('.$objA->count.', 'agurkas');";
        $this->pdo->query($sql); // <--- NESAUGU!!!!!!!!!
    }

    public function addNewMoliugas(Moliugas $objM)
    {
        $sql = "INSERT INTO darzove (`count`, `type`)
        VALUES ('.$objM->count.', 'moliugas');";
        $this->pdo->query($sql); // <--- NESAUGU!!!!!!!!!
    }

    public function removeAgurkus($id) {
        $sql = "DELETE FROM darzove
        WHERE id='".$id."';";
        $this->pdo->query($sql); // <--- NESAUGU!!!!!!!!!
    }

    public function removeMoliugus($id) {
        $sql = "DELETE FROM darzove
        WHERE id='".$id."';";
        $this->pdo->query($sql); // <--- NESAUGU!!!!!!!!!
    }

    public function augintiAgurkus()
    {
        $sql = "UPDATE darzove (`count`);";
        foreach ($agurkuMasyvas as $row => $objA) {
            $objA->addDarzove();
            $objA->count = $row['count'];

            $this->pdo->query($sql);
        }
    }

    public function  augintiMoliugus()
    {
        foreach ($this->moliuguMasyvas as $row => $objM)  {
            $objM->addDarzove();
            
            //$this->masyvas['obj'][$row] = $obj;
            $objM->count = $row['count'];

            $sql = "UPDATE darzove
            SET '.$objM->count.'
            WHERE 'count';";
            $this->pdo->query($sql);
        }
    }

}