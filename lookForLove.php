<?php
session_start();
require_once "DatabaseAccess/databaseAccess.php";

$connection = getConnection();
?>

<!DOCTYPE html>
<html>
<head>
    <title>W3.CSS Template</title>
    <?php include "HeaderFooter/head.php"?>
    <style>
        .card {
            /* Add shadows to create the "card" effect */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            width: 25%;
            float: left;
            margin: 20px;
        }

        /* On mouse-over, add a deeper shadow */
        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
    </style>
</head>
<body class="w3-theme-l5">

<!-- Navbar -->
<?php include "HeaderFooter/navbar.php";?>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
    <!-- The Grid -->
    <div class="w3-row">
        <!-- Left Column -->
        <div class="w3-col m3">
            <div class="w3-card w3-round w3-white">
                <div class="w3-container w3-pink">
                    <h4><b>Choose Preferences</b></h4>
                </div>

                <form class="w3-container" method="post" action="lookForLove.php">
                    <p>
                        <label>City</label>
                        <input class="w3-input" type="text" name="city">
                    </p>

                    <p>
                        <label>Interests</label>
                        <input class="w3-input" type="text" name="interests">
                    </p>

                    <p>
                        <label>Age Range</label>
                        <select class="w3-input" name="age">
                            <option selected>any</option>
                            <option>18-24</option>
                            <option>24-30</option>
                            <option>30-36</option>
                            <option>36-42</option>
                            <option><42</option>
                        </select>
                    </p>
                    <input type="submit" class="w3-btn w3-pink w3-margin" value="Go">
                </form>
            </div>
            <br>
        </div>
        <!-- End Left Column -->

        <!-- Right Column -->
        <div class="w3-col m9">
            <?php
            if(isset($_POST['age'])){
                if(isset($connection)) {
                    $query = "select distinct users.user_id,first_name,last_name,profile_image from users,user_details,user_interests where users.user_id = user_details.user_id and user_details.user_id = user_interests.user_id";
                    if(!empty($_POST['city'])) {
                        $query .= " and city = '{$_POST['city']}'";
                    }
                    if($_POST['age'] != 'any'){
                        if(strpos($_POST['age'],'-')){
                            $values = explode('-',$_POST['age']);
                            $query .= " and (age between $values[0] and $values[1])";
                        }
                        else{
                            $query .= " and age > 40";
                        }
                    }
                    if(!empty($_POST['interests'])){
                        $query .= " and interest = '{$_POST['interests']}'";
                    }

                    $stmt = $connection->prepare($query);
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    foreach ($stmt->fetchAll() as $item){
                        if(isset($_SESSION['currentUserId']) && $item['user_id']!=$_SESSION['currentUserId']){
                        ?>
                        <a href="profile.php?profileUserId=<?=$item['user_id']?>">
                        <div class="card">
                            <img src="images/<?=$item['profile_image']?>" alt="Avatar" style="width:100%;height: 200px;">
                            <div class="container" style="text-align: center">
                                <h4><b><?=$item['first_name']." ".$item['last_name']?></b></h4>
                            </div>
                        </div>
                        </a>
                        <?php
                        }
                    }
                }
            }
            $connection = null;
            ?>
        </div>
        <!--End Right Column -->
    </div>
    <!-- End Grid -->
<br>
<!-- Footer -->
<?php include "HeaderFooter/footer.php";?>
<!--End Footer -->
</body>
</html>
