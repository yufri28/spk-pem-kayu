<?php 
    // session_start();
    require_once '../config.php';
    class Hasil{

        private $db;

        public function __construct()
        {
            $this->db = connectDatabase();
        }

        public function getDataNormalisasi($c1=0,$c2=0,$c3=0,$c4=0)
        {
            $c_3 = 'Cost';
            $c_4 = 'Cost';
            return $this->db->query("SELECT a.nama_alternatif, a.id_alternatif, a.umur, a.harga, a.gambar, a.nama_mebel, a.latitude, a.longitude,
                MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END) AS C1,
                MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END) AS C2,
                MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END) AS C3,
                MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END) AS C4,
                MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.nama_sub_kriteria END) AS nama_C1,
                MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.nama_sub_kriteria END) AS nama_C2
                
                FROM alternatif a
                JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
                JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
                JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria
                GROUP BY a.nama_alternatif, a.id_alternatif ORDER BY a.id_alternatif ASC;");

            // return $this->db->query("SELECT a.nama_alternatif, a.id_alternatif, a.umur, a.harga, a.gambar,
            //     MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END) AS C1,
            //     MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END) AS C2,
            //     MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END) AS C3,
            //     MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END) AS C4,
                
            //     (MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C1' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
            //     JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            //     JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            //     JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) * ($c1)) AS norm_C1,
                
            //     (MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C2' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
            //     JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            //     JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            //     JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) * ($c2)) AS norm_C2,
                
            //     (MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END, 2))) 
            //     FROM alternatif a
            //     JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            //     JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            //     JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) * ($c3)) AS norm_C3,
                
            //     (MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)/(SELECT SQRT(SUM(POW(CASE WHEN k.id_kriteria = 'C4' THEN 	  	  sk.bobot_sub_kriteria END, 2))) FROM alternatif a
            //     JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            //     JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            //     JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) * ($c4)) AS norm_C4
                
            //     FROM alternatif a
            //     JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            //     JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            //     JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria
            //     GROUP BY a.nama_alternatif, a.id_alternatif ORDER BY a.id_alternatif ASC;");
            
        }    
        
        public function getDataPreferensiLimOne($c1=0,$c2=0,$c3=0,$c4=0,$c5=0,$c6=0,$c7=0,$c8=0)
        {
            return $this->db->query("SELECT a.nama_alternatif, a.id_alternatif, a.gambar, a.f_id_kategori, ka.nama_kategori, a.nama_mebel, a.latitude, a.longitude,
            MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.nama_sub_kriteria END) AS nama_C1,
            MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.nama_sub_kriteria END) AS nama_C2,
            MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.nama_sub_kriteria END) AS nama_C3,
            MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.nama_sub_kriteria END) AS nama_C4,
            MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.nama_sub_kriteria END) AS nama_C5,
            MAX(CASE WHEN k.id_kriteria = 'C6' THEN sk.nama_sub_kriteria END) AS nama_C6,
            MAX(CASE WHEN k.id_kriteria = 'C7' THEN sk.nama_sub_kriteria END) AS nama_C7,
            MAX(CASE WHEN k.id_kriteria = 'C8' THEN sk.nama_sub_kriteria END) AS nama_C8,
            
                     
            
            (MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C1,
            
            (MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C2,
            
            (MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C3,
            
            (MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C4,
            
            (MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C5,

            (MAX(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C6,

            (MAX(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C7,

            (MAX(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria)) AS utilitas_C8,
            
            (($c1/($c1+$c2+$c3+$c4+$c5+$c6+$c7+$c8)) * (MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C1' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) + 
            (($c2/($c1+$c2+$c3+$c4+$c5+$c6+$c7+$c8)) * (MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C2' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) +
            (($c3/($c1+$c2+$c3+$c4+$c5+$c6+$c7+$c8)) * (MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C3' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) +
            (($c4/($c1+$c2+$c3+$c4+$c5+$c6+$c7+$c8)) * (MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C4' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) + 
            (($c5/($c1+$c2+$c3+$c4+$c5+$c6+$c7+$c8)) * (MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C5' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) + 
            (($c6/($c1+$c2+$c3+$c4+$c5+$c6+$c7+$c8)) * (MAX(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C6' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) + 
            (($c7/($c1+$c2+$c3+$c4+$c5+$c6+$c7+$c8)) * (MAX(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C7' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) + 
            (($c8/($c1+$c2+$c3+$c4+$c5+$c6+$c7+$c8)) * (MAX(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))/((SELECT MAX(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria) - (SELECT MIN(CASE WHEN k.id_kriteria = 'C8' THEN sk.bobot_sub_kriteria END)
            FROM alternatif a
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria))) AS preferensi
            FROM alternatif a
            JOIN kategori_alt ka ON ka.id_kategori=a.f_id_kategori
            JOIN kecocokan_alt_kriteria kak ON a.id_alternatif = kak.f_id_alternatif
            JOIN sub_kriteria sk ON kak.f_id_sub_kriteria = sk.id_sub_kriteria
            JOIN kriteria k ON kak.f_id_kriteria = k.id_kriteria
            GROUP BY a.nama_alternatif ORDER BY preferensi DESC LIMIT 1;")->fetch_assoc();
        }     
    }

    $getDataHasil = new Hasil();
?>