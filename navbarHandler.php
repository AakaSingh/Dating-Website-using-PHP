<?php
session_start();
if($_GET['action'] == 'logout'){
    session_unset();
    session_destroy();
    header("location: index.php");
}
elseif ($_GET['action'] == 'profile'){
    $_SESSION['profileUserId'] = $_SESSION['currentUserId'];
    header("location: profile.php");
}