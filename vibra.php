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
function messagrw($userid,$user){
        $content      = array(
        "en" => ''.$user.' has requested to follow you ',
    );
    $hashes_array = array();
    array_push($hashes_array, array(
        "id" => "like-button",
        "text" => "Check Out",
        // "icon" => "https://th.bing.com/th/id/OIP.EHF5lQ7spRnBMjfqJS17PQHaCT?w=349&h=109&c=7&r=0&o=5&pid=1.7",
        "url" => "https://aquacode.000webhostapp.com/accept.php"
    ));
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
if(isset($_POST['clicked_id'])){
    $_SESSION['clicked']=$_POST['clicked_id'];
    echo "fgbfgbfgbfgbgfbf";
    header("Location: profile.php" );
    exit("fgfgftg");
}
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
if(isset($_POST['frid'])){
    $frd = $conn->real_escape_string($_POST['frid']);
    $frdv=",".$frd;
    $conn->query("update users set friend_req = concat(friend_req,'$frdv') where name = '$user'");
    $sql = $conn->query("SELECT userId from users where id=$frd");
$img_data = $sql->fetch_assoc();
$useridt = $img_data['userId'];
    $r=messagrw($useridt,$user);
    exit($frd);
}
?>

<!DOCTYPE html>

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
        background-image: linear-gradient(-90deg , black, purple);

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
        .icono{
    height:90%;
    width:80%;
    border-radius:100%;
}
        @media (min-width: 600px){
.icon{
    width: 5vw;
    height:5vw;
}
.icono{
    height:90%;
    width:23%;
    border-radius:100%;
}
        }
        .logo{
            width:20vw;
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
        .nav-item {
            padding-right: 1.5rem;
            padding-left: 1.5rem;
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
    /*margin-bottom:40px;*/
    }
    #blank{
        height:2vh;
        width:100vw;
        background:black;
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
    .butyk{
        
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
    position: absolute;}
    .butyf{
        background:linear-gradient( 
145deg
 , #ffffff, #69ea18);
    }
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
    .butya{
        display:none;
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
    .active{
        background-color:white;
    }
    .whu{
        /*background:white;*/
        grid-template-columns:auto auto auto;
    }
    .itema{
        width:69%;
        height:57%;
    }
    .imgac{
        border:azure 5px solid;
    }
    #list2{
        display:none;
    }
    #list3{
        display:none;
    }
    #list4{
        display:none;
    }
</style>
<!--<link rel="stylesheet" href="styleu.css">-->
</head>

<body>
    <section id="sec1">
        <div class="center">
             
           
        <div class="grid-container">
            <div class="imgclass" style="background:black;"><img class="logo" style="width:20vw" src="logo.png"></div>
            <a href = "index.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/68/86/49/240_F_268864992_LW8zrb4ptCVjRMN3h6zDLbDFVRd45JOH.jpg"></a>
            <a href = "chatting.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/04/07/59/77/240_F_407597763_ui4HZq5LnavX8Uv3hNNiDYhKYilAhkiR.jpg"></a>
            <a href="vibra.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/68/87/07/240_F_268870763_IUgW17MNkw0rFQWfbplwdc0ZodfUVOCd.jpg"></a>
            <a href = "yourpro.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/48/55/79/240_F_248557937_JIRxzMX2NVPXxoHS9SijR1eYnKUXcxgl.jpg"></a>
            <a href = "logout.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/22/46/27/240_F_222462743_FAD151Nvec04PyUao7lcJiD3p9WrqpQv.jpg"></a>

        </div>
    </div>
        <div id="head1"><div id="hj">Digi Insta Users</div></div>
        <div id="blank"></div>
        <div class="center">
        <div class="grid-container whu">
            <div id="list3f" onclick="change1()"><img class="icono grid-item" src="https://cdn-icons-png.flaticon.com/128/3437/3437315.png"></div>
            <div id="list2f" onclick="change()"><img class="icono grid-item" src="https://cdn-icons-png.flaticon.com/128/3437/3437367.png"></div>
            <div id="list4f" onclick="change2()"><img class="icono grid-item active" src="https://cdn-icons-png.flaticon.com/128/5671/5671776.png"></div>

        </div>
    </div>
    </section>
    <section id="list">
        <?php
                // echo($SESSION['username']);
                function createn($data,$userdata,$user){
                $id=$data['id'];
                if(strtolower($data['name'])==strtolower($user)) return;
                $xreq = (explode(',',$userdata['friend_req']));
                $xref = (explode(',',$userdata['friends']));
                // echo $xref;
                if($data['images']=="") $data['images']="the.jpg";
                if($data['active']==0) $srh=0;
                else $srh=1;
                if(in_array($id,$xreq)){
                
                $response = '<div class="okkkkk"><div class="userphoto click" onclick="clicked ='.$data['id'].';"><img class="small click"  src="'. $data['images'].'" alt="" srcset=""></div><div class="useri click" onclick="clicked ='.$data['id'].';">'.$data['name'].'</div><div class="butya" id="buty'.$srh.'"></div><button style="float:right" class="butyr" id="mainCommentl'.$data['id'].'">Requested</button></div>
                ';
                    
                }
                else if(in_array($id,$xref)){
                    if($data['image']=="") $data['image']="the.jpg";
                    $response = '<div class="okkkkk"><div class="userphoto click" onclick="clicked ='.$data['id'].';"><img class="small click" onclick="clicked ='.$data['id'].';" src="'. $data['images'].'" alt="" srcset=""></div><div class="useri click" onclick="clicked ='.$data['id'].';">'.$data['name'].'</div><div class="butya" id="buty'.$srh.'"></div><button style="float:right" class="butyf" onclick="photoID ='.$data['id'].';" id="mainCommentl'.$data['id'].'">Friend</button></div>
                ';
                }

                    
                else{
                $response = '<div class="okkkkk"><div class="userphoto click" onclick="clicked ='.$data['id'].';"><img class="small click" onclick="clicked ='.$data['id'].';" src="'. $data['images'].'" alt="" srcset=""></div><div class="useri click" onclick="clicked ='.$data['id'].';">'.$data['name'].'</div><div class="butya" id="buty'.$srh.'"></div><button style="float:right" class="buty" onclick="photoID ='.$data['id'].';" id="mainCommentl'.$data['id'].'">Follow</button></div>
                ';
                }
                echo $response;
            }
            $sql = $conn->query("SELECT * from users where name='$user'");
            $userdata=$sql->fetch_assoc();
            $sql=$conn->query("SELECT * from users");
            
            while($data = $sql->fetch_assoc()){
                createn($data,$userdata,$user);
            }
        ?>
    </section>
    <section id="list2">
            <?php
                // echo($SESSION['username']);
                function createno($data,$userdata,$user){
                $id=$data['id'];
                $number=0;
                if(strtolower($data['name'])==strtolower($user)) return;
                $xref = (explode(',',$userdata['friends']));
                // echo $xref;
                if($data['images']=="") $data['images']="the.jpg";
                if($data['active']==0) $srh=0;
                else $srh=1;
                if(in_array($id,$xref)){
                    $number=$number+1;
                    if($data['image']=="") $data['image']="the.jpg";
                    $response = '<div class="okkkkk" id="okkkkk'.$data['id'].'"><div class="userphoto click" onclick="clicked ='.$data['id'].';"><img class="small click" onclick="clicked ='.$data['id'].';" src="'. $data['images'].'" alt="" srcset=""></div><div class="useri click" onclick="clicked ='.$data['id'].';">'.$data['name'].'</div><div class="butya" id="buty'.$srh.'"></div><button style="float:right" class="unfollow butyf" onclick="ID ='.$data['id'].';" id="mainCommentl'.$data['id'].'">Unfollow</button></div>
                ';
                }

                    
               
                echo $response;
                return $number;
            }
            $sql = $conn->query("SELECT * from users where name='$user'");
            $userdata=$sql->fetch_assoc();
            $sql=$conn->query("SELECT * from users");
            $number=0;
            while($data = $sql->fetch_assoc()){
                $number=$number+createno($data,$userdata,$user);
            }
            if($number==0){
                echo "<div class='info' style='color:white; margin-left:3vw;'>You Do Not Follow Anyone</div>";
            };
        ?>
    </section>
    <section id="list3">
        <?php
                // echo($SESSION['username']);
                function createnp($data,$userdata,$user){
                $id=$userdata['id'];
                $number3=0;
                if($data['name']==$user) return;
                $xreq = (explode(',',$data['friend_req']));
                $xref = (explode(',',$data['friends']));
                if(in_array($id,$xreq)){
                    $number3=$number3+1;
                if($data['images']=="") $data['images']="the.jpg";
                $response = '<div class="okkkkk" id="okkkkkk'.$data['id'].'"><div class="userphoto"><img class="small" src="'. $data['images'].'" alt="" srcset=""></div><div class="useri">'.$data['name'].'</div><button class="butyd" onclick="photoIDe ='.$data['id'].';" id="mainCommentle'.$data['id'].'">Decline</button><button style="float:right" class="butyk" onclick="photoID ='.$data['id'].';" id="mainCommentls'.$data['id'].'">Accept</button></div>
                ';
                    
                }
                
                else return $number3;
                echo $response;
                return $number3;
            }
            $sql = $conn->query("SELECT * from users where name='$user'");
            $userdata=$sql->fetch_assoc();
            $sql=$conn->query("SELECT * from users");
            $number3=0;
            while($data = $sql->fetch_assoc()){
                $number3=$number3+createnp($data,$userdata,$user);
            }
            echo '<div id=message><div style="color:white; margin-left:20px;">Refresh The Page To See New Requests</div></div>';
            
                echo "<div class='info' id='fufu' style='color:white; margin-left:3vw;'>You have $number3 Follow Requests</div>";
            
        ?>
    </section>
    <section id="list4">
        <?php
                // echo($SESSION['username']);
                function createni($data,$userdata,$user){
                $id=$userdata['id'];
                if(strtolower($data['name'])==strtolower($user)) return;
                // $xreq = (explode(',',$userdata['friend_req']));
                $xref = (explode(',',$data['friends']));
                // echo $xref;
                if($data['images']=="") $data['images']="the.jpg";
                if($data['active']==0) $srh=0;
                else $srh=1;
                $number2=0;
                if(in_array($id,$xref)){
                    $number2=$number2+1;
                    if($data['image']=="") $data['image']="the.jpg";
                    $response = '<div class="okkkkk"><div class="userphoto click" onclick="clicked ='.$data['id'].';"><img class="small click" onclick="clicked ='.$data['id'].';" src="'. $data['images'].'" alt="" srcset=""></div><div class="useri click" onclick="clicked ='.$data['id'].';">'.$data['name'].'</div><div class="butya" id="buty'.$srh.'"></div></div>
                ';
                }

                    
                echo $response;
                return $number2;
            }
            $sql = $conn->query("SELECT * from users where name='$user'");
            $userdata=$sql->fetch_assoc();
            $sql=$conn->query("SELECT * from users");
            $number2=0;
            while($data = $sql->fetch_assoc()){
                $number2=$number2+createni($data,$userdata,$user);
            }
            
            if($number2==0){
                echo "<div class='info' style='color:white; margin-left:3vw;'>You have no Followers</div>";
            };
        ?>
    </section>
</body>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
    function change(){
    var a = document.getElementById("list");
    var b = document.getElementById("list2");
    var f=document.getElementById("list3");
    var l=document.getElementById("list4");
    
    var k=document.getElementById("hj");
    b.style.display = "block";
    k.innerHTML="Your Followings";
    a.style.display = "none";
    f.style.display = "none";
    l.style.display = "none";
    
}
    function change1(){
    var a = document.getElementById("list");
    var b = document.getElementById("list2");
    var f=document.getElementById("list3");
    
    var l=document.getElementById("list4");
    var k=document.getElementById("hj");
    f.style.display = "block";
    k.innerHTML="Friend Requests";
    a.style.display = "none";
    b.style.display = "none";
    l.style.display = "none";
}
function change2(){
        var a = document.getElementById("list");
    var b = document.getElementById("list2");
    var f=document.getElementById("list3");
    
    var l=document.getElementById("list4");
    var k=document.getElementById("hj");
    l.style.display = "block";
    k.innerHTML="Your Followers";
    a.style.display = "none";
    b.style.display = "none";
    f.style.display = "none";
}

    $(document).ready(function(){
        // var clicked=0;
//         function change(){
//     var c = document.getElementById("list2");
//   var contentId = document.getElementById("list");
//     c.style.display = "flex";
    
// contentId.style.display = "none";}
         $('.unfollow').on('click' , function(){
                navigator.vibrate(500);
                var f = "#okkkkk"+ID;
                $.ajax({
           url : 'vibra.php',
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
              location.replace("profile.php");
           }
       })
    });
        $('.buty').on('click' , function(){
                navigator.vibrate(1000);
               
               var commentl;
              var f='#mainCommentl'+photoID;
              $(f).html("Requested");
              $(f).css({'background': 'linear-gradient(145deg,#ffffff,#ddea18)', 'font-size': '11px'});
                // alert(photoID);
                $.ajax({
                        url: 'vibra.php',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            frid : photoID
                        },
                        success: function(response) {
                            console.log(response);
                        }
        });
    });
    
        $('.butyk').on('click' , function(){
                navigator.vibrate(1000);
               
               var commentl;
               var yu="#okkkkkk"+photoID;
              var f='#mainCommentls'+photoID;
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
                        }
        });
    });
     $('.butyd').on('click' , function(){
                navigator.vibrate(1000);
               
               var commentl;
               var yu="#okkkkkk"+photoIDe;
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
              location.replace("profile.php");
           }
       })
    });
    
    });
    
</script>
</html>
