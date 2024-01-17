<?php 
session_start();
if(isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['role'] == 0) {
    header("Location: ./admin/index.php");
}
require_once './config.php';
$keyword = '';
if (isset($_POST['k'])) {
    $keyword = $_POST['k'];
    $query_budaya = $koneksi->prepare("SELECT * FROM alternatif WHERE kategori='Budaya' AND nama_alternatif LIKE ?");
    $searchKeyword = '%' . $keyword . '%';
    $query_budaya->bind_param('s', $searchKeyword);
    $query_budaya->execute();
    $tempat_kayu_budaya = $query_budaya->get_result();

    $query_buatan = $koneksi->prepare("SELECT * FROM alternatif WHERE kategori='Buatan' AND nama_alternatif LIKE ?");
    $searchKeyword = '%' . $keyword . '%';
    $query_buatan->bind_param('s', $searchKeyword);
    $query_buatan->execute();
    $tempat_kayu_buatan = $query_buatan->get_result();

    $query_alam = $koneksi->prepare("SELECT * FROM alternatif WHERE  kategori='Alam' AND nama_alternatif LIKE ?");
    $searchKeyword = '%' . $keyword . '%';
    $query_alam->bind_param('s', $searchKeyword);
    $query_alam->execute();
    $tempat_kayu_alam = $query_alam->get_result();
}
else{
    $tempat_kayu_budaya = $koneksi->query("SELECT * FROM alternatif WHERE kategori='Budaya' ORDER BY rating DESC");
    $tempat_kayu_buatan = $koneksi->query("SELECT * FROM alternatif WHERE kategori='Buatan' ORDER BY rating DESC");
    $tempat_kayu_alam = $koneksi->query("SELECT * FROM alternatif WHERE kategori='Alam' ORDER BY rating DESC");
    // $tempat_kayu = $koneksi->query("SELECT * FROM alternatif ORDER BY rating DESC");
}


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

    .content {
        display: none;
    }

    .content1 {
        display: none;
    }

    .content2 {
        display: none;
    }

    .noContent {
        color: #61677A !important;
        background-color: transparent !important;
        pointer-events: none;
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>

    <section class="">
        <!-- Section: Design Block -->
        <nav class="navbar fixed-top navbar-transparent navbar-expand-lg bg-body-tertiary">
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
                            <a class="nav-link fw-bolder active" aria-current="page" href="./home.php">Beranda</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link fw-bolder" aria-current="page" href="./tempat-kayu.php">Tempat
                                kayu</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link fw-bolder" aria-current="page" href="./rekomendasi.php">Rekomendasi</a>
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
        <!-- Jumbotron -->
        <div class="text-center text-lg-start">
            <div class="container col-lg-12" style="margin-top: 10%;">
                <div class="row gx-lg-10 text-center">
                    <div class="title">
                        <h3>SISTEM PENDUKUNG KEPUTUSAN REKOMENDASI TEMPAT kayu</h3>
                        <h3>DI KABUPATEN TIMOR TENGAH SELATAN</h3>
                    </div>
                </div>
                <div class="search-box d-flex justify-content-center mt-5 col-lg-12">
                    <form class="col-lg-6 d-flex" role="search" action="" method="post">
                        <input name="k" class="form-control bg-light ps-5 py-2" style="border-radius: 3em;"
                            type="search" value="<?=$keyword;?>" placeholder="Cari kayu" aria-label="Search">
                        <button style="position: absolute; border-top-left-radius: 3em; border-bottom-left-radius: 3em;"
                            class="btn py-2 border border-0" type="submit"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
                <!-- Jumbotron -->
                <div class="text-center text-lg-start">
                    <div class="container col-lg-8" style="margin-top: 10%;">
                        <?php if(mysqli_num_rows($tempat_kayu_alam) > 0):?>
                        <h5 class="" style="margin-top:100px;">Daftar kayu Alam</h5>
                        <div class="row list-kayu d-flex justify-content-center mt-2 col-lg-12 col-md-12">
                            <?php foreach ($tempat_kayu_alam as $key => $kayu):?>
                            <div class="col-lg-4 mt-1 content2">
                                <div class="card shadow-sm">
                                    <img style="height: 200px;"
                                        src="<?= $kayu['gambar'] == '-'? './assets/images/no-img.png':"./user_area/gambar/".$kayu['gambar'];?>"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?=$kayu['nama_alternatif'];?></h5>
                                        <?php for($i = 0; $i < $kayu['rating'];$i++): ?>
                                        <span class="card-text text-warning"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-star-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg></span>
                                        <?php endfor;?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <?php if(mysqli_num_rows($tempat_kayu_alam) > 6):?>
                        <div class="button d-flex justify-content-center mt-3">
                            <a class="btn btn-outline-secondary" id="loadMore2">Load More</a>
                        </div>
                        <?php endif;?>
                        <?php endif;?>
                        <?php if(mysqli_num_rows($tempat_kayu_budaya) > 0):?>
                        <h5 class="" style="margin-top:100px;">Daftar kayu Budaya</h5>
                        <div class="row list-kayu d-flex justify-content-center mt-2 col-lg-12 col-md-12">
                            <?php foreach ($tempat_kayu_budaya as $key => $kayu):?>
                            <div class="col-lg-4 mt-1 content">
                                <div class="card shadow-sm">
                                    <img style="height: 200px;"
                                        src="<?= $kayu['gambar'] == '-'? './assets/images/no-img.png':"./user_area/gambar/".$kayu['gambar'];?>"
                                        class="
                                card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?=$kayu['nama_alternatif'];?></h5>
                                        <?php for($i = 0; $i < $kayu['rating'];$i++): ?>
                                        <span class="card-text text-warning"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-star-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg></span>
                                        <?php endfor;?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <?php endif;?>
                        <?php if(mysqli_num_rows($tempat_kayu_budaya) > 6):?>
                        <div class="button d-flex justify-content-center mt-3">
                            <a class="btn btn-outline-secondary" id="loadMore">Load More</a>
                        </div>
                        <?php endif;?>
                        <?php if(mysqli_num_rows($tempat_kayu_buatan) > 0):?>
                        <h5 class="" style="margin-top:100px;">Daftar kayu Buatan</h5>
                        <div class="row list-kayu d-flex justify-content-center mt-2 col-lg-12 col-md-12">
                            <?php foreach ($tempat_kayu_buatan as $key => $kayu):?>
                            <div class="col-lg-4 mt-1 content1">
                                <div class="card shadow-sm">
                                    <img style="height: 200px;"
                                        src="<?= $kayu['gambar'] == '-'? './assets/images/no-img.png':"./user_area/gambar/".$kayu['gambar'];?>"
                                        class="
                                card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?=$kayu['nama_alternatif'];?></h5>
                                        <?php for($i = 0; $i < $kayu['rating'];$i++): ?>
                                        <span class="card-text text-warning"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-star-fill"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                            </svg></span>
                                        <?php endfor;?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <?php if(mysqli_num_rows($tempat_kayu_buatan) > 6):?>
                        <div class="button d-flex justify-content-center mt-3">
                            <a class="btn btn-outline-secondary" id="loadMore1">Load More</a>
                        </div>
                        <?php endif;?>
                        <?php endif;?>
                    </div>
                </div>
                <!-- Jumbotron -->
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->
    <footer class="bg-white mt-5 text-center text-lg-start">
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
    <script>
    // load more button
    $(document).ready(function() {
        $(".content").slice(0, 6).show();
        $("#loadMore").on("click", function(e) {
            e.preventDefault();
            $(".content:hidden").slice(0, 6).slideDown();
            if ($(".content:hidden").length == 0) {
                $("#loadMore").text("No Content").addClass("noContent");
            }
        })
        $(".content1").slice(0, 6).show();
        $("#loadMore1").on("click", function(e) {
            e.preventDefault();
            $(".content1:hidden").slice(0, 6).slideDown();
            if ($(".content1:hidden").length == 0) {
                $("#loadMore1").text("No Content").addClass("noContent");
            }
        })
        $(".content2").slice(0, 6).show();
        $("#loadMore2").on("click", function(e) {
            e.preventDefault();
            $(".content2:hidden").slice(0, 6).slideDown();
            if ($(".content2:hidden").length == 0) {
                $("#loadMore2").text("No Content").addClass("noContent");
            }
        })
    });
    </script>
</body>

</html>