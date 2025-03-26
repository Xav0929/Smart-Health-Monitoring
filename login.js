document.getElementById('loginForm').onsubmit = async function(event) {
  event.preventDefault();

  const email = document.getElementById('useremail').value;
  const password = document.getElementById('userpassword').value;
  const errorMessage = document.getElementById('error-message');

  try {
      const response = await fetch('login.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams({ email: email, password: password })
      });

      const data = await response.json(); // Parse the JSON response
      console.log("Parsed JSON:", data); // Log the full response for debugging

      // Check the success flag and redirect URL
      if (data.success === "1" && data.redirect_url) {
          console.log("Redirecting to: " + data.redirect_url); // Log the URL to debug
          window.location.href = data.redirect_url; // Perform the redirection
      } else {
          // Show error message if success is 0 or redirect_url is missing
          errorMessage.innerText = data.message || "Unknown error occurred.";
          errorMessage.classList.remove('hidden');
      }
  } catch (error) {
      console.error('Error:', error);
      alert('Network Error: ' + error.message);
  }
};
