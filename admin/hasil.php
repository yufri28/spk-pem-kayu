<?php 

require_once '../config.php';

$norm = $koneksi->query("SELECT 
a.nama_alternatif, 
a.id_alternatif,
a.latitude,
a.longitude,
a.alamat,
a.gambar,
MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END) AS C1,
MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END) AS C2,
MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END) AS C3,
MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END) AS C4,
MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END) AS C5,

(MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C1' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) * (SELECT C1 FROM bobot_kriteria bk WHERE bk.f_id_user=2)) AS norm_C1,

(MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C2' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* (SELECT C2 FROM bobot_kriteria bk WHERE bk.f_id_user=2)) AS norm_C2,

(MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C3' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* (SELECT C3 FROM bobot_kriteria bk WHERE bk.f_id_user=2)) AS norm_C3,

(MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C4' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* (SELECT C4 FROM bobot_kriteria bk WHERE bk.f_id_user=2)) AS norm_C4,

(MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C5' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) * (SELECT C5 FROM bobot_kriteria bk WHERE bk.f_id_user=2)) AS norm_C5
FROM alternatif a
JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria
GROUP BY a.nama_alternatif, a.id_alternatif ORDER BY a.id_alternatif ASC;");


$ap_am = $koneksi->query(
    "SELECT 
    'A+' AS nama_alternatif,
    NULL AS id_alternatif,
    NULL AS C1,
    NULL AS C2,
    NULL AS C3,
    NULL AS C4,
    NULL AS C5,
    IF('cost'='cost', MIN(norm_C1), MAX(norm_C1)) AS norm___C1,
    IF('benefit'='benefit', MAX(norm_C2), MIN(norm_C2)) AS norm___C2,
    IF('cost'='cost', MIN(norm_C3), MAX(norm_C3)) AS norm___C3,
    IF('benefit'='benefit', MAX(norm_C4), MIN(norm_C4)) AS norm___C4,
    IF('benefit'='benefit', MAX(norm_C5), MIN(norm_C5)) AS norm___C5
FROM (
    SELECT 
        a.nama_alternatif, 
        a.id_alternatif,
        MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END) AS C1,
        MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END) AS C2,
        MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END) AS C3,
        MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END) AS C4,
        MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END) AS C5,
        (MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C1' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) * (SELECT C1 FROM bobot_kriteria bk WHERE bk.f_id_user=2)) AS norm_C1,
        (MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C2' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* (SELECT C2 FROM bobot_kriteria bk WHERE bk.f_id_user=2)) AS norm_C2,
        (MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C3' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* (SELECT C3 FROM bobot_kriteria bk WHERE bk.f_id_user=2)) AS norm_C3,
        (MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C4' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* (SELECT C4 FROM bobot_kriteria bk WHERE bk.f_id_user=2)) AS norm_C4,
        (MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C5' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* (SELECT C5 FROM bobot_kriteria bk WHERE bk.f_id_user=2)) AS norm_C5
    FROM alternatif a
    JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
    JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
    JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria
    GROUP BY a.nama_alternatif, a.id_alternatif
) AS t

UNION ALL

SELECT 
    'A-' AS nama_alternatif,
    NULL AS id_alternatif,
    NULL AS C1,
    NULL AS C2,
    NULL AS C3,
    NULL AS C4,
    NULL AS C5,
    IF('cost'='cost', MAX(norm_C1), MIN(norm_C1)) AS norm__C1,
    IF('benefit'='benefit', MIN(norm_C2), MAX(norm_C2)) AS norm__C2,
    IF('cost'='cost', MAX(norm_C3), MIN(norm_C3)) AS norm__C3,
    IF('benefit'='benefit', MIN(norm_C4), MAX(norm_C4)) AS norm__C4,
    IF('benefit'='benefit', MIN(norm_C5), MAX(norm_C5)) AS norm__C5
FROM (
    SELECT 
        a.nama_alternatif, 
        a.id_alternatif,
        MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END) AS C1,
        MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END) AS C2,
        MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END) AS C3,
        MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END) AS C4,
        MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END) AS C5,
        (MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C1' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) * (SELECT C1 FROM bobot_kriteria bk WHERE bk.f_id_user=2)) AS norm_C1,
        (MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C2' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* (SELECT C2 FROM bobot_kriteria bk WHERE bk.f_id_user=2)) AS norm_C2,
        (MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C3' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* (SELECT C3 FROM bobot_kriteria bk WHERE bk.f_id_user=2)) AS norm_C3,
        (MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C4' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* (SELECT C4 FROM bobot_kriteria bk WHERE bk.f_id_user=2)) AS norm_C4,
        (MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C5' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* (SELECT C5 FROM bobot_kriteria bk WHERE bk.f_id_user=2)) AS norm_C5
    FROM alternatif a
    JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
    JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
    JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria
    GROUP BY a.nama_alternatif, a.id_alternatif
) AS t;"
);

$D_plus = 0;
$D_min = 0;
$d = 0;
$V = 0;
$kedekatan_rel = array(); 
foreach ($norm as $key => $value) {
    foreach ($ap_am as $keys => $values) {

        switch ($values['nama_alternatif']) {
            case "A+":
                $D_plus = sqrt(pow(($value['norm_C1'] - $values['norm___C1']),2)+pow(($value['norm_C2'] - $values['norm___C2']),2)+pow(($value['norm_C3'] - $values['norm___C3']),2)+pow(($value['norm_C4'] - $values['norm___C4']),2)+pow(($value['norm_C5'] - $values['norm___C5']),2));
                break;
            case "A-":
                $D_min = sqrt(pow(($value['norm_C1'] - $values['norm___C1']),2)+pow(($value['norm_C2'] - $values['norm___C2']),2)+pow(($value['norm_C3'] - $values['norm___C3']),2)+pow(($value['norm_C4'] - $values['norm___C4']),2)+pow(($value['norm_C5'] - $values['norm___C5']),2));
                break;
        }
    }
    $d = $D_plus + $D_min;
    $V = $D_min/($D_min+$D_plus);
    // echo $value['nama_alternatif'].' D: '.$V;
    // echo "<br>";


    array_push($kedekatan_rel,[
        'id_alternatif' => $value['id_alternatif'],
        'nama_alternatif' => $value['nama_alternatif'],
        'nilai_akhir' => $V,
        'nilai_d' => $d,
        'lat' => $value['latitude'],
        'long' => $value['longitude']
    ]);
    // $kedekatan_rel = [
    //     'nama_alternatif' => $value['nama_alternatif'],
    //     'nilai_akhir' => $V,
    // ]; 
}

function compareNilaiAkhir($a, $b) {
    if ($a['nilai_akhir'] == $b['nilai_akhir']) {
        return 0;
    }
    return ($a['nilai_akhir'] > $b['nilai_akhir']) ? -1 : 1;
}

// Menggunakan fungsi usort untuk mengurutkan array berdasarkan nilai_akhir
usort($kedekatan_rel, 'compareNilaiAkhir');

// Menampilkan hasil pengurutan
foreach ($kedekatan_rel as $alternatif) {
    echo "Id Alternatif: " . $alternatif['id_alternatif'] ." Nama Alternatif: " . $alternatif['nama_alternatif'] . ", Nilai Akhir: " . $alternatif['nilai_akhir'] . " Latitude: " .$alternatif['lat']. " Longitude: " .$alternatif['long']. "\n";
    echo "<br>";
}

?>