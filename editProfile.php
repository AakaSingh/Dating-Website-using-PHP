<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<?php include "HeaderFooter/head.php"?>
<style>
    html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<body class="w3-theme-l5">

<!-- Navbar -->
<?php include "HeaderFooter/navbar.php";?>
<?php include "viewProfile.php"; ?>

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
        <form action="viewProfile.php" method="post" enctype="multipart/form-data" action="viewProfile.php">
        <!-- Left Column -->
        <div class="w3-col m3">
            <!-- Profile -->
            <div class="w3-card w3-round w3-white w3-margin">
                <div class="w3-container">
                    <h4>Edit Profile</h4>
                    <!--<form class="w3-container w3-card-4 w3-light-grey w3-margin" action="ViewProfile.php" method="post"  >-->

                    <p class="w3-center"><img src="images/<?=$profileImage;?>" class="w3-circle" style="height:106px;width:106px" alt="Picture Not Uploaded"></p>
                    <p class="w3-center"></p>

                    <!--<p class="w3-center">Upload a different photo.</p>-->

                        <input type="file" id="myFile" name="image[]"  class="w3-border w3-block">
                        <label style="font-weight: bold; font-size: 120%; padding: 5px;">Regular</label>
                        <label class="w3-margin switch">
                            <input type="checkbox" name='userType' <?php if($isPremium=="1") {?>  checked="false" <?php }  ?>>
                            <span class="slider round"></span>
                        </label>
                        <label style="font-weight: bold; font-size: 120%; padding: 5px;">Premium</label>
                        <br><br>
                </div>
            </div>
            <br>
            <!-- End Left Column -->
        </div>

        <!-- Right Column -->
        <div class="w3-col m9">

            <div class="w3-container w3-card w3-white w3-round w3-margin"  > <br>
                <h3>Personal Information</h3><hr>

             <!--  //form-->
                    <div class="w3-row-padding">
                        <div class="w3-half w3-margin-bottom">
                            <p><label>Name</label>
                                <input class="w3-input w3-border" name="name" type="text" <?php if(!empty($oldFullName)){?> value="<?=$oldFullName?>" <?php } ?>  ></p>
                        </div>
                        <div class="w3-half">
                            <p><label>Birth Date</label>
                                <input class="w3-input w3-border" name="birthdate" type="date" value="<?=$dateOfBirth; ?>"></p>
                        </div>
                    </div>

                    <div class="w3-row-padding">
                        <div class="w3-half w3-margin-bottom">
                            <p><label>Gender</label></p>
                            <p>
                                <input class="w3-radio" type="radio" name="gender"  <?php if($gender=="Male"){?> checked="true" <?php } ?> value="Male">
                                <label>Male</label>
                                <span></span>
                                <input class="w3-radio" type="radio" name="gender"  <?php if($gender=="Female"){?> checked="true" <?php } ?>value="Female" style="margin-left: 25px;">
                                <label>Female</label>
                            </p>
                        </div>
                        <div class="w3-half">
                            <p><label>Interested In</label></p>
                            <p>
                                <input class="w3-radio" type="radio" name="interestedIn"  <?php if($interested_in=="Male"){?> checked="true" <?php } ?>value="Male">
                                <label>Male</label>
                                <span></span>
                                <input class="w3-radio" type="radio" name="interestedIn"  <?php if($interested_in=="Female"){?> checked="true" <?php } ?> value="Female" style="margin-left: 25px;">
                                <label>Female</label>
                            </p>
                        </div>
                    </div>

                    <div class="w3-row-padding">
                        <div class="w3-half w3-margin-bottom">
                            <p><label>Country</label></p>
                            <p>
                                <select class="w3-input" name="country" id="country" ">
                                    <?php if(!empty($country)); { ?>
                                    <option value='<?=$country?>'><?= $country; ?></option>
                                    <?php }?>
                                    <option value="Australia">Australia</option>
                                    <option value="Canada">Canada</option>
                                    <option value="China">China</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="France">France</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="India">India</option>
                                    <option value="Iran">Iran</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United Arab Erimates">United Arab Emirates</option>
                                    <option value="United States of America">United States of America</option>
                                </select>
                            </p>
                        </div>
                        <div class="w3-half">
                            <p><label>City</label></p>
                            <p><input class="w3-input w3-border" name="city" type="text" value="<?= $city; ?>"></p>
                        </div>
                    </div>

                    <div class="w3-row-padding">
                        <div class="w3-half w3-margin-bottom">
                            <p><label>Marital Status</label></p>
                            <p>
                                <select class="w3-input" name="maritalStatus" id="maritalStatus"  >
                                    <option value="Single" <?=!empty($maritalStatus) && ($maritalStatus == "Single")?"selected":""?>>Single</option>
                                    <option value="Married" <?=!empty($maritalStatus) && $maritalStatus == "Married"?"selected":""?>>Married</option>
                                </select>
                            </p>
                        </div>
<!--                        <div class="w3-half">-->
<!--                            <p><label>Age</label></p>-->
<!--                            <p><input class="w3-input w3-border" name="age" type="number" value="--><?//= $age; ?><!--"></p>-->
<!--                        </div>-->
                    </div>

                    <p><label>Interests</label>
                    <p><textarea class="w3-input " name="Interests" type="text" ><?=$interests?></textarea> </p>

                       <button class="w3-button w3-section w3-teal w3-ripple"> Submit </button></p>

                </form>

                <!-- End Right Column -->
            </div>

            <!-- End Grid -->
        </div>
        </form>

        <!-- End Page Container -->
    </div>
    <br>

    <!-- Footer -->
    <?php include "HeaderFooter/footer.php";?>
</body>
</html>

