function togglePatientForm() {
  let form = document.getElementById("patientForm");
  form.style.display = form.style.display === "none" || form.style.display === "" ? "block" : "none";
}

// Add New Patient
function addNewPatient() {
  let name = document.getElementById("patientName").value.trim();
  let age = document.getElementById("patientAge").value.trim();
  let lastVisit = document.getElementById("lastVisit").value.trim();
  let status = document.getElementById("healthStatus").value.trim();

  if (!name || !age || !lastVisit || !status) {
      alert("Please fill in all fields.");
      return;
  }

  let bodyData = `patientName=${encodeURIComponent(name)}&patientAge=${encodeURIComponent(age)}&lastVisit=${encodeURIComponent(lastVisit)}&healthStatus=${encodeURIComponent(status)}`;
  console.log("Adding Patient:", bodyData); // Debugging

  fetch("records.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: bodyData
  })
  .then(response => response.text())
  .then(data => {
      console.log("PHP Response:", data); // Debugging
      if (data.trim() === "success") {
          alert("Patient added successfully!");
          location.reload();
      } else {
          alert("Error: " + data);
      }
  })
  .catch(error => console.error("Error:", error));
}

// Edit patient record
function editRecord(button) {
  let row = button.closest("tr");
  let cells = row.querySelectorAll(".editable");

  cells.forEach(cell => {
      let text = cell.innerText;
      cell.innerHTML = `<input type="text" value="${text}">`;
  });

  button.textContent = "Save";
  button.setAttribute("onclick", "saveEdit(this)");
}

function saveEdit(button) {
  let row = button.closest("tr");
  let patientId = row.cells[0].innerText; // Get Patient ID
  let inputs = row.querySelectorAll("input");

  let name = inputs[0].value.trim();
  let age = inputs[1].value.trim();
  let lastVisit = inputs[2].value.trim();
  let status = inputs[3].value.trim();

  if (!name || !age || !lastVisit || !status) {
      alert("Please fill in all fields.");
      return;
  }

  let bodyData = `action=update&patientId=${encodeURIComponent(patientId)}&patientName=${encodeURIComponent(name)}&patientAge=${encodeURIComponent(age)}&lastVisit=${encodeURIComponent(lastVisit)}&healthStatus=${encodeURIComponent(status)}`;
  console.log("Updating Patient:", bodyData); // Debugging

  fetch("records.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: bodyData
  })
  .then(response => response.text())
  .then(data => {
      console.log("PHP Response:", data); // Debugging
      if (data.trim() === "success") {
          alert("Patient record updated successfully!");
          location.reload(); // Reload to fetch updated records
      } else {
          alert("Error updating record: " + data);
      }
  })
  .catch(error => console.error("Error:", error));

  // Restore text values in table after editing
  row.cells[1].innerText = name;
  row.cells[2].innerText = age;
  row.cells[3].innerText = lastVisit;
  row.cells[4].innerText = status;

  button.textContent = "Edit";
  button.setAttribute("onclick", "editRecord(this)");
}
