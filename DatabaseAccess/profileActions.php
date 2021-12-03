<?php
session_start();
require_once "databaseAccess.php";

$connection = getConnection();


if($_GET['action'] == 'saveImage'){
    $imageFile = $_FILES['imageChosen'];
    $allowedTypes = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
    $detectedType = exif_imagetype($imageFile['tmp_name']);
    $error = !in_array($detectedType, $allowedTypes);
        if (!$error) {
            move_uploaded_file($imageFile['tmp_name'], "../images/$imageFile[name]");
            $stmt = $connection->prepare("insert into user_images values($_SESSION[currentUserId],'$imageFile[name]')");
            $stmt->execute();
        }

}
elseif ($_GET['action'] == 'wink'){
    $stmt = $connection->prepare("insert into winks(sender_id, reciever_id)  values($_SESSION[currentUserId],$_SESSION[profileUserId])");
    $stmt->execute();
}
elseif ($_GET['action'] == 'Favorite' || $_GET['action'] == 'Unfavorite'){
    if($_GET['action'] == 'Favorite'){
        $stmt = $connection->prepare("insert into favorites values($_SESSION[currentUserId],$_SESSION[profileUserId])");
        $stmt1 = $connection->prepare("insert into notifications(user_id, sender_id, content, type) values($_SESSION[profileUserId],$_SESSION[currentUserId],' added you to their Favorites List',1)");
    }
    else{
        $stmt = $connection->prepare("delete from favorites where user_id = $_SESSION[currentUserId] and favorite_user_id = $_SESSION[profileUserId]");
        $stmt1 = $connection->prepare("insert into notifications(user_id, sender_id, content, type) values($_SESSION[profileUserId],$_SESSION[currentUserId],' removed you from their Favorites List',1)");
    }
    $stmt->execute();
    $stmt1->execute();
}
elseif ($_GET['action'] == 'accept' || $_GET['action'] == 'ignore'){
    if($_GET['action'] == 'accept'){
        $stmt1 = $connection->prepare("insert into notifications(user_id, sender_id, content, type) values($_GET[senderId],$_SESSION[currentUserId],' accepted your wink ;)',1)");
    }
    else{
        $stmt1 = $connection->prepare("insert into notifications(user_id, sender_id, content, type) values($_GET[senderId],$_SESSION[currentUserId],' ignored your wink :(',1)");
    }
    $stmt = $connection->prepare("delete from winks where reciever_id = $_SESSION[currentUserId] and sender_id = $_GET[senderId]");
    $stmt->execute();
    $stmt1->execute();
}
elseif ($_GET['action'] == 'clearNotifications'){
    $stmt = $connection->prepare("delete from notifications where user_id = $_SESSION[currentUserId]");
    $stmt->execute();
}

$connection = null;
header("location: ../profile.php" );