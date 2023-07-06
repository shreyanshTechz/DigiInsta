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
$bool = 0;
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$user = $_SESSION['username'];
// echo $user , $_SESSION['clicked'];
$id=$_SESSION['clicked'];
$sql = $db->query("select * from users where id='$id'");
$data=$sql->fetch_assoc();
$sql=$db->query("select friends,friend_req from users where name='$user'");
$friend_data=$sql->fetch_assoc();
// echo $friend_data;
$xref = (explode(',',$friend_data['friends']));
$xrer = (explode(',',$friend_data['friend_req']));
if(in_array("$id",$xref)) $bool=1;
if(in_array("$id",$xrer)) $bool=2;
function messagrw($userid,$user){
        $content      = array(
        "en" => ''.$user.' has requested to follow you ',
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
};
if(isset($_POST['unfollow'])){
        $frdv=",".$id;
        $sql = $db->query("SELECT friends from users where name='$user'");
        $img_data = $sql->fetch_assoc();
        
        $main_string = $img_data['friends'];
        $remove_string = ",".$id;
        $new=str_replace($remove_string, " ", $main_string);
        $db->query("update users set friends = '$new' where name = '$user'");
        // $r=messagrw($useridt,$user);
        exit();
}
if(isset($_POST['frid'])){
    $frdv=",".$id;
    $db->query("update users set friend_req = concat(friend_req,'$frdv') where name = '$user'");
    $sql = $db->query("SELECT userId from users where id='$id'");
$img_data = $sql->fetch_assoc();
$useridt = $img_data['userId'];
    $r=messagrw($useridt,$user);
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styleu.css">
    <title>DIGI INSTA WELCOMES YOU</title>
</head>

<body>

                    <div class="grid-container">
                         <div class="imgclass" style="background:black;"><img class="logo" style="width:30vw" src="logo.png"></div>
           
            <a href = "index.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/68/86/49/240_F_268864992_LW8zrb4ptCVjRMN3h6zDLbDFVRd45JOH.jpg"></a>
            <a href = "chatting.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/04/07/59/77/240_F_407597763_ui4HZq5LnavX8Uv3hNNiDYhKYilAhkiR.jpg"></a>
            <a href="vibra.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/68/87/07/240_F_268870763_IUgW17MNkw0rFQWfbplwdc0ZodfUVOCd.jpg"></a>
            <a href = "yourpro.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/48/55/79/240_F_248557937_JIRxzMX2NVPXxoHS9SijR1eYnKUXcxgl.jpg"></a>
            <a href = "logout.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/22/46/27/240_F_222462743_FAD151Nvec04PyUao7lcJiD3p9WrqpQv.jpg"></a>

        </div>
    <div class="container">
        <div class="pro">
            <img class="profilepic" src="<?php if($data['images']=="") $data['images']="the.jpg"; echo $data['images']; ?>" title="" width="200" height="200" class="img-responsive" />
        </div>
        <hr>
        <h1><a><?php echo $data['name'] ?></a></h1>
        <h3><?php echo $data['bio']?></h3>
    </div><div style="display:flex; justify-content:center;">
    <div class="line">
        <div class="circle" data-aos="fade-right">
            <h1>P</h1>
        </div>
        <div class="circle" data-aos="fade-right">
            <h1>R</h1>
        </div>
        <div class="circle" data-aos="fade-right">
            <h1>O</h1>
        </div>
        <div class="circle" data-aos="fade-right">
            <h1>F</h1>
        </div>
        <div class="circle" data-aos="fade-left">
            <h1>I</h1>
        </div>
        <div class="circle" data-aos="fade-left">
            <h1>L</h1>
        </div>
        <div class="circle" data-aos="fade-left">
            <h1>E</h1>
        </div>
    </div></div><br><br>
    <?php if($bool==1)echo
    '<div id="content1" style="background-color: #black;">
                <div class="buttons" style="display:flex;">
                    <div>
                        <button id="upload5" style="    font-family: cursive;
    margin-left: 10px;">
                            <a href="chat.php" style="color:white;">Message</a>
                        </button>
                    </div>
                    <div>
                        <button id="upload5" class="unfollow" style="    font-family: cursive;
    margin-left: 10px;">
                            Unfollow
                        </button>
                    </div>
                </div>
            </div>';
            else if($bool==2) echo '<div id="content1" style="background-color: black;">
                <div class="buttons" style="display:flex;">
                    <div>
                        <button id="upload5" class="follow" style="    font-family: cursive;
    margin-left: 10px; background-color:black;">
                            Requested
                        </button>
                    </div>
                </div>
            </div>';
            else echo '<div id="content1" style="background-color: black;">
                <div class="buttons" style="display:flex;">
                    <div>
                        <button id="upload5" class="follow" style="    font-family: cursive;
    margin-left: 10px;">
                            Follow
                        </button>
                    </div>
                </div>
            </div>'
    ?>
    <section class="Post">
        <div class="first" id="firstw">
            <h1><a>POSTS</a></h1>>>>>>>>>>>><<<<<<<<<<
            <?php
            function create($data)
            {
                global $db;
                $sql = $db->query("SELECT images from users where name='" . $data['username'] . "'");
                $img_data = $sql->fetch_assoc();
                $img_src = $img_data['images'];
                $caption = Emoji::Decode($data['caption']);
                $response = '<hr>
            <div class="first" id="firstw">
            <div class="username">
                <img class="small" src="' . $img_src . '" alt="" srcset="">
                <a class="name" href="">' . $data['username'] . '</a>
            </div>
            <div><span>' . $data['time'] . '<span></div>
            <div class="box" data-aos="fade-right">
                <div class="first1" data-aos="fade-right">
                    <img class="img" src="' . $data['file'] . '" alt="" srcset="" data-aos="flip-left">
                </div>
            </div>
            <div class="captiondiv">
                <span class="User" data-aos="fade-right">' . $data['username'] . '</span>
                <div class="caption" data-aos="fade-right">' . $caption . '</div>
            </div><br>
            <div>
            <div id="mainCommentl'.$data['photoID'].'7">
                
            </div>
            
            '
                ;
                $response2 = '<hr>
            <div class="first" id="firstw">
            <div class="username">
                <img class="small" src="' . $img_src . '" alt="" srcset="">
                <a class="name" href="">' . $data['username'] . '</a>
            </div>
                        <div><span>' . $data['time'] . '<span></div>

            <div class="box" data-aos="fade-right">
                <div class="first1" data-aos="fade-right">
                    <video class="img iframe"width="320" height="240" controls><source src="' . $data['file'] . '" type="video/mp4" data-aos="flip-left"></video>
                </div>
            </div>
            <div class="captiondiv">
            <span class="User" data-aos="fade-right">' . $data['username'] . '</span>
                <div class="caption" data-aos="fade-right">' . $caption. '</div>
            </div><br>
            <div>
            
            <div id="mainCommentl'.$data['photoID'].'7">
                
            </div>
            
            
            '
            
            ;
                $str = $data['file'];
                $s = substr($str, -3);
                if ($s == "mp4")
                    echo $response2;
                else
                    echo $response;
            }
            function createn($comment_data){
                global $db;
                 $sql = $db->query("SELECT images from users where name='" . $comment_data['user'] . "'");
                $img_data = $sql->fetch_assoc();
                $comment = Emoji::Decode($comment_data['comment']);
                $img_src = $img_data['images'];
                $response = '<div class="okkkkk"><div class="userphoto"><img class="small" src="' . $img_src . '" alt="" srcset=""></div><div class="useri">'.$comment_data['user'].'</div><div class="commenti"> '.$comment.'</div></div>
                ';
                echo $response;
            }
            if($bool==1){
             $sql=$db->query("select * from photos where userid='$id'");
             while($datag=$sql->fetch_assoc()){
                 create($datag);
                 $Idm=$datag['photoID'];
                 $sqlp=$db->query("SELECT * from usercomment where ID=$Idm");
                $comment_data = $sqlp->fetch_assoc();
                echo '<div class="commentary">';
                while ($comment_data = $sqlp->fetch_assoc())
                createn($comment_data);
                echo '</div>';
                echo '<div class="area col-md-12">
                    <textarea class="area2 form-control" id="mainCommentl'.$datag['photoID'].'" placeholder="Comment on this Post" cols="30" rows="2"></textarea><br>
                    <button style="float:right" class="addCommentl btn-primary btn" onclick="photoID ='.$datag['photoID'].';" name="addCommentl">Add Comment</button>
                </div><hr>';
             }
            }
            else{
                echo '<div class="hide"><div><img src="https://th.bing.com/th/id/OIP.4jC_Bo1CckhIbkGyhi_L-QHaHa?w=166&h=180&c=7&r=0&o=5&pid=1.7"></div><div class="hidec">Follow to See Posts</div>';
            }
            ?>
            
            
         </div>   
    </section>
    <!--<h1>display: grid</h1>-->

<!--<p>Use display: grid; to make a block-level grid container:</p>-->

<!--<div class="grid-container">-->
<!--  <div class="grid-item">1</div>-->
<!--  <div class="grid-item">2</div>-->
<!--  <div class="grid-item">3</div>  -->
<!--  <div class="grid-item">4</div>-->
<!--  <div class="grid-item">5</div>-->
<!--  <div class="grid-item">6</div>  -->
<!--  <div class="grid-item">7</div>-->
<!--  <div class="grid-item">8</div>-->
<!--  <div class="grid-item">9</div>  -->
<!--</div>-->

</body>
 <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <hr>
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
var videos = document.getElementsByTagName("video"), fraction = 0.8;
      
      function checkScroll() {
      
        for(var i = 0; i < videos.length; i++) {
          var video = videos[i];
          var x = 0,
              y = 0,
              w = video.offsetWidth,
              h = video.offsetHeight,
              r, //right
              b, //bottom
              visibleX, visibleY, visible,
              parent;

            parent = video;
            while (parent && parent !== document.body) {
              x += parent.offsetLeft;
              y += parent.offsetTop;
              parent = parent.offsetParent;
            }
          
            r = x + w;
            b = y + h;
          
            visibleX = Math.max(0, Math.min(w, window.pageXOffset + window.innerWidth - x, r - window.pageXOffset));
            visibleY = Math.max(0, Math.min(h, window.pageYOffset + window.innerHeight - y, b - window.pageYOffset));

            visible = visibleX * visibleY / (w * h);

            if (visible > fraction) {
                video.play();
            } else {
                video.pause();
            }
        }
      
      }
      
      window.addEventListener('scroll', checkScroll, false);
      window.addEventListener('resize', checkScroll, false);

      //check at least once so you don't have to wait for scrolling for the video to start
      window.addEventListener('load', checkScroll, false);
      checkScroll();
      
      </script>
    <script>
        $(document).ready(function(){
            
           $('.addCommentl').on('click' , function(){
                navigator.vibrate(1000);
               
               var commentl;
               var f='#mainCommentl'+photoID;
               var g='#mainCommentl'+photoID+"7";
               var newcomment = commentl;
               var newphoto = photoID;
            //   alert("Clicked in an element of the class.");
               commentl=$(f).val();
               
               $.ajax({
                   url : 'index.php',
                   method:'POST',
                   dataType : 'text',
                   data : {
                       addCommentl:1,
                       commentl : commentl,
                       photoId : photoID
                   },
                   success : function(response){
                                
                                alert("POSTED")
                                $(g).prepend(response);
                                $(f).val("");                       
                   }
               });
                $.ajax({
                url: 'index.php',
                method:'POST',
                dataType: 'text',
                data : {
                    ncommentl:newcomment,
                    nphotoId:newphoto,
                    flag:1,
                },
                    
                success: function(data){
                    
       }
    });
            }); 
            $('.unfollow').on('click' , function(){
                navigator.vibrate(500);
                $.ajax({
           url : 'profile.php',
           method:'POST',
           dataType:'text',
           data : {
               unfollow : 1
           },
           success : function(){
              alert("Unfollowed");
              location.replace("vibra.php");
           }
       });
            });
            $('.follow').on('click',function(){
                navigator.vibrate(500);
                $.ajax({
           url : 'profile.php',
           method:'POST',
           dataType:'text',
           data : {
               frid : 1
           },
           success : function(){
              alert("Requested");
              var f='#upload5';
              $(f).html("Requested");
              $(f).css({'background': 'linear-gradient(145deg,#ffffff,#ddea18)', 'font-size': '11px'});
            //   location.replace("vibra.php");
           }
            });
        });
        });
    </script>