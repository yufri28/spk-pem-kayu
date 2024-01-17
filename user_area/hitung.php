<?php 

$c1 = "benefit";
$c2 = "benefit";
$c3 = "benefit";
$c4 = "benefit";

$bobot_c1 = $C1;
$bobot_c2 = $C2;
$bobot_c3 = $C3;
$bobot_c4 = $C4;


// echo $bobot_c1.$bobot_c2.$bobot_c3.$bobot_c4;
// die; 

$norm = $koneksi->query("SELECT 
a.nama_alternatif, 
a.id_alternatif,
a.latitude,
a.longitude,
a.alamat,
a.gambar, a.rating, a.kategori, a.biaya_alt, a.fasilitas_alt, a.jarak_alt, a.jumlah_peng_alt,
MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END) AS C1,
MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END) AS C2,
MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END) AS C3,
MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END) AS C4,
MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.spesifikasi END) AS namaC1,
MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.spesifikasi END) AS namaC2,
MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.spesifikasi END) AS namaC3,
MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.spesifikasi END) AS namaC4,

(MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C1' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) * ($bobot_c1)) AS norm_C1,

(MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C2' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) * ($bobot_c2)) AS norm_C2,

(MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C3' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* ($bobot_c3)) AS norm_C3,

(MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C4' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* ($bobot_c4)) AS norm_C4

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
    IF('$c1'='cost', MIN(norm_C1), MAX(norm_C1)) AS norm___C1,
    IF('$c2'='benefit', MAX(norm_C2), MIN(norm_C2)) AS norm___C2,
    IF('$c3'='cost', MIN(norm_C3), MAX(norm_C3)) AS norm___C3,
    IF('$c4'='benefit', MAX(norm_C4), MIN(norm_C4)) AS norm___C4
FROM (
    SELECT 
        a.nama_alternatif, 
        a.id_alternatif,
        MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END) AS C1,
        MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END) AS C2,
        MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END) AS C3,
        MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END) AS C4,
        MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.spesifikasi END) AS namaC1,
        MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.spesifikasi END) AS namaC2,
        MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.spesifikasi END) AS namaC3,
        MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.spesifikasi END) AS namaC4,
        (MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C1' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) * ($bobot_c1)) AS norm_C1,
        (MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C2' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* ($bobot_c2)) AS norm_C2,
        (MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C3' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* ($bobot_c3)) AS norm_C3,
        (MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C4' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* ($bobot_c4)) AS norm_C4
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
    IF('$c1'='cost', MAX(norm_C1), MIN(norm_C1)) AS norm__C1,
    IF('$c2'='benefit', MIN(norm_C2), MAX(norm_C2)) AS norm__C2,
    IF('$c3'='cost', MAX(norm_C3), MIN(norm_C3)) AS norm__C3,
    IF('$c4'='benefit', MIN(norm_C4), MAX(norm_C4)) AS norm__C4
FROM (
    SELECT 
        a.nama_alternatif, 
        a.id_alternatif,
        MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END) AS C1,
        MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END) AS C2,
        MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END) AS C3,
        MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END) AS C4,
        MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.spesifikasi END) AS namaC1,
        MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.spesifikasi END) AS namaC2,
        MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.spesifikasi END) AS namaC3,
        MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.spesifikasi END) AS namaC4,
        (MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C1' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) * ($bobot_c1)) AS norm_C1,
        (MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C2' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* ($bobot_c2)) AS norm_C2,
        (MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C3' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)* ($bobot_c3)) AS norm_C3,
        (MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C4' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
        JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
        JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
        JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) * ($bobot_c4)) AS norm_C4
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
                $D_plus = sqrt(pow(($value['norm_C1'] - $values['norm___C1']),2)+pow(($value['norm_C2'] - $values['norm___C2']),2)+pow(($value['norm_C3'] - $values['norm___C3']),2)+pow(($value['norm_C4'] - $values['norm___C4']),2));
                // echo $D_plus;
                break;
            case "A-":
                $D_min = sqrt(pow(($value['norm_C1'] - $values['norm___C1']),2)+pow(($value['norm_C2'] - $values['norm___C2']),2)+pow(($value['norm_C3'] - $values['norm___C3']),2)+pow(($value['norm_C4'] - $values['norm___C4']),2));
                // echo $D_min;
                break;
        }
    }
    $D_min = $D_plus + $D_min;

    if($D_min == 0){
        $D_min = $bobot_c4;
    }
    $V = $D_min/($D_min+$D_plus);

    // echo $value['nama_alternatif'].' D: '.$V;
    // echo "<br>";


    array_push($kedekatan_rel,[
        'id_alternatif' => $value['id_alternatif'],
        'nama_alternatif' => $value['nama_alternatif'],
        'nilai_akhir' => $V,
        'nilai_d' => $d,
        'kategori' => $value['kategori'],
        'gambar' => $value['gambar'],
        'biaya_alt' => $value['biaya_alt'],
        'fasilitas_alt' => $value['fasilitas_alt'],
        'jarak_alt' => $value['jarak_alt'],
        'jumlah_peng_alt' => $value['jumlah_peng_alt'],
        'lat' => $value['latitude'],
        'long' => $value['longitude']
    ]);
}


// function compareNilaiAkhir($a, $b) {
//     if ($a['nilai_akhir'] == $b['nilai_akhir']) {
//         return 0;
//     }
//     return ($a['nilai_akhir'] > $b['nilai_akhir']) ? -1 : 1;
// }

function compareNilaiAkhir($a, $b) {
    if ($a['nilai_akhir'] == $b['nilai_akhir']) {
        return 0;
    }
    return ($a['nilai_akhir'] > $b['nilai_akhir']) ? -1 : 1;
}


// Menggunakan fungsi usort untuk mengurutkan array berdasarkan nilai_akhir
usort($kedekatan_rel, 'compareNilaiAkhir');