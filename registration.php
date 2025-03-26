<?php
// Secure Headers
header("Content-Type: application/json; charset=UTF-8");
header("X-Frame-Options: DENY"); // Prevent Clickjacking
header("X-Content-Type-Options: nosniff"); // Prevent MIME sniffing
header("Referrer-Policy: no-referrer"); // No referrer data exposed

// Database Connection
$host = "fdb1030.awardspace.net";
$user = "4585350_appointment";
$password = "Migs0929*";
$database = "4585350_appointment";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    echo json_encode(["success" => "0", "message" => "Database connection failed"]);
    exit();
}

// Handle POST Request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize inputs
    $fullname = trim(htmlspecialchars($_POST['fullname'], ENT_QUOTES, 'UTF-8'));
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($fullname) || empty($email) || empty($password)) {
        echo json_encode(["success" => "0", "message" => "All fields are required"]);
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => "0", "message" => "Invalid email format"]);
        exit();
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $fullname)) {
        echo json_encode(["success" => "0", "message" => "Full name should only contain letters and spaces"]);
        exit();
    }

    if (strlen($password) < 8) {
        echo json_encode(["success" => "0", "message" => "Password must be at least 8 characters long"]);
        exit();
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["success" => "0", "message" => "Email already exists"]);
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();

    // Hash password securely
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert new user (with Pending status for admin role assignment)
    $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, 'Pending')");
    $stmt->bind_param("sss", $fullname, $email, $hashed_password);

    if ($stmt->execute()) {
        echo json_encode(["success" => "1", "message" => "Registration successful, awaiting admin role assignment"]);
    } else {
        echo json_encode(["success" => "0", "message" => "Registration failed"]);
    }

    $stmt->close();
}

$conn->close();
exit();
?>
