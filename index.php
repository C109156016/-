<!DOCTYPE html>

<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />

    <!--====== Title ======-->
    <title>eCommerce HTML | Login</title>

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--====== Favicon Icon ======-->
    <link
      rel="shortcut icon"
      href="assets/images/favicon.png"
      type="image/png"
    />

    <!--====== Tiny Slider CSS ======-->
    <link rel="stylesheet" href="assets/css/tiny-slider.css" />

    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="assets/css/LineIcons.css" />

    <!--====== Material Design Icons CSS ======-->
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />

    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />

    <!--====== gLightBox CSS ======-->
    <link rel="stylesheet" href="assets/css/glightbox.min.css" />

    <!--====== nouiSlider CSS ======-->
    <link rel="stylesheet" href="assets/css/nouislider.min.css" />

    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="assets/css/default.css" />

    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>

  <body>

<?php
    if(isset($_REQUEST['email']))
    {
      $email=$_REQUEST['email'];
      $passwd=$_REQUEST['passwd'];

      echo "email=$email passwd=$passwd";
      include("connectdb.php");
      include("basic.php");
      $sql = "SELECT uid,email,username,loadlogin FROM user where email='$email' and passwd='$passwd'";
      $result =$connect->query($sql);

      if($row = $result->fetch_assoc())
      {
        $uid=$row['uid'];
        $username=$row['username'];
        $loadlogin=$row['loadlogin'];
        session_start();
        $_SESSION['uid']=$uid;
        $_SESSION['email']=$email;
        $_SESSION['username']=$username;
        $_SESSION['loadlogin']=$loadlogin;

        switchto("home.php");

      }
      else  echo "login fail!";


    }


?>
    <section class="login-registration-wrapper pt-50 pb-100">
      <div class="container">
        <div class="row">
        <div class="col-lg-3"></div>
          <div class="col-lg-6">
            <div class="login-registration-style-1 mt-50">
              <h1 class="heading-4 font-weight-500 title">
                Login to your account
              </h1>
              <div class="login-registration-form pt-10">
                <form action="index.php" method='post'>
                  <div class="single-form form-default form-border">
                    <label>Email Address</label>
                    <div class="form-input">
                      <input type="email" name='email' placeholder="user@email.com" />
                      <i class="mdi mdi-email"></i>
                    </div>
                  </div>
                  <div class="single-form form-default form-border">
                    <label>Choose Password</label>
                    <div class="form-input">
                      <input name='password'   id="password"   type="password"    placeholder="Password"/>
                      <i class="mdi mdi-lock"></i>
                      <span
                        toggle="#password-1"
                        class="mdi mdi-eye-outline toggle-password"
                      ></span>
                    </div>
                  </div>
                  <div class="single-form">
                    <button class="main-btn primary-btn">Signin</button>
                  </div>
                </form>
              </div>
              <p class="login">
                Don’t have an account? <a href="add.php">Sign up</a>
              </p>
            </div>
          </div>