<?php
include '../db.php';

$province_id = $_POST['province_id'] ?? '';

if ($province_id != '') {
    $query = $conn->query("SELECT * FROM table_municipality WHERE province_id = '$province_id'");

    echo '<label>City/Municipality</label>';
    echo '<select name="city" id="city" required>';
    echo '<option value="">-- Select City/Municipality --</option>';

    while ($row = $query->fetch_assoc()) {
        echo "<option value='{$row['municipality_id']}'>{$row['municipality_name']}</option>";
    }

    echo '</select>';
}
?>
