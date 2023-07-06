<?php

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

$sql = $conn->query("SELECT Id from users where name='$user'");
$_data = $sql->fetch_assoc();
$usergid = $_data['Id'];
function messagrw($userid,$user){
        $content      = array(
        "en" => ''.$user.' has Accepted Your follow Request',
    );
    $hashes_array = array();
    $fields = array(
        'app_id' => "b5b6f302-da39-410d-976e-6056c1a666a9",
        'include_player_ids' => array(
            "$userid"
        ),
        'data' => array(
            "foo" => "bar"
        ),
        'contents' => $content,
        'web_buttons' => $hashes_array,
    );
    
    $fields = json_encode($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic YjliMWU0NjgtM2RiNS00ZTcyLThiMWYtMTAxYWM1YjU5N2E5'
        
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    curl_close($ch);
return "done"; 
}
if(isset($_POST['fride'])){
    $frde = $conn->real_escape_string($_POST['fride']);
    echo $frde;
    $frdv=",".$usergid;
    $conn->query("update users set friends = concat(friends,'$frdv') where id = '$frde'");
    $sql = $conn->query("SELECT userId,friend_req from users where id=$frde");
$img_data = $sql->fetch_assoc();
$useridt = $img_data['userId'];
$main_string = $img_data['friend_req'];
$remove_string = ",".$usergid;
$new=str_replace($remove_string, " ", $main_string);
$conn->query("update users set friend_req = '$new' where id = '$frde'");
    $r=messagrw($useridt,$user);
    exit($frde);
}
if(isset($_POST['frided'])){
    $frided = $conn->real_escape_string($_POST['frided']);
    $sql = $conn->query("SELECT friend_req from users where id='$frided'");
    $datafreq = $sql->fetch_assoc();
    $main_string = $datafreq['friend_req'];
    $remove_string = ",".$usergid;
    $new=str_replace($remove_string, " ", $main_string);
    $conn->query("update users set friend_req = '$new' where id = '$frided'");
    exit();
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DIGI USERS</title>
    <meta name="viewport" content="width=device-width">
     <!--<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>-->
      <link rel="stylesheet" href="styleu.css">
    <style>
    
@import url('https://fonts.googleapis.com/css2?family=Creepster&family=Rampart+One&display=swap');
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style>
    body{
         background-image: linear-gradient(-90deg , black,darkblue);
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
                   border-radius:100%;
            width: 80%;
            height: 90%;
        }
        @media(min-width: 600px) {
 .icon {
    width : 5vw;
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
 , #ffffff, #92fffa);
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
    
    .butyd{
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
    right:70px;
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
    #line{
        background-color: azure;
    width: 100vw;
    height: 10px;
    }
</style>
</head>

<body>
    <section id="sec1">
        <div class="centers">
        <div class="grid-container">
            
            <div class="imgclass"><img class="logo" src="logo.png"></div>
            <a href = "index.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/68/86/49/240_F_268864992_LW8zrb4ptCVjRMN3h6zDLbDFVRd45JOH.jpg"></a>
            <a href = "chatting.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/04/07/59/77/240_F_407597763_ui4HZq5LnavX8Uv3hNNiDYhKYilAhkiR.jpg"></a>
            <a href="vibra.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/68/87/07/240_F_268870763_IUgW17MNkw0rFQWfbplwdc0ZodfUVOCd.jpg"></a>
            <a href = "yourpro.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/48/55/79/240_F_248557937_JIRxzMX2NVPXxoHS9SijR1eYnKUXcxgl.jpg"></a>
            <a href = "logout.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/22/46/27/240_F_222462743_FAD151Nvec04PyUao7lcJiD3p9WrqpQv.jpg"></a>

        </div>
    </div>
        <div id="head1"><div>Friend Requests</div></div>
        <div id="blank"></div>
        <div class="centers">
        <div class="grid-container whu">
            <a href = "accept.php"><img class="icon grid-item" src="https://cdn-icons-png.flaticon.com/128/3437/3437315.png"></a>
            <a href = "friends.php"><img class="icon grid-item" src="https://cdn-icons-png.flaticon.com/128/3437/3437367.png"></a>
            <a href="followers.php"><img class="icon grid-item active" src="https://cdn-icons-png.flaticon.com/128/5671/5671776.png"></a>

        </div>
    </div>
    </section>
    <section id="list">
        <?php
                // echo($SESSION['username']);
                function createn($data,$userdata,$user){
                $id=$userdata['id'];
                if($data['name']==$user) return;
                $xreq = (explode(',',$data['friend_req']));
                $xref = (explode(',',$data['friends']));
                if(in_array($id,$xreq)){
                if($data['images']=="") $data['images']="the.jpg";
                $response = '<div class="okkkkk" id="okkkkk'.$data['id'].'"><div class="userphoto"><img class="small" src="'. $data['images'].'" alt="" srcset=""></div><div class="useri">'.$data['name'].'</div><button class="butyd" onclick="photoIDe ='.$data['id'].';" id="mainCommentle'.$data['id'].'">Decline</button><button style="float:right" class="buty" onclick="photoID ='.$data['id'].';" id="mainCommentl'.$data['id'].'">Accept</button></div>
                ';
                    
                }
                
                else return;
                echo $response;
            }
            $sql = $conn->query("SELECT * from users where name='$user'");
            $userdata=$sql->fetch_assoc();
            $sql=$conn->query("SELECT * from users");
            while($data = $sql->fetch_assoc()){
                createn($data,$userdata,$user);
            }
            echo '<div id=message><div>Refresh The Page To See New Requests</div></div>'
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
        $('.buty').on('click' , function(){
                navigator.vibrate(1000);
               
               var commentl;
               var yu="#okkkkk"+photoID;
              var f='#mainCommentl'+photoID;
              $(f).html("Accepted");
                // alert(photoID);
                $.ajax({
                        url: 'accept.php',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            fride : photoID
                        },
                        success: function(response) {
                            console.log(response);
                            $(yu).hide();
                            $('#fufu').hide();
                        }
        });
    });
     $('.butyd').on('click' , function(){
                navigator.vibrate(1000);
               
               var commentl;
               var yu="#okkkkk"+photoIDe;
            //   var f='#mainCommentle'+photoID;
            //   $(f).html("Accepted");
                // alert(photoID);
                $.ajax({
                        url: 'accept.php',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            frided : photoIDe
                        },
                        success: function(response) {
                            console.log(response);
                            $(yu).hide();
                        }
        });
    });
    //     $('.butyd').on('click' function(){
    //   navigator.vibrate(500);
    //   var t = '#mainCommentle'+photoIDe;
    //   $.ajax({
    //       url:'accept.php',
    //       method:'POST',
    //       dataType:'text',
    //       data :{
    //           frided:photoIDe
    //       },
    //       success:function(){
    //           $(t).hide();
    //       }
    //   });
       
    // });
    });
</script>
</html>
