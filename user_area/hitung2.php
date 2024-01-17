<?php 
require '../config.php';

$c1 = "benefit";
$c2 = "benefit";
$c3 = "benefit";
$c4 = "benefit";

$bobot_c1 = $c1;
$bobot_c2 = $c2;
$bobot_c3 = $c3;
$bobot_c4 = $c4;
$array_temp = array();

$kriteria = array(
    'C1', 'C2', 'C3', 'C4'
);

foreach ($kriteria as $keys => $values) {
    $norm[]= $koneksi->query("SELECT a.nama_alternatif, a.id_alternatif,
    MAX(CASE WHEN k.id_kriteria = '$values' THEN sk.bobot_sub_kriteria END) AS '$values'
    FROM alternatif a
    JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
    JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
    JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria
    GROUP BY a.nama_alternatif ORDER BY a.id_alternatif ASC;");



}

$total_bobot = 0;
$bobot = 0;
for($i = 0; $i < count($kriteria); $i++){
    foreach ($norm[$i] as $key => $value) {
        $bobot = $value[$kriteria[$i]];
        echo $bobot;
    }
    $total_bobot += $bobot^2;
}

echo $total_bobot;


// foreach ($kriteria as $keys => $values) {
//     foreach ($norm as $key => $value) {

//             echo "<pre>";
//             print_r($value);
//             echo "</pre>";
        
//     }
// }