<?php
// session_start();
// if(isset($_SESSION["username"])) { 
// header("location: index.php"); 
// exit;
// }
// Include config file 
require_once "config.php";
$username = $password = "";
$username_err = $password_err = "";
if(isset($_POST["login"]) && $_POST["login"]=="Login") {
$username = trim($_POST["username"]); if(empty(trim($_POST["username"]))) {
$username_err = "Please enter a username.";
}
else{
$username = trim($_POST["username"]);
}
if(empty(trim($_POST["password"]))){
$password_err = "Please enter a password.";
}
else{
$password = trim($_POST["password"]);
}
if(empty($username_err) && empty($password_err)){
$sql = "SELECT name,password,email FROM users WHERE name='$username' OR email='$username'";
$result = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($result); 
if($user){
if($user['password'] === md5($password)){ session_start();
$_SESSION['username'] = $username;
$_SESSION['loggedin']=true;

header('location: index.php');
}
else{
$password_err = "Password is incorrect.";
}}
else{
$username_err = "Username does not exist.";
}
mysqli_close($conn);
}} ?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Otomanopee+One&display=swap');
  </style>
  <style>
@import url('https://fonts.googleapis.com/css2?family=IM+Fell+DW+Pica+SC&display=swap');
</style>
   <style>
@import url('https://fonts.googleapis.com/css2?family=Creepster&family=Rampart+One&display=swap');
</style>
  <!--<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>-->
  <style>
  .disclaimer{
      display:none;
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
     
      color: rgb(2, 7, 16);
      font-family: 'IM Fell DW Pica SC', serif;
      color: white;
      font-size:initial;
      margin-left: 10px;
    }

    .bg {
       background:black;

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

    #head {
     display: none;
    /* margin-left: 5vw; */
    margin-top: 9vh;
    font-size: 10vh;
    color: white;
    font-weight: 900;
    /* align-items: center; */
    justify-content: center;
    }
    #head2 {
     display: none;
    /* margin-left: 5vw; */
    margin-top: 9vh;
    font-size: 10vh;
    color: white;
    font-weight: 900;
    /* align-items: center; */
    justify-content: center;
    }
    
    #upload5{
            border-radius: 150px;
            color:white;
            /*background: black;*/
            /*box-shadow: 3px 11px 4px #5a5a5a, -3px -11px 15px #ffffff;*/
            height: 100px;
            width: 100px;
            /*font-family: 'Rampart One', cursive;*/
            /* From https://css.glass */
background: rgba(204, 200, 200, 0.2);
/*border-radius: 16px;*/
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(5px);
-webkit-backdrop-filter: blur(5px);
border: 1px solid rgba(204, 200, 200, 0.3);
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
    color:white;
    font-family: serif;
    }

    #Start {
      background-color: aliceblue;
      opacity: 0.86;
          font-family: 'Rampart One'
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
    @media (min-width:768px){
        .masterdiv{
            display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    align-items: center;
    height: 100vh;
        }
        .logo{
            margin-left:5vw;
            width:auto;
        }
    }
    
    @media (max-width:768px){
        .logo{
            width:100vw;
        }
}
    .ques{
        display: flex;
        flex-direction:column;
    justify-content: center;
    align-items: center;
    /*top: 34vh;*/
    /*left: 10vw;*/
    /*position: fixed;*/
    animation: 1s ease-out 0s 1 slideInLeft;
}
    
    @keyframes slideInLeft {
        0% {
          transform: translateY(-100vh);
          
        }
        100% {
          transform: translateY(0);
        }
      }
    #entry{
        margin-top:8vh;
        /*top:26%;*/
            /*position: fixed;*/
    /*z-index: 12;*/
    /*background:black;*/
    color: White;
    /*height: 120vh;*/
    /*display: flex;*/
    /*justify-content: center;*/
    /*align-items: center;*/
    /*width: 120vw;*/
    font-family: 'Rampart One';
    /*animation : 1s ease-out 0s 1 colorchange;*/
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
    .yes{
        height:80%;
        width:80%;
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
    #arro{
        height:65px;
        width:auto;
    }
    .copyright {
      border-radius: 71px;
      background: #16988f;
      box-shadow: inset 9px 9px 21px #0f645e,
        inset -9px -9px 21px #1dccc0;
    }
    .arrow{
        position:fixed;
        bottom:14px;
        left:56px;
    }
    .logo{
        /*width: 100vw;*/
    margin-top: 10vh;
    /*left: -19vw;*/
    /*position: fixed;*/
     /*width: 120vw; */
    /*height: 97%;*/
    /*z-index: 0;*/
    }
    /*.imgclass{*/
    /*    top: 0px;*/
    /*display: flex;*/
    /*justify-content: center;*/
    /*align-items: center;*/
    /*z-index: 1000;*/
    /*}*/
    .buttons{
        flex-direction:column;
    }
    .guui{margin-top: 14px;
    display: flex;
    /* justify-content: center; */
    align-items: center;
    font-size: 2rem;
}
    
    
    .guut{
        padding: 14px;
    border-radius: 12px 4px 49px;
    color: white;
    text-decoration:none;
    background: rgba(204, 200, 200, 0.2);
    /* border-radius: 16px; */
    box-shadow: 0 4px 30px rgb(0 0 0 / 10%);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    border: 1px solid rgba(204, 200, 200, 0.3);
    }
    body{
        background-color:#343a40;
    }
  </style>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body style="background-color:black;">
    <div class="masterdiv">
        <div class="imgclass"><img class="logo" src="logo.png"></div>
    <div id="entry">
    
        <div class="ques">
            <div class="buttons" style="display:flex;">
                    <div class="guui" onclick="toggleContent()">
                        <button id="upload5" style="margin-right:10px;" onclick="toggleContent()">
                            <img class="yes" src="https://cdn-icons-png.flaticon.com/128/2754/2754372.png">
                        </button>
                        <div class="guut">Login</div>
                    </div>
                    <div class="guui" onclick="change()">
                        <button id="upload5">
                            <img class="yes no" src="https://cdn-icons-png.flaticon.com/512/4767/4767136.png">
                        </button>
                        <div class="guut">Register</div>
                    </div>
                </div>
        </div>
        <div class="arrow" style="color:black;"><img id="arro" src="https://cdn-icons-png.flaticon.com/512/2413/2413598.png">Click Here To get Notifications</div>
    </div>
    <div id="head">
      <!--<div id="Start" data-aos="fade-left">Welcome To DigiInsta</div>-->
      <div class="login">
        <div class="form-container">
            <!--<div class="logoimg"><img class="logoj" src="image/compress_DIGI INSTA (1).png"></div>-->
          <h3>Login</h3>
          <form action="login.php" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
              <label>Username</label>
              <input type="text" name="username" class="form-control" value="<?php echo $username;?>">
              <span class="help-block">
                <?php echo $username_err; ?>
              </span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
              <label>Password</label>
              <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
              <span class="help-block">
                <?php echo $password_err; ?>
              </span>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-info" value="Login" name="login"><input type="reset"
                class="btn btn-warning" value="Reset">
            </div>
            <!--<p>Not yet a member? <a href="register.php">SignUp</a>.</p>-->
          </form>
        </div>
      </div>
    </div>
    <div id="head2">
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
              <input id="oll" type="Email" name="email" onchange="myFunctionp()" class="form-control" value="<?php echo $email;?>">
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
              <input type="submit" onclick="run()" class="btn btn-info" value="Register" name="register">
              <input type="reset" class="btn btn-warning" value="Reset">
              </div>
              <p>Already a member? <a href="login.php">Login here</a>.</p>
              </form>            
            </div></div>
    </div>
    </div>
    
