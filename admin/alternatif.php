<?php
session_start();
unset($_SESSION['menu']);
$_SESSION['menu'] = 'alternatif';
require_once './header.php';
require_once './classes/alternatif.php';
require_once './classes/sub_kriteria.php';

$dataAlternatif = $getDataAlternatif->getDataAlternatif();
$dataSifatMekanik = $getDataAlternatif->getSubKriteriaSifatMekanik();
$dataSubKelasKeawetan = $getDataAlternatif->getSubKriteriaKelasKeawetan();
$dataSubUmurKayu = $getDataAlternatif->getSubKriteriaUmurKayu();
$dataSubHargaKayu = $getDataAlternatif->getSubKriteriaHargaKayu();

$umurId = 0;
$hargaId = 0;
if (isset($_POST['simpan'])) {
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $namaFile = $_FILES['gambar']['name'];
        $lokasiSementara = $_FILES['gambar']['tmp_name'];

        // Tentukan lokasi tujuan penyimpanan
        $targetDir = '../user_area/gambar/';
        $targetFilePath = $targetDir . $namaFile;

        // Cek apakah nama file sudah ada dalam direktori target
        if (file_exists($targetFilePath)) {
            $fileInfo = pathinfo($namaFile);
            $baseName = md5($fileInfo['filename'] . time()); // Tambahkan timestamp untuk memastikan keunikan
            $extension = $fileInfo['extension'];
            $counter = 1;

            // Loop hingga menemukan nama file yang unik
            while (file_exists($targetDir . $baseName . '_' . $counter . '.' . $extension)) {
                $counter++;
            }

            $namaFile = $baseName . '_' . $counter . '.' . $extension;
            $targetFilePath = $targetDir . $namaFile;
        } else {
            $fileInfo = pathinfo($namaFile);
            $baseName = md5($fileInfo['filename'] . time()); // Tambahkan timestamp untuk memastikan keunikan
            $extension = $fileInfo['extension'];
            $namaFile = $baseName . '.' . $extension;
            $targetFilePath = $targetDir . $namaFile;
        }

        // Pindahkan file gambar dari lokasi sementara ke lokasi tujuan
        if (move_uploaded_file($lokasiSementara, $targetFilePath)) {
            $namaAlternatif = htmlspecialchars($_POST['nama_alternatif']);
            $sifat_mekanik = htmlspecialchars($_POST['sifat_mekanik']);
            $kelas_keawetan = htmlspecialchars($_POST['kelas_keawetan']);

            // umur
            $umur = htmlspecialchars($_POST['umur']);
            $umur_cek = htmlspecialchars($_POST['umur']);
            foreach ($dataSubUmurKayu as $key => $sub) {
                if ($sub['bobot_sub_kriteria'] == 5 && ($umur_cek >= 60)) {
                    $umurId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 4 && ($umur_cek >= 40 && $umur_cek < 60)) {
                    $umurId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 3 && ($umur_cek >= 30 && $umur_cek < 40)) {
                    $umurId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 2 && ($umur_cek >= 25 && $umur_cek < 30)) {
                    $umurId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 1 && ($umur_cek < 25)) {
                    $umurId = $sub['id_sub_kriteria'];
                }
            }

            // harga
            $harga = htmlspecialchars($_POST['harga']);
            foreach ($dataSubHargaKayu as $key => $sub) {
                if ($sub['bobot_sub_kriteria'] == 5 && ($harga >= 5000000)) {
                    $hargaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 4 && ($harga >= 3500000 && $harga < 5000000)) {
                    $hargaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 3 && ($harga >= 2000000 && $harga < 3500000)) {
                    $hargaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 2 && ($harga >= 600000 && $harga < 2000000)) {
                    $hargaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 1 && ($harga < 600000)) {
                    $hargaId = $sub['id_sub_kriteria'];
                }
            }

            $dataAlt = [
                'nama_alternatif' => $namaAlternatif,
                'sifat_mekanik' => $sifat_mekanik,
                'harga' => $harga,
                'umur' => $umur,
                'kelas_keawetan' => $kelas_keawetan,
                'gambar' => $namaFile
            ];

            $dataSubKriteria = [
                'C1' => $sifat_mekanik,
                'C2' => $kelas_keawetan,
                'C3' => $umurId,
                'C4' => $hargaId
            ];

            $getDataAlternatif->tambahAlternatif($dataAlt, $dataSubKriteria);
        } else {
            return $_SESSION['error'] = 'Tidak ada data yang dikirim!';
        }
    } else {
        return $_SESSION['error'] = 'Tidak ada data yang dikirim!';
    }
}
if (isset($_POST['edit'])) {
    // Pastikan ada file gambar yang diunggah
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $namaFile = $_FILES['gambar']['name'];
        $lokasiSementara = $_FILES['gambar']['tmp_name'];

        // Tentukan lokasi tujuan penyimpanan
        $targetDir = '../user_area/gambar/';
        $targetFilePath = $targetDir . $namaFile;

        // Cek apakah nama file sudah ada dalam direktori target
        if (file_exists($targetFilePath)) {
            $fileInfo = pathinfo($namaFile);
            $baseName = md5($fileInfo['filename'] . time()); // Tambahkan timestamp untuk memastikan keunikan
            $extension = $fileInfo['extension'];
            $counter = 1;

            // Loop hingga menemukan nama file yang unik
            while (file_exists($targetDir . $baseName . '_' . $counter . '.' . $extension)) {
                $counter++;
            }

            $namaFile = $baseName . '_' . $counter . '.' . $extension;
            $targetFilePath = $targetDir . $namaFile;
        } else {
            $fileInfo = pathinfo($namaFile);
            $baseName = md5($fileInfo['filename'] . time()); // Tambahkan timestamp untuk memastikan keunikan
            $extension = $fileInfo['extension'];
            $namaFile = $baseName . '.' . $extension;
            $targetFilePath = $targetDir . $namaFile;
        }

        // Pindahkan file gambar dari lokasi sementara ke lokasi tujuan
        if (move_uploaded_file($lokasiSementara, $targetFilePath)) {
            $id_alternatif = htmlspecialchars($_POST['id_alternatif']);
            $namaAlternatif = htmlspecialchars($_POST['nama_alternatif']);
            $sifat_mekanik = htmlspecialchars($_POST['sifat_mekanik']);
            $kelas_keawetan = htmlspecialchars($_POST['kelas_keawetan']);

            // Hapus gambar lama jika ada
            if (isset($_POST["gambar_lama"])) {
                $fileLama = $_POST["gambar_lama"];
                if (file_exists($targetDir . $fileLama)) {
                    unlink($targetDir . $fileLama);
                }
            }


            // umur
            $umur = htmlspecialchars($_POST['umur']);
            $umur_cek = htmlspecialchars($_POST['umur']);
            foreach ($dataSubUmurKayu as $key => $sub) {
                if ($sub['bobot_sub_kriteria'] == 5 && ($umur_cek >= 60)) {
                    $umurId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 4 && ($umur_cek >= 40 && $umur_cek < 60)) {
                    $umurId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 3 && ($umur_cek >= 30 && $umur_cek < 40)) {
                    $umurId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 2 && ($umur_cek >= 25 && $umur_cek < 30)) {
                    $umurId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 1 && ($umur_cek < 25)) {
                    $umurId = $sub['id_sub_kriteria'];
                }
            }

            // harga
            $harga = htmlspecialchars($_POST['harga']);
            foreach ($dataSubHargaKayu as $key => $sub) {
                if ($sub['bobot_sub_kriteria'] == 5 && ($harga >= 5000000)) {
                    $hargaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 4 && ($harga >= 3500000 && $harga < 5000000)) {
                    $hargaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 3 && ($harga >= 2000000 && $harga < 3500000)) {
                    $hargaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 2 && ($harga >= 600000 && $harga < 2000000)) {
                    $hargaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 1 && ($harga < 600000)) {
                    $hargaId = $sub['id_sub_kriteria'];
                }
            }

            $dataAlt = [
                'id_alternatif' => $id_alternatif,
                'nama_alternatif' => $namaAlternatif,
                'sifat_mekanik' => $sifat_mekanik,
                'harga' => $harga,
                'umur' => $umur,
                'kelas_keawetan' => $kelas_keawetan,
                'gambar' => $namaFile
            ];

            $dataSubKriteria = [$sifat_mekanik, $kelas_keawetan, $umurId, $hargaId];
            $getDataAlternatif->editAlternatif($dataAlt, $dataSubKriteria);
        } else {
            return $_SESSION['error'] = 'Tidak ada data yang dikirim!';
        }
    } else {
        $id_alternatif = htmlspecialchars($_POST['id_alternatif']);
        $namaAlternatif = htmlspecialchars($_POST['nama_alternatif']);
        $sifat_mekanik = htmlspecialchars($_POST['sifat_mekanik']);
        $kelas_keawetan = htmlspecialchars($_POST['kelas_keawetan']);
        $namaFile = htmlspecialchars($_POST['gambar_lama']);

        // umur
        $umur = htmlspecialchars($_POST['umur']);
        $umur_cek = htmlspecialchars($_POST['umur']);
        foreach ($dataSubUmurKayu as $key => $sub) {
            if ($sub['bobot_sub_kriteria'] == 5 && ($umur_cek >= 60)) {
                $umurId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 4 && ($umur_cek >= 40 && $umur_cek < 60)) {
                $umurId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 3 && ($umur_cek >= 30 && $umur_cek < 40)) {
                $umurId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 2 && ($umur_cek >= 25 && $umur_cek < 30)) {
                $umurId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 1 && ($umur_cek < 25)) {
                $umurId = $sub['id_sub_kriteria'];
            }
        }

        // harga
        $harga = htmlspecialchars($_POST['harga']);
        foreach ($dataSubHargaKayu as $key => $sub) {
            if ($sub['bobot_sub_kriteria'] == 5 && ($harga >= 5000000)) {
                $hargaId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 4 && ($harga >= 3500000 && $harga < 5000000)) {
                $hargaId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 3 && ($harga >= 2000000 && $harga < 3500000)) {
                $hargaId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 2 && ($harga >= 600000 && $harga < 2000000)) {
                $hargaId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 1 && ($harga < 600000)) {
                $hargaId = $sub['id_sub_kriteria'];
            }
        }

        $dataAlt = [
            'id_alternatif' => $id_alternatif,
            'nama_alternatif' => $namaAlternatif,
            'sifat_mekanik' => $sifat_mekanik,
            'harga' => $harga,
            'umur' => $umur,
            'kelas_keawetan' => $kelas_keawetan,
            'gambar' => $namaFile
        ];

        $dataSubKriteria = [$sifat_mekanik, $kelas_keawetan, $umurId, $hargaId];
        $getDataAlternatif->editAlternatif($dataAlt, $dataSubKriteria);
    }
}

