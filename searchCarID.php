<?php
if (isset($_POST['car-id'])) {
    $carId = $_POST['car-id'];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sign_in";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("فشل الاتصال: " . $conn->connect_error);
    }

    // SQL query to search for the car ID
    $sql = "SELECT * FROM car WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $carId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Car ID exists, fetch data
        $car = $result->fetch_assoc();
        header("Location: displayCarData.php?car-id=" . $car['id']);
    } else {
        echo "<script>alert('لم يتم العثور على كود السيارة'); window.location.href = 'QR.html';</script>";
    }

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('لم يتم توفير كود السيارة'); window.location.href = 'searchCarID.html';</script>";
}
?>
