<?php
    //importálás
    include_once "Adatbazis.php";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magyar kártya</title>
    <link rel="stylesheet" href="stilus.css">
</head>
<body>
    <?php
    $adatbazis = new Adatbazis();
    //megjelenitjük a szin ábla képeit
    $eredmeny = $adatbazis->adatLeker("kep","szin");
    //mátrix bejárása
    $adatbazis->megvalosit($eredmeny);
    echo "<br>";
    //asszociativ bejárás
    $eredmeny = $adatbazis->adatleker2("ertek","szoveg","forma");
    //mátrix bejárása; egydimenziós mátrix
    $adatbazis->megvalositAssoc($eredmeny,"ertek","szoveg");
    
    if ($adatbazis->azonMind("kartya")< 1){
        $adatbazis->kartyaFeltolt("kartya");
    }



    $adatbazis->kapcsolatBezar();


    ?>
    
</body>
</html>