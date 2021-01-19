<?php
namespace Main;


class DBConnnection {


    public static function OpenCon() 
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
        $pdo = new PDO($dsn, $user, $pass, $options);

        
        $masyvas = [];

        while ($row = $stmt->fetch()) // <--- statmento metodas fetch - jis paima viena eilute. Kiekvienas kreipimasis duoda viena eilute ir taip cikle paduoda vis kita eilute
        {
            // echo $row['name'] . "\n";
            $masyvas[] = $row; //<----- turime masyva su duomenu bazes eilutemis [0],[1],[2],.....
        }

        return $masyvas;
    }
}