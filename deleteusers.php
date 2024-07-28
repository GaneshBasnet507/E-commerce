<?php

if(isset($_GET['username'])) {
    // Connect to database
    $con = mysqli_connect("localhost", "root", "", "ecommerce");
    
    // Escape book ID to prevent SQL injection
    $username= mysqli_real_escape_string($con, $_GET['username']);
    
    // Prepare delete query
    $delete_query = "DELETE FROM users WHERE username = '$username'";
    
    // Execute delete query
    if(mysqli_query($con, $delete_query)) {
        // Book deleted successfully, redirect to the page with the book list
        header("Location: adminDashboard.php");
        exit(); // Ensure script stops executing after redirection
    } else {
        // Error occurred while deleting book
        echo "Error: " . mysqli_error($con);
    }
} else {
    // No book ID provided, show error message or redirect to error page
    echo "No username provided.";
}
?>