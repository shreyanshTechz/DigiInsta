<?php
// Include config file 
require_once "config.php";


$username = $password = $confirm_password =$email="";
$username_err = $password_err = $confirm_password_err = "";


if(isset($_POST["register"]) && $_POST["register"]=="Register") {
$username = trim($_POST["username"]);
$password = trim($_POST["password"]);
$email = trim($_POST["email"]);

if(empty(trim($_POST["username"]))) {
    $username_err = "Please enter a username.";
}


else {
$sql = "SELECT * FROM users WHERE name = '$username'";
$result = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($result);


if($user){
if($user['name'] === $username) {
$username_err = "This username is already taken.";
}}}


if(empty(trim($_POST["password"]))) {
$password_err = "Please enter a password.";
}
if(empty(trim($_POST["confirm_password"]))) {
$confirm_password_err = "Please confirm password.";
} 
else{
$confirm_password = trim($_POST["confirm_password"]); if(empty($password_err) && ($password != $confirm_password)) {
$confirm_password_err = "Password did not match.";
}}
if(empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
$password = md5($password);
// echo 'Success';
$sql = "INSERT INTO users (name, email,password,createdOn) VALUES ('$username','$email', '$password',NOW())";
$result = mysqli_query($conn,$sql); mysqli_close($conn); header('location: login.php');
}}?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    html body {
      background-image:'pl.png');
    }

    .container1 {
      display: flex;
      flex-direction: row;
      margin-top: 5vh;
      margin-bottom:5vh;
      justify-content: center;
      align-items: center;
      overflow: visible;
      height: 50vh;
      width: 86vw;
      background-color: #0ff;
      border: 1px solid #000;
      background: #ffffff40;
      box-shadow: 0 8px 32px 0 rgb(31 38 135 / 37%);
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
      border-radius: 10px;
      border: 1px solid #ffffff2e;
      /*background-color:blue;*/
      transition: transform 0.8s;
      transform-style: preserve-3d;
    }

    .box1 {
      display: flex;
      flex-direction: column;
      height: 50vh;
      width: 86vw;
    }

    .head1 {
      /* background-color: black; */
      /* overflow: hidden; */
      display: flex;
      justify-content: center;
      align-items: center;
      /* font-size: 0pc; */
      color: none;
    }

    .box {
      /* margin-left: 10px; */
      /* background-image:linear-gradient(rgb(255, 255, 254),pink); */
      width: 89vw;
      height: 50vh;
      /* background-color: rgb(3, 35, 63); */
      display: flex;
      flex-direction: column;
      align-items: center;
      text-decoration: none;
      margin-top: 10px;
      justify-content:center;
    }

    .container1:hover{
       backdrop-filter: blur(14px) saturate(200%);
    -webkit-backdrop-filter: blur(14px) saturate(200%);
    background-color: rgba(255, 255, 255, 0.51);
    border-radius: 12px;
    border: 1px solid rgba(209, 213, 219, 0.3);
    }

    .heading {
      font-size: 2.1rem;
      color: rgb(255 172 101);
      /* font-style: normal; */
      text-decoration: none;
    }

    .inside {
      font-family: 'Otomanopee One', sans-serif;
      color: rgb(2, 7, 16);
      font-family: 'Otomanopee One', sans-serif;
      color: white;
      font-size:initial;
      margin-left: 10px;
    }

    .bg {
       background-image: linear-gradient(
314deg
, #99b14f, #1896ce00,#add8e6,#ffb6c1);

      /* Full height */
      height: 100%;

      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      display: flex;
      justify-content: center;
      /* align-items: center; */
    }

    .head {
      margin-left: 5vw;
      margin-top: 10px;
      font-size:10vh;
      color: black;
      font-weight: 900;
    }

    .login {font-size: 1.1rem;
    height: auto;
    width: fit-content;
    margin-top: 20px;
    /* opacity: 0.86; */
    /* background-image: linear-gradient(rgb(113, 155, 233), rgb(220, 120, 130)); */
    /* color: rgb(1, 5, 9); */
    /* background-color: #0ff; */
    /* border: 1px solid #000; */
    background: #ffffff40;
    box-shadow: 0 8px 32px 0 rgb(31 38 135 / 37%);
    backdrop-filter: blur(4px);
    -webkit-backdrop-filter: blur(4px);
    border-radius: 10px;
    color:black;
    font-family: serif;
    }

    #Start {
      background-color: aliceblue;
      opacity: 0.86;
    }

    #sec1 {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background-color:black;
    }
    .nav-item{
         padding-right: 1.5rem;
    padding-left: 1.5rem;
    }
    .nav-item:hover{
          /*margin-left: -14px;*/
    /* border-radius: 71px; */
    /* background: #c318668a; */
    /* box-shadow: inset 9px 9px 21px #901c82, inset -9px -9px 21px #a56b98; */
    border-radius: 71px;
    background: #16988f;
    box-shadow: inset 9px 9px 21px #0f645e,
            inset -9px -9px 21px #1dccc0;
      }
    @media (min-width:900px) {
      #sec1 {
        flex-direction: row;
        margin-left: 10px;
        padding: 10px;
        /*width:10vw;*/
      }
      .nav-item{
    padding-right: 1.5rem;
    padding-left: 1.5rem;
}
      .nav-item:hover{
          /*margin-left: -14px;*/
    /* border-radius: 71px; */
    /* background: #c318668a; */
    /* box-shadow: inset 9px 9px 21px #901c82, inset -9px -9px 21px #a56b98; */
    border-radius: 71px;
    background: #16988f;
    box-shadow: inset 9px 9px 21px #0f645e,
            inset -9px -9px 21px #1dccc0;
      }

      .box {
        width: 30vw;
      }

      .container1 {
        width: 30vw;
        margin-left: auto;
        background-image:linear-gradient(black,grey);
        /*margin-bottom:10vh;*/
        
        
        
      }

    }

    .copyright {
      margin-top: 10vh;
      display: flex;
      flex-direction: column;
      margin-left: 10px;
      color: aliceblue;
      color: white;
      align-items: center;
      justify-content: center;
    }

    .form-container {
      margin: 10px;
    }

    #Next {
      /*width:100px;*/
      height: 100px;
      background-color: orange;
      /*margin-left:10px;*/
    }

    #line {
      height: 10px;
      background-color: orange;
    }
    #Start{
        display:flex;
        justify-content:center;
        align-items:center;
        /*height:40vh;*/
      background: rgba( 255, 255, 255, 0.67 );
