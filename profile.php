<?php
    session_start();
    require_once "DatabaseAccess/databaseAccess.php";

    $connection = getConnection();
    if(isset($_GET['profileUserId']))
    {
        $_SESSION['profileUserId'] = $_GET['profileUserId'];
    }
    if(isset($connection)) {
        $query = "select * from users,user_details where users.user_id = user_details.user_id and users.user_id = {$_SESSION['profileUserId']}";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetchAll();
    }

    ?>
<!DOCTYPE html>
<html>
<head>
    <title>W3.CSS Template</title>
    <?php include "HeaderFooter/head.php"?>
    <style>
        html, body, h1, h2, h3, h4, h5 {
            font-family: "Open Sans", sans-serif
        }

        button.w3-button.w3-padding-large{
            background-color: white;
            box-shadow: 2px 3px 2px grey inset;
        }

        #myFile{
            z-index: -1;
            opacity: 0;
        }
        .card {
            /* Add shadows to create the "card" effect */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            float: left;
            width: 30%;
            height: 200px;
            margin: 10px;
        }

        /* On mouse-over, add a deeper shadow */
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.4);
        }

        /* Add some padding inside the card container */
        .container {
            padding: 20px;
            margin: auto;
        }

        .card img{
            height: 100%;
        }
    </style>
</head>
<body class="w3-theme-l5">