<form hidden action="https://000webhostapp.us6.list-manage.com/subscribe/post?u=015dde9fe0ec00e575fb754ca&amp;id=3a70848120" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
	<h2>Subscribe</h2>
<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
<div class="mc-field-group">
	<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
</label>
	<input type="email" value="<?php echo $email;?>" name="EMAIL" class="required email" id="mce-EMAIL">
    <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
</div></div></form>
<script>
function run(){
    document.getElementById("mc-embedded-subscribe").click();
}
function myFunctionp() {
  var x = document.getElementById("oll").value;
  document.getElementById("mce-EMAIL").value = x;
}
</script>

  <!--<section id="sec1">-->
  <!--  <div class="container1" data-aos="fade-right"-->
  <!--   data-aos-offset="300"-->
  <!--   data-aos-easing="ease-in-sine">-->
  <!--    <div class="box1">-->
  <!--      <div class="head1"> <a class="box">-->
  <!--          <h1 class="heading">Post Photos</h1>-->
  <!--          <div class="inside">-->
  <!--            Starting A New Platform Where You can Post Photo Vedio Just like Instagram-->
  <!--          </div><br>-->
            <!--<img src="https://iconape.com/wp-content/files/cm/286303/svg/youtube-icon-logo-logo-icon-png-svg.png" alt=""-->
              <!--srcset="" style="height: 10vh; width: auto;">-->
  <!--        </a></div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--  <div class="container1" data-aos="fade-right">-->
  <!--    <div class="box1">-->
  <!--      <div class="head1"><a class="box">-->
  <!--          <h1 class="heading">Share Your Talent</h1>-->
  <!--          <div class="inside">-->
  <!--            Share Your Talent Via Multimedia using Photos and Vedios . ALso Get Likes and Comments on It.-->
  <!--          </div><br>-->
  <!--        </a></div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--  <div class="container1" data-aos="flip-up">-->
  <!--    <div class="box1">-->
  <!--      <div class="head1"><a class="box">-->
  <!--          <h1 class="heading">Make Your Account</h1>-->
  <!--          <div class="inside">-->
  <!--            Make Your Account For Free and Display Your Talent-->
  <!--          </div><br>-->
            <!--<img-->
              <!--src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/18/ISO_C%2B%2B_Logo.svg/306px-ISO_C%2B%2B_Logo.svg.png"-->
              <!--alt="" srcset="" style="height: 10vh; width: auto;">-->
  <!--        </a></div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</section>-->
  <!--<section style="background-color:#16988f;align-items:center;display: flex;flex-direction: column;">-->
    <!--<div class="copyright container1">-->
    <!--  <span>&#169Copyright Belongs To Shreyansh Techz</span>-->
    <!--  <span> A project of Shreyansh Techz Venture</span>-->
    <!--  <span> Our Mailing Address</span>-->
    <!--  <a href="mailto:shreyansh.fractal2000@gmail.com">emailHelp</a>-->
    <!--</div>-->
   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
<!--<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>-->
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>

<script>
  window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "b5b6f302-da39-410d-976e-6056c1a666a9",
    //   safari_web_id: "web.onesignal.auto.54cd441e-7f12-4aed-9845-f98eb5c10ecb",
      notifyButton: {
        enable: true,
      },
    });
  });
 OneSignal.push(function() {
  OneSignal.getUserId(function(userId) {
    console.log("OneSignal User ID:", userId);
    // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316    
  });
});
function change(){
    var c = document.getElementById("head2");
  var contentId = document.getElementById("entry");
    c.style.display = "flex";
    
contentId.style.display = "none";
}
 function toggleContent() {
  var contentId = document.getElementById("entry");
  
  var contentId2 = document.getElementById("head");
  
  
contentId.style.display = "none"; 
contentId2.style.display = "flex"; 

}

</script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
    <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
</body>

</html>