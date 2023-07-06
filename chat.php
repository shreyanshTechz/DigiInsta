<?php
require_once('emoji.php');
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id17209995_userinp');
define('DB_PASSWORD', 'H2RJmDcSF&Y%H$_c');
define('DB_NAME', 'id17209995_user');
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    echo "Login first";
}
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$user = $_SESSION['clicked'];

$sql = $db->query("select * from users where id='$user'");
$data=$sql->fetch_assoc();
$id=$data['id'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="1.png" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sacramento&family=Special+Elite&display=swap');
    </style>
        <style>
@import url('https://fonts.googleapis.com/css2?family=Creepster&family=Rampart+One&display=swap');
</style>
<style>
@import url('https://fonts.googleapis.com/css2?family=Kavoon&display=swap');
</style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="./vendor/bootstrap.min.css">
  <link rel="stylesheet" href="./indexw.css">
    <style>
           body{
         background-image: linear-gradient(-90deg , black,darkblue);
    }
                .grid-container{
            width: 100%;
    display: grid;
    grid-template-columns: auto auto auto auto auto;
    background-color: #0a0a0a;
    padding: 6px;
    color: blanchedalmond;
    grid-gap: 6px;
        }
        .grid-items{
            background: rgba(255, 255, 255, 0.2);
    border-radius: 100%;
    box-shadow: 0 4px 30px rgb(0 0 0 / 10%);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    /* background-color: rgba(255, 255, 255, 0.8); */
    /* border: 1px solid rgba(0, 0, 0, 0.8); */
    padding: 0px;
    font-size: 2rem;
    text-align: center;
        }
        .disclaimer{
      display:none;
  }
               .icon {
                   border-radius:100%;
            width: 80%;
            height: 90%;
        }
        @media(min-width: 600px) {
 .icon {
    width : 23%;
  }
}
    #message{
        color: aliceblue;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: monospace;
    }
    .okkkkk{
    font-size: 1.2rem;
        height: 100px;
        width: 95vw;
        display: flex;
        flex-direction: row;
        align-items: center;
        color:white;
        
       /* From https://css.glass */
background: rgba(255, 255, 255, 0.2);
border-radius: 16px;
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(5px);
-webkit-backdrop-filter: blur(5px);
border: 1px solid rgba(255, 255, 255, 0.3);
        margin-bottom:20px;
        margin-top:20px;
        padding-left:14px;
        }
    #head1{
        font-family:'Rampart One', cursive;;
        font-size: 2.29rem;
    height: 74px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    background:black;
    }
    #blank{
        height:30px;
        width:100vw;
        background:black;
    }
    .whu{
        /*background:white;*/
        grid-template-columns:auto auto auto;
    }
        .small {
            height: 60px;
    width: 60px;
    border-radius: 100%;
    margin-right: 20px;
        }
    
        .small {
            height: 60px;
    width: 60px;
    border-radius: 100%;
    margin-right: 20px;
        }
    .butyf{
       font-size: 1rem;
    right: 0px;
    /* margin-top: 60px; */
    height: 70px;
    width: 70px;
    /* font-weight: 600; */
    border-radius: 50%;
   background: linear-gradient( 
145deg
 , #ffffff, red);
    /* box-shadow: 20px 20px 42px #7d7d7d, -20px -20px 42px #ffffff; */
    position: absolute;
    }
    .buty{ font-size: 1rem;
    right: 0px;
    /* margin-top: 60px; */
    height: 70px;
    width: 70px;
    /* font-weight: 600; */
    border-radius: 50%;
   background: linear-gradient( 
145deg
 , #ffffff, #92fffa);
    /* box-shadow: 20px 20px 42px #7d7d7d, -20px -20px 42px #ffffff; */
    position: absolute;}
    .butyf{
        background:linear-gradient( 
145deg
 , #ffffff, #69ea18);
    }
    .butyr{
         font-size: 11px;
    right: 0px;
    /* margin-top: 60px; */
    height: 70px;
    width: 70px;
    /* font-weight: 600; */
    border-radius: 50%;
   background: linear-gradient( 
145deg
 , #ffffff, #e6cb0a);
    /* box-shadow: 20px 20px 42px #7d7d7d, -20px -20px 42px #ffffff; */
    position: absolute;
    }
    .butya{
         font-size: 11px;
    right: 95px;
    /* margin-top: 60px; */
    height: 10px;
    width: 10px;
    /* font-weight: 600; */
    border-radius: 50%;
    background: linear-gradient( 
145deg
 , #ffffff, #e6cb0a);
    /* box-shadow: 20px 20px 42px #7d7d7d, -20px -20px 42px #ffffff; */
    position: absolute;
    }
    #buty1{
        background: linear-gradient( 
145deg
 , #ffffff, green);
 
    }
    #buty0{
        background: linear-gradient( 
145deg
 , #ffffff, red);
 
    }
    .xopp{
        position:absolute;
        right:0px;
    }
    .useri{
        font-weight:900;
    }
</style>
    <title>DIGI INSTA WELCOMES YOU</title>
</head>
<body>
    <section id="sec1">
        
                        <div class="grid-container">
            <a href = "index.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/68/86/49/240_F_268864992_LW8zrb4ptCVjRMN3h6zDLbDFVRd45JOH.jpg"></a>
            <a href = "chatting.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/04/07/59/77/240_F_407597763_ui4HZq5LnavX8Uv3hNNiDYhKYilAhkiR.jpg"></a>
            <a href="vibra.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/68/87/07/240_F_268870763_IUgW17MNkw0rFQWfbplwdc0ZodfUVOCd.jpg"></a>
            <a href = "yourpro.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/48/55/79/240_F_248557937_JIRxzMX2NVPXxoHS9SijR1eYnKUXcxgl.jpg"></a>
            <a href = "logout.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/22/46/27/240_F_222462743_FAD151Nvec04PyUao7lcJiD3p9WrqpQv.jpg"></a>

        </div>
    </div>
    </section>
    <section style="
    display: flex;
    justify-content: center;
    flex-direction:column;
">

  <div class="wrapper">
    <section class="chat-area">
      <header>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="<?php echo $data['images']; ?>" alt="">
        <div class="details">
          <span><?php echo $data['name']?></span>
          
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="34" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"><img src="https://cdn-icons-png.flaticon.com/128/786/786407.png" style="
    height: 49%;
    width: 78%;
"></i></button>
      </form>
    </section>
  </div>
   <div class="container">
    <form id="join-form">

      <div class="button-group">
        <button id="join" type="submit" class="btn btn-primary btn-sm">Vedio-Call</button>
        <button id="leave" type="button" class="btn btn-primary btn-sm" disabled>Leave</button>
      </div>
    </form>

    <div class="row video-group">
      <div class="col">
        <p id="local-player-name" class="player-name"></p>
        <div id="local-player" class="player"></div>
      </div>
      <div class="w-100"></div>
      <div class="col">
        <div id="remote-playerlist"></div>
      </div>
    </div>
  </div>
</section>
</body>
<script src="chat.js"></script>
  <script src="./vendor/jquery-3.4.1.min.js"></script>
  <script src="./vendor/bootstrap.bundle.min.js"></script>
  <script src="./AgoraRTC_N-4.7.1.js"></script>
  <script src="./indexw.js"></script>
</html>
