<?php 
require_once './config.php';
require_once './user_area/classes/kriteria_v1.php';
require_once './user_area/classes/alternatif.php';

$post = false;

$biaya_masuk = 0;
$fasilitas = 0;
$jarak_kota = 0;
$jumlah_pengunjung = 0;
$jenis_c4 = "";
$jenis_kriteria4 = "";
$totalBobot = 0;

$C1 = 0.1;
$C2 = 0.1;
$C3 = 0.1;
$C4 = 0.1;
$dataBobotKriteria = array();
$dataTampung = array();

if(isset($_POST['t_bobot_kriteria'])){
    $biaya_masuk = $_POST['t_bobot_kriteria'][0];
    $fasilitas = $_POST['t_bobot_kriteria'][1];
    $jarak_kota = $_POST['t_bobot_kriteria'][2];
    $jumlah_pengunjung = $_POST['t_bobot_kriteria'][3];
    $jenis_c4 = $_POST['jenis_c4'];

    if($jenis_c4 == 1)
    {
        $jenis_kriteria4 = "benefit";
    }else if($jenis_c4 == 0){
        $jenis_kriteria4 = "cost";
    }

    $totalBobot = $biaya_masuk + $fasilitas + $jarak_kota + $jumlah_pengunjung;

    $C1 = $biaya_masuk/$totalBobot;
    $C2 = $fasilitas/$totalBobot;
    $C3 = $jarak_kota/$totalBobot;
    $C4 = $jumlah_pengunjung/$totalBobot;

    $post = true;
}

if(isset($_POST['e_bobot_kriteria'])){
    $biaya_masuk = $_POST['e_bobot_kriteria'][0];
    $fasilitas = $_POST['e_bobot_kriteria'][1];
    $jarak_kota = $_POST['e_bobot_kriteria'][2];
    $jumlah_pengunjung = $_POST['e_bobot_kriteria'][3];
    $jenis_c4 = $_POST['jenis_c4'];
    
    if($jenis_c4 == 1)
    {
        $jenis_kriteria4 = "benefit";
    }else if($jenis_c4 == 0){
        $jenis_kriteria4 = "cost";
    }

    $totalBobot = $biaya_masuk + $fasilitas + $jarak_kota + $jumlah_pengunjung;

    $C1 = $biaya_masuk/$totalBobot;
    $C2 = $fasilitas/$totalBobot;
    $C3 = $jarak_kota/$totalBobot;
    $C4 = $jumlah_pengunjung/$totalBobot;

    $post = true;
}
$dataKriteria = [
    "Biaya masuk", "Fasilitas", "Jarak dari pusat kota", "Jumlah pengunjung"
];
$alternatif_kriteria = $getDataAlternatif->alternatif_kriteria();


