<?php
    $con = mysqli_connect("localhost","root","","ecommerce");
    $sel = "SELECT * FROM products";
    $result = mysqli_query($con, $sel);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<h1 style="text-align:center">Total Available Products </h1>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }

        tr.item td {
            background-color: #ffcccc;
            font-weight: bold;
        }

        tr.item:hover td {
            background-color: #ff9999;
            color: white;
        }

        .boo {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            margin: 10px;
            float: right;
            cursor: pointer;
        }

        .boo:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<table border="1">
    <thead>
        <tr class="item">
             <th> ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Size</th>
            <th>Edit</th>
            
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
             <td><?php echo $row['ID']; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Quantity']; ?></td>
                <td><?php echo $row['Size']; ?></td>
            
                <td><a href="edit.php?product_id=<?php echo $row['ID']; ?>">Edit</a>/
                <a href="deleteproduct.php?product_id=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
            </td>
            </tr>
        <?php } ?> 
    </tbody>
</table>

<button class="boo" onclick="window.location.href='addproducts.php';">Add Product</button>
<button class="boo" onclick="window.location.href='adminDashboard.php';">Back</button>


</body>
</html>