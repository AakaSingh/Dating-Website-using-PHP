<?php
    session_start();
    require_once "DatabaseAccess/databaseAccess.php";

    $connection = getConnection();
    $query = "select * from messages where (reciever_id = $_SESSION[profileUserId] and sender_id = $_SESSION[currentUserId]) or (reciever_id = $_SESSION[currentUserId] and sender_id = $_SESSION[profileUserId])";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $stmt1 = $connection->prepare("select * from users,user_details where users.user_id = $_SESSION[profileUserId] and users.user_id = user_details.user_id");
    $stmt1->execute();
    $reciever = $stmt1->fetchAll()[0];
    $stmt2 = $connection->prepare("select * from users,user_details where users.user_id = $_SESSION[currentUserId] and users.user_id = user_details.user_id");
    $stmt2->execute();
    $sender = $stmt2->fetchAll()[0];
?>

<html lang="en">
    <head>
        <title></title>
        <?php include "HeaderFooter/head.php"?>
        <style>
            .chatBox{
                width:100%;
                overflow: auto;
                height: 400px;
                background-color: whitesmoke;
                font-family: Arial;
            }
            .chat{
                border-radius: 20px;
                padding: 0px 10px;
                margin: 10px 0;
                width: 60%;
                font-size: 120%;
            }
            .chatLeft{
                float: left;
                background-color: #dddddd;
                padding: 10px 10px 10px 20px;
                margin-top: 10px;
                text-align: left;
            }
            .chatRight{
                float: right;
                background-color: #cfe9ba;
                padding: 10px 20px 10px 10px;
                margin: 10px 10px 0 0;
                text-align: right;
            }
            .inputMessage{
                width: 100%;
                margin-top: 5px;
            }
            .inputMessage input[type="text"]{
                width: 85%;
                height: 40px;
                margin-bottom: -2px;
            }
        </style>
    </head>
    <body>
        <?php include "HeaderFooter/navbar.php";
        ?>

        <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
            <!-- The Grid -->
            <div class="w3-row">
                <!-- Left Column -->
                <div class="w3-col m3">
                    <div class="w3-card w3-round w3-white" style="text-align: center">
                        <p class="w3-center"><img src='<?="images/".$reciever['profile_image']?>' class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                        <hr>
                        <?=$reciever['first_name']." ".$reciever['last_name']?>
                    </div>
                </div>
                <div class="w3-col m6">
                    <div class="w3-card w3-round w3-white">
                        <div class="chatBox">
                            <?php
                            foreach ($stmt->fetchAll() as $row){
                            ?>
                            <div class="chat <?=($_SESSION['currentUserId'] == $row['sender_id'])? 'chatRight' : 'chatLeft'?>">
                                <?=$row['message_content']?><br>
                                <span style="font-size: 50%; float:<?=($_SESSION['currentUserId'] == $row['sender_id'])? 'left' : 'right'?>"><?=date("d/m/y H:i",strtotime($row['time_sent']))?></span>
                            </div><br>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="inputMessage">
                            <form action="DatabaseAccess/messageSending.php" method="post">
                                <input type="text" name="messageContent"><input class="w3-btn w3-green" type="submit" value="Send">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="w3-col m3">
                    <div class="w3-card w3-round w3-white" style="text-align: center">
                        <p class="w3-center"><img src='<?="images/".$sender['profile_image']?>' class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                        <hr>
                        <?=$sender['first_name']." ".$sender['last_name']?>
                    </div>
                </div>
            </div>
        </div>
        <?php include "HeaderFooter/footer.php"?>
    </body>
</html>
<?php
    $stmt1 = $connection->prepare("select * from messages where sender_id = '$_SESSION[profileUserId]' and reciever_id = '$_SESSION[currentUserId]' and read_unread = 0");
    $stmt1->execute();
    if(count($stmt1->fetchAll()) > 0){
        $stmt2 = $connection->prepare("update messages set read_unread = 1 where sender_id = '$_SESSION[profileUserId]' and reciever_id = '$_SESSION[currentUserId]'");
        $stmt2->execute();
        $stmt2 = $connection->prepare("insert into notifications(user_id, sender_id, content, type) values($_SESSION[profileUserId],$_SESSION[currentUserId],' read your messages',0)");
        $stmt2->execute();
        $stmt2 = $connection->prepare("insert into notifications(user_id, sender_id, content, type) values($_SESSION[profileUserId],$_SESSION[currentUserId],' read your messages',1)");
        $stmt2->execute();
    }
    $connection = null;
?>