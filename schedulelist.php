<?php
$host = "fdb1030.awardspace.net";
$user = "4585350_appointment";
$password = "Migs0929*";
$database = "4585350_appointment";

// ✅ Connect to database
$conn = new mysqli($host, $user, $password, $database);

// ✅ Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// ✅ Handle status update request
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'], $_POST['status'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    // ✅ Prepare update query
    $stmt = $conn->prepare("UPDATE appointments SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    exit; // Stop further execution
}

// ✅ Fetch appointments
$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment List</title>
    <link rel="stylesheet" href="css/schedulelist.css">
</head>
<body>
    <div class="container">
        <h1>Appointment List</h1>
        <table id="appointmentTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr id="row-<?= $row['id']; ?>">
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td><?= htmlspecialchars($row['age']); ?></td>
                        <td><?= htmlspecialchars($row['appointment_date']); ?></td>
                        <td><?= htmlspecialchars($row['appointment_time']); ?></td>
                        <td id="status-<?= $row['id']; ?>"><?= htmlspecialchars($row['status']); ?></td>
                        <td>
                            <?php if ($row['status'] == 'Pending'): ?>
                                <button class="btn approve-btn" onclick="updateStatus(<?= $row['id']; ?>, 'Approved')">Approve</button>
                                <button class="btn reject-btn" onclick="updateStatus(<?= $row['id']; ?>, 'Rejected')">Reject</button>
                            <?php else: ?>
                                <?= htmlspecialchars($row['status']); ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>
