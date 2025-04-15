<?php
include '../db.php';

$city_id = $_POST['city_id'] ?? '';

if ($city_id != '') {
    $query = $conn->query("SELECT * FROM table_barangay WHERE municipality_id = '$city_id'");
    
    echo '<label>Barangay</label>';
    echo '<select name="barangay" id="barangay" required>';
    echo '<option value="">-- Select Barangay --</option>';

    while ($row = $query->fetch_assoc()) {
        echo "<option value='{$row['barangay_id']}'>{$row['barangay_name']}</option>";
    }

    echo '</select>';
}
?>
