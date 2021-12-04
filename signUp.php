<?php
session_start();
$servername = "localhost";
$username = "project";
$password = "project";
$dbname = "dating_website";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$newUsername = $_POST['email'];
$newPassword = $_POST['password'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];

$sql = "select * from users where username = '$newUsername'";
$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) == 0){
    $sql = "insert into users(first_name, last_name, username, password) values('$firstName','$lastName','$newUsername','$newPassword')";
    if(mysqli_query($conn,$sql)){
        $_SESSION['currentUserId'] = mysqli_insert_id($conn);
        $_SESSION['profileUserId'] = $_SESSION['currentUserId'];
        header("location: editProfile.php");
    }
    else{
        setcookie("loginError","Sign Up Failed! Please Retry!",time()+5);
        header("location: login.php");
    }
}
else{
    setcookie("loginError","Username Already Exists! Please Try Another Username",time()+5);
    header("location: login.php");
}

mysqli_close($conn);