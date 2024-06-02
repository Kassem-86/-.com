<?php
if (isset($_GET['car-id'])) {
    $carId = $_GET['car-id'];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sign_in";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch car data by ID
    $sql = "SELECT * FROM car WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $carId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Car data exists, fetch data
        $car = $result->fetch_assoc();
    } else {
        echo "<script>alert('Car ID not found'); window.location.href = 'searchCarID.html';</script>";
        exit;
    }

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Car ID not provided'); window.location.href = 'searchCarID.html';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 300px;
        }
        .form h1, .form h3 {
            margin-top: 0;
        }
        .form input, .form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            border: none;
            background-color: #f4f4f4;
        }
        .form input:read-only, .form textarea:read-only {
            background-color: #e9e9e9;
        }
        .form textarea {
            height: 100px;
            resize: vertical;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form">
            <h1>Car Information</h1>
            <h3>Car Type</h3>
            <input type="text" value="<?php echo $car['car_type']; ?>" readonly>
            <h3>Car Number</h3>
            <input type="text" value="<?php echo $car['car_number']; ?>" readonly>
            <h3>Car Model</h3>
            <input type="text" value="<?php echo $car['car_model']; ?>" readonly>
            <h3>Serial Number</h3>
            <input type="text" value="<?php echo $car['serial_number']; ?>" readonly>
            <h3>Car Date</h3>
            <input type="date" value="<?php echo $car['car_Date']; ?>" readonly>
            <h3>Oil</h3>
            <input type="text" value="<?php echo $car['Oil']; ?>" readonly>
            <h3>Battery</h3>
            <input type="text" value="<?php echo $car['Battery']; ?>" readonly>
            <h3>Covers</h3>
            <input type="text" value="<?php echo $car['Covers']; ?>" readonly>

            <h1>Next Maintenance</h1>
            <h3>Maintenance Date</h3>
            <input type="date" value="<?php echo $car['maintenance_date']; ?>" readonly>
            <h3>Maintenance Details</h3>
            <textarea readonly><?php echo $car['maintenance_details']; ?></textarea>

            <h1>Previous Maintenance</h1>
            <h3>Maintenance Date</h3>
            <input type="date" value="<?php echo $car['previous_maintenance_date']; ?>" readonly>
            <h3>Maintenance Details</h3>
            <textarea readonly><?php echo $car['previous_maintenance_details']; ?></textarea>
        </div>
    </div>
</body>
</html>
