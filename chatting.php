<?php
require_once "emoji.php";
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id17209995_userinp');
define('DB_PASSWORD', 'H2RJmDcSF&Y%H$_c');
define('DB_NAME', 'id17209995_user');
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    echo "Login first";
}

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$user = $_SESSION['username'];
if(isset($_POST['unfollow'])){
        $frdv=",".$id;
        $sql = $conn->query("SELECT friends from users where name='$user'");
        $img_data = $sql->fetch_assoc();
        $id = $conn->real_escape_string($_POST['ID']);
        $main_string = $img_data['friends'];
        $remove_string = ",".$id;
        $new=str_replace($remove_string, " ", $main_string);
        $conn->query("update users set friends = '$new' where name = '$user'");
        // $r=messagrw($useridt,$user);
        exit();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DIGI USERS</title>
    <meta name="viewport" content="width=device-width">
     <!--<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>-->
    <style>
@import url('https://fonts.googleapis.com/css2?family=Creepster&family=Rampart+One&display=swap');
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
      body{
         background-image: linear-gradient(-90deg , black,darkblue);
    }
    .disclaimer{
      display:none;
  }
           img {
    pointer-events: none;
}
                .grid-container{
            width: 100%;
    display: grid;
    grid-template-columns: auto auto auto auto auto auto;
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
               .icon {
            border-radius:140%;
            width: 80%;
            height: 90%;
        }
        @media (min-width: 600px){
.icon{
    width: 5vw;
    height:5vw;
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
</head>

<body>
    <section id="sec1">
         
                        <div class="grid-container">
         <div class="imgclass" style="background:black;"><img class="logo" style="width:20vw" src="logo.png"></div>
                              
            <a href = "index.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/68/86/49/240_F_268864992_LW8zrb4ptCVjRMN3h6zDLbDFVRd45JOH.jpg"></a>
            <a href = "chat.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/04/07/59/77/240_F_407597763_ui4HZq5LnavX8Uv3hNNiDYhKYilAhkiR.jpg"></a>
            <a href="vibra.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/68/87/07/240_F_268870763_IUgW17MNkw0rFQWfbplwdc0ZodfUVOCd.jpg"></a>
            <a href = "yourpro.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/48/55/79/240_F_248557937_JIRxzMX2NVPXxoHS9SijR1eYnKUXcxgl.jpg"></a>
            <a href = "logout.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/22/46/27/240_F_222462743_FAD151Nvec04PyUao7lcJiD3p9WrqpQv.jpg"></a>

        </div>
    </div>
        <!--<div id="head1"><div>Friend Requests</div></div>-->
        <div id="head1"><div>Messenger</div><img class="small click xopp" src="https://cdn-icons-png.flaticon.com/128/2190/2190552.png" alt="" srcset=""></div>
            <div id="blank" style="display:flex; justify-content:center; color:white" >You Can Only Message To Your Followings</div>
        <div class="center">
        <!--<div class="grid-container whu">-->
        <!--    <a href = "accept.php"><img class="icon grid-item" src="https://cdn-icons-png.flaticon.com/128/3437/3437315.png"></a>-->
        <!--    <a href = "friends.php"><img class="icon grid-item" src="https://cdn-icons-png.flaticon.com/128/3437/3437367.png"></a>-->
        <!--    <a href="followers.php"><img class="icon grid-item active" src="https://cdn-icons-png.flaticon.com/128/5671/5671776.png"></a>-->

        <!--</div>-->
    </div>
    </section>
    <section id="list">
            <?php
                // echo($SESSION['username']);
                function createn($data,$userdata,$user,$conn){
                    $id=$data['id'];
                    $userids=$userdata['id'];
                $sql = $conn->query("SELECT * FROM `messages` WHERE `incoming_msg_id`=$userids and outgoing_msg_id=$id OR incoming_msg_id=$id and outgoing_msg_id=$userids ORDER BY msg_id DESC LIMIT 0,1");
                $lastmsg = $sql->fetch_assoc();
                $msg = $lastmsg['msg'];
                $msg=Emoji::Decode($msg);
                if(strtolower($data['name'])==strtolower($user)) return;
                $xref = (explode(',',$userdata['friends']));
                // echo $xref;
                if($data['images']=="") $data['images']="the.jpg";
                if($data['active']==0) $srh=0;
                else $srh=1;
                if(in_array($id,$xref)){
                    if($data['image']=="") $data['image']="the.jpg";
                    $response = '<div class="okkkkk" id="okkkkk'.$data['id'].'"><div class="userphoto click" onclick="clicked ='.$data['id'].';"><img class="small click" onclick="clicked ='.$data['id'].';" src="'. $data['images'].'" alt="" srcset=""></div><div class="meed"><div class="useri click" onclick="clicked ='.$data['id'].';">'.$data['name'].'</div><div class="msg">'.$msg.'</div></div></div>
                ';
                }

                    
               
                echo $response;
            }
            $sql = $conn->query("SELECT * from users where name='$user'");
            $userdata=$sql->fetch_assoc();
            $sql=$conn->query("SELECT * from users");
            
            while($data = $sql->fetch_assoc()){
                createn($data,$userdata,$user,$conn);
            }
        ?>
    </section>
</body>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function(){
        // var clicked=0;
        $('.unfollow').on('click' , function(){
                navigator.vibrate(500);
                var f = "#okkkkk"+ID;
                $.ajax({
           url : 'friends.php',
           method:'POST',
           dataType:'text',
           data : {
               unfollow : 1,
               Id : ID
           },
           success : function(){
               $(f).hide();
              alert("Unfollowed");
              
           }
       });
            });
    $('.click').on('click' , function(){
        // alert(clicked);
       $.ajax({
           url : 'vibra.php',
           method:'POST',
           dataType:'text',
           data : {
               clicked_id : clicked
           },
           success : function(response){
            //   alert(response);
              location.replace("chat.php");
           }
       })
    });
    });
</script>
</html>
