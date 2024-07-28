<?php
// Check if book ID is provided
if(isset($_GET['product_id'])) {
    // Connect to database
    $con = mysqli_connect("localhost", "root", "", "ecommerce");
    
    // Escape book ID to prevent SQL injection
    $product_id = mysqli_real_escape_string($con, $_GET['product_id']);
    
    // Prepare delete query
    $delete_query = "DELETE FROM products WHERE ID = '$product_id'";
    
    // Execute delete query
    if(mysqli_query($con, $delete_query)) {
        // Book deleted successfully, redirect to the page with the book list
        header("Location: products.php");
        exit(); // Ensure script stops executing after redirection
    } else {
        // Error occurred while deleting book
        echo "Error: " . mysqli_error($con);
    }
} else {
    // No book ID provided, show error message or redirect to error page
    echo "No book ID provided.";
}
?>