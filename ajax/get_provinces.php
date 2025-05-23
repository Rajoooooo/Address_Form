<?php
include '../db.php';

$region_id = $_POST['region_id'] ?? '';

if ($region_id != '') {
    $query = $conn->query("SELECT * FROM table_province WHERE region_id = '$region_id'");

    echo '<label class="text-sm font-semibold text-gray-700 block mb-1">Province</label>';
    echo '<select name="province" id="province" required
            class="w-full px-4 py-3 border border-gray-300 rounded-md bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-black mt-1 mb-4">';
    echo '<option value="">-- Select Province --</option>';

    while ($row = $query->fetch_assoc()) {
        echo "<option value='{$row['province_id']}'>{$row['province_name']}</option>";
    }

    echo '</select>';
}
?>
