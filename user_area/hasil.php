<?php
session_start();
unset($_SESSION['menu']);
$_SESSION['menu'] = 'hasil';
require_once './header.php';
require_once './classes/alternatif.php';
require_once './classes/hasil.php';

$dataAlternatif = $getDataAlternatif->getDataAlternatif();
$dataSifatMekanik = $getDataAlternatif->getSubKriteriaSifatMekanik();
$dataSubKelasKeawetan = $getDataAlternatif->getSubKriteriaKelasKeawetan();
$dataSubUmurKayu = $getDataAlternatif->getSubKriteriaUmurKayu();
$dataSubHargaKayu = $getDataAlternatif->getSubKriteriaHargaKayu();

$c1 = 0;
$c2 = 0;
$c3 = 0;
$c4 = 0;

$C1_ = 0;
$C2_ = 0;
$C3_ = 0;
$C4_ = 0;

$total_bobot = 0;
$post = false;
$array = array();
// init k
$k = 0;

$data = $koneksi->query("SELECT * FROM kriteria ORDER BY id_kriteria");

while ($row = mysqli_fetch_assoc($data)) {
    $array[] = $row['nama_kriteria'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $matrik = array();
	$urut 	= 0;

	for ($i = 0; $i <= (count($array) - 2); $i++) {
		for ($j = ($i + 1); $j <= (count($array) - 1); $j++) {
			$urut++;
			$opsi	= "opsi".$urut;
			$bobot 	= "bobot".$urut;
			if ($_POST[$opsi] == 1) {
				$matrik[$i][$j] = $_POST[$bobot];
				$matrik[$j][$i] = 1 / $_POST[$bobot];
			} else {
				$matrik[$i][$j] = 1 / $_POST[$bobot];
				$matrik[$j][$i] = $_POST[$bobot];
			}
		}
	}

    // diagonal --> bernilai 1
    for ($i = 0; $i <= (count($array) - 1); $i++) {
        $matrik[$i][$i] = 1;
    }
    
    // inisialisasi jumlah tiap kolom dan baris kriteria
	$jmlmpb = array();
	$jmlmnk = array();
	for ($i=0; $i <= (count($matrik) - 1); $i++) {
		$jmlmpb[$i] = 0;
		$jmlmnk[$i] = 0;
	}

	// menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
	for ($x=0; $x < count($matrik); $x++) {
		for ($y=0; $y < count($matrik) ; $y++) {
			$value		= $matrik[$x][$y];
			$jmlmpb[$y] += $value;
		}
      
	}
    
	// menghitung jumlah pada baris kriteria tabel nilai kriteria
	// matrikb merupakan matrik yang telah dinormalisasi
	for ($x=0; $x <= (count($matrik) - 1) ; $x++) {
		for ($y=0; $y <= (count($matrik) - 1) ; $y++) {
			$matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
			$value	= $matrikb[$x][$y];
			$jmlmnk[$x] += $value;
		}

		// nilai priority vektor
		$pv[$x]	 = $jmlmnk[$x] / count($matrik);

		
	}

    for ($x=0; $x < (count($matrik)) ; $x++) {
        switch ($x) {
            case 0:
                $c1 = $pv[$x];
                break;
            case 1:
                $c2 = $pv[$x];
                break;
            case 2:
                $c3 = $pv[$x];
                break;
            case 3:
                $c4 = $pv[$x];
                break;
            case 4:
                $c5 = $pv[$x];
                break;
        }
    }

   
  
    $dataBobotKriteria = [
        $c1,$c2,$c3,$c4
    ];
   
    $dataNormalisasi = $getDataHasil->getDataNormalisasi($c1,$c2,$c3,$c4);

    
    echo "<pre>";
    print_r ($dataBobotKriteria);
    echo "</pre>";  
    foreach ($dataNormalisasi as $key => $value) {
        $max = $value['norm_C1'] + $value['norm_C2'] + $value['norm_C3'] + $value['norm_C4']; 
        echo $max;
        echo "<br>";
    }

    die;
    // $dataPreferensiLimOne = $getDataHasil->getDataPreferensiLimOne($c1,$c2,$c3,$c4);
    // // $simpanRiwayat = $getDataHasil->simpanRiwayat($dataPreferensiLimOne['id_alternatif'],$c1,$c2,$c3,$c4);
    $post = true;

}else{
    $dataNormalisasi = $getDataHasil->getDataNormalisasi($c1,$c2,$c3,$c4);
}
$array_skala = [
    ['nilai' => '1', 'keterangan' => 'Kedua Kriteria sama-sama penting'],
    ['nilai' => '3', 'keterangan' => 'Salah satu Kriteria sedikit lebih penting'],
    ['nilai' => '5', 'keterangan' => 'Salah satu Kriteria lebih penting'],
    ['nilai' => '7', 'keterangan' => 'Salah Kriteria sangat lebih penting'],
    ['nilai' => '9', 'keterangan' => 'Salah Kriteria jauh lebih penting'],
    ['nilai' => '2, 4, 6, 8', 'keterangan' => 'Ragu-ragu antara kedua Kriteria yang dibandingkan']
];

$increament = 0;
$urut = 0;
?>
<?php if (isset($_SESSION['success'])) : ?>
<script>
var successfuly = '<?php echo $_SESSION["success"]; ?>';
Swal.fire({
    title: 'Sukses!',
    text: successfuly,
    icon: 'success',
    confirmButtonText: 'OK'
}).then(function(result) {
    if (result.isConfirmed) {
        window.location.href = '';
    }
});
</script>
<?php unset($_SESSION['success']); // Menghapus session setelah ditampilkan 
    ?>
<?php endif; ?>
<?php if (isset($_SESSION['error'])) : ?>
<script>
Swal.fire({
    title: 'Error!',
    text: '<?php echo $_SESSION['error']; ?>',
    icon: 'error',
    confirmButtonText: 'OK'
}).then(function(result) {
    if (result.isConfirmed) {
        window.location.href = '';
    }
});
</script>
<?php unset($_SESSION['error']); // Menghapus session setelah ditampilkan 
    ?>
<?php endif; ?>
<style>
table {
    font-size: 10pt;
}

ol {
    text-align: start;
}
</style>
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let button_like_link = document.getElementById('btn-like-link');

    button_like_link.addEventListener('click', function() {
        Swal.fire({
            title: 'Panduan',
            text: 'Langkah-langkah pengisian form perbandingan kriteria:',
            icon: 'warning',
            html: `
            <ol>
                <li>Pilih Kriteria yang lebih penting</li>
                <li>Masukkan Nilai perbandingannya berdasarkan tabel berikut:</li>
                <table class="table nowrap">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nilai Perbandingan</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($array_skala as $key => $value): ?>
                        <tr>
                            <th scope="row"><?=++$increament;?></th>
                            <td><?= $value['nilai'];?></td>
                            <td><?= $value['keterangan'];?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <li>Klik tombol submit</li>
            </ol>
        `,
            confirmButtonText: 'Paham'
        });

    });
});
</script>
<div class="container mb-5" style="font-family: 'Prompt', sans-serif;">
    <div class="row">
        <div class="d-xxl-flex">
            <div class="mt-5 col-lg-12">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading text-center">PANDUAN</h4>
                    <ul>
                        <li>
                            <p>Model perengkingan dari sistem ini menggunakan form perbandingan kriteria/spesifikasi
                                laptop,
                                sehingga anda perlu mengisi form perbandingan tersebut. Namun sebelum mengisi form
                                perbandingan, diharapkan membaca panduan pengisian form terlebih dahulu.</p>
                        </li>
                        <li>
                            <p>Jika pada
                                kolom Preferensi semua
                                nilainya 0 atau anda belum mengisi form perbandingan, maka silahkan isi terlebih dahulu
                                dengan mengklik tombol Isi Form.</p>
                        </li>
                        <hr>
                        <div class="d-flex">
                            <button type="button" id="btn-like-link"
                                class="button-like-link me-2 btn btn-primary mb-4 d-flex justify-content-end"><small
                                    class="">Baca
                                    Panduan</small></button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#isi-form"
                                class="btn btn-secondary mb-4 d-flex justify-content-end"><small class="">Isi
                                    Form</small></button>
                        </div>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header">HASIL PREFERENSI</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered nowrap" style="width:100%"
                                id="table-penilaian">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Nama Alternatif</th>
                                        <th scope="col">Sifat Mekanik</th>
                                        <th scope="col">Kelas Keawetan</th>
                                        <th scope="col">Umur</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <?php foreach ($dataAlternatif as $i => $alternatif) : ?>
                                    <tr>
                                        <th scope="row"><?= $i + 1; ?></th>
                                        <td><a href="../user_area/gambar/<?= $alternatif['gambar'] == '-' ? 'no-img.png' : $alternatif['gambar']; ?>"
                                                data-lightbox="image-1"
                                                data-title="<?= $alternatif['nama_alternatif']; ?>"><img
                                                    style="width:100px; height:100px;"
                                                    src="../user_area/gambar/<?= $alternatif['gambar'] == '-' ? 'no-img.png' : $alternatif['gambar']; ?>"
                                                    alt=""></a>
                                        </td>
                                        <td><?= $alternatif['nama_alternatif']; ?></td>
                                        <td><?= $alternatif['nama_C1']; ?></td>
                                        <td><?= $alternatif['nama_C2']; ?></td>
                                        <td><?= $alternatif['umur']; ?> Tahun</td>
                                        <td><?= $alternatif['harga']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#edit<?= $alternatif['id_alternatif']; ?>">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapus<?= $alternatif['id_alternatif']; ?>">
                                                Hapus
                                            </button>
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

<!-- Modal -->
<div class="modal fade" id="isi-form" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Perbandingan Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body shadow-lg d-flex justify-content-center py-5 px-md-5">
                        <div class="container">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Pilih yang lebih penting</th>
                                        <th scope="col"></th>
                                        <th scope="col">Nilai Perbandingan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i <= (count($array) - 2); $i++) : ?>
                                    <?php for ($j = ($i + 1); $j <= (count($array) - 1); $j++) : ?>
                                    <?php $k++; ?>
                                    <tr>
                                        <td>
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="opsi<?= $k ?>"
                                                    id="flexRadioDefault<?= $k ?>" value="1">
                                                <label class="form-check-label" for="flexRadioDefault<?= $k ?>">
                                                    <?= $array[$i]; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="opsi<?= $k ?>"
                                                    value="2" id="flexRadioDefaults<?= $k ?>">
                                                <label class="form-check-label" for="flexRadioDefaults<?= $k ?>">
                                                    <?= $array[$j]; ?>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mb-3">
                                                <input class="form-control" type="number" placeholder="0"
                                                    name="bobot<?php echo $k;?>" value="<?php echo $nilai ?>" max="9"
                                                    required>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endfor; ?>
                                    <?php endfor; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once './footer.php';
?>