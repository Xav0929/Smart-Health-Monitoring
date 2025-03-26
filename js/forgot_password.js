document.getElementById('forgotPasswordForm').onsubmit = async function(event) {
  event.preventDefault();

  const email = document.getElementById('email').value.trim();
  const messageBox = document.getElementById('message');

  if (!email) {
      messageBox.innerText = "Please enter your email.";
      messageBox.classList.remove('hidden');
      return;
  }

  try {
      const response = await fetch('forgot_password.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams({ email: email })
      });

      const data = await response.json();
      messageBox.innerText = data.message;
      messageBox.classList.remove('hidden');

      if (data.success == 1) {
          messageBox.style.color = "green";
      } else {
          messageBox.style.color = "red";
      }
  } catch (error) {
      console.error('Error:', error);
      messageBox.innerText = 'Network Error. Please try again.';
      messageBox.classList.remove('hidden');
  }
};