include_once './user_area/hitung.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>SPK Pemilihan kayu</title>

    <style>
    .navbar-transparent {
        background-color: hsl(0, 0%, 96%);
    }

    @media (min-width: 992px) {
        .navbar-transparent {
            margin-bottom: -40px;
        }
    }

    .navbar-brand {
        font-family: 'Rubik', sans-serif;
    }

    .nav-link {
        font-family: 'Prompt', sans-serif;
    }

    .input-search {
        border-radius: 0.3rem;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let button_like_link = document.getElementById('btn-like-link');

        button_like_link.addEventListener('click', function() {
            Swal.fire({
                title: 'Panduan',
                text: 'Masukan Range Bobot Kriteria Dimana Range Bobot Setiap Kriteria Adalah 0 Sampai 100 dan Bobot Terbesar Menunjukan Kriteria Yang Diprioritaskan.',
                icon: 'warning',
                confirmButtonText: 'Paham'
            });
        });
    });
    </script>

    <style>
    .button-like-link {
        background: none;
        border: none;
        color: blue;
        /* Warna teks mirip tautan */
        text-decoration: none;
        /* Garis bawah mirip tautan */
        cursor: pointer;
        /* Jika ingin menyesuaikan tampilan saat digerakkan mouse */
    }

    .button-like-link:hover {
        text-decoration: none;
        /* Menghilangkan garis bawah saat digerakkan mouse */
        /* Sesuaikan tampilan hover sesuai keinginan */
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Prompt&family=Righteous&family=Roboto:wght@500&family=Rubik:wght@600&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="./assets/vendor/fontawesome-free/css/all.min.css">
    <script src="./assets/vendor/fontawesome-free/js/all.min.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SPK Pemilihan kayu</title>
    <link href="./assets/DataTables/datatables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
    #mapid,
    .teks {
        height: 70vh;
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <section class="">
        <!-- Section: Design Block -->
        <nav class="navbar fixed-top navbar-transparent shadow-sm navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand fw-bolder" href="#">SPK kayu</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link fw-bolder" aria-current="page" href="./home.php">Beranda</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link fw-bolder" aria-current="page" href="./tempat-kayu.php">Tempat
                                kayu</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link fw-bolder active" aria-current="page"
                                href="./rekomendasi.php">Rekomendasi</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="btn btn-outline-secondary fw-bolder" aria-current="page"
                                href="./auth/login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <hr>
        <hr class="navbar-transparent">
        <div class="container mt-5 pt-3" style="font-family: 'Prompt', sans-serif;">
            <div class="row">
                <!-- <div class="d-md-flex"> -->
                <div class="col-md-4 mt-3 mb-4">
                    <div class="card shadow-lg">
                        <?php if($post == false):?>
                        <div class="card-header" style="background-color:#62B6B7">
                            <h5 class="text-center pt-2 col-12">
                                Masukan Bobot Kriteria
                            </h5>
                        </div>
                        <form method="post" id="kriteriaForm" action="">
                            <div class="card-body">
                                <div id="error-message" style="color: red; display: none;">
                                    Total bobot kriteria harus sama dengan 100.
                                </div>
                                <button type="button" id="btn-like-link"
                                    class="button-like-link col-lg-12 d-flex justify-content-end"><small
                                        class="">Panduan?</small></button>

                                <script>
                                function updateWeight1(value) {
                                    document.getElementById('weightDisplay1').textContent = 'Bobot Biaya Masuk: ' +
                                        value;
                                }

                                function updateWeight2(value) {
                                    document.getElementById('weightDisplay2').textContent = 'Bobot Fasilitas: ' + value;
                                }

                                function updateWeight3(value) {
                                    document.getElementById('weightDisplay3').textContent =
                                        'Bobot Jarak dari Pusat Kota: ' + value;
                                }

                                function updateWeight4(value) {
                                    document.getElementById('weightDisplay4').textContent =
                                        'Bobot Jumlah Pengunjung: ' + value;
                                }
                                </script>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Apakah anda suka tempat yang ramai?
                                </label>
                                <div class="form-check">
                                    <input class="form-check-input" <?=$jenis_c4 == 1 ? 'checked':'';?> required
                                        type="radio" value="1" name="jenis_c4" id="jenis_c41">
                                    <label class="form-check-label" for="jenis_c41">
                                        Suka
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" required <?=$jenis_c4 == 0 ? 'checked':'';?>
                                        type="radio" value="0" name="jenis_c4" id="jenis_c42">
                                    <label class="form-check-label" for="jenis_c42">
                                        Tidak suka
                                    </label>
                                </div>
                                <hr>
                                <i><small>Range bobot setiap Kriteria : 0 - 100</small></i>
                                <div class="mb-3 mt-3">
                                    <span id="weightDisplay1">Bobot <label for="bobot_kriteria" class="form-label">Biaya
                                            Masuk</label>: 0</span>
                                    <input type="range" min="0" oninput="updateWeight1(this.value)"
                                        value="<?=$biaya_masuk;?>" max="100" class="form-range bobot-kriteria"
                                        name="t_bobot_kriteria[]">
                                </div>
                                <div class="mb-3 mt-3">

                                    <span id="weightDisplay2">Bobot <label for="bobot_kriteria"
                                            class="form-label">Fasilitas</label>: 0</span>
                                    <input type="range" min="0" oninput="updateWeight2(this.value)" max="100"
                                        value="<?=$fasilitas;?>" class="form-range bobot-kriteria"
                                        name="t_bobot_kriteria[]">
                                </div>
                                <div class="mb-3 mt-3">

                                    <span id="weightDisplay3">Bobot <label for="bobot_kriteria" class="form-label">Jarak
                                            dari Pusat Kota</label>: 0</span>
                                    <input type="range" min="0" oninput="updateWeight3(this.value)" max="100"
                                        value="<?=$jarak_kota;?>" class="form-range bobot-kriteria"
                                        name="t_bobot_kriteria[]">
                                </div>
                                <div class="mb-3 mt-3">

                                    <span id="weightDisplay4">Bobot <label for="bobot_kriteria"
                                            class="form-label">Jumlah
                                            Pengunjung</label>: 0</span>
                                    <input type="range" min="0" oninput="updateWeight4(this.value)" max="100"
                                        class="form-range bobot-kriteria" value="<?=$jumlah_pengunjung;?>"
                                        name="t_bobot_kriteria[]">
                                </div>
                                <button type="submit" name="simpan" onclick="return validateTotal()"
                                    class="btn col-12 btn-outline-success">
                                    Simpan
                                </button>
                            </div>
                        </form>
                        <?php endif;?>
                        <?php if($post == true):?>
                        <div class="card-header" style="background-color:#62B6B7">
                            <h5 class="text-center pt-2 col-12">
                                Edit Bobot Kriteria
                            </h5>
                        </div>
                        <form method="post" id="editKriteriaForm" action="">
                            <div class="card-body">
                                <div id="error-message" style="color: red; display: none;">
                                    Total bobot kriteria harus sama dengan 100.
                                </div>
                                <button type="button" id="btn-like-link"
                                    class="button-like-link col-lg-12 d-flex justify-content-end"><small
                                        class="">Panduan?</small></button>
                                <script>
                                function updateWeight1(value) {
                                    document.getElementById('bobotValue1').innerText = 'Bobot Biaya Masuk: ' +
                                        value;
                                }

                                function updateWeight2(value) {
                                    document.getElementById('bobotValue2').textContent = 'Bobot Fasilitas: ' + value;
                                }

                                function updateWeight3(value) {
                                    document.getElementById('bobotValue3').textContent =
                                        'Bobot Jarak dari Pusat Kota: ' + value;
                                }

                                function updateWeight4(value) {
                                    document.getElementById('bobotValue4').textContent =
                                        'Bobot Jumlah Pengunjung: ' + value;
                                }


                                // Inisialisasi bobot saat halaman dimuat
                                window.onload = function() {
                                    var initialValue1 = document.querySelector('.edit-bobot-kriteria1').value;
                                    var initialValue2 = document.querySelector('.edit-bobot-kriteria2').value;
                                    var initialValue3 = document.querySelector('.edit-bobot-kriteria3').value;
                                    var initialValue4 = document.querySelector('.edit-bobot-kriteria4').value;
                                    updateWeight1(initialValue1);
                                    updateWeight2(initialValue2);
                                    updateWeight3(initialValue3);
                                    updateWeight4(initialValue4);
                                };
                                </script>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Apakah anda suka tempat yang ramai?
                                </label>
                                <div class="form-check">
                                    <input class="form-check-input" <?=$jenis_c4 == 1 ? 'checked':'';?> required
                                        type="radio" value="1" name="jenis_c4" id="jenis_c41">
                                    <label class="form-check-label" for="jenis_c41">
                                        Suka
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" required <?=$jenis_c4 == 0 ? 'checked':'';?>
                                        type="radio" value="0" name="jenis_c4" id="jenis_c42">
                                    <label class="form-check-label" for="jenis_c42">
                                        Tidak suka
                                    </label>
                                </div>
                                <hr>
                                <i><small>Range bobot setiap Kriteria : 0 - 100</small></i>
                                <div class="mb-3 mt-3">
                                    <span id="bobotValue1">Bobot <label for="bobot_kriteria" class="form-label">Biaya
                                            Masuk</label>: 0</span>

                                    <input type="range" min="0" onload="updateWeight1(this.value)"
                                        oninput="updateWeight1(this.value)" value="<?=$biaya_masuk;?>" max="100"
                                        class="form-range edit-bobot-kriteria1" name="e_bobot_kriteria[]">
                                </div>
                                <div class="mb-3 mt-3">

                                    <span id="bobotValue2">Bobot <label for="bobot_kriteria"
                                            class="form-label">Fasilitas</label>: 0</span>

                                    <input type="range" min="0" oninput="updateWeight2(this.value)" max="100"
                                        value="<?=$fasilitas;?>" class="form-range edit-bobot-kriteria2"
                                        name="e_bobot_kriteria[]">
                                </div>
                                <div class="mb-3 mt-3">

                                    <span id="bobotValue3">Bobot <label for="bobot_kriteria" class="form-label">Jarak
                                            dari Pusat Kota</label>: 0</span>

                                    <input type="range" min="0" oninput="updateWeight3(this.value)" max="100"
                                        value="<?=$jarak_kota;?>" class="form-range edit-bobot-kriteria3"
                                        name="e_bobot_kriteria[]">
                                </div>
                                <div class="mb-3 mt-3">

                                    <span id="bobotValue4">Bobot <label for="bobot_kriteria" class="form-label">Jumlah
                                            Pengunjung</label>: 0</span>

                                    <input type="range" min="0" oninput="updateWeight4(this.value)"
                                        onload="updateWeight4(this.value)" max="100"
                                        class="form-range edit-bobot-kriteria4" value="<?=$jumlah_pengunjung;?>"
                                        name="e_bobot_kriteria[]">
                                </div>
                                <button type="submit" name="simpan" onclick="return validateTotal()"
                                    class="btn col-12 btn-outline-success">
                                    Simpan
                                </button>
                            </div>
                        </form>
                        <?php endif;?>
                    </div>
                </div>
                <div class="col-md-8 mt-3 mb-3">
                    <div class="card shadow-lg">
                        <div class="card-header" style="background-color:#62B6B7">
                            <h5 class="text-start">DAFTAR kayu</h5>
                            <hr>
                        </div>
                        <div class="d-flex justify-content-end">
                            <!-- <div class="form-group me-1">
                                <input type="text" class="form-control form-control-sm" id="filterInput"
                                    style="border-radius:3em; border: 1px solid gray;" placeholder="Cari kayu...">
                            </div> -->
                            <div class="form-group mt-3 me-5">
                                <select id="filterSelect" style="border-radius:3em; border: 1px solid gray;"
                                    class="form-control form-control-sm">
                                    <option value="">-- Pilih Jenis kayu --</option>
                                    <option value="Alam">Alam</option>
                                    <option value="Budaya">Budaya</option>
                                    <option value="Buatan">Buatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row d-flex justify-content-center" id="cardContainer">
                                    <?php foreach($kedekatan_rel as $key => $value):?>
                                    <div class="card col-lg-3 m-2" style="width: 15rem;">
                                        <a class="card-img-top" style="margin-left: -12px; margin-rigth:-12px;"
                                            href="./user_area/gambar/<?= $value['gambar'] == '-'? 'no-img.png': $value['gambar'];?>"
                                            data-lightbox="image-1" data-title="<?= $value['nama_alternatif']; ?>"><img
                                                style="width:238px; height:200px;"
                                                src="./user_area/gambar/<?= $value['gambar'] == '-'? 'no-img.png': $value['gambar']; ?>"
                                                alt=""></a>

                                        <div class="card-body">
                                            <p class="card-title"><?= $key + 1; ?>. <?= $value['nama_alternatif']; ?>
                                                (<span class="card-kategori"><?= $value['kategori']; ?></span>)
                                            </p>
                                            <div id="detail<?= $key; ?>" class="collapse">
                                                <table class="table" style="font-size: 10pt;">
                                                    <tbody>
                                                        <tr>
                                                            <td>Harga</td>
                                                            <td>:</td>
                                                            <td><small><?= $value['biaya_alt']; ?></small></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Fasilitas</td>
                                                            <td>:</td>
                                                            <td><small>
                                                                    <?= $value['fasilitas_alt']; ?></small></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jarak</td>
                                                            <td>:</td>
                                                            <td><small><?= $value['jarak_alt']; ?> KM</small>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pengunjung</td>
                                                            <td>:</td>
                                                            <td><small>
                                                                    <?= $value['jumlah_peng_alt']; ?> Orang</small></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nilai Akhir</td>
                                                            <td>:</td>
                                                            <?php if($post == true):;?>
                                                            <td><small><?= $value['nilai_akhir']; ?></small></td>
                                                            <?php else:?>
                                                            <td><small>0</small></td>
                                                            <?php endif;?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button type="button" class="btn col-lg-6 me-1 btn-sm btn-primary"
                                                    data-toggle="collapse"
                                                    data-target="#detail<?= $key; ?>">Detail</button>
                                                <a target="_blank"
                                                    href="https://www.google.com/maps/dir/?api=1&destination=<?=$value['lat'];?>,<?=$value['long'];?>"
                                                    class="btn col-lg-6 btn-sm btn-success">Maps</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if($post == true):?>
        <div class="container" style="font-family: 'Prompt', sans-serif">
            <div class="row">
                <div class="d-xxl-flex">
                    <div class="col-xxl-12 mt-3 ms-xxl-6 mb-1">
                        <!-- <div class="card"> -->
                        <!-- <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div id="mapid"></div>
                                </div>
                            </div>
                        </div> -->
                        <!-- </div> -->
                        <!-- <div class="card mt-2">
                            <div class="card-header">Hasil Perengkingan</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered nowrap" style="width:100%"
                                        id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Ranking</th>
                                                <th scope="col">Nama kayu</th>
                                                <th scope="col">Biaya Masuk</th>
                                                <th scope="col">Fasilitas</th>
                                                <th scope="col">Jarak Pusat Kota</th>
                                                <th scope="col">Jumlah Pengunjung</th>
                                                <th scope="col">Nilai Akhir</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                            <?php foreach ($kedekatan_rel as $key => $value):?>
                                            <tr>
                                                <th scope="row"><?=$key+1;?></th>
                                                <td><?=$value['nama_alternatif']?></td>
                                                <td><?=$value['biaya_alt']?></td>
                                                <td><?=$value['fasilitas_alt']?></td>
                                                <td><?=$value['jarak_alt']?></td>
                                                <td><?=$value['jumlah_peng_alt']?></td>
                                                <td><?=$value['nilai_akhir'];?></td>
                                                <td>
                                                    <a href="https://www.google.com/maps/dir/?api=1&destination=<?=$value['lat'];?>,<?=$value['long'];?>"
                                                        title="Lokasi di MAPS" class="btn btn-sm btn-success">Lokasi</a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>

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
                echo "marker.bindPopup('<div class=\"custom-popup\"><img src=\"./user_area/gambar/" . "no-img.png" . "\" width=\"210\" height=\"150\"><br><b>" . $iconNumber.'. '.htmlspecialchars($location['nama_alternatif']) . "</b><br><div style=\"word-wrap: break-word;width:200px\">Biaya masuk : " . $location['biaya_alt'] . "<br>Fasilitas : " . $location['fasilitas_alt'] . "<br>Jarak dari pusat kota : " . $location['jarak_alt'] . "<br>Jumlah pengunjung : " . $location['jumlah_peng_alt'] . "<br></div></div>', {className:'custom-popup'}).openPopup();";
            } else {
                echo "marker.bindPopup('<div class=\"custom-popup\"><img src=\"./user_area/gambar/" . $location['gambar'] . "\" width=\"200\" height=\"150\"><br><b>" . htmlspecialchars($location['nama_alternatif']) . "</b><br><div style=\"word-wrap: break-word;\">Biaya masuk : " . $location['biaya_alt'] . "<br>Fasilitas : " . $location['fasilitas_alt'] . "<br>Jarak dari pusat kota : " . $location['jarak_alt'] . "<br>Jumlah pengunjung : " . $location['jumlah_peng_alt'] . "<br>" . "<br></div></div>', {className:'custom-popup'}).openPopup();";
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
        <footer class="bg-white text-center text-lg-start">
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: #F0F0F0;">
                © 2023 Copyright:
                <a class="text-dark" href="https://www.instagram.com/ilkom19_unc/">Intel'19</a>
            </div>
            <!-- Copyright -->
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
        <script src="./assets/DataTables/jquery.js"></script>
        <script src="./assets/DataTables/datatables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
        <!-- jquery datatables -->
        <script>
        $(document).ready(function() {
            var table = $('#table').DataTable({
                responsive: true,
                "lengthMenu": [
                    [5, 10, 15, 20, 100, -1],
                    [5, 10, 15, 20, 100, "All"]
                ],
                "scrollX": true,
                "scrollY": true,
            });
            var table = $('#table1').DataTable({
                responsive: true,
                "lengthMenu": [
                    [5, 10, 15, 20, 100, -1],
                    [5, 10, 15, 20, 100, "All"]
                ],
                "scrollX": true,
                "scrollY": true,
            });
            var table = $('#table2').DataTable({
                responsive: true,
                "lengthMenu": [
                    [5, 10, 15, 20, 100, -1],
                    [5, 10, 15, 20, 100, "All"]
                ],
                "scrollX": true,
                "scrollY": true,
            });
            var table = $('#table-penilaian').DataTable({
                responsive: true,
                "lengthMenu": [
                    [5, 10, 15, 20, 100, -1],
                    [5, 10, 15, 20, 100, "All"]
                ],
                "scrollX": true,
                "scrollY": true,
            });
            // new $.fn.dataTable.FixedHeader(table);
        });
        </script>
        <script>
        // Ambil semua tombol "Go Somewhere"
        var buttons = document.querySelectorAll(".btn.btn-primary");

        // Tambahkan event listener ke masing-masing tombol
        buttons.forEach(function(button) {
            button.addEventListener("click", function() {
                // Ambil target collapse ID yang sesuai dari tombol
                var targetCollapseId = button.getAttribute("data-target");

                // Toggle tampilan detail
                var targetCollapse = document.querySelector(targetCollapseId);
                if (targetCollapse.style.display === "none") {
                    targetCollapse.style.display = "block";
                } else {
                    targetCollapse.style.display = "none";
                }
            });
        });
        </script>
        <script>
        $(document).ready(function() {
            $("#prioritas_1").change(function() {
                var prioritas_1 = $("#prioritas_1").val();
                $.ajax({
                    type: 'POST',
                    url: "./user_area/classes/pilihan.php",
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
                    url: "./user_area/classes/pilihan.php",
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
                    url: "./user_area/classes/pilihan.php",
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

        <script>
        // Ambil elemen input, select box, dan kontainer kartu
        // var filterInput = document.getElementById('filterInput');
        var filterSelect = document.getElementById('filterSelect');
        var cardContainer = document.getElementById('cardContainer');

        // Tambahkan event listener pada input dan select box untuk memantau perubahan
        // filterInput.addEventListener('input', filterCards);
        filterSelect.addEventListener('change', filterCards);

        // Fungsi untuk memfilter kartu-kartu
        function filterCards() {
            // var filterText = filterInput.value.toLowerCase();
            var filterOption = filterSelect.value.toLowerCase();
            var cards = cardContainer.getElementsByClassName('card');

            for (var i = 0; i < cards.length; i++) {
                var card = cards[i];
                var cardTitle = card.querySelector('.card-kategori').textContent.toLowerCase();
                var displayStyle = 'block'; // Default: Tampilkan kartu

                // Periksa apakah teks pada judul kartu cocok dengan filter
                if (filterOption === '' || cardTitle.includes(filterOption)) {
                    // if (!cardTitle.includes(filterText)) {
                    //     displayStyle = 'none'; // Sembunyikan kartu jika tidak cocok dengan judul
                    // }
                } else {
                    displayStyle = 'none'; // Sembunyikan kartu jika tidak cocok dengan opsi yang dipilih
                }

                card.style.display = displayStyle;
            }
        }


        // // Fungsi untuk memfilter kartu-kartu
        // function filterCards2() {
        //     var filterText = filterInput.value.toLowerCase();
        //     var cards = cardContainer.getElementsByClassName('card');

        //     for (var i = 0; i < cards.length; i++) {
        //         var card = cards[i];
        //         var cardTitle = card.querySelector('.card-title').textContent.toLowerCase();
        //         // var cardText = card.querySelector('.card-text').textContent.toLowerCase();

        //         console.log(cardTitle)
        //         // Periksa apakah teks pada judul atau isi kartu cocok dengan filter
        //         if (cardTitle.includes(filterText)) {
        //             card.style.display = 'block'; // Tampilkan kartu jika cocok
        //         } else {
        //             card.style.display = 'none'; // Sembunyikan kartu jika tidak cocok
        //         }
        //     }
        // }

        // Tambahkan event listener pada input untuk memantau perubahan
        // filterInput.addEventListener('input', filterCards2);
        // Pemanggilan awal saat halaman dimuat
        filterSelect.addEventListener('DOMContentLoaded', filterCards);
        </script>
</body>

</html>