if (isset($_POST['hapus'])) {
    $idAlternatif = htmlspecialchars($_POST['id_alternatif']);
    $getDataAlternatif->hapusAlternatif($idAlternatif);
    $fileLama = htmlspecialchars($_POST["gambar_lama"]);
    $targetDir = '../user_area/gambar/';
    if (file_exists($targetDir . $fileLama)) {
        unlink($targetDir . $fileLama);
    }
}

// $getSubBiaya = $getDataAlternatif->getSubBiaya();
// $getSubFasilitas = $getDataAlternatif->getSubFasilitas();
// $getSubPusatKota = $getDataAlternatif->getSubPusatKota();
// $getSubJumlahPengunjung = $getDataAlternatif->getSubJumlahPengunjung();
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
<div class="container" style="font-family: 'Prompt', sans-serif;">
    <div class="row">
        <div class="d-xxl-flex">
            <div class="col-xxl-3 mb-xxl-3 mt-5">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center pt-2 col-12">
                                Tambah Data
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 mt-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Kayu</label>
                                <input type="text" name="nama_alternatif" class="form-control"
                                    id="exampleFormControlInput1" required placeholder="Nama kayu" />
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="sifat_mekanik" class="form-label">Sifat Mekanik</label>
                                <select name="sifat_mekanik" id="sifat_mekanik" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach ($dataSifatMekanik as $key => $sifat_mekanik) : ?>
                                    <option value="<?= $sifat_mekanik['id_sub_kriteria']; ?>">
                                        <?= $sifat_mekanik['nama_sub_kriteria']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="kelas_keawetan" class="form-label">Kelas Keawetan</label>
                                <select name="kelas_keawetan" id="kelas_keawetan" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach ($dataSubKelasKeawetan as $key => $kelas_keawetan) : ?>
                                    <option value="<?= $kelas_keawetan['id_sub_kriteria']; ?>">
                                        <?= $kelas_keawetan['nama_sub_kriteria']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="umur" class="form-label">Umur Kayu</label>
                                <input type="number" name="umur" required class="form-control" id="umur"
                                    placeholder="Umur dalam tahun" step="0.01" min="0.00" />
                                <small style="font-size: 8pt"><i>Cukup masukkan angka saja. Cth 1 Tahun,
                                        cukup masukkan
                                        angka 1.</i></small>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="harga" class="form-label">Harga Kayu</label>
                                <input type="number" name="harga" required class="form-control" id="harga"
                                    placeholder="Contoh: 2000000" />
                                <small style="font-size: 8pt"><i>Cukup masukkan angka saja. Cth 2.000.000,
                                        cukup masukkan
                                        angka 2000000.</i></small>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" accept=".jpg,.jpeg,.png" class="form-control" name="gambar"
                                    id="gambar" required />
                            </div>

                            <button type="submit" name="simpan" class="btn col-12 btn-outline-secondary">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xxl-9 mt-5 ms-xxl-5">
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

