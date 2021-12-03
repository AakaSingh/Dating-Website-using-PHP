<!DOCTYPE html>
<html>
    <head>
        <title>OurSite</title>
        <?php include "HeaderFooter/head.php"?>
    </head>

    <body id="myPage">
        <!-- Navbar -->
        <?php include "HeaderFooter/homeNavbar.php";?>

        <!-- Image Header -->
        <div class="w3-display-container w3-animate-opacity" style="position: relative;">
          <h1 style="color: pink; position: absolute; left: 150px; top: 200px;">Best Ways to Find Your<br>True Sole Mate</h1>
          <img src="images/img.png" style="width:50%; height: 50%; float: right;">
          <div class="w3-container w3-display-bottomleft w3-margin-bottom">
          </div>
        </div>

        <!-- Modal -->
        <div id="id01" class="w3-modal">
          <div class="w3-modal-content w3-card-4 w3-animate-top">
            <header class="w3-container w3-teal w3-display-container">
              <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-teal w3-display-topright"><i class="fa fa-remove"></i></span>
              <h4>Oh snap! We just showed you a modal..</h4>
              <h5>Because we can <i class="fa fa-smile-o"></i></h5>
            </header>
            <div class="w3-container">
              <p>Cool huh? Ok, enough teasing around..</p>
              <p>Go to our <a class="w3-text-teal" href="/w3css/default.asp">W3.CSS Tutorial</a> to learn more!</p>
            </div>
            <footer class="w3-container w3-teal">
              <p>Modal footer</p>
            </footer>
          </div>
        </div>

        <!-- Users Container -->
        <div class="w3-container w3-padding-64 w3-center" id="team">
        <h2>USERS</h2>
        <p>Meet New People Today!</p>

        <div class="w3-row"><br>

        <div class="w3-quarter">
          <img src="images/op-img4.png" style="width:50%">
          <h3>Rebecca Flex</h3>
            <a href="login.php"><button class="connect-new-user-btn">Connect</button></a>
        </div>

        <div class="w3-quarter">
          <img src="images/up6.jpg"style="width:50%">
          <h3>Johnny Walker</h3>
            <a href="login.php"><button class="connect-new-user-btn">Connect</button></a>
        </div>

        <div class="w3-quarter">
          <img src="images/friend10.png"style="width:50%">
          <h3>Jan Ringo</h3>
          <a href="login.php"><button class="connect-new-user-btn">Connect</button></a>
        </div>

        <div class="w3-quarter">
          <img src="images/op-img3.png"style="width:50%">
          <h3>Amanda Larson</h3>
            <a href="login.php"><button class="connect-new-user-btn">Connect</button></a>
        </div>

        </div>
        </div>

        <!-- Work Row -->
        <div class="w3-row-padding w3-padding-64 w3-theme-l1" id="work" style="background-color: #cc66ff;">
          <div class="w3-half">
          <h2>Start Flirting..!</h2>
          <p>In our modern day and age dating apps have become an integral part of our lives. They allow you to check the profile of singles living near you, to chat with them, to meet them and maybe to fall in love.</p>
          <p>If you’re searching for a simple dating app with free features allowing to meet singles, you’re in good hands with Pairko. With Pairko you get all you need from a mobile dating app, which presents you thousands of users through your smartphone in a very pleasant experience.</p>
          </div>
          <div class="w3-half" style="padding-left: 70px; background-image: url(images/circle.png); background-repeat: no-repeat;">
            <img src="images/illutration.png">
          </div>
        </div>

        <!-- Contact Container -->
        <div class="contact-container" id="contact">
            <span class="w3-xlarge w3-border-teal w3-bottombar" style="text-align: center;">Contact Us</span>
              <h3>Address :</h3>
              <p><i class="fa fa-map-marker w3-text-teal w3-xlarge"></i>  Chicago, US</p>
              <p><i class="fa fa-phone w3-text-teal w3-xlarge"></i>  +1 515-489-5057</p>
              <p><i class="fa fa-envelope-o w3-text-teal w3-xlarge"></i>  peyamba@service.com</p>
        </div>

        <!-- Footer -->
        <?php include "HeaderFooter/footer.php";?>
    </body>
</html>
