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

        $allAgurkai = [];
        while ($row = $stmt->fetch())
        {
            if ('agurkas' == $row['type']) {
                $objA = new Agurkas(null);
            }
            $objA->id = $row['id'];
            $objA->count = $row['count'];
            $objA->type = $row['type'];
            $allAgurkai[] = $objA;
        }
        return $allAgurkai;

    }

    public function getAllMoliugus()
    {
        //SKAITYMAS
        $sql = "SELECT * FROM darzove
        ;";
        $stmt = $this->pdo->query($sql); // <---saugi

        $allMoliugai = [];
        while ($row = $stmt->fetch())
        {
            if ('moliūgas' == $row['type']) {
                $objM = new Moliugas(null);
            }
            $objM->id = $row['id'];
            $objM->count = $row['count'];
            $objM->type = $row['type'];
            $allMoliugai[] = $objM;
            
        }
        return $allMoliugai;
    }

    public function getNewId()
    {
        return null;
    }

    public function addNewAgurkas(Agurkas $obj)
    {
        $sql = "INSERT INTO darzove (`count`, `type`)
        VALUES ('.$obj->count.', 'agurkas');";
        $this->pdo->query($sql); // <--- NESAUGU!!!!!!!!!
    }

    public function addNewMoliugas(Moliugas $obj)
    {
        $sql = "INSERT INTO darzove (`count`, `type`)
        VALUES ('.$obj->count.', 'moliugas');";
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

}