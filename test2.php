<?php
 
 if(isset($_POST['vol'])){
 
 $vol = $_POST['vol'];

	echo $vol;
}
?>

<!DOCTYPE html>
<html>

<body>

    <h1>Display a Range Field</h1>

    <form action="" method="post">
        <label for="vol">Volume (between 0 and 100):</label>
        <input type="range" value="0" id="vol" name="vol" min="0" max="100" oninput="updateWeight(this.value)">
        <span id="weightDisplay">Bobot: 0</span>
        <input type="submit">
    </form>

    <script>
    function updateWeight(value) {
        document.getElementById('weightDisplay').textContent = 'Bobot: ' + value;
    }
    </script>

</body>

</html>