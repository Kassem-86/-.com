<?php
// Database connection
$con = mysqli_connect("localhost", "root", "", "sign_in");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$car_type = $_POST['car_type'];
$car_number = $_POST['car_number'];
$car_model = $_POST['car_model'];
$serial_number = $_POST['serial_number'];
$car_date = $_POST['car_Date'];
$oil = $_POST['oil'];
$battery = $_POST['battery'];
$covers = $_POST['Covers'];
$maintenance_date = $_POST['maintenance_date'];
$maintenance_details = $_POST['maintenance_details'];
$previous_maintenance_date = $_POST['previous_maintenance_date'];
$previous_maintenance_details = $_POST['previous_maintenance_details'];

// Validate if serial number and car number are numeric
if (is_numeric($serial_number) && is_numeric($car_number)) {
    // Check if car number already exists
    $check_car_number_query = "SELECT * FROM car WHERE car_number = '$car_number'";
    $car_number_result = mysqli_query($con, $check_car_number_query);
    
    // Check if serial number already exists
    $check_serial_number_query = "SELECT * FROM car WHERE serial_number = '$serial_number'";
    $serial_number_result = mysqli_query($con, $check_serial_number_query);

    if (mysqli_num_rows($car_number_result) > 0 || mysqli_num_rows($serial_number_result) > 0) {
        echo '<script>alert("Car Number or Serial Number already exists .")</script>';
        require 'test2.html';
    } else {
        // Insert data into the database
        $sql = "INSERT INTO car (car_type, car_number, car_model, serial_number, car_Date, Oil, Battery, Covers, maintenance_date, maintenance_details, previous_maintenance_date, previous_maintenance_details) VALUES ('$car_type', '$car_number', '$car_model', '$serial_number', '$car_date', '$oil', '$battery', '$covers', '$maintenance_date', '$maintenance_details', '$previous_maintenance_date', '$previous_maintenance_details')";

        if (mysqli_query($con, $sql)) {
            echo '<script>alert("New record created successfully")</script>';
            require 'option.html';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
} else {
    echo '<script>alert("Serial Number and Car Number must be numeric.");</script>';
    require  'test2.html';
}

mysqli_close($con);
?>