box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
backdrop-filter: blur( 0.0px );
-webkit-backdrop-filter: blur( 0.0px );
border-radius: 10px;
border: 1px solid rgba( 255, 255, 255, 0.18 );
    }
    .copyright {
      /*border-radius: 71px;*/
      background: #16988f;
      box-shadow: inset 9px 9px 21px #0f645e,
        inset -9px -9px 21px #1dccc0;
    }
  </style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Shreyansh Techz</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active" style="
    margin-left: -4px;
    /* border-radius: 71px; */
    /* background: #c318668a; */
    /* box-shadow: inset 9px 9px 21px #901c82, inset -9px -9px 21px #a56b98; */
    border-radius: 71px;
    background: #16988f;
    box-shadow: inset 9px 9px 21px #0f645e,
            inset -9px -9px 21px #1dccc0;
">
              <a class="nav-link" href="register.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
      
            
           
          </ul>
        </div>
      </nav>
<div class="bg">

    <div class="head">
        <div id="Start"data-aos="flip-left"
     data-aos-easing="ease-out-cubic"
     data-aos-duration="2000">SignUp To DigiInsta</div>
        <div class="login">
               <div class="form-container">
              <h3>Register</h3>
              <form action="register.php" method="post">
              <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>"
              <label>Username</label>
              <input type="text" name="username" class="form-control" value="<?php echo $username;?>">
              <span class="help-block"><?php echo $username_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>"
              <label>UserEmail</label>
              <input type="Email" name="email" class="form-control" value="<?php echo $email;?>">
              <span class="help-block"><?php echo $username_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
              <label>Password</label>
              <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
              <span class="help-block"><?php echo $password_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
              <label>Confirm Password</label>
              <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
              <span class="help-block"><?php echo $confirm_password_err; ?></span>
              </div>
              <div class="form-group">
              <input type="submit" class="btn btn-info" value="Register" name="register">
              <input type="reset" class="btn btn-warning" value="Reset">
              </div>
              <p>Already a member? <a href="login.php">Login here</a>.</p>
              </form>            
            </div></div>
    </div>
</div></div><br><br><hr>
<section style="background-color:#16988f;align-items:center;display: flex;flex-direction: column;">
    <div class="copyright container1"data-aos="flip-left"
     data-aos-easing="ease-out-cubic">
      <span>&#169Copyright Belongs To Shreyansh Techz</span>
      <span> A project of Shreyansh Techz Venture</span>
      <span> Our Mailing Address</span>
      <a href="mailto:shreyansh.fractal2000@gmail.com">emailHelp</a>
    </div>
    <hr>
  </section>
  <div id="Next"></div>
   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
<!-- <p>This example creates a full page background image. Try to resize the browser window to see how it always will cover the full screen (when scrolled to top), and that it scales nicely on all screen sizes.</p> -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "b5b6f302-da39-410d-976e-6056c1a666a9",
      safari_web_id: "web.onesignal.auto.54cd441e-7f12-4aed-9845-f98eb5c10ecb",
      notifyButton: {
        enable: true,
      },
    });
  });
</script>
</body>
</html>
