$(document).ready(function () {
  function assignRole(userId, newRole) {
      $.ajax({
          url: 'usermanagement.php',
          type: 'POST',
          data: { id: userId, role: newRole },
          dataType: 'json',
          success: function (response) {
              if (response.success) {
                  let row = $(`button[data-user="${userId}"]`).closest("tr");

                  // Update Role column
                  row.find("td:nth-child(4)").text(newRole);

                  // Remove buttons and show "Assigned: Role"
                  row.find("td:nth-child(5)").html(`<span>Assigned: ${newRole}</span>`);
              }
          }
      });
  }

  // Make function globally accessible
  window.assignRole = assignRole;
});
