function updateStatus(id, status) {
  fetch('schedulelist.php', { // ✅ Make sure this matches your PHP file
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'id=' + id + '&status=' + status
  })
  .then(response => response.text())
  .then(data => {
      if (data.trim() === 'success') {
          document.getElementById('status-' + id).innerText = status;
          document.getElementById('row-' + id).querySelector('td:last-child').innerText = status;
      } else {
          alert('Failed to update status');
      }
  })
  .catch(error => console.error('Error:', error));
}