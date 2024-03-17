<?php 
require_once './header.php';

?>

<section class="">
    <!-- Jumbotron -->
    <div class="px-5 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%);">
        <div class="container" style="height:100vh;">
            <div class="row gx-lg-5 align-items-center">
                <div class="col-lg-5 mb-1 mb-lg-0">
                    <h2 class="my-3 mt-4 display-5 fw-bolder ls-tight">
                        Sistem Pendukung Keputusan <br />
                        <span style="color:#5B9A8B">Pemilihan Kayu</span>
                    </h2>
                    <h5 style="color: hsl(217, 10%, 50.8%)">
                        Sistem pendukung keputusan menggunakan metode <i style="color:#116A7B">ANALYTICAL HIERARCHY
                            PROCESS (AHP) DAN MULTIOBJECTIVE OPTIMIZATION BY RATIO ANALYSIS (MOORA)</i>
                    </h5>
                    <p class="fw-bolder" style="color: hsl(217, 10%, 50.8%)">Bingung dalam menentukan pilihan
                        kayu? Klik 'Mulai' untuk
                        mendapatkan bantuan dalam
                        menemukan kayu yang cocok untuk mebel anda.</p>
                    <a class="btn btn-lg py-2 px-4 me-5 col-lg-3" style="background-color: #29ADB2; color: white;"
                        href="./user/hasil.php">Mulai</a>
                </div>
                <div class="col-lg-7 mb-1 mt-4 mb-lg-0">
                    <div class="card">
                        <div class="card-body shadow-lg d-flex justify-content-center py-5 px-md-5">
                            <ol>
                                <li><b>(Menurut Ralph C. Davis)</b>
                                    Keputusan merupakan hasil penyelesaian yang tegas terhadap permasalahan yang
                                    dihadapi.
                                    Keputusan
                                    adalah jawaban yang jelas atas sebuah pertanyaan. Keputusan harus menjawab
                                    pertanyaan
                                    tentang
                                    apa yang dibicarakan dalam kaitannya dengan perencanaan. Keputusan juga dapat
                                    berupa
                                    pelaksanaan
                                    tindakan yang berbeda secara signifikan dari rencana semula (Hasan, 2004).
                                </li>
                                <br>
                                <li><b>(Menurut Mary Follett)</b>
                                    Keputusan tersebut merupakan suatu atau sebagai hukum situasi. Berbeda dengan
                                    menaati
                                    suatu perintah jika semua fakta tersedia dan semua yang terlibat, baik pengawas
                                    maupun
                                    penegak hukum, mau mematuhi undang-undang atau ketentuannya. Kewenangan tetap
                                    perlu
                                    dijalankan, namun kewenangan adalah situasi (Hasan, 2004).
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jumbotron -->
</section>
<?php 
require_once './../includes/footer.php';
?>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
var mymap = L.map('mapid').setView([-9.7847232, 124.1418834], 9.04);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(mymap);

<?php
      usort($kedekatan_rel, function($a, $b) {
          return $a['nilai_akhir'] <=> $b['nilai_akhir'];
      });
      $iconNumber = count($kedekatan_rel); // Angka awal untuk ikon (misalnya 1)
      foreach ($kedekatan_rel as $location) {
        if ($location['lat'] != '-' && $location['long'] != '-') {
            echo "var marker = L.marker([" . $location['lat'] . "," . $location['long'] . "]).addTo(mymap);";
            if ($location['gambar'] == '-') {
                echo "marker.bindPopup('<div class=\"custom-popup\"><img src=\"../user/gambar/" . "no-img.png" . "\" width=\"210\" height=\"150\"><br><b>" . $iconNumber.'. '.htmlspecialchars($location['nama_alternatif']) . "</b><br><div style=\"word-wrap: break-word;width:200px\">Biaya masuk : " . $location['namaC1'] . "<br>Fasilitas : " . $location['namaC2'] . "<br>Jarak dari pusat kota : " . $location['namaC3'] . "<br>Jumlah pengunjung : " . $location['namaC4'] . "<br></div></div>', {className:'custom-popup'}).openPopup();";
            } else {
                echo "marker.bindPopup('<div class=\"custom-popup\"><img src=\"../user/gambar/" . $location['gambar'] . "\" width=\"200\" height=\"150\"><br><b>" . htmlspecialchars($location['nama_alternatif']) . "</b><br><div style=\"word-wrap: break-word;\">Biaya masuk : " . $location['namaC1'] . "<br>Fasilitas : " . $location['namaC2'] . "<br>Jarak dari pusat kota : " . $location['namaC3'] . "<br>Jumlah pengunjung : " . $location['namaC4'] . "<br>" . "<br></div></div>', {className:'custom-popup'}).openPopup();";
            }
        }
        $iconNumber--;
    }
?>
</script>
<style>
.custom-icon {
    text-align: center;
    color: #EB455F;
    font-size: 16pt;
    font-weight: bold;
}
</style>
<?php 
require_once '../includes/footer.php';
?>

<script>
$(document).ready(function() {
    $("#prioritas_1").change(function() {
        var prioritas_1 = $("#prioritas_1").val();
        $.ajax({
            type: 'POST',
            url: "./classes/pilihan.php",
            data: {
                prioritas_1: [prioritas_1]
            },
            cache: false,
            success: function(msg) {
                $("#prioritas_2").html(msg);
            }
        });
    });

    $("#prioritas_2").change(function() {
        var prioritas_1 = $("#prioritas_1").val();
        var prioritas_2 = $("#prioritas_2").val();
        $.ajax({
            type: 'POST',
            url: "./classes/pilihan.php",
            data: {
                prioritas_2: [prioritas_1, prioritas_2]
            },
            cache: false,
            success: function(msg) {
                $("#prioritas_3").html(msg);
            }
        });
    });

    $("#prioritas_3").change(function() {
        var prioritas_1 = $("#prioritas_1").val();
        var prioritas_2 = $("#prioritas_2").val();
        var prioritas_3 = $("#prioritas_3").val();
        $.ajax({
            type: 'POST',
            url: "./classes/pilihan.php",
            data: {
                prioritas_3: [prioritas_1, prioritas_2, prioritas_3]
            },
            cache: false,
            success: function(msg) {
                $("#prioritas_4").html(msg);
            }
        });
    });
});
</script>