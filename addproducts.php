<html>
<?php
$con = mysqli_connect("localhost", "root", "", "ecommerce") or die("db fail");
if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $Name = mysqli_real_escape_string($con, $_POST['text']);
    $Quantity = mysqli_real_escape_string($con, $_POST['number']);
    $Size = mysqli_real_escape_string($con, $_POST['stxt']);
    $file = mysqli_real_escape_string($con, $_POST['file']);

    if (!ctype_digit($Quantity) || $Quantity <= 0 || $id<=0) {
        echo "<script>alert('Please enter a valid positive integer for Quantity.')</script>";
    } else {
        if (!ctype_alpha(str_replace(' ', '', $Name))) {
            echo "<script>alert('Please enter a valid Product name containing only alphabets.')</script>";
        } else {
            $createtbl = "CREATE TABLE IF NOT EXISTS products (
                ID BIGINT unique,
                Name VARCHAR(50),
                Quantity VARCHAR(30),
                Size VARCHAR(30)
        
            )";
            mysqli_query($con,$createtbl);
            $query = "SELECT ID FROM products WHERE ID = '$id'";
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result)>0){
                echo "<script>alert('Id already exists please enter unique ID'); window.location.href = 'products.php';</script>";
            }
            else{
            $tbl = "INSERT INTO products( ID , Name, Quantity, Size) VALUES('$id','$Name', '$Quantity', '$Size')";
            $rel = mysqli_query($con, $tbl);
            if ($rel) {
                echo "<script>alert('Insert successfully'); window.location.href = 'products.php';</script>";
            } else {
                echo "wrong entry";
                return false;
            }
        }
    }
    }
}
?>
<body>
    <title>Adding Book</title>
    <form action="" method="POST">
    <input type="text" name="id" placeholder="enter products id" required>
        <input type="text" name="text" placeholder="enter products name" required>
        <input type="text" name="number" placeholder="enter products quantity" required>
        <select name="stxt" required>
            <option value="" disabled selected>Select Size</option>
            <option value="L">L</option>
            <option value="M">M</option>
            <option value="XL">XL</option>
        </select><br><br>
        <input type="file" name="file" placeholder="upload photo" required>
        <input type="submit" name="submit" value="submit">
        <input type="button" name="button" value="back" onclick="window.location.href ='products.php'"><br><br>
    </form>
</body>
</html>
<style>
    body {
        background-color: #f7f7f7;
    }

    h1,
    h2 {
        font-family: Arial, sans-serif;
        color: #333;
    }

    input[type=text] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: none;
        border-bottom: 2px solid #4CAF50;
    }

    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
    }

    input[type=submit]:hover {
        background-color: #3e8e41;
    }

    input[type=button] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
    }

    input[type=button]:hover {
        background-color: #3e8e41;
    }

    form {
        width: 50%;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: none;
        border-bottom: 2px solid #4CAF50;
        background-color: #fff;
        color: #333;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
    }

    select:hover {
        border-color: #3e8e41;
    }

    option:checked {
        background-color: #4CAF50;
        color: #fff;
    }

    option {
        background-color: #fff;
        color: #333;
    }

    option:hover {
        background-color: #f0f0f0;
        color: #333;
    }
</style>
