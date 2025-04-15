<?php
include '../db.php';

$region_id = $_POST['region_id'] ?? '';

if ($region_id != '') {
    $query = $conn->query("SELECT * FROM table_province WHERE region_id = '$region_id'");

    echo '<label>Province</label>';
    echo '<select name="province" id="province" required>';
    echo '<option value="">-- Select Province --</option>';

    while ($row = $query->fetch_assoc()) {
        echo "<option value='{$row['province_id']}'>{$row['province_name']}</option>";
    }

    echo '</select>';
}
?>
