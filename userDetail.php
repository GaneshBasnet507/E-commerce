<?php
    $con = mysqli_connect("localhost","root","","ecommerce");
    $sel="select * from users";
    $result=mysqli_query($con,$sel);


    ?>
    <!doctype html>
        <body>
            <title>Users data</title>
            <table style="text-align:center;" border="3">
            <tr class="item">
                <td>Name</td>
                <td>Password</td>
                <td>Email ID</td>
                <td>Contact</td>
                 <td>Delete</td>
                
                </tr>
            <tr>
                <?php
                while($row=mysqli_fetch_assoc($result))
                {
                ?>
                <td><?php echo $row['username'];?></td>
                <td><span class="masked-password"><?php echo str_repeat('*', strlen($row['password'])); ?></span></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['contact'];?></td>
               <td><a href="deleteusers.php?username=<?php echo $row['username']; ?>" onclick="return confirm('Are you sure you want to delete this account?');">Delete</a>
            </td>
               
            </tr>
            <?php
                }
                ?>
        </table>
        </body>
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        a.verify-link {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a.verify-link:hover {
            background-color: #45a049;
        }
    </style>
        </style>