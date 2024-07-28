<?php
session_start();

if (isset($_POST['submit'])) {
    $uname = $_POST['uname'];
    $psw = $_POST['psw'];

    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "ecommerce") or die("DB connection error");

    // Check user table
    $select_user = "SELECT * FROM users WHERE username='$uname' AND password='$psw'";
    $result_user = mysqli_query($con, $select_user) or die("Retrieval error");
    $num_user = mysqli_num_rows($result_user);

    if ($num_user > 0) {
        $_SESSION['username'] = $uname;
        $_SESSION['psw'] = $psw;
        echo "Welcome $_SESSION[uname]";
        header("Location: userdashboard.html");
        exit();
    } else {
        // Check admin table
        $select_admin = "SELECT * FROM admin WHERE username='$uname' AND password='$psw'";
        $result_admin = mysqli_query($con, $select_admin) or die("Retrieval error");
        $num_admin = mysqli_num_rows($result_admin);

        if ($num_admin > 0) {
            $_SESSION['username'] = $uname;
            $_SESSION['psw'] = $psw;
            header("Location: adminDashboard.php");
            exit();
        } 
   else {
    echo "<script> alert('Register first to access this content.'); window.location.href = '/E-CommerceWebsite/index.html';</script>";
}
    }
}
?>
