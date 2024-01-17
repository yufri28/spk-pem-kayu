<?php
// Assuming you have the database connection already established and stored in the $koneksi variable.
require_once './config.php';
if (isset($_POST['keyword'])) {
    // Handle AJAX search request
    $keyword = $_POST['keyword'];

    // Perform the database query using the given keyword
    $query = $koneksi->prepare("SELECT * FROM alternatif WHERE nama_alternatif LIKE ?");
    $searchKeyword = '%' . $keyword . '%';
    $query->bind_param('s', $searchKeyword);
    $query->execute();

    // Get the result
    $result = $query->get_result();

    // Build the HTML for displaying the search results
    $output = '';
    while ($row = $result->fetch_assoc()) {
        // Customize this part according to your needs
        $output .= '
            <div class="col-lg-4 mt-1 content">
                <div class="card">
                    <img src="' . ($row['gambar'] == '-' ? './assets/images/no-img.png' : $row['gambar']) . '"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">' . $row['nama_alternatif'] . '</h5>';

        for ($i = 0; $i < $row['rating']; $i++) {
            $output .= '<span class="card-text text-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg></span>';
        }

        $output .= '
                    </div>
                </div>
            </div>';
    }

    // Close the database connection and output the result
    $query->close();

    echo $output;
} else {
    // Handle initial page load without search keyword
    $tempat_kayu = $koneksi->query("SELECT * FROM alternatif ORDER BY rating DESC");
?>

<!-- Display the initial list of places -->
<div class="row list-kayu d-flex justify-content-center mt-2 col-lg-12 col-md-12">
    <?php foreach ($tempat_kayu as $key => $kayu) : ?>
    <div class="col-lg-4 mt-1 content">
        <div class="card">
            <img src="<?= $kayu['gambar'] == '-' ? './assets/images/no-img.png' : $kayu['gambar']; ?>"
                class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $kayu['nama_alternatif']; ?></h5>
                <?php for ($i = 0; $i < $kayu['rating']; $i++) : ?>
                <span class="card-text text-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path
                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                    </svg></span>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<div class="button d-flex justify-content-center mt-3">
    <a class="btn btn-outline-secondary" id="loadMore">Load More</a>
</div>

<?php } ?>