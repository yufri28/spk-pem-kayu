<?php 

require_once '../config.php';
class JenisKriteria{
    private $db;

    public function __construct()
    {
        $this->db = connectDatabase();
    }

    public function getKriteriaByUser($id_user)
    {
        return $this->db->query("SELECT * FROM `kriteria` JOIN bobot_kriteria ON bobot_kriteria.f_id_user = '$id_user'");
    }
    public function getJenisKriteria($id_user=null)
    {
        return $this->db->query("SELECT * FROM `jenis_kriteria` jk JOIN `kriteria` k ON jk.f_id_kriteria=k.id_kriteria WHERE jk.f_id_user='$id_user'");
    }
    public function getBobotKriteria($id_user=null)
    {
        return $this->db->query("SELECT * FROM bobot_kriteria WHERE f_id_user='$id_user'");
    }
    // public function tambahJenisKriteria($dataJenisKriteria,$id_user)
    // {
    //     if (empty($dataJenisKriteria)) {
    //         return $_SESSION['error'] = 'Tidak ada data yang dikirim!';
    //      } 
    //      else {
    //         foreach ($dataJenisKriteria as $key => $jenis_kriteria) {
    //             $stmtInsert = $this->db->query("INSERT INTO jenis_kriteria (id_jenis_kriteria, jenis, f_id_kriteria,f_id_user) VALUES (0, '$jenis_kriteria','$key','$id_user')");
    //         }
    //         if($stmtInsert){
    //             return $_SESSION['success'] = 'Data berhasil ditambahkan!';
    //         }else{
    //             return $_SESSION['error'] = 'Terjadi kesalahan dalam menyimpan data.';
    //         }
    //      }
    //      $stmt->close();
    // }
    public function tambahJenisKriteria($dataJenisKriteria,$id_user)
    {
        if (empty($dataJenisKriteria)) {
            return $_SESSION['error'] = 'Tidak ada data yang dikirim!';
         } 
         else {
            foreach ($dataJenisKriteria as $key => $jenis_kriteria) {
                $stmtInsert = $this->db->query("INSERT INTO jenis_kriteria (id_jenis_kriteria, jenis, f_id_kriteria,f_id_user) VALUES (0, '$jenis_kriteria','$key','$id_user')");
            }
            if($stmtInsert){
                return $_SESSION['success'] = 'Terima kasih atas jawabannya!';
            }else{
                $_SESSION['warning'] = "Apakah anda suka dengan tempat kayu yang ramai?";
            }
           
             
         }
         $stmt->close();
    }
    public function editJenisKriteria($dataJenisKriteria=null)
    {
        $id_jenis_kriteria = $dataJenisKriteria['id_jenis_kriteria'];
        $jenis_kriteria = $dataJenisKriteria['jenis_kriteria'];
        
        $update = $this->db->query("UPDATE jenis_kriteria SET jenis='$jenis_kriteria' WHERE id_jenis_kriteria='$id_jenis_kriteria'");
        if($update){
            return $_SESSION['success'] = 'Data berhasil diedit!';
        }else{
            return $_SESSION['error'] = 'Terjadi kesalahan dalam menyimpan data.';
        }
    }
    public function tambahTampung($dataTampung,$id_user)
    {
        $C1 = $dataTampung[0];
        $C2 =  $dataTampung[1];
        $C3 =  $dataTampung[2];
        $C4 =  $dataTampung[3];
        $C5 =  $dataTampung[4];
        $this->db->query("INSERT INTO tabel_tampung (id, prio1, prio2, prio3, prio4, prio5, f_id_user) VALUES (NULL, '$C1', '$C2', '$C3', '$C4', '$C5', '$id_user')");
    }
    public function editTampung($id,$dataTampung)
    {
        $C1 = $dataTampung[0];
        $C2 =  $dataTampung[1];
        $C3 =  $dataTampung[2];
        $C4 =  $dataTampung[3];
        $C5 =  $dataTampung[4];

        $this->db->query("UPDATE tabel_tampung SET prio1='$C1',prio2='$C2',prio3='$C3',prio4='$C4',prio5='$C5' WHERE id='$id'");
    }

}


$JenisKriteria = new JenisKriteria();

?>