<?php 
session_start();
unset($_SESSION['menu']);
$_SESSION['menu'] = 'beranda-admin';
require_once './header.php';

$alternatif = $koneksi->query("SELECT a.nama_alternatif, a.id_alternatif, a.gambar, a.latitude, a.longitude, a.rating, a.kategori, a.biaya_alt, a.fasilitas_alt, a.jarak_alt, a.jumlah_peng_alt,
MAX(CASE WHEN k.id_kriteria = 'C1' THEN kak.id_alt_kriteria END) AS id_sub_C1,
MIN(CASE WHEN k.id_kriteria = 'C2' THEN kak.id_alt_kriteria END) AS id_sub_C2,
MIN(CASE WHEN k.id_kriteria = 'C3' THEN kak.id_alt_kriteria END) AS id_sub_C3,
MAX(CASE WHEN k.id_kriteria = 'C4' THEN kak.id_alt_kriteria END) AS id_sub_C4,
MAX(CASE WHEN k.id_kriteria = 'C5' THEN kak.id_alt_kriteria END) AS id_sub_C5,
MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.nama_sub_kriteria END) AS nama_C1,
MIN(CASE WHEN k.id_kriteria = 'C2' THEN sk.nama_sub_kriteria END) AS nama_C2,
MIN(CASE WHEN k.id_kriteria = 'C3' THEN sk.nama_sub_kriteria END) AS nama_C3,
MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.nama_sub_kriteria END) AS nama_C4,
MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.nama_sub_kriteria END) AS nama_C5,
MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.spesifikasi END) AS spesifikasi_C1,
MIN(CASE WHEN k.id_kriteria = 'C2' THEN sk.spesifikasi END) AS spesifikasi_C2,
MIN(CASE WHEN k.id_kriteria = 'C3' THEN sk.spesifikasi END) AS spesifikasi_C3,
MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.spesifikasi END) AS spesifikasi_C4,
MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.spesifikasi END) AS spesifikasi_C5
FROM alternatif a
JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria
GROUP BY a.nama_alternatif;");

?>
<div class="container">
    <div class="row">
        <div class="col-12 mt-3 mb-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 gx-lg-10 text-center">
                    <div class="title">
                        <h3>SISTEM PENDUKUNG KEPUTUSAN REKOMENDASI TEMPAT kayu DI KABUPATEN TIMOR TENGAH SELATAN</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div id="mapid"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
require_once './footer.php';
?>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
var mymap = L.map('mapid').setView([-9.7847232, 124.1418834], 9.04);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(mymap);

<?php
    //   foreach ($alternatif as $location) {
    //     if($location['latitude'] != '-' && $location['longitude'] != '-'){
    //         echo "var marker = L.marker([" . $location['latitude'] . "," . $location['longitude'] . "]).addTo(mymap);";
    //         echo "marker.bindPopup('<b>" . htmlspecialchars($location['nama_alternatif']) . "</b><br>Biaya masuk : " . $location['spesifikasi_C1'] . "<br>Fasilitas : " . $location['spesifikasi_C2'] . "<br>Jarak dari pusat kota : " . $location['spesifikasi_C3'] . "<br>Jumlah pengunjung : " . $location['spesifikasi_C4'] . "<br>Kualitas jalan : " . $location['spesifikasi_C5'] . "').openPopup();";
    //     }
    //   }
    
    ?>
<?php
foreach ($alternatif as $location) {
    if ($location['latitude'] != '-' && $location['longitude'] != '-') {
        echo "var marker = L.marker([" . $location['latitude'] . "," . $location['longitude'] . "]).addTo(mymap);";
        if ($location['gambar'] == '-') {
            echo "marker.bindPopup('<div class=\"custom-popup\"><img src=\"../user_area/gambar/" . "no-img.png" . "\" width=\"210\" height=\"150\"><br><b>" . htmlspecialchars($location['nama_alternatif']) . "</b><br><div style=\"word-wrap: break-word;width:200px\">Biaya masuk : " . $location['biaya_alt'] . "<br>Fasilitas : " . $location['fasilitas_alt'] . "<br>Jarak dari pusat kota : " . $location['jarak_alt'] . "<br>Jumlah pengunjung : " . $location['jumlah_peng_alt'] . "<br></div></div>', {className:'custom-popup'}).openPopup();";
        } else {
            echo "marker.bindPopup('<div class=\"custom-popup\"><img src=\"../user_area/gambar/" . $location['gambar'] . "\" width=\"200\" height=\"150\"><br><b>" . htmlspecialchars($location['nama_alternatif']) . "</b><br><div style=\"word-wrap: break-word;\">Biaya masuk : " . $location['biaya_alt'] . "<br>Fasilitas : " . $location['fasilitas_alt'] . "<br>Jarak dari pusat kota : " . $location['jarak_alt'] . "<br>Jumlah pengunjung : " . $location['jumlah_peng_alt'] . "<br></div></div>', {className:'custom-popup'}).openPopup();";
        }
    }
}
?>
</script>

<style>
.custom-popup {
    width: 250px;
    /* Sesuaikan lebar popup sesuai dengan kebutuhan Anda */
    white-space: pre-wrap;
    /* Membuat teks wrap jika melewati batas popup */
    text-align: left;
    /* Untuk membuat teks di dalam popup menjadi rata kiri */
}
</style>