<?php
session_start();
unset($_SESSION['menu']);
$_SESSION['menu'] = 'beranda-admin';
require_once './header.php';



?>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-10 mt-5 mb-lg-5">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8 gx-lg-10 text-center">
                    <div class="title">
                        <h3>SISTEM PENDUKUNG KEPUTUSAN PEMILIHAN KAYU</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mt-lg-5 mb-lg-5">
            <div class="card mb-5">
                <div class="card-body">
                    <div id="">
                        <ol>
                            <li><b>(Menurut Ralph C. Davis)</b>
                                Keputusan merupakan hasil penyelesaian yang tegas terhadap permasalahan yang dihadapi.
                                Keputusan
                                adalah jawaban yang jelas atas sebuah pertanyaan. Keputusan harus menjawab pertanyaan
                                tentang
                                apa yang dibicarakan dalam kaitannya dengan perencanaan. Keputusan juga dapat berupa
                                pelaksanaan
                                tindakan yang berbeda secara signifikan dari rencana semula (Hasan, 2004).
                            </li>
                            <br>
                            <li><b>(Menurut Mary Follett)</b>
                                Keputusan tersebut merupakan suatu atau sebagai hukum situasi. Berbeda dengan menaati
                                suatu perintah jika semua fakta tersedia dan semua yang terlibat, baik pengawas maupun
                                penegak hukum, mau mematuhi undang-undang atau ketentuannya. Kewenangan tetap perlu
                                dijalankan, namun kewenangan adalah situasi (Hasan, 2004).
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>

<?php
require_once './footer.php';
?>