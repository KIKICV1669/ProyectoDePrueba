<?php
    $arreglo = [

        'keyStr1' => 'lado',
        0 => 'ledo',
    
        'keyStr2' => 'lido',
        1 => 'lodo',
        2 => 'ludo'
    
    ];

    echo $arreglo['keyStr1'] . ', ',$arreglo[0] . ', ', $arreglo['keyStr2'] . ', ', $arreglo[1] . ', ', $arreglo[2];
    echo 'Decirlo al revés lo dudo.';
    echo $arreglo[2], $arreglo[1], $arreglo['keyStr2'], $arreglo[0], $arreglo['keyStr1'];
    echo 'Qué trabajo me ha costado!';

    $ejercicio2 = [
        'Mexico' => [
            'Monterrey', 'Queretaro', 'Guadalajara'
        ],
        'Colombia' => [
            'Bogota', 'Cartagena', 'Medellin'
        ],
        'Peru' => [
            'Lima', 'Arequipa', 'Cuzco'
        ],
        'Argentina' => [
            'Buenos Aires', 'Rosario', 'Mar de Plata'
        ],
        'Venezuela' => [
            'Caracas', 'Valencia', 'Maracay'
        ]
    ];
    
    echo "<h3>Ejercicio 2</h3>";  
    
    foreach ($ejercicio2 as $pais => $ciudades) {
        echo "El pais $pais de tiene como ciudades a ";
        foreach ($ciudades as $valor){
            echo "$valor ";
        }	
    }

    $valores = [23, 54, 32, 67, 34, 78, 98, 56, 21, 34, 57, 92, 12, 5, 61];
    rsort($valores);
    $size = count($valores);
    echo 'Los más grandes: ';
    for ($i=0; $i < 3; $i++) 
    { 
        echo "$valores[$i], ";
    }
    echo 'Los más chicos: ';
    for ($i=$size-1; $i > $size-4; $i--) 
    { 
        echo "$valores[$i], ";
    }
?>