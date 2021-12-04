<?php
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
$userFound = false;
$currentUserId = 0;

$sql = "SELECT * from users";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo $row['username'];
        if($_POST['loginEmail'] == $row['username'] && $_POST['loginPass'] == $row['password']){
            $userFound = true;
            $currentUserId = $row['user_id'];
        }
    }
}
if($userFound){
    session_start();
    $_SESSION['currentUserId'] = $currentUserId;
    $_SESSION['profileUserId'] = $currentUserId;
    header("location: profile.php");
}
else{
    setcookie("loginError","Incorrect Credentials",time()+5);
    header("location: login.php");
}
mysqli_close($conn);
