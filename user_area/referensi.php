<?php
session_start();
unset($_SESSION['menu']);
$_SESSION['menu'] = 'referensi';
require_once './header.php';
require_once './classes/alternatif.php';

$dataAlternatif = $getDataAlternatif->getDataAlternatif();
$dataSifatMekanik = $getDataAlternatif->getSubKriteriaSifatMekanik();
$dataSubKelasKeawetan = $getDataAlternatif->getSubKriteriaKelasKeawetan();
$dataSubUmurKayu = $getDataAlternatif->getSubKriteriaUmurKayu();
$dataSubHargaKayu = $getDataAlternatif->getSubKriteriaHargaKayu();
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
<div class="container" style="font-family: 'Prompt', sans-serif; height: 100vh;">
    <div class="row">
        <div class="d-xxl-flex">
            <div class="mt-5 col-lg-12">
                <div class="card">
                    <div class="card-header">DAFTAR ALTERNATIF</div>
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
<?php
require_once './footer.php';
?>