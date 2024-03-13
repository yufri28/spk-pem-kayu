<?php
session_start();
unset($_SESSION['menu']);
$_SESSION['menu'] = 'alternatif';
require_once './header.php';
require_once './classes/alternatif.php';
require_once './classes/sub_kriteria.php';

$dataAlternatif = $getDataAlternatif->getDataAlternatif();
$dataSifatMekanik = $getDataAlternatif->getSubKriteriaSifatMekanik();
$dataSubFisik = $getDataAlternatif->getSubKriteriaFisik();
$dataSubKelasKeawetan = $getDataAlternatif->getSubKriteriaKelasKeawetan();
$dataSubUmurKayu = $getDataAlternatif->getSubKriteriaUmurKayu();
$dataSubHargaKayu = $getDataAlternatif->getSubKriteriaHargaKayu();

$teks = "";
$biayaId = 0;
$fasId = 0;
$jarakId = 0;
$pengId = 0;
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
            $sifat_fisik = htmlspecialchars($_POST['sifat_fisik']);
            $kelas_keawetan = htmlspecialchars($_POST['kelas_keawetan']);

            // umur
            $umur = htmlspecialchars($_POST['umur']);
            $umur_cek = htmlspecialchars($_POST['umur']);
            foreach ($dataSubUmurKayu as $key => $sub) {
                if ($sub['bobot_sub_kriteria'] == 5 && ($umur_cek >= 0 && $umur_cek <= 30000)) {
                    $umurId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 4 && ($umur_cek > 30000 && $umur_cek <= 60000)) {
                    $umurId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 3 && ($umur_cek > 60000 && $umur_cek <= 90000)) {
                    $umurId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 2 && ($umur_cek > 90000 && $umur_cek <= 120000)) {
                    $umurId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 1 && ($umur_cek > 120000)) {
                    $umurId = $sub['id_sub_kriteria'];
                }
            }

            // harga
            $harga = htmlspecialchars($_POST['harga']);
            foreach ($dataSubHargaKayu as $key => $sub) {
                if ($sub['bobot_sub_kriteria'] == 5 && ($harga >= 0 && $harga <= 3000)) {
                    $hargaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 4 && ($harga > 3000 && $harga <= 6000)) {
                    $hargaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 3 && ($harga > 6000 && $harga <= 9000)) {
                    $hargaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 2 && ($harga > 9000 && $harga <= 12000)) {
                    $hargaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 1 && ($harga > 12000)) {
                    $hargaId = $sub['id_sub_kriteria'];
                }
            }

            $dataAlt = [
                'nama_alternatif' => $namaAlternatif,
                'sifat_mekanik' => $sifat_mekanik,
                'sifat_fisik' => $sifat_fisik,
                'harga_kayu' => $haarga,
                'umur_kayu' => $umur,
                'kelas_keawetan' => $kelas_keawetan,
                'gambar' => $namaFile
            ];

            $dataSubKriteria = [
                'C1' => $sifat_mekanik,
                'C2' => $sifat_fisik,
                'C3' => $kelas_keawetan,
                'C4' => $umurId,
                'C5' => $hargaId
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
            $alamat = htmlspecialchars($_POST['alamat']);
            $rating = htmlspecialchars($_POST['rating']);
            $kategori = htmlspecialchars($_POST['kategori']);

            // Hapus gambar lama jika ada
            if (isset($_POST["gambar_lama"])) {
                $fileLama = $_POST["gambar_lama"];
                if (file_exists($targetDir . $fileLama)) {
                    unlink($targetDir . $fileLama);
                }
            }

            // biaya
            $biaya = htmlspecialchars($_POST['biaya']);
            foreach ($dataSubBiaya as $key => $sub) {
                if ($sub['bobot_sub_kriteria'] == 5 && ($biaya >= 0 && $biaya <= 3000)) {
                    $biayaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 4 && ($biaya > 3000 && $biaya <= 6000)) {
                    $biayaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 3 && ($biaya > 6000 && $biaya <= 9000)) {
                    $biayaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 2 && ($biaya > 9000 && $biaya <= 12000)) {
                    $biayaId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 1 && ($biaya > 12000)) {
                    $biayaId = $sub['id_sub_kriteria'];
                }
            }

            // fasilitas
            $fasilitas = htmlspecialchars($_POST['fasilitas']);
            $explod = explode(", ", $fasilitas);
            $count = count($explod);
            if ($count > 1) {
                foreach ($explod as $key => $value) {
                    if ($key == count($explod) - 1) {
                        $teks .= "dan " . $value;
                    } else if ($key == count($explod) - 2) {
                        $teks .= $value . " ";
                    } else {
                        $teks .= $value . ", ";
                    }
                }
            } else {
                $teks = $fasilitas;
            }

            foreach ($dataSubFas as $key => $sub) {
                if ($sub['bobot_sub_kriteria'] == 5 && count($explod) >= 5) {
                    $fasId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 4 && count($explod) == 4) {
                    $fasId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 3 && count($explod) == 3) {
                    $fasId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 2 && count($explod) == 2) {
                    $fasId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 1 && count($explod) == 1) {
                    $fasId = $sub['id_sub_kriteria'];
                }
            }


            // jarak
            $jarak = htmlspecialchars($_POST['jarak']);
            $jarak_cek = htmlspecialchars($_POST['jarak']) * 1000;

            foreach ($dataSubJarak as $key => $sub) {
                if ($sub['bobot_sub_kriteria'] == 5 && ($jarak_cek >= 0 && $jarak_cek <= 30000)) {
                    $jarakId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 4 && ($jarak_cek > 30000 && $jarak_cek <= 60000)) {
                    $jarakId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 3 && ($jarak_cek > 60000 && $jarak_cek <= 90000)) {
                    $jarakId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 2 && ($jarak_cek > 90000 && $jarak_cek <= 120000)) {
                    $jarakId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 1 && ($jarak_cek > 120000)) {
                    $jarakId = $sub['id_sub_kriteria'];
                }
            }

            // Jumlah pengunjung
            $jumlah_pengunjung = htmlspecialchars($_POST['jumlah-pengunjung']);
            foreach ($dataSubPeng as $key => $sub) {
                if ($sub['bobot_sub_kriteria'] == 5 && ($jumlah_pengunjung >= 0 && $jumlah_pengunjung <= 10000)) {
                    $pengId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 4 && ($jumlah_pengunjung > 10000 && $jumlah_pengunjung <= 25000)) {
                    $pengId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 3 && ($jumlah_pengunjung > 25000 && $jumlah_pengunjung <= 50000)) {
                    $pengId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 2 && ($jumlah_pengunjung > 50000 && $jumlah_pengunjung <= 100000)) {
                    $pengId = $sub['id_sub_kriteria'];
                } else if ($sub['bobot_sub_kriteria'] == 1 && ($jumlah_pengunjung > 100000)) {
                    $pengId = $sub['id_sub_kriteria'];
                }
            }

            $dataAlt = [
                'id_alternatif' => $id_alternatif,
                'nama_alternatif' => $namaAlternatif,
                'rating' => $rating,
                'kategori' => $kategori,
                'fasilitas_alt' => $teks,
                'biaya_alt' => $biaya,
                'gambar' => $namaFile,
                'jarak_alt' => $jarak,
                'alamat' => $alamat,
                'jumlah_peng_alt' => $jumlah_pengunjung
            ];



            $dataSubKriteria = [$biayaId, $fasId, $jarakId, $pengId];
            $getDataAlternatif->editAlternatif($dataAlt, $dataSubKriteria);
        } else {
            return $_SESSION['error'] = 'Tidak ada data yang dikirim!';
        }
    } else {
        $id_alternatif = htmlspecialchars($_POST['id_alternatif']);
        $namaAlternatif = htmlspecialchars($_POST['nama_alternatif']);
        $latitude = htmlspecialchars($_POST['latitude']);
        $longitude = htmlspecialchars($_POST['longitude']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $rating = htmlspecialchars($_POST['rating']);
        $kategori = htmlspecialchars($_POST['kategori']);

        // biaya
        $biaya = htmlspecialchars($_POST['biaya']);
        foreach ($dataSubBiaya as $key => $sub) {
            if ($sub['bobot_sub_kriteria'] == 5 && ($biaya >= 0 && $biaya <= 3000)) {
                $biayaId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 4 && ($biaya > 3000 && $biaya <= 6000)) {
                $biayaId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 3 && ($biaya > 6000 && $biaya <= 9000)) {
                $biayaId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 2 && ($biaya > 9000 && $biaya <= 12000)) {
                $biayaId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 1 && ($biaya > 12000)) {
                $biayaId = $sub['id_sub_kriteria'];
            }
        }

        // fasilitas
        $fasilitas = htmlspecialchars($_POST['fasilitas']);
        $explod = explode(", ", $fasilitas);
        $count = count($explod);
        if ($count > 1) {
            foreach ($explod as $key => $value) {
                if ($key == count($explod) - 1) {
                    $teks .= "dan " . $value;
                } else if ($key == count($explod) - 2) {
                    $teks .= $value . " ";
                } else {
                    $teks .= $value . ", ";
                }
            }
        } else {
            $teks = $fasilitas;
        }
        foreach ($dataSubFas as $key => $sub) {
            if ($sub['bobot_sub_kriteria'] == 5 && count($explod) == 5) {
                $fasId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 4 && count($explod) == 4) {
                $fasId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 3 && count($explod) == 3) {
                $fasId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 2 && count($explod) == 2) {
                $fasId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 1 && count($explod) == 1) {
                $fasId = $sub['id_sub_kriteria'];
            }
        }


        // jarak
        $jarak = htmlspecialchars($_POST['jarak']);
        $jarak_cek = htmlspecialchars($_POST['jarak']) * 1000;

        foreach ($dataSubJarak as $key => $sub) {
            if ($sub['bobot_sub_kriteria'] == 5 && ($jarak_cek >= 0 && $jarak_cek <= 30000)) {
                $jarakId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 4 && ($jarak_cek > 30000 && $jarak_cek <= 60000)) {
                $jarakId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 3 && ($jarak_cek > 60000 && $jarak_cek <= 90000)) {
                $jarakId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 2 && ($jarak_cek > 90000 && $jarak_cek <= 120000)) {
                $jarakId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 1 && ($jarak_cek > 120000)) {
                $jarakId = $sub['id_sub_kriteria'];
            }
        }

        // Jumlah pengunjung
        $jumlah_pengunjung = htmlspecialchars($_POST['jumlah-pengunjung']);
        foreach ($dataSubPeng as $key => $sub) {
            if ($sub['bobot_sub_kriteria'] == 5 && ($jumlah_pengunjung >= 0 && $jumlah_pengunjung <= 10000)) {
                $pengId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 4 && ($jumlah_pengunjung > 10000 && $jumlah_pengunjung <= 25000)) {
                $pengId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 3 && ($jumlah_pengunjung > 25000 && $jumlah_pengunjung <= 50000)) {
                $pengId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 2 && ($jumlah_pengunjung > 50000 && $jumlah_pengunjung <= 100000)) {
                $pengId = $sub['id_sub_kriteria'];
            } else if ($sub['bobot_sub_kriteria'] == 1 && ($jumlah_pengunjung > 100000)) {
                $pengId = $sub['id_sub_kriteria'];
            }
        }

        $dataAlt = [
            'id_alternatif' => $id_alternatif,
            'nama_alternatif' => $namaAlternatif,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'rating' => $rating,
            'kategori' => $kategori,
            'biaya_alt' => $biaya,
            'gambar' => $_POST['gambar_lama'],
            'fasilitas_alt' => $teks,
            'jarak_alt' => $jarak,
            'alamat' => $alamat,
            'jumlah_peng_alt' => $jumlah_pengunjung
        ];

        $dataSubKriteria = [$biayaId, $fasId, $jarakId, $pengId];
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
<div class="container" style="font-family: 'Prompt', sans-serif; height: 100vh;">
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
                                <input type="text" name="nama_alternatif" class="form-control" id="exampleFormControlInput1" required placeholder="Nama kayu" />
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="umur_kayu" class="form-label">Umur Kayu</label>
                                <input type="number" name="umur_kayu" required class="form-control" id="umur_kayu" placeholder="Umur dalam tahun" step="0.01" min="0.00" />
                                <small style="font-size: 8pt"><i>Cukup masukkan angka saja. Cth 1 Tahun,
                                        cukup masukkan
                                        angka 1.</i></small>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="biaya" class="form-label">Harga Kayu</label>
                                <input type="number" name="biaya" required class="form-control" id="biaya" placeholder="Contoh: 2000" />
                                <small style="font-size: 8pt"><i>Cukup masukkan angka saja. Cth 2.000.000,
                                        cukup masukkan
                                        angka 2000000.</i></small>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" accept=".jpg,.jpeg,.png" class="form-control" name="gambar" id="gambar" required />
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
                            <table class="table table-striped table-bordered nowrap" style="width:100%" id="table-penilaian">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Nama Alternatif</th>
                                        <th scope="col">Sifat Mekanik</th>
                                        <th scope="col">Sifat Fisik</th>
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
                                            <td><a href="../user_area/gambar/<?= $alternatif['gambar'] == '-' ? 'no-img.png' : $alternatif['gambar']; ?>" data-lightbox="image-1" data-title="<?= $alternatif['nama_alternatif']; ?>"><img style="width:100px; height:100px;" src="../user_area/gambar/<?= $alternatif['gambar'] == '-' ? 'no-img.png' : $alternatif['gambar']; ?>" alt=""></a>
                                            </td>
                                            <td><?= $alternatif['nama_alternatif']; ?></td>
                                            <td><?= $alternatif['nama_C1']; ?></td>
                                            <td><?= $alternatif['nama_C2']; ?></td>
                                            <td><?= $alternatif['nama_C3']; ?></td>
                                            <td><?= $alternatif['umur']; ?></td>
                                            <td><?= $alternatif['harga']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?= $alternatif['id_alternatif']; ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $alternatif['id_alternatif']; ?>">
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
    <div class="modal fade" id="edit<?= $alternatif['id_alternatif']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="text" class="form-control" required name="nama_alternatif" value="<?= $alternatif['nama_alternatif']; ?>" id="exampleFormControlInput1" placeholder="Nama Alternatif" />
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 mt-3">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" class="form-control" value="<?= $alternatif['latitude']; ?>" name="latitude" id="latitude" required placeholder="Latitude" />
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 mt-3">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control" value="<?= $alternatif['longitude']; ?>" name="longitude" id="longitude" required placeholder="Longitude" />
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 mt-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" required name="alamat"><?= $alternatif['alamat']; ?></textarea>
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="number" max="5" value="<?= $alternatif['rating']; ?>" name="rating" required class="form-control" id="rating" placeholder="0" />
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" name="kategori" required aria-label="Default select example">
                                <option value="">-- Pilih --</option>
                                <option <?= $alternatif['kategori'] == 'Budaya' ? 'selected' : ''; ?> value="Budaya">Budaya
                                </option>
                                <option <?= $alternatif['kategori'] == 'Buatan' ? 'selected' : ''; ?> value="Buatan">Buatan
                                </option>
                                <option <?= $alternatif['kategori'] == 'Alam' ? 'selected' : ''; ?> value="Alam">Alam</option>
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="biaya" class="form-label">Biaya</label>
                            <input type="number" name="biaya" required class="form-control" id="biaya" placeholder="Contoh: 2000" value="<?= $alternatif['biaya_alt']; ?>" />
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="exampleFormControlInput1" class="form-label">Fasilitas</label>
                            <textarea class="form-control" required placeholder="Pisahkan dengan tanda koma" name="fasilitas"><?= str_replace(" dan ", ", ", $alternatif['fasilitas_alt']); ?></textarea>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="jarak" class="form-label">Jarak</label>
                            <input type="number" name="jarak" required class="form-control" id="jarak" placeholder="Jarak dalam KM" value="<?= $alternatif['jarak_alt']; ?>" step="0.01" min="0.00" />
                            <small style="font-size: 8pt"><i>Cukup masukkan angka saja. Cth 0.2
                                    km,
                                    cukup masukkan
                                    angka
                                    0.2.</i></small>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="jumlah-pengunjung" class="form-label">Jumlah Pengunjung</label>
                            <input type="number" name="jumlah-pengunjung" required class="form-control" id="jumlah-pengunjung" value="<?= $alternatif['jumlah_peng_alt']; ?>" placeholder="Jumlah pengunjung" />
                            <small style="font-size: 8pt"><i>Cukup masukkan angka saja.</i></small>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 mt-3">
                                <input type="hidden" name="gambar_lama" value="<?= $alternatif['gambar']; ?>">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" accept=".jpg,.jpeg,.png" class="form-control" name="gambar" id="gambar" />
                                <?php if ($alternatif['gambar'] == '-') : ?>
                                    <img class="mt-2" style="width: 150px; height:150px;" src="../user_area/gambar/gereja.jpg" alt="">
                                <?php else : ?>
                                    <img class="mt-2" style="width: 150px; height:150px;" src="../user_area/gambar/<?= $alternatif['gambar']; ?>" alt="">
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
    <div class="modal fade" id="hapus<?= $alternatif['id_alternatif']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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