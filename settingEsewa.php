<?php
// Define eSewa API URL
$epay_url = "https://rc-epay.esewa.com.np/api/epay/main/v2/form"; // Use the correct eSewa endpoint for testing

// Payment Details
$amount = "100";
$tax_amount = "10";
$total_amount = $amount + $tax_amount ;
$transaction_uuid = uniqid("ab-", true);
$transaction_uuid = preg_replace("/[^a-zA-Z0-9]/", "", $transaction_uuid);// Ensure this is unique for each transaction
$product_code = "EPAYTEST";
$product_service_charge = "0";
$product_delivery_charge = "0";
$success_url = "https://esewa.com.np"; // Your actual success URL
$failure_url = "https://google.com"; // Your actual failure URL
$signed_field_names = "total_amount,transaction_uuid,product_code";

// Secret key for generating signature
$secret_key = "8gBm/:&EnhH.1/q"; 

// Message to be signed
// Message to be signed
$message = "total_amount=$total_amount,transaction_uuid=$transaction_uuid,product_code=$product_code";


// Generate the signature
$signature = hash_hmac('sha256', $message, $secret_key, true);
$signature =  base64_encode($signature);
?>
