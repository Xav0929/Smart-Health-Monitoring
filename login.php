<<<<<<< HEAD
<?php
session_start();
header("Content-Type: application/json");

// Database connection
$host = "	smarthealt.south.it.com";
$user = "smarthealt_appointment";
$password = "frqu.tonzo.au";
$database = "smarthealt_appointment";

// Create a connection to the database
$conn = new mysqli($host, $user, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    echo json_encode(["success" => "0", "message" => "Database connection failed"]);
    exit();
}

// Handle POST Request (Login)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        echo json_encode(["success" => "0", "message" => "Email and password are required"]);
        exit();
    }

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
    if ($stmt === false) {
        echo json_encode(["success" => "0", "message" => "Error preparing query"]);
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId, $hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            if (strtolower($role) == 'pending') {  // Make sure "Pending" is properly checked
                echo json_encode(["success" => "0", "message" => "Your account is pending role assignment. Please wait for an admin to approve your role."]);
                exit();
            }

            $_SESSION['user_id'] = $userId;
            $_SESSION['role'] = $role;

            $redirect_url = ($role == 'Admin') ? 'admin.php' : 'user.php';
            echo json_encode(["success" => "1", "redirect_url" => $redirect_url]);
            exit();
        } else {
            echo json_encode(["success" => "0", "message" => "Incorrect password!"]);
            exit();
        }
    } else {
        echo json_encode(["success" => "0", "message" => "User not found! Please register first."]);
        exit();
    }

    $stmt->close();
}

$conn->close();
exit();
=======
<?php
session_start();
header("Content-Type: application/json");

// Database connection
$host = "fdb1030.awardspace.net";
$user = "4585350_appointment";
$password = "Migs0929*";
$database = "4585350_appointment";

// Create a connection to the database
$conn = new mysqli($host, $user, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    echo json_encode(["success" => "0", "message" => "Database connection failed"]);
    exit();
}

// Handle POST Request (Login)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        echo json_encode(["success" => "0", "message" => "Email and password are required"]);
        exit();
    }

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
    if ($stmt === false) {
        echo json_encode(["success" => "0", "message" => "Error preparing query"]);
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId, $hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            if (strtolower($role) == 'pending') {  // Make sure "Pending" is properly checked
                echo json_encode(["success" => "0", "message" => "Your account is pending role assignment. Please wait for an admin to approve your role."]);
                exit();
            }

            $_SESSION['user_id'] = $userId;
            $_SESSION['role'] = $role;

            $redirect_url = ($role == 'Admin') ? 'admin.php' : 'user.php';
            echo json_encode(["success" => "1", "redirect_url" => $redirect_url]);
            exit();
        } else {
            echo json_encode(["success" => "0", "message" => "Incorrect password!"]);
            exit();
        }
    } else {
        echo json_encode(["success" => "0", "message" => "User not found! Please register first."]);
        exit();
    }

    $stmt->close();
}

$conn->close();
exit();
>>>>>>> aba50b88d02abc0f3148339440bdab16c59e817c
