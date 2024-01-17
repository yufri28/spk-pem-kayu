<?php 
    // session_start();
    // require_once '../config.php';
    class Alternatif{

        private $db;

        public function __construct()
        {
            $this->db = connectDatabase();
        }

        public function getDataAlternatif()
        {
            return $this->db->query("SELECT * FROM alternatif");
        }
        public function alternatif_kriteria()
        {
            return $this->db->query("SELECT 
            a.nama_alternatif, 
            a.id_alternatif,
            a.latitude,
            a.longitude,
            a.alamat,
            a.gambar,
            a.rating, a.kategori, a.biaya_alt, a.fasilitas_alt, a.jarak_alt, a.jumlah_peng_alt,
            MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.spesifikasi END) AS namaC1,
            MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.spesifikasi END) AS namaC2,
            MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.spesifikasi END) AS namaC3,
            MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.spesifikasi END) AS namaC4,
            MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.spesifikasi END) AS namaC5
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria
            GROUP BY a.nama_alternatif, a.id_alternatif ORDER BY a.id_alternatif ASC;            
            ");
        }

        public function tambahAlternatif($dataAlternatif)
        {
            $stmtInsert = $this->db->prepare("INSERT INTO alternatif(nama_alternatif,alamat,latitude,longitude) VALUES(?,?,?,?)");
            $stmtInsert->bind_param("ssss", $dataAlternatif['nama_alternatif'],$dataAlternatif['alamat'],$dataAlternatif['latitude'],$dataAlternatif['longitude']);
            $stmtInsert->execute();
            if($stmtInsert){
                return $_SESSION['success'] = 'Data berhasil disimpan!';
            }else{
                return $_SESSION['error'] = 'Terjadi kesalahan dalam menyimpan data.';
            }
            $stmtInsert->close();
        }

        public function hapusAlternatif($id) {
            $stmtDelete = $this->db->prepare("DELETE FROM alternatif WHERE id_alternatif=?");
            $stmtDelete->bind_param("i", $id);
            $stmtDelete->execute();
            if($stmtDelete){
                return $_SESSION['success'] = 'Data berhasil dihapus!';
            }else{
                return $_SESSION['error'] = 'Terjadi kesalahan dalam menghapus data.';
            }
            $stmtDelete->close();
        }

    }

    $getDataAlternatif = new Alternatif();
?>