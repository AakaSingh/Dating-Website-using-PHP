<?php
    session_start();
    require_once "DatabaseAccess/databaseAccess.php";
    $connection = getConnection();
    $userId = $_SESSION['currentUserId'];
    $query = "SELECT  * FROM dating_website.user_details where dating_website.user_details.user_id  = ? ";
    $stmt = $connection->prepare($query);
    $stmt->execute(array($userId));
    $rows=$stmt->fetchAll();


    if(count($rows)>0)  //if user exist in USer Details table
    {


        $query = "SELECT  * FROM user_details , users   where  user_details.user_id = users.user_id and dating_website.user_details.user_id  = ? ";
        $stmt = $connection->prepare($query);
        $stmt->execute(array($userId));
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $profileImage = "";


        foreach ($stmt->fetchAll() as $row)
        {
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $oldFullName=$firstName." ".$lastName;
            $dateOfBirth = $row['date_of_birth'];
            $gender = $row['gender'];
            $interested_in = $row['interested_in'];
            $maritalStatus = $row['marital_status'];
            $country = $row['country'];
            $city = $row['city'];
            $profileImage = $row['profile_image'];
            $isPremium = $row['user_type'];
            /*if user is premium it will get notification otherwise no */

        }
      // for Users Interests
        $query = "SELECT  * FROM user_interests   where user_id = ? ";
        $stmt = $connection->prepare($query);
        $stmt->execute(array($userId));

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $interestList = array();
        while ($row = $stmt->fetch())
        {
            $interestList[] = $row['interest'];
        }
        $comma_separated = implode(",",$interestList);

        $interests =  Strip_tags($comma_separated);

        // if USer Click Submit Button it will Insert the values entered by User
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if(!empty($_POST['name']) )
            {
                $name = $_POST['name'];
                $fullName = explode(" ", $name);
                if (!count($fullName) == 2) {
                    $fullName[1]=" ";
                }
            }
            $isPremium=0;
            if(!empty($_POST['userType'])) {
                $isPremium = 1;

            }

            $birthDate= $_POST['birthdate'];
            $gender = $_POST['gender'];
            $interestedIn= $_POST['interestedIn'];
            $country=$_POST['country'];
            $city=$_POST['city'];
            $interests=$_POST['Interests'];
            $maritalStatus=$_POST['maritalStatus'];
            $interests=$_POST['Interests'];
            $interestsArray = explode(",", $interests);

            /*Updating Profile Image */
            if($_FILES['image']['name'][0] != "") {
                $output_dir = "images/";/* Path for file upload */
                $RandomNumber = time();
                $ImageName = str_replace(' ', '-', strtolower($_FILES['image']['name'][0]));
                $ImageType = $_FILES['image']['type'][0];

                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt = str_replace('.', '', $ImageExt);
                $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                $profileImage = $ImageName . '-' . $RandomNumber . '.' . $ImageExt;
                $ret[$profileImage] = $output_dir . $profileImage;

                move_uploaded_file($_FILES["image"]["tmp_name"][0], $output_dir . "/" . $profileImage);
            }
            /*End code of Updating Profile Image */

            /*update the User Table if User Changes His/her name */

            $sql = "UPDATE users SET first_name=:name, last_name=:surname WHERE user_id=:id";
            $data = [
                'name' => $fullName[0],
                'surname' => $fullName[1],
                 'id' => $userId ];

            $stmt= $connection->prepare($sql);
            $stmt->execute($data);
            /*update  User_details table   table Update */
            $age = round((time()-strtotime($birthDate))/(3600*24*365.25));
            $sql = "UPDATE user_details SET date_of_birth=?,age = ?, gender=? , interested_in=?,
                    marital_status=?, country=?, city=?,profile_image=?,user_type=? WHERE user_id=?";
            $stmt= $connection->prepare($sql);
            $stmt->execute([$birthDate,$age,$gender,$interestedIn,$maritalStatus,$country,$city,$profileImage,$isPremium,$userId]);


            /*First it will delete all Intersets of the given User */
            $sql = "DELETE from user_interests  WHERE user_id=?";
            $stmt= $connection->prepare($sql);
            $stmt->execute(array($userId));

            /* it will Insert  Intersets of the given User, one row per one Interest */
           foreach ($interestsArray as &$value)
           {
            $query = "insert  into  user_interests (`user_id`, interest ) VALUES(?,?)";
            $stmt = $connection->prepare($query);
            $stmt->execute([$userId,$value]);
           }
           header("location: profile.php");
        }
    }
    else    // if User is Not Exist in UserDetails table , for New user , it will first create his/her profile
    {
        $firstName = "";
        $lastName =  "";
        $dateOfBirth =  "";
        $gender =  "";
        $interested_in =  "";
        $marital_status =  "";
        $country = "";
        $city =  "";
        $isPremium="";
        $interests ="";
        $profileImage = "noImage.jpg";   // save photo in upload folder in as noImage ok


        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            /*if user press Submit button to create his/her profile */
            if(!empty($_POST['name']) )
            {
                $name = $_POST['name'];
                $fullName = explode(" ", $name);
                if (!count($fullName) == 2) {
                    $fullName[1]=" ";
                }
            }
            $isPremium=0;

            if(!empty($_POST['userType'])) {
                $isPremium = 1;
            }
            $birthDate = $_POST['birthdate'];
            $gender = $_POST['gender'];
            $interestedIn = $_POST['interestedIn'];
            $country = $_POST['country'];
            $city = $_POST['city'];
            $interests = $_POST['Interests'];
            $interestsArray = explode(",", $interests);
            $maritalStatus = $_POST['maritalStatus'];


            /*   For IMAGE upload */
            if($_FILES['image']['name'][0] != "") {
                $output_dir = "images/";/* Path for file upload */
                $RandomNum = time();
                $ImageName = str_replace(' ', '-', strtolower($_FILES['image']['name'][0]));
                $ImageType = $_FILES['image']['type'][0];

                $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
                $ImageExt = str_replace('.', '', $ImageExt);
                $ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
                $profileImage = $ImageName . '-' . $RandomNum . '.' . $ImageExt;
                $ret[$profileImage] = $output_dir . $profileImage;
                /* Try to create the directory if it does not exist */
                if (!file_exists($output_dir)) {
                    @mkdir($output_dir, 0777);
                }
                move_uploaded_file($_FILES["image"]["tmp_name"][0], $output_dir . "/" . $profileImage);
                /*Image code end */
            }
            //Insertion  User_details in Table User Details
            $age = round((time()-strtotime($birthDate))/(3600*24*365.25));
            $query = "insert  into  user_details values(?,?,?,?,?,?,?,?,?,?)";
            $stmt = $connection->prepare($query);
            $stmt->execute([$userId,$birthDate,$gender,$interestedIn,$maritalStatus,$country,$city,$profileImage,$age,$isPremium]);

           // User has entered name at signup page , so here we can only update the name of user in users table
            $sql = "UPDATE users SET first_name=:name, last_name=:surname WHERE user_id=:id";
            $data = [
                'name' => $fullName[0],
                'surname' => $fullName[1],
                'id' => $userId
            ];
            $stmt= $connection->prepare($sql);
            $stmt->execute($data);

            /* it will Insert  Interests of the given User, one row per one Interest */
            foreach ($interestsArray as &$value)
            {
                $query = "insert  into  user_interests (`user_id`, interest ) VALUES(?,?)";
                $stmt = $connection->prepare($query);
                $stmt->execute([$userId,$value]);
            }
            header("location: profile.php");
    }
}
?>