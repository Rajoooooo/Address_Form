<?php
include '../db.php';

$province_id = $_POST['province_id'] ?? '';

if ($province_id != '') {
    $query = $conn->query("SELECT * FROM table_municipality WHERE province_id = '$province_id'");

    echo '<label class="text-sm font-semibold text-gray-700 block mb-1">City/Municipality</label>';
    echo '<select name="city" id="city" required
            class="w-full px-4 py-3 border border-gray-300 rounded-md bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-black mt-1 mb-4">';
    echo '<option value="">-- Select City/Municipality --</option>';

    while ($row = $query->fetch_assoc()) {
        echo "<option value='{$row['municipality_id']}'>{$row['municipality_name']}</option>";
    }

    echo '</select>';
}
?>
