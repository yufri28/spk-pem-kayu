<?php 

function autoloader($class_name) {
    // Ubah namespace separator menjadi direktori separator (backslash menjadi garis miring)
    $class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);

    // Tentukan direktori utama di mana file-file kelas berada
    $class_directory = __DIR__ . '/Models/';

    // Buat path lengkap ke file kelas
    $class_file = $class_directory . $class_name . '.php';

    // Periksa apakah file kelas ada, dan jika iya, sertakan file tersebut
    if (file_exists($class_file)) {
        require $class_file;
    }
}
spl_autoload_register('autoloader');


?>