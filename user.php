<?php
session_start();
$uname = $_POST['uname'];
$psw = $_POST['psw'];
$cpsw = $_POST['cpsw'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$con = mysqli_connect("localhost", "root", "", "ecommerce");


if (mysqli_connect_errno()) {
    echo "<script>alert('Failed to connect to MySQL: " . mysqli_connect_error() . "'); window.location.href = '/E-CommerceWebsite/register.html';</script>";
    exit();
}


if ($uname == "ganesh" && $psw == "1234" && $email == "ganeshbasnet507@gmail.com") {
    echo "<script>alert('You are admin so don\'t need to register.'); window.location.href = '/E-CommerceWebsite/index.html';</script>";
    exit();
}


if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Invalid email, please try again!!.'); window.location.href = '/E-CommerceWebsite/register.html';</script>";
    exit();
}


if (!preg_match("/^[a-zA-Z]+$/", $uname)) {
    echo "<script>alert('Username should be only alphabets, please try again!!.'); window.location.href = '/E-CommerceWebsite/register.html';</script>";
    exit();
}


if ($psw !== $cpsw) {
    echo "<script>alert('Passwords do not match, please try again!!.'); window.location.href = '/E-CommerceWebsite/register.html';</script>";
    exit();
}

$tble = "CREATE TABLE IF NOT EXISTS users (
    username VARCHAR(40),
    password VARCHAR(40),
    contact VARCHAR(50),
    email VARCHAR(100)
)";
mysqli_query($con, $tble);


$insert = "INSERT INTO users (username, password, contact, email) VALUES ('$uname', '$psw', '$contact', '$email')";
if (mysqli_query($con, $insert)) {
    echo "<script>alert('Registration successful. You can now login.'); window.location.href = '/E-CommerceWebsite/index.html';</script>";
} else {
    echo "<script>alert('Registration Failed: " . mysqli_error($con) . "'); window.location.href = '/E-CommerceWebsite/register.html';</script>";
}

mysqli_close($con);
?>
