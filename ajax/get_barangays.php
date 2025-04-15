<?php
include '../db.php';

$city_id = $_POST['city_id'] ?? '';

if ($city_id != '') {
    $query = $conn->query("SELECT * FROM table_barangay WHERE municipality_id = '$city_id'");
    
    echo '<label class="text-sm font-semibold text-gray-700 block mb-1">Barangay</label>';
    echo '<select name="barangay" id="barangay" required
            class="w-full px-4 py-3 border border-gray-300 rounded-md bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-black mt-1 mb-4">';
    echo '<option value="">-- Select Barangay --</option>';

    while ($row = $query->fetch_assoc()) {
        echo "<option value='{$row['barangay_id']}'>{$row['barangay_name']}</option>";
    }

    echo '</select>';
}
?>
