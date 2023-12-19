<?php
    $nama = 'dwi yuliawan';
    $tinggi_badan = 1.65;
    $berat_badan = 55;
    $tinggi_badan2 = $tinggi_badan*$tinggi_badan;
    
    //rumus BMI = tinggi_badan/berat_badan2
    $BMI = $berat_badan/$tinggi_badan2;
    echo "$berat_badan/$tinggi_badan2 = $BMI";

    $bmi = 20.2;

    //BMT di bawah 18,5 kurang proporsional
    //BMT di antara 18,5 - 22,9 Berat badan ideal
    //BMT di antara 23 - 29,9 Berat badan berlebih (berpotensi obesitas)
    if( $bmi <= 18.5 ) {
        echo "Halo, $nama. Nilai BMI anda kurang, anda termasuk kurus dan kurang proporsional";
    }elseif( $bmi >= 18.5 ) {
        echo "Halo, $nama. Nilai BMI anda ideal, anda termasuk ideal dan proporsional ";
    }else  {
        echo "Halo, $nama. Nilai BMI anda over, anda termasuk gemuk dan berpotensi obesitas";
    };


?>