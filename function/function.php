<?php
    //1. Luas Persegi
    function luas_persegi($sisi1, $sisi2){
        $hasil_luas_persegi = $sisi1 * $sisi2;
        echo "Luas Persegi : $sisi1 * $sisi2 = $hasil_luas_persegi";
    }
    luas_persegi(20, 20);
    echo "<br>";
    //2. Luas Segi Tiga
    function luas_segitiga($alas, $tinggi){
        $hasil_luas_segitiga = 1/2 * $alas * $tinggi;
        echo "Luas Segi Tiga : 1/2 * $alas * $tinggi = $hasil_luas_segitiga";
    }
    luas_segitiga(24, 20);
    echo "<br>";
    //3. Luas Lingkaran
    function luas_lingkaran($jari1, $jari2){
        $hasil_luas_lingkaran = 22/7 * $jari1 * $jari2;
        echo "Luas Lingkaran : 22/7 * $jari1 * $jari2 = $hasil_luas_lingkaran";
    }
    luas_lingkaran(15, 15);
    echo "<br>";
    //4. Volume Kubus
    function volume_kubus($sisi1, $sisi2, $sisi3){
        $hasil_volume_kubus = $sisi1 * $sisi2 * $sisi3;
        echo "Volume Kubus : $sisi1 * $sisi2 * $sisi3 = $hasil_volume_kubus";
    }
    volume_kubus(13, 13, 13);
    echo "<br>";
    //5. Volume Limas
    function volume_limas($luas_alas, $tinggi){
        $hasil_volume_limas = 1/3 * $luas_alas * $tinggi;
        echo "Volume Limas : 1/3 * $luas_alas * $tinggi = $hasil_volume_limas";
    }
    volume_limas(25, 15);
 ?>