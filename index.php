<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Address Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

<div id="main-content" class="w-full max-w-2xl bg-white p-10 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold text-gray-800 mb-8">Address form template</h2>

    <form id="address-form" class="space-y-6">
        <!-- Name Fields -->
        <div>
            <label class="text-sm font-semibold text-gray-700 block mb-1">Name</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <input type="text" id="firstname" name="firstname" placeholder="First name" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                <input type="text" id="lastname" name="lastname" placeholder="Last name" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
            </div>
        </div>

        <!-- Region Dropdown -->
        <div>
            <label class="text-sm font-semibold text-gray-700 block mb-1">Region</label>
            <select name="region" id="region" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-md bg-white text-gray-800 focus:outline-none focus:ring-2 focus:ring-black">
                <option value="">-- Select Region --</option>
                <?php
                $regions = $conn->query("SELECT * FROM table_region");
                while ($row = $regions->fetch_assoc()) {
                    echo "<option value='{$row['region_id']}'>{$row['region_name']}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Dynamic Containers -->
        <div id="province-container" class="space-y-4"></div>
        <div id="city-container" class="space-y-4"></div>
        <div id="barangay-container" class="space-y-4"></div>

        <button type="submit"
                class="mt-4 inline-flex items-center px-6 py-3 bg-black text-white font-semibold rounded-md hover:bg-gray-800 transition">
            Submit
            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </button>
    </form>
</div>

<script>
$(document).ready(function () {
    $('#region').change(function () {
        let regionId = $(this).val();
        $('#province-container').html('');
        $('#city-container').html('');
        $('#barangay-container').html('');
        if (regionId !== '') {
            $.post('ajax/get_provinces.php', {region_id: regionId}, function (data) {
                $('#province-container').html(data);
            });
        }
    });

    $(document).on('change', '#province', function () {
        let provinceId = $(this).val();
        $('#city-container').html('');
        $('#barangay-container').html('');
        if (provinceId !== '') {
            $.post('ajax/get_municipality.php', {province_id: provinceId}, function (data) {
                $('#city-container').html(data);
            });
        }
    });

    $(document).on('change', '#city', function () {
        let cityId = $(this).val();
        $('#barangay-container').html('');
        if (cityId !== '') {
            $.post('ajax/get_barangays.php', {city_id: cityId}, function (data) {
                $('#barangay-container').html(data);
            });
        }
    });

    $('#address-form').submit(function (e) {
        e.preventDefault();

        let firstname = $('#firstname').val();
        let lastname = $('#lastname').val();
        let region = $("#region option:selected").text();
        let province = $("#province option:selected").text();
        let city = $("#city option:selected").text();
        let barangay = $("#barangay option:selected").text();

        let message = `
            <div class="bg-white p-10 rounded-lg shadow-md text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Hello ${firstname} ${lastname},</h2>
                <p class="text-gray-700 text-lg">You live at<br>
                    <strong>${barangay}, ${city}, ${province}, ${region}</strong>, Philippines.</p>
            </div>
        `;
        $('#main-content').html(message);
    });
});
</script>

</body>
</html>
