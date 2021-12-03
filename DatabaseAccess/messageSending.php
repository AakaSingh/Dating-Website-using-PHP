<?php
    session_start();
    require_once "databaseAccess.php";

    $connection = getConnection();
    if(isset($_POST['messageContent'])){
        $stmt = $connection->prepare("insert into messages(sender_id, reciever_id, message_content, time_sent, read_unread) values(?,?,?,?,?)");
        $date = date('Y-m-d H:i:s');
        $stmt->execute(array($_SESSION['currentUserId'],$_SESSION['profileUserId'],$_POST['messageContent'],$date,0));
        header("location: ../messagesPage.php");
    }
    else{
        header("location: ../messagesPage.php");
    }
?>