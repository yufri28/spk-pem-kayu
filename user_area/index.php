<?php 
require_once './header.php';
require_once './classes/kriteria_v1.php';
require_once './classes/alternatif.php';

$post = false;

$prioritas1 = "";
$prioritas2 = "";
$prioritas3 = "";
$prioritas4 = "";
$jenis_c4 = "";
$jenis_kriteria4 = "";

$C1 = 1;
$C2 = 1;
$C3 = 1;
$C4 = 1;

if(isset($_POST['simpan'])){
    $prioritas1 = $_POST['prioritas_1'];
    $prioritas2 = $_POST['prioritas_2'];
    $prioritas3 = $_POST['prioritas_3'];
    $prioritas4 = $_POST['prioritas_4'];
    $jenis_c4 = $_POST['jenis_c4'];


    if($jenis_c4 == 1)
    {
        $jenis_kriteria4 = "benefit";
    }else if($jenis_c4 == 0){
        $jenis_kriteria4 = "cost";
    }

    $dataTampung = [
        $prioritas1,$prioritas2,$prioritas3,$prioritas4
    ];
    $dataBobotKriteria = [
        $prioritas1 => 0.25,
        $prioritas2 => 0.2,
        $prioritas3 => 0.15,
        $prioritas4 => 0.2
    ];

  
   
    foreach ($dataBobotKriteria as $key => $value) {
       switch ($key) {
        case "Biaya masuk":
            $C1 = $value;
            break;
        case "Fasilitas":
            $C2 = $value;
            break;
        case "Jarak dari pusat kota":
            $C3 = $value;
            break;
        case "Jumlah pengunjung":
            $C4 = $value;
            break;
       }
    }

    $post = true;
}


$dataKriteria = [
    "Biaya masuk", "Fasilitas", "Jarak dari pusat kota", "Jumlah pengunjung"
];
$alternatif_kriteria = $getDataAlternatif->alternatif_kriteria();


include_once './hitung.php';

?>

<div class="container" style="font-family: 'Prompt', sans-serif">
    <div class="row">
        <!-- <div class="d-md-flex"> -->
        <div class="col-md-4 mt-3 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center pt-2 col-12">
                        Masukan Prioritas
                    </h5>
                </div>
                <form method="post" action="">
                    <div class="card-body">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Apakah anda suka tempat yang ramai?
                        </label>
                        <div class="form-check">
                            <input class="form-check-input" <?=$jenis_c4 == 1 ? 'checked':'';?> required type="radio"
                                value="1" name="jenis_c4" id="jenis_c41">
                            <label class="form-check-label" for="jenis_c41">
                                Suka
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" required <?=$jenis_c4 == 0 ? 'checked':'';?> type="radio"
                                value="0" name="jenis_c4" id="jenis_c42">
                            <label class="form-check-label" for="jenis_c42">
                                Tidak suka
                            </label>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="prioritas_1" class="form-label">Prioritas 1</label>
                            <select class="form-control" id="prioritas_1" name="prioritas_1"
                                aria-label="Default select example">
                                <option value="">-- Pilih prioritas 1 --</option>
                                <?php foreach($dataKriteria as $kriteria):?>
                                <option <?=$kriteria == $prioritas1 ? 'selected':'';?> value="<?=$kriteria;?>">
                                    <?=$kriteria;?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="prioritas_2" class="form-label">Prioritas 2</label>
                            <select class="form-control" id="prioritas_2" name="prioritas_2">
                                <option value="">-- Pilih prioritas 2 --</option>
                                <?php foreach($dataKriteria as $kriteria):?>
                                <option <?=$kriteria == $prioritas2 ? 'selected':'';?> value="<?=$kriteria;?>">
                                    <?=$kriteria;?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="prioritas_3" class="form-label">Prioritas 3</label>
                            <select class="form-control" id="prioritas_3" name="prioritas_3">
                                <option value="">-- Pilih prioritas 3 --</option>
                                <?php foreach($dataKriteria as $kriteria):?>
                                <option <?=$kriteria == $prioritas3 ? 'selected':'';?> value="<?=$kriteria;?>">
                                    <?=$kriteria;?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="prioritas_4" class="form-label">Prioritas 4</label>
                            <select class="form-control" id="prioritas_4" name="prioritas_4">
                                <option value="">-- Pilih prioritas 4 --</option>
                                <?php foreach($dataKriteria as $kriteria):?>
                                <option <?= $kriteria == $prioritas4 ? 'selected':'';?> value="<?=$kriteria;?>">
                                    <?=$kriteria;?>
                                </option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <button type="submit" name="simpan" class="btn col-12 btn-outline-success">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-8 mt-3 mb-3">
            <div class="card">
                <div class="card-header">
                    DAFTAR kayu
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered nowrap" style="width:100%"
                            id="table-penilaian">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama kayu</th>
                                    <th scope="col">Biaya Masuk</th>
                                    <th scope="col">Fasilitas</th>
                                    <th scope="col">Jarak Pusat Kota</th>
                                    <th scope="col">Jumlah Pengunjung</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php foreach ($alternatif_kriteria  as $i => $value):?>
                                <tr>
                                    <th scope="row"><?= $i+1; ?></th>
                                    <td><a href="./gambar/<?= $value['gambar'] == '-'? 'no-img.png': $value['gambar'];?>"
                                            data-lightbox="image-1" data-title="<?= $value['nama_alternatif']; ?>"><img
                                                style="width:100px; height:100px;"
                                                src="./gambar/<?= $value['gambar'] == '-'? 'no-img.png': $value['gambar']; ?>"
                                                alt=""></a>
                                    </td>
                                    <td><?= $value['nama_alternatif']; ?></td>
                                    <td><?= $value['namaC1']; ?></td>
                                    <td><?= $value['namaC2']; ?></td>
                                    <td><?= $value['namaC3']; ?></td>
                                    <td><?= $value['namaC4']; ?></td>
                                    <td>
                                        <a href="https://www.google.com/maps/dir/?api=1&destination=<?=$value['latitude'];?>,<?=$value['longitude'];?>"
                                            title="Lokasi di MAPS" class="btn btn-sm btn-success">Lokasi</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
</div>

<?php if($post == true):?>
<div class="container" style="font-family: 'Prompt', sans-serif">
    <div class="row">
        <div class="d-xxl-flex">
            <div class="col-xxl-12 mt-3 ms-xxl-6 mb-1">
                <!-- <div class="card"> -->
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div id="mapid"></div>
                        </div>
                    </div>
                </div>
                <!-- </div> -->
                <div class="card mt-2">
                    <div class="card-header">Hasil Perengkingan</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered nowrap" style="width:100%" id="table">
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
                                        <td><?=$value['namaC1']?></td>
                                        <td><?=$value['namaC2']?></td>
                                        <td><?=$value['namaC3']?></td>
                                        <td><?=$value['namaC4']?></td>
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
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
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