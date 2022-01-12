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
    //   $uid=$_REQUEST['uid'];
      $email=$_REQUEST['email'];
    //   $passwd=$_REQUEST['passwd'];
      $username=$_REQUEST['username'];
    //   $loadlogin=$_REQUEST['loadlogin'];
    //   echo "email=$email passwd=$passwd username=$username";
      include("connectdb.php");
      include("basic.php");
      $sql = "insert into user (email,passwd,username) values ('$email','$passwd','$username')";
      $result =$connect->query($sql);
      switchto("index.php");
    if($row = $result->fetch_assoc())
      {
        $uid=$row['uid'];
        $email=$row['email'];
        $passwd=$row['passwd'];
        $username=$row['username'];
        $loadlogin=$row['loadlogin'];
        session_start();
        $_SESSION['uid']=$uid;
        $_SESSION['email']=$email;
        $_SESSION['passwd']=$passwd;
        $_SESSION['username']=$username;
        $_SESSION['loadlogin']=$loadlogin;

        switchto("index.php");

      }
      else  echo "fail!";
    }


?>

  <!-- <?php
                // $email=$_REQUEST['email'];
                // $passwd=$_REQUEST['passwd'];
                // $username=$_REQUEST['username'];
                // $conn=$_REQUEST['result'];
                // $sql="insert into user (email,passwd,username) values ('$email','$passwd','$username')";
                // include("connectdb.php");
                // include('dbutil.php');
    ?> -->
    <section class="login-registration-wrapper pt-50 pb-100">
      <div class="container">
        <div class="row">
        <div class="col-lg-3"></div>
          <div class="col-lg-6">
            <div class="login-registration-style-1 mt-50">
              <h1 class="heading-4 font-weight-500 title">
                建立帳號
              </h1>
              <div class="login-registration-form pt-10">
                <form action="add.php" method='post'>
                  <div class="single-form form-default form-border">
                    <label>Username</label>
                    <div class="form-input">
                      <input type="text" name='username' placeholder="username" id="username"/>
                      <i class="mdi mdi-text"></i>
                    </div>
                  </div>
                  <div class="single-form form-default form-border">
                    <label>Email Address</label>
                    <div class="form-input">
                      <input type="email" name='email' placeholder="user@email.com" id="email"/>
                      <i class="mdi mdi-email"></i>
                    </div>
                  </div>
                  <div class="single-form form-default form-border">
                    <label>Choose Password</label>
                    <div class="form-input">
                      <input name='password' id="passwd" type="password" placeholder="Password"/>
                      <i class="mdi mdi-lock"></i>
                      <span
                        toggle="#password-1"
                        class="mdi mdi-eye-outline toggle-password"
                      ></span>
                    </div>
                  </div>
                  <div class="single-form">
                    <button class="main-btn primary-btn">建立</button>
                  </div>
                </form>
              </div>
            </div>
          </div>