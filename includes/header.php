<?php 
require_once '../config.php';
global $conn;

if(!isset($_SESSION['login']) && $_SESSION['login'] != true){
    header("Location: ../index.php");
}
else if($_SESSION['level'] != 1){
    header("Location: ../404.php");
    exit;
}

$id_user = $_SESSION['id_user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SPK Pemilihan kayu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Prompt&family=Righteous&family=Roboto:wght@500&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="../assets/DataTables/datatables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    #mapid,
    .teks {
        height: 70vh;
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg sticky-top shadow-lg fixed-top" style="background-color: #0B666A"
        data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <h3 style="font-family: 'Righteous', cursive">SPK kayu</h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup" style="font-family: 'Manrope', sans-serif">
                <div class="navbar-nav ms-auto me-auto mt-3 mb-3">
                    <a class="nav-link <?=$_SESSION['menu'] == 'beranda-user' ? 'active':'';?>"
                        href="index.php">Beranda</a>
                    <a class="nav-link <?=$_SESSION['menu'] == 'kriteria' ? 'active':'';?>"
                        href="kriteria_v1.php">Kriteria</a>
                    <!-- <a class="nav-link <?=$_SESSION['menu'] == 'jenis-kriteria' ? 'active':'';?>"
                        href="jenis_kriteria.php">Jenis Kriteria</a> -->
                    <a class="nav-link <?=$_SESSION['menu'] == 'penilaian' ? 'active':'';?>"
                        href="tempat_kayu.php">Tempat
                        kayu</a>
                    <a class="nav-link <?=$_SESSION['menu'] == 'hasil' ? 'active':'';?>" href="hasil.php">Hasil</a>
                    <a class="nav-link" href="../auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>