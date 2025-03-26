<<<<<<< HEAD
<?php
$host = "fdb1030.awardspace.net";
$user = "4585350_appointment";
$password = "Migs0929*";
$database = "4585350_appointment";

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Debugging - Log incoming POST data
error_log("POST DATA: " . print_r($_POST, true));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === "update") {
        // Handle update request
        if (!isset($_POST['patientId'], $_POST['patientName'], $_POST['patientAge'], $_POST['lastVisit'], $_POST['healthStatus'])) {
            die("Error: Missing form fields.");
        }

        $id = (int) $_POST['patientId'];
        $name = trim($_POST['patientName']);
        $age = (int) $_POST['patientAge'];
        $lastVisit = trim($_POST['lastVisit']);
        $healthStatus = trim($_POST['healthStatus']);

        if (empty($name) || empty($age) || empty($lastVisit) || empty($healthStatus)) {
            die("Error: Please fill in all fields.");
        }

        $sql = "UPDATE patients SET name=?, age=?, last_visit=?, health_status=? WHERE patient_id=?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing query: " . $conn->error);
        }

        $stmt->bind_param("sissi", $name, $age, $lastVisit, $healthStatus, $id);

        if ($stmt->execute()) {
            echo "success";
        } else {
            die("Error executing query: " . $stmt->error);
        }
        exit();
    } else {
        // Handle new patient addition
        if (!isset($_POST['patientName'], $_POST['patientAge'], $_POST['lastVisit'], $_POST['healthStatus'])) {
            die("Error: Missing form fields.");
        }

        $name = trim($_POST['patientName']);
        $age = (int) $_POST['patientAge'];
        $lastVisit = trim($_POST['lastVisit']);
        $healthStatus = trim($_POST['healthStatus']);

        if (empty($name) || empty($age) || empty($lastVisit) || empty($healthStatus)) {
            die("Error: Please fill in all fields.");
        }

        $sql = "INSERT INTO patients (name, age, last_visit, health_status) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing query: " . $conn->error);
        }

        $stmt->bind_param("siss", $name, $age, $lastVisit, $healthStatus);

        if ($stmt->execute()) {
            echo "success";
        } else {
            die("Error executing query: " . $stmt->error);
        }
        exit();
    }
}

// Fetch and display patient records
$sql = "SELECT * FROM patients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Health Monitoring - BHW</title>
    <link rel="stylesheet" href="/css/records.css">
    <script src="records.js" defer></script>
</head>
<body>

    <section class="content-area">
        <h1>Manage Patient Records</h1>
        <button class="btn-primary" onclick="togglePatientForm()">Add New Patient</button>

        <div class="form-container" id="patientForm" style="display:none;">
            <h3>Add New Patient</h3>
            <form id="patientFormElement">
                <input type="text" id="patientName" placeholder="Enter Patient Name" required>
                <input type="number" id="patientAge" placeholder="Enter Age" required>
                <input type="date" id="lastVisit" required>
                <input type="text" id="healthStatus" placeholder="Enter Health Status" required>
                <button class="btn-primary" type="button" onclick="addNewPatient()">Submit</button>
            </form>
        </div>

        <table class="patients-table">
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Last Visit</th>
                    <th>Health Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="patientsTableBody">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row["patient_id"]) ?></td>
                        <td class="editable"><?= htmlspecialchars($row["name"]) ?></td>
                        <td class="editable"><?= htmlspecialchars($row["age"]) ?></td>
                        <td class="editable"><?= htmlspecialchars($row["last_visit"]) ?></td>
                        <td class="editable"><?= htmlspecialchars($row["health_status"]) ?></td>
                        <td><button onclick="editRecord(this)">Edit</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>

</body>
</html>

<?php $conn->close(); ?>
=======
<?php
$host = "fdb1030.awardspace.net";
$user = "4585350_appointment";
$password = "Migs0929*";
$database = "4585350_appointment";

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Debugging - Log incoming POST data
error_log("POST DATA: " . print_r($_POST, true));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === "update") {
        // Handle update request
        if (!isset($_POST['patientId'], $_POST['patientName'], $_POST['patientAge'], $_POST['lastVisit'], $_POST['healthStatus'])) {
            die("Error: Missing form fields.");
        }

        $id = (int) $_POST['patientId'];
        $name = trim($_POST['patientName']);
        $age = (int) $_POST['patientAge'];
        $lastVisit = trim($_POST['lastVisit']);
        $healthStatus = trim($_POST['healthStatus']);

        if (empty($name) || empty($age) || empty($lastVisit) || empty($healthStatus)) {
            die("Error: Please fill in all fields.");
        }

        $sql = "UPDATE patients SET name=?, age=?, last_visit=?, health_status=? WHERE patient_id=?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing query: " . $conn->error);
        }

        $stmt->bind_param("sissi", $name, $age, $lastVisit, $healthStatus, $id);

        if ($stmt->execute()) {
            echo "success";
        } else {
            die("Error executing query: " . $stmt->error);
        }
        exit();
    } else {
        // Handle new patient addition
        if (!isset($_POST['patientName'], $_POST['patientAge'], $_POST['lastVisit'], $_POST['healthStatus'])) {
            die("Error: Missing form fields.");
        }

        $name = trim($_POST['patientName']);
        $age = (int) $_POST['patientAge'];
        $lastVisit = trim($_POST['lastVisit']);
        $healthStatus = trim($_POST['healthStatus']);

        if (empty($name) || empty($age) || empty($lastVisit) || empty($healthStatus)) {
            die("Error: Please fill in all fields.");
        }

        $sql = "INSERT INTO patients (name, age, last_visit, health_status) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing query: " . $conn->error);
        }

        $stmt->bind_param("siss", $name, $age, $lastVisit, $healthStatus);

        if ($stmt->execute()) {
            echo "success";
        } else {
            die("Error executing query: " . $stmt->error);
        }
        exit();
    }
}

// Fetch and display patient records
$sql = "SELECT * FROM patients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Health Monitoring - BHW</title>
    <link rel="stylesheet" href="/css/records.css">
    <script src="records.js" defer></script>
</head>
<body>

    <section class="content-area">
        <h1>Manage Patient Records</h1>
        <button class="btn-primary" onclick="togglePatientForm()">Add New Patient</button>

        <div class="form-container" id="patientForm" style="display:none;">
            <h3>Add New Patient</h3>
            <form id="patientFormElement">
                <input type="text" id="patientName" placeholder="Enter Patient Name" required>
                <input type="number" id="patientAge" placeholder="Enter Age" required>
                <input type="date" id="lastVisit" required>
                <input type="text" id="healthStatus" placeholder="Enter Health Status" required>
                <button class="btn-primary" type="button" onclick="addNewPatient()">Submit</button>
            </form>
        </div>

        <table class="patients-table">
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Last Visit</th>
                    <th>Health Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="patientsTableBody">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row["patient_id"]) ?></td>
                        <td class="editable"><?= htmlspecialchars($row["name"]) ?></td>
                        <td class="editable"><?= htmlspecialchars($row["age"]) ?></td>
                        <td class="editable"><?= htmlspecialchars($row["last_visit"]) ?></td>
                        <td class="editable"><?= htmlspecialchars($row["health_status"]) ?></td>
                        <td><button onclick="editRecord(this)">Edit</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>

</body>
</html>

<?php $conn->close(); ?>
>>>>>>> aba50b88d02abc0f3148339440bdab16c59e817c
