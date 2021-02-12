<?php

$a = 20;
$b = 3;
$c = 3.5;
$d = -3;
$e= -20;

$erg = $a / $b;
var_dump($erg);
echo "<br>";
$erg2 = $a + $b;
var_dump($erg2);
echo "<br>";

$erg3 = $a +$c;
var_dump($erg3);
echo "<br>";

$erg4 = $a/$e;
var_dump($erg4);
echo "<br>";
// 
// 
// 

// $str1 ='10 Eier';
// $str2 = 'Schachtel mit 10 Eiern';
// $str3 = '3.5 Äpfel';

// $ergStr1 = $str1 + 2;
// var_dump($ergStr1);

// $ergStr2 = $str2 + 2;
// var_dump($ergStr2);

// $ergStr3 = $str3 + 2;
// var_dump($ergStr3);

// 
// 
// 

$string = '22';
$zahl = (int) $string;
var_dump($zahl);
echo "<br>";

// 
// 
// 

$array1 = ['nie', 'manchmal', 42];
print_r($array1);
echo "<br>";
echo $array1[0];
echo "<br>";
$array1[] = 'oft';
print_r($array1);
echo "<br>";
echo "<pre>";
print_r($array1);
echo "</pre>";

// 
// 
// 
$array2 = ['Bremen', 'Hamburg', 'Berlin', 'München', 'Bremerhaven'];

    echo "<ul>";
foreach ($array2 as $city){
    echo "<li>".$city."<br></li>";
}
    echo "</ul>";
?>