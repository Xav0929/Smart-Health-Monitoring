$(document).ready(function () {
    function assignRole(userId, newRole) {
        // ✅ Step 1: Show confirmation before proceeding
        const confirmAction = confirm(`Are you sure you want to assign this user the role of ${newRole}?`);

        if (!confirmAction) {
            console.log("❌ Role assignment canceled.");
            return; // Stop execution if user cancels
        }

        // ✅ Step 2: Proceed with role update
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

                    // ✅ Step 3: Show success alert
                    alert(`🎉 Role successfully updated to ${newRole}!`);
                } else {
                    alert(`❌ Error: ${response.message}`);
                }
            },
            error: function () {
                alert("❌ An error occurred while updating the role. Please try again.");
            }
        });
    }

    // Make function globally accessible
    window.assignRole = assignRole;
});