<?php foreach ($dataAlternatif as $alternatif) : ?>

<div class="modal fade" id="edit<?= $alternatif['id_alternatif']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal edit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="id_alternatif" value="<?= $alternatif['id_alternatif']; ?>">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="mb-3 mt-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Alternatif</label>
                            <input type="text" class="form-control" required name="nama_alternatif"
                                value="<?= $alternatif['nama_alternatif']; ?>" id="exampleFormControlInput1"
                                placeholder="Nama Alternatif" />
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="sifat_mekanik" class="form-label">Sifat Mekanik</label>
                        <select name="sifat_mekanik" id="sifat_mekanik" class="form-control">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($dataSifatMekanik as $key => $sifat_mekanik) : ?>
                            <option
                                <?= $sifat_mekanik['id_sub_kriteria'] == $alternatif['id_sub_C1'] ? 'selected' : ''; ?>
                                value="<?= $sifat_mekanik['id_sub_kriteria']; ?>">
                                <?= $sifat_mekanik['nama_sub_kriteria']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="kelas_keawetan" class="form-label">Kelas Keawetan</label>
                        <select name="kelas_keawetan" id="kelas_keawetan" class="form-control">
                            <option value="">-- Pilih --</option>
                            <?php foreach ($dataSubKelasKeawetan as $key => $kelas_keawetan) : ?>
                            <option
                                <?= $kelas_keawetan['id_sub_kriteria'] == $alternatif['id_sub_C2'] ? 'selected' : ''; ?>
                                value="<?= $kelas_keawetan['id_sub_kriteria']; ?>">
                                <?= $kelas_keawetan['nama_sub_kriteria']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="umur" class="form-label">Umur Kayu</label>
                        <input type="number" name="umur" required class="form-control"
                            value="<?= $alternatif['umur']; ?>" id="umur" placeholder="Umur dalam tahun" step="0.01"
                            min="0.00" />
                        <small style="font-size: 8pt"><i>Cukup masukkan angka saja. Cth 1 Tahun,
                                cukup masukkan
                                angka 1.</i></small>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="harga" class="form-label">Harga Kayu</label>
                        <input type="number" name="harga" required class="form-control"
                            value="<?= $alternatif['harga']; ?>" id="harga" placeholder="Contoh: 2000000" />
                        <small style="font-size: 8pt"><i>Cukup masukkan angka saja. Cth 2.000.000,
                                cukup masukkan
                                angka 2000000.</i></small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 mt-3">
                            <input type="hidden" name="gambar_lama" value="<?= $alternatif['gambar']; ?>">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" accept=".jpg,.jpeg,.png" class="form-control" name="gambar"
                                id="gambar" />
                            <?php if ($alternatif['gambar'] == '-') : ?>
                            <img class="mt-2" style="width: 150px; height:150px;" src="../user_area/gambar/gereja.jpg"
                                alt="">
                            <?php else : ?>
                            <img class="mt-2" style="width: 150px; height:150px;"
                                src="../user_area/gambar/<?= $alternatif['gambar']; ?>" alt="">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="edit" class="btn btn-outline-primary">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php foreach ($dataAlternatif as $alternatif) : ?>
<div class="modal fade" id="hapus<?= $alternatif['id_alternatif']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal hapus</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="id_alternatif" value="<?= $alternatif['id_alternatif']; ?>">
                <input type="hidden" name="gambar_lama" value="<?= $alternatif['gambar']; ?>">
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus alternatif <strong>
                            <?= $alternatif['nama_alternatif']; ?></strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="hapus" class="btn btn-outline-primary">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php
require_once './footer.php';
?>