<?php
class Adatbazis{
    private $host = "localhost";
    private $felhasznaloNev = "root";
    private $jelszo = "";
    private $adatbazisNev = "magyarkartya";
    private $kapcsolat;

    //konstruktor
    public function __construct(){
        //kapcsolat beállítása
        $this->kapcsolat = new mysqli(
            $this->host,
            $this->felhasznaloNev,
            $this->jelszo,
            $this->adatbazisNev,
        );
        $szoveg = "";
        if ($this->kapcsolat->connect_error) {
            $szoveg = "Sikertelen kapcsolódás!";
        }
        else
            $szoveg = "Sikeres kapcsolódás!";

        //ékezetes betűk miatt
        $this->kapcsolat->query('SET NAMES UTF8');
        $this->kapcsolat->query('set character set utf8');
        echo $szoveg;
    }

    //egyéb metódusok
    public function adatLeker($oszlop, $tabla){
        $sql = "SELECT $oszlop FROM $tabla";
        $adatok = $this->kapcsolat->query($sql);
        if ($adatok) 
            echo"Sikeres lekérdezés";
        else
            echo"Sikeres lekérdezés";
        return $adatok;
    }

    function adatleker2($melyik01,$melyik02,$tabla){
        //lekérdezés
        $sql = "SELECT $melyik01, $melyik02 FROM $tabla ORDER BY
        $melyik01";
        return $this->kapcsolat->query($sql);
        
    }

    public function megvalosit($eredmeny){
        while ($sor = $eredmeny->fetch_row()) {
            echo "<img src=\"forras/$sor[0]\" alt=\"$sor[0]\">";
        }
    }

    public function megvalositAssoc($eredmeny,$melyik01,$melyik02){
        while ($row = $eredmeny->fetch_assoc()) {
            echo "1. oszlop: $row[$melyik01] - 2. oszlop: ". $row[$melyik02]."<br>";
        }
    }

    function azonMind($tabla){
        $result = $this->kapcsolat->query("SELECT * FROM $tabla");
        return $result->num_rows;
    }

    function kartyaFeltolt($tabla){
        $countSzin = $this->azonMind('szin') +1;
        $countForma = $this->azonMind('forma') +1;
        for ($indexSzin = 1; $indexSzin < $countSzin; $indexSzin++) { 
            for ($indexForma = 1; $indexForma < $countForma; $indexForma++) { 
                $sql = "INSERT INTO $tabla (szinAzon, formaAzon) VALUES
                ($indexSzin, $indexForma);";
                $this->kapcsolat->query($sql);
            }
        }
    }

    public function kapcsolatBezar(){
        $this->kapcsolat->close();
    }
}
?>