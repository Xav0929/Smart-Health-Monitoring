<<<<<<< HEAD
<?php
// Database Connection
$host = "fdb1030.awardspace.net";
$user = "4585350_appointment";
$password = "Migs0929*";
$database = "4585350_appointment";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Role Assignment
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['role'])) {
    $id = intval($_POST['id']);
    $newRole = $conn->real_escape_string($_POST['role']);

    // Check current role before updating
    $checkRoleQuery = "SELECT role FROM users WHERE id = $id";
    $result = $conn->query($checkRoleQuery);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["role"] !== "Pending") {
            echo json_encode(["success" => false, "message" => "Role cannot be changed once assigned."]);
            exit;
        }
    }

    // Update the role
    $sql = "UPDATE users SET role = '$newRole' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Role assigned successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => $conn->error]);
    }
    $conn->close();
    exit;
}

// Fetch Users from Database
$sql = "SELECT * FROM users WHERE role IN ('Pending', 'User', 'Admin')";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Assign Roles</title>
    <link rel="stylesheet" href="css/usermanagement.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <script src="js/usermanagement.js"></script> <!-- JavaScript File -->
</head>
<body>

<div class="container">
    <h2>Assign Roles</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Assign</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["fullname"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["role"] . "</td>";
                    echo "<td>";

                    // Only allow role assignment if user is "Pending"
                    if ($row["role"] === "Pending") {
                        echo "<button class='admin-btn' data-user='" . $row["id"] . "' onclick='assignRole(" . $row["id"] . ", \"Admin\")'>Make Admin</button>";
                        echo "<button class='user-btn' data-user='" . $row["id"] . "' onclick='assignRole(" . $row["id"] . ", \"User\")'>Make User</button>";
                    } else {
                        echo "<span>Assigned: " . $row["role"] . "</span>"; // Show assigned role
                    }

                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No users found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
=======
<?php
// Database Connection
$host = "fdb1030.awardspace.net";
$user = "4585350_appointment";
$password = "Migs0929*";
$database = "4585350_appointment";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Role Assignment
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['role'])) {
    $id = intval($_POST['id']);
    $newRole = $conn->real_escape_string($_POST['role']);

    // Check current role before updating
    $checkRoleQuery = "SELECT role FROM users WHERE id = $id";
    $result = $conn->query($checkRoleQuery);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row["role"] !== "Pending") {
            echo json_encode(["success" => false, "message" => "Role cannot be changed once assigned."]);
            exit;
        }
    }

    // Update the role
    $sql = "UPDATE users SET role = '$newRole' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Role assigned successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => $conn->error]);
    }
    $conn->close();
    exit;
}

// Fetch Users from Database
$sql = "SELECT * FROM users WHERE role IN ('Pending', 'User', 'Admin')";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Assign Roles</title>
    <link rel="stylesheet" href="css/usermanagement.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery -->
    <script src="js/usermanagement.js"></script> <!-- JavaScript File -->
</head>
<body>

<div class="container">
    <h2>Assign Roles</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Assign</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["fullname"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["role"] . "</td>";
                    echo "<td>";

                    // Only allow role assignment if user is "Pending"
                    if ($row["role"] === "Pending") {
                        echo "<button class='admin-btn' data-user='" . $row["id"] . "' onclick='assignRole(" . $row["id"] . ", \"Admin\")'>Make Admin</button>";
                        echo "<button class='user-btn' data-user='" . $row["id"] . "' onclick='assignRole(" . $row["id"] . ", \"User\")'>Make User</button>";
                    } else {
                        echo "<span>Assigned: " . $row["role"] . "</span>"; // Show assigned role
                    }

                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No users found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
>>>>>>> aba50b88d02abc0f3148339440bdab16c59e817c
