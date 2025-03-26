<<<<<<< HEAD
<?php
// Start the session
session_start();

// Destroy all session variables
session_unset();

// Destroy the session
session_destroy();

// Output JavaScript to clear client-side data and redirect the user
echo "<script type='text/javascript'>
    // Clear local storage (if you are storing session data on the client side)
    localStorage.clear();
    // Clear session storage (if you are using sessionStorage)
    sessionStorage.clear();
    
    // Redirect to login page or home page
    window.location.href = 'index.html';
</script>";
exit();
?>
=======
<?php
// Start the session
session_start();

// Destroy all session variables
session_unset();

// Destroy the session
session_destroy();

// Output JavaScript to clear client-side data and redirect the user
echo "<script type='text/javascript'>
    // Clear local storage (if you are storing session data on the client side)
    localStorage.clear();
    // Clear session storage (if you are using sessionStorage)
    sessionStorage.clear();
    
    // Redirect to login page or home page
    window.location.href = 'index.html';
</script>";
exit();
?>
>>>>>>> aba50b88d02abc0f3148339440bdab16c59e817c
