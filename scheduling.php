<?php
header("Content-Type: application/json"); // Ensure JSON response for AJAX calls

// Database credentials
$host = "fdb1030.awardspace.net";
$user = "4585350_appointment";
$password = "Migs0929*";
$database = "4585350_appointment";

// Create database connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Handle form submission (only process if it's a POST request)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $age = $_POST['age'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';

    // Validate inputs
    if (empty($name) || empty($age) || empty($date) || empty($time)) {
        echo json_encode(["status" => "error", "message" => "All fields are required!"]);
        exit;
    }

    // Ensure age is a valid number
    if (!is_numeric($age) || $age <= 0) {
        echo json_encode(["status" => "error", "message" => "Invalid age value!"]);
        exit;
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO appointments (name, age, appointment_date, appointment_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $name, $age, $date, $time);

    // Execute query and send JSON response
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Appointment added successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add appointment."]);
    }

    $stmt->close();
    $conn->close();
    exit;
}

// If it's not a POST request, load the HTML form
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule an Appointment</title>
    <link rel="stylesheet" href="/css/Schedule.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Schedule Your Appointment</h1>
            <p>Select a date and time to schedule your appointment.</p>
        </header>

        <!-- Appointment Form -->
        <form id="appointmentForm">
            <h2>Enter Appointment Details</h2>
            
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="age">Your Age:</label>
            <input type="number" id="age" name="age" required>

            <label for="date">Appointment Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Appointment Time:</label>
            <input type="time" id="time" name="time" required>

            <div id="status"></div>
            <button type="submit">Schedule Appointment</button>
        </form>
    </div>

    <script src="js/scheduling.js"></script>
</body>
</html>
