<!DOCTYPE html>
<html>
<head>
    <meta charset="ISO-8859-1">
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="wrapper">
     <div class="title-text">
          <div class="title login">
              Login Form</div>
          <div class="title signup">
              Signup Form</div>
    </div>
<div class="form-container">
    <div class="slide-controls">
        <input type="radio" name="slide" id="login" checked>
        <input type="radio" name="slide" id="signup">
        <label for="login" class="slide login">Login</label>
        <label for="signup" class="slide signup">Signup</label>
        <div class="slider-tab">
        </div>
    </div>
    <div class="form-inner">
          <form action="loginValidation.php" method="post" class="login">
            <div class="field">
              <input type="text" placeholder="Email Address" name="loginEmail" id="loginEmail" required>
            </div>
            <div class="field">
              <input type="password" placeholder="Password" name="loginPass" id="loginPass" required>
            </div>
            <div class="field btn">
                <div class="btn-layer">
                </div>
                <input type="submit" value="Login">
            </div>
            <div class="signup-link">
            Not a member? <a href="">Signup now</a></div>
          </form>


          <form action="signUp.php" class="signup" method="post">
              <div class="field">
                  <input type="text" placeholder="Email Address" name="email" required>
              </div>
            <div class="field">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="field">
                <input type="text" placeholder="First Name" name="firstName" required>
            </div>
            <div class="field">
                <input type="text" placeholder="Last Name" name="lastName" required>
            </div>
            <div class="field btn">
                <div class="btn-layer">
                </div>
            <input type="submit" value="Signup"></div>
            </form>
        </div>
    </div>
</div>
<?php
if(isset($_COOKIE['loginError'])){
    echo "<h3> $_COOKIE[loginError]</h3>";
}
?>
<script>
      const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });
    </script>
</body>
</html>