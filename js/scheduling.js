document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("appointmentForm");

  if (!form) {
      console.warn("No appointment form found on this page. Skipping script.");
      return; // Exit script if form doesn't exist
  }

  form.addEventListener("submit", function(event) {
      event.preventDefault(); // Prevent default form submission

      const formData = new FormData(form);

      fetch("scheduling.php", {
          method: "POST",
          body: formData
      })
      .then(response => response.json()) // Convert response to JSON
      .then(data => {
          console.log("Server Response:", data); // Debugging

          if (data.status === "success") {
              alert("✅ Appointment scheduled successfully!");
              form.reset(); // Clear form fields
          } else {
              alert("❌ Failed to schedule appointment: " + data.message);
          }
      })
      .catch(error => {
          console.error("Fetch error:", error);
          alert("⚠️ Something went wrong. Please try again.");
      });
  });
});
