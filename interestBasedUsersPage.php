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
            width: 30%;
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
            <div class="w3-card w3-round w3-white" style="text-align: center">
                <h3>Your Results :</h3>
            </div>
            <!-- End Left Column -->
        </div>

        <!-- Middle Column -->
        <div class="w3-col m7">
            <div class="container">
                <?php
                $stmt = $connection->prepare("select * from users,user_details,user_interests where users.user_id = user_details.user_id and  users.user_id = user_interests.user_id and user_interests.interest = '$_GET[interest]'");
                $stmt->execute();
                $results = $stmt->fetchAll();
                foreach($results as $result)
                {
                    ?>
                    <a href="profile.php?profileUserId=<?=$result['user_id']?>">
                        <div class="card">
                            <img src="<?="images/".$result['profile_image']?>" alt="Avatar" style="width:100%;height: 200px;">
                            <div class="container" style="text-align: center">
                                <h4><b><?=$result['first_name']." ".$result['last_name']?></b></h4>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                ?>
            </div>
            <!-- End Middle Column -->
        </div>

        <!-- Right Column -->
        <div class="w3-col m2">

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