<!-- Navbar -->
<?php include "HeaderFooter/navbar.php";?>
<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
        <?php
        if(isset($_SESSION['currentUserId']) && ($_SESSION['profileUserId'] == $_SESSION['currentUserId'])){
        ?>
        <div class="w3-dropdown-hover w3-hide-small">
            <?php
                $stmt = $connection->prepare("select * from notifications,user_details where notifications.user_id = user_details.user_id and notifications.user_id = $_SESSION[currentUserId] and type = user_type");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $notifications = $stmt->fetchAll();
            ?>
            <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green"><?=count($notifications)?></span></button>
            <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
                <?php
                    foreach ($notifications as $notification){
                        if(strpos($notification['content'],'wink')){
                            $barColor = 'w3-pink';
                        }elseif (strpos($notification['content'],'Favorites')){
                            $barColor = 'w3-blue';
                        }else{
                            $barColor = 'w3-green';
                        }
                        $stmt1 = $connection->prepare("select first_name,last_name from users where user_id = $notification[sender_id]");
                        $stmt1->execute();
                        $name = ($stmt1->fetchAll())[0];
                ?>
                    <a href="#" class="w3-bar-item w3-button <?=$barColor?>"><?=$name['first_name']." ".$name['last_name']." ".$notification['content']?></a>
                <?php
                    }
                ?>
                <a href="DatabaseAccess/profileActions.php?action=clearNotifications" class="w3-bar-item w3-button w3-black"><i class="fa fa-trash" style="color: red"></i><span style='color:red'>&NonBreakingSpace;Clear All Notifications</span></a>
            </div>
            <?php

            ?>
        </div>
        <?php
            }
        ?>
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <p class="w3-center"><img src='<?="images/".$row[0]['profile_image']?>' class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p>Name : <?=$row[0]['first_name']." ".$row[0]['last_name']?></p>
         <p>Birth Date : <?=$row[0]['date_of_birth']?></p>
         <p>Gender : <?=$row[0]['gender']?></p>
         <p>Interested In : <?=$row[0]['interested_in']?></p>
         <p>Marital Status : <?=$row[0]['marital_status']?></p>
         <p>Country : <?=$row[0]['country']?></p>
         <p>City : <?=$row[0]['city']?></p>
        </div>
      </div>
        <!-- Interests -->
        <div class="w3-card w3-round w3-white w3-hide-small">
            <div class="w3-container">
                <p>Interests</p>
                <p>
                    <?php
                        $stmt = $connection->prepare("select * from user_interests where user_id = $_SESSION[profileUserId]");
                        $stmt->execute();
                        $interests = $stmt->fetchAll();
                        $themeCounter = 1;
                        for($counter = 0; $counter<count($interests); $counter++){
                    ?>
                        <span class="w3-tag w3-small w3-theme-d<?=$themeCounter?>"><?=$interests[$counter]['interest']?></span>
                    <?php
                            $themeCounter++;
                            if($themeCounter > 5){
                                $themeCounter = 0;
                            }
                        }
                    ?>
                </p>
            </div>
        </div>

        <br>
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
        <?php
        if(isset($_SESSION['currentUserId']) && ($_SESSION['profileUserId'] == $_SESSION['currentUserId'])){
            ?>
              <div class="w3-row-padding">
                <div class="w3-col m12">
                  <div class="w3-card w3-round w3-white">
                    <div class="w3-container w3-padding">
                              <h6 class="w3-opacity">Add More Photos, You Look Good ;)</h6>
                              <form action="DatabaseAccess/profileActions.php?action=saveImage" enctype="multipart/form-data" method="post">
                                  <label for="myFile" class="w3-button w3-theme" style="margin-right: -80px">
                                      <i class="fa fa-upload"></i>&NonBreakingSpace;Choose Image
                                  </label>
                                  <input type="file" id="myFile" name="imageChosen">
                                  <br><br>
                                  <input type="submit" value="Post" class="w3-button w3-theme">
                              </form>
                    </div>
                  </div>
                </div>
              </div>
        <?php
        }
        ?>
        <div class="container">
            <?php
                $stmt = $connection->prepare("select * from user_images where user_id = $_SESSION[profileUserId]");
                $stmt->execute();
                $images = $stmt->fetchAll();
                foreach($images as $image)
                {
            ?>
                <div class="card">
                    <img src="<?="images/".$image['image_path']?>" alt="Avatar" style="width:100%;">
                </div>
            <?php
                }
            ?>
        </div>
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
        <?php
            if(isset($_SESSION['currentUserId']) && $_SESSION['profileUserId'] == $_SESSION['currentUserId']){
                $stmt = $connection->prepare("select distinct sender_id,reciever_id from winks where reciever_id=$_SESSION[currentUserId]");
                $stmt->execute();
                foreach($stmt->fetchAll() as $wink){
                    $stmt1 = $connection->prepare("select * from users,user_details where users.user_id=$wink[sender_id] and users.user_id=user_details.user_id");
                    $stmt1->execute();
                    $sender = $stmt1->fetchAll();
        ?>
          <div class="w3-card w3-round w3-white w3-center">
            <a href="profile.php?profileUserId=<?=$wink['sender_id']?>" style="text-decoration: none">
                <div class="w3-container">
                  <img src="images/<?=$sender[0]['profile_image']?>" style="width:50%"><br>
                  <span><?=$sender[0]['first_name']." ".$sender[0]['last_name']?></span>
                    <p>Sent a <span style="color: deeppink; font-weight: bolder">Wink ;)</span></p>
                  <div class="w3-row w3-opacity">
                    <div class="w3-half">
                        <a href="DatabaseAccess/profileActions.php?action=accept&senderId=<?=$sender[0]['user_id']?>"><button class="w3-button w3-block w3-green w3-section" title="Accept"><i class="fa fa-check"></i></button></a>
                    </div>
                    <div class="w3-half">
                        <a href="DatabaseAccess/profileActions.php?action=ignore&senderId=<?=$sender[0]['user_id']?>"><button class="w3-button w3-block w3-red w3-section" title="Ignore"><i class="fa fa-remove"></i></button></a>
                    </div>
                  </div>
                </div>
            </a>
          </div>
        <?php
                }
            }
        else{
            if(isset($_SESSION['currentUserId'])){
        ?>
            <a href="messagesPage.php"><button class="w3-button w3-green" style="width: 100%;margin-top: 20%;"><i class="fa fa-comment"></i> Chat</button></a><br><br>
            <?php
                $favoriteStatus = "Favorite";
                $stmt2 = $connection->prepare("select * from favorites where user_id = $_SESSION[currentUserId] and favorite_user_id = $_SESSION[profileUserId]");
                $stmt2->execute();
                if(count($stmt2->fetchAll())>0){
                    $favoriteStatus = "Unfavorite";
                }
            ?>
            <a href="DatabaseAccess/profileActions.php?action=<?=$favoriteStatus?>"><button class="w3-button w3-blue" style="width: 100%;"><i class="fa fa-star"></i> <?=$favoriteStatus?></button></a><br><br>
            <a href="DatabaseAccess/profileActions.php?action=wink"><button class="w3-button w3-pink" style="width: 100%;"><i class="fa fa-heart"></i> Wink</button></a><br><br>
        <?php
            }
        }
        ?>
          <br>
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>
<!-- Footer -->
<?php include "HeaderFooter/footer.php";?>
<?php $connection = null;?>
</body>
</html> 
