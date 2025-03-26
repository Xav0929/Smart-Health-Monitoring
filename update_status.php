<<<<<<< HEAD
<?php
session_start();  // Make sure to check if the user is logged in here!

// Session timeout and validation as discussed earlier
$timeout_duration = 1800; // 30 minutes in seconds
if (!isset($_SESSION['user_id']) || !isset($_SESSION['fingerprint'])) {
    header("Location: index.html");
    exit();
}

if ($_SESSION['fingerprint'] !== hash('sha256', $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'])) {
    session_unset();
    session_destroy();
    header("Location: index.html");
    exit();
}

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: index.html");
    exit();
}
$host = "fdb1030.awardspace.net";
$user = "4585350_appointment";
$password = "Migs0929*";
$database = "4585350_appointment";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE appointments SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}

$conn->close();
?>
=======
<?php
session_start();  // Make sure to check if the user is logged in here!

// Session timeout and validation as discussed earlier
$timeout_duration = 1800; // 30 minutes in seconds
if (!isset($_SESSION['user_id']) || !isset($_SESSION['fingerprint'])) {
    header("Location: index.html");
    exit();
}

if ($_SESSION['fingerprint'] !== hash('sha256', $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR'])) {
    session_unset();
    session_destroy();
    header("Location: index.html");
    exit();
}

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: index.html");
    exit();
}
$host = "fdb1030.awardspace.net";
$user = "4585350_appointment";
$password = "Migs0929*";
$database = "4585350_appointment";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE appointments SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}

$conn->close();
?>
>>>>>>> aba50b88d02abc0f3148339440bdab16c59e817c
