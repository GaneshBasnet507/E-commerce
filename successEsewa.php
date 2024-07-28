<?php
    $con = mysqli_connect("localhost", "root", "", "ecommerce") or die("DB connection error");

    // Retrieve the hidden fields passed from the form
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];
    $order_date = $_POST['order_date'];
    $total_amount = $_POST['total_amount'];
    $transaction_uuid = $_POST['transaction_uuid'];
    $name = mysqli_real_escape_string($con, $name);
    $quantity = mysqli_real_escape_string($con, $quantity);
    $size = mysqli_real_escape_string($con, $size);
    $order_date = mysqli_real_escape_string($con, $order_date);
    $total_amount = mysqli_real_escape_string($con, $total_amount);
    $transaction_uuid = mysqli_real_escape_string($con, $transaction_uuid);
// Fetch the UserID based on the transaction_uuid
    $user_query = "SELECT UserID FROM transactions WHERE TransactionUUID = '$transaction_uuid'";
    $user_result = mysqli_query($con, $user_query);
    if (mysqli_num_rows($user_result) > 0) {
        $user_row = mysqli_fetch_assoc($user_result);
        $user_id = $user_row['UserID'];
    
        // Fetch the user's contact number from the user table
        $contact_query = "SELECT contact FROM user WHERE UserID = '$user_id'";
        $contact_result = mysqli_query($con, $contact_query);
    
        if (mysqli_num_rows($contact_result) > 0) {
            $contact_row = mysqli_fetch_assoc($contact_result);
            $contact_number = $contact_row['contact'];

            mysqli_query($con, $createtbl);
    
            // Reduce product quantity
            $sql_reduce = "UPDATE products SET Quantity = Quantity - $quantity WHERE Name = '$name'";
            $result_reduce = mysqli_query($con, $sql_reduce);
    
            // Insert order details into the database
            $insert = "INSERT INTO Order_Placement (Name, Quantity, Size, OrderDate, Payment, ContactNumber) VALUES ('$name', '$quantity', '$size', '$order_date', '$total_amount', '$contact_number')";
            $query = mysqli_query($con, $insert);
    
            if ($query) {
                echo "<script>alert('Order placed successfully'); window.location.href = 'products.php';</script>";
            } else {
                echo "Failed to place order: " . mysqli_error($con);
            }
        } else {
            echo "Failed to fetch contact number for the user.";
        }
    } else {
        echo "Invalid transaction.";
    }
    
    mysqli_close($con);
    ?>
