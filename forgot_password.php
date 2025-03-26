<?php
session_start();
header("Content-Type: application/json");

// Database connection
$host = "fdb1030.awardspace.net";
$user = "4585350_appointment";
$password = "Migs0929*";
$database = "4585350_appointment";

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["success" => "0", "message" => "Database connection failed"]);
    exit();
}

// Handle Forgot Password Request (Send Reset Email)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {
    $email = trim($_POST["email"]);

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo json_encode(["success" => "0", "message" => "Email not found"]);
        exit();
    }

    // Generate reset token
    $reset_token = bin2hex(random_bytes(32)); 
    $expires_at = date("Y-m-d H:i:s", strtotime("+1 hour"));

    // Store reset token in database
    $stmt = $conn->prepare("UPDATE users SET reset_token=?, reset_expires=? WHERE email=?");
    $stmt->bind_param("sss", $reset_token, $expires_at, $email);
    $stmt->execute();

    // Send email (Replace with actual email sending code)
    $reset_link = "https://yourwebsite.com/password_reset.php?token=$reset_token";
    // mail($email, "Password Reset", "Click here to reset your password: $reset_link");

    echo json_encode(["success" => "1", "message" => "Password reset link sent to your email", "reset_link" => $reset_link]);
    exit();
}

// Handle Password Reset (Update New Password)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["token"], $_POST["new_password"])) {
    $token = $_POST["token"];
    $new_password = password_hash($_POST["new_password"], PASSWORD_BCRYPT);

    // Verify token
    $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_expires > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo json_encode(["success" => "0", "message" => "Invalid or expired token"]);
        exit();
    }

    // Update password
    $stmt->bind_result($userId);
    $stmt->fetch();
    $stmt = $conn->prepare("UPDATE users SET password=?, reset_token=NULL, reset_expires=NULL WHERE id=?");
    $stmt->bind_param("si", $new_password, $userId);
    $stmt->execute();

    echo json_encode(["success" => "1", "message" => "Password has been reset"]);
    exit();
}

$conn->close();
?>
