<?php
// Establish database connection
$con = mysqli_connect("localhost", "root", "", "ecommerce");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the product ID from the URL
$id = $_GET['product_id'];

// Query to select the product with the given ID
$sel = "SELECT * FROM products WHERE ID='$id'";


// Execute the query
$result = mysqli_query($con, $sel);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Fetch the product details
$sql = mysqli_fetch_assoc($result);

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $number = $_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];

    // Validate ID
    if (!ctype_digit($number) || $number <= 0) {
        echo "<script>alert('Please enter a valid integer for ID.')</script>";
    } else {
        // Validate Name
        if (!ctype_alpha(str_replace(' ', '', $name))) {
            echo "<script>alert('Please enter a valid product name containing only alphabets.')</script>";
        } else {
            // Validate Quantity
            if (!is_numeric($quantity) || $quantity <= 0) {
                echo "<script>alert('Please enter a valid positive number for product quantity.')</script>";
            } else {
                // Update query
                $update_query = "UPDATE products
                                 SET ID = '$number', Name = '$name', Quantity = '$quantity', Size = '$size'
                                 WHERE ID = '$id'";
                
                // Execute the update query
                $update = mysqli_query($con, $update_query);
                
                // Check if the update was successful
                if ($update) {
                    echo "<script>alert('Update successfully'); window.location.href = 'products.php';</script>";
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            }
        }
    }
}
?>
<html>
<head>
    <title>Update Product</title>
    <style>
        table {
            color: white;
            border-radius: 20px;
        }
        #button {
            background-color: green;
            color: white;
            height: 32px;
            width: 125px;
            border-radius: 25px;
            font-size: 16px;
        }
        body {
            background: linear-gradient(red, blue);
        }
        select {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <br><br><br><br><br><br><br>
    <form action="" method="POST">
        <table border="0" align="center" cellspacing="20">
            <tr>
                <td>Product Id</td>
                <td><input type="text" value="<?php echo $sql['ID']; ?>" name="id" required></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input type="text" value="<?php echo $sql['Name']; ?>" name="name" required></td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td><input type="text" value="<?php echo $sql['Quantity']; ?>" name="quantity" required></td>
            </tr>
            <tr>
                <td>Size</td>
                <td>
                    <select name="size" required>
                        <option value="">Select Size</option>
                        <option value="M"<?php if ($sql['Size'] == "M") echo " selected"; ?>>M</option>
                        <option value="L"<?php if ($sql['Size'] == "L") echo " selected"; ?>>L</option>
                        <option value="XL"<?php if ($sql['Size'] == "XL") echo " selected"; ?>>XL</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" id="button" name="submit" value="Update Details"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="button" id="button" name="back" onclick="window.location.href='products.php'" value="Back"></td>
            </tr>
        </table>
    </form>
</body>
</html>
