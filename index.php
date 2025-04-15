<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Address Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div id="main-content">
    <h2>Address Form</h2>
    <form id="address-form">
        <div>
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname" required>
        </div>
        <div>
            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>

        <div>
            <label for="region">Region</label>
            <select name="region" id="region" required>
                <option value="">-- Select Region --</option>
                <?php
                $regions = $conn->query("SELECT * FROM table_region");
                while ($row = $regions->fetch_assoc()) {
                    echo "<option value='{$row['region_id']}'>{$row['region_name']}</option>";
                }
                ?>
            </select>
        </div>

        <div id="province-container"></div>
        <div id="city-container"></div>
        <div id="barangay-container"></div>

        <button type="submit">Submit</button>
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
            <div>
                <h2>Hello ${firstname} ${lastname},</h2>
                <p>You live at <strong>${barangay}, ${city}, ${province}, ${region}</strong>, Philippines.</p>
            </div>
        `;
        $('#main-content').html(message);
    });
});
</script>

</body>
</html>
