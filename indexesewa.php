
<?php
        if (isset($_POST['submit'])) {
    
                session_start();
                $con = mysqli_connect("localhost","root","","ecommerce");
       
                if (isset($_SESSION['username'])) {
                $user_name = $_SESSION['username'];
                $result = mysqli_query($con, "SELECT username, contact FROM users WHERE username = '$user_name'");
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $uname = $row['username'];
                    $contact = $row['contact'];
                } else {
                    $uname = '';
                    $contact = '';
                }
            } else {
                $uname = '';
                $contact = '';
            }

    
        $epay_url = "https://rc-epay.esewa.com.np/api/epay/main/v2/form"; // Use the correct eSewa endpoint for testing
        if (isset($_POST['price']) && isset($_POST['quantity'])) {

        $amount =(int)$_POST['price']; 
        $tax_amount = "10";
        $quantity = (int)$_POST['quantity'];
        $amount = $amount * $quantity;
        $total_amount = $amount + $tax_amount;
        $size = $_POST['size'];
        $name = $_POST['name'];
        

     
        $transaction_uuid = uniqid("ab-", true);
        $transaction_uuid = preg_replace("/[^a-zA-Z0-9]/", "", $transaction_uuid); // Ensure this is unique for each transaction

        $product_code = "EPAYTEST";
        $product_service_charge = "0";
        $product_delivery_charge = "0";
        $success_url = "http://localhost/E-CommerceWebsite/successEsewa.php"; 
        $failure_url = "https://google.com"; 
        $signed_field_names = "total_amount,transaction_uuid,product_code";

    
        $secret_key = "8gBm/:&EnhH.1/q";

     
        $message = "total_amount=$total_amount,transaction_uuid=$transaction_uuid,product_code=$product_code";

       
        $signature = hash_hmac('sha256', $message, $secret_key, true);
        $signature = base64_encode($signature);
        $orderdate= date("Y-m-d H:i:s");
        $insert = "INSERT INTO Order_Placement (Name, Quantity, Size,  Payment,OrderDate, username,contact) VALUES ('$name', '$quantity', '$size', '$total_amount','$orderdate', '$uname','$contact')";
            $query = mysqli_query($con, $insert);
            $sql_reduce = "UPDATE products SET Quantity = Quantity - $quantity  WHERE Name = '$name' AND Size = '$size'";
            $result_reduce = mysqli_query($con, $sql_reduce);
    
    
        
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Male Cloth</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    
           
            <form action="<?php echo $epay_url; ?>" method="POST">
                <input type="hidden" id="amount" name="amount" value="<?php echo $amount; ?>" required>
                <input type="hidden" id="tax_amount" name="tax_amount" value="<?php echo $tax_amount; ?>" required>
                <input type="hidden" id="total_amount" name="total_amount" value="<?php echo $total_amount; ?>" required>
                <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="<?php echo $transaction_uuid; ?>" required>
                <input type="hidden" id="product_code" name="product_code" value="<?php echo $product_code; ?>" required>
                <input type="hidden" id="product_service_charge" name="product_service_charge" value="<?php echo $product_service_charge; ?>" required>
                <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="<?php echo $product_delivery_charge; ?>" required>
                <input type="hidden" id="success_url" name="success_url" value="<?php echo $success_url; ?>" required>
                <input type="hidden" id="failure_url" name="failure_url" value="<?php echo $failure_url; ?>" required>
                <input type="hidden" id="signed_field_names" name="signed_field_names" value="<?php echo $signed_field_names; ?>" required>
                <input type="hidden" id="signature" name="signature" value="<?php echo $signature; ?>"required>
                <input type="submit" value="Pay Via Esewa" class="btn btn-primary">
            </form>
        </div>
    </div>  
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha256.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/enc-base64.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var message = "<?php echo $message; ?>";
            var hash = CryptoJS.HmacSHA256(message, "8gBm/:&EnhH.1/q");
            var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);
            document.getElementById("signature").value = hashInBase64;
        });
    </script>-->
</body>
</html>
