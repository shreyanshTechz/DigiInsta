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
$user = $_SESSION['username'];

$sql = $db->query("select * from users where name='$user'");
$data=$sql->fetch_assoc();
$id=$data['id'];
if (isset($_POST['upload'])) {

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "proimage/" . $filename;
    /* Attempt to dbect to MySQL
    database */
    if($filename!=""){
    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $user = $_SESSION['username'];
    // Get all the submitted data from the form
    $sql = "UPDATE users SET images='$folder' WHERE name='$user'";
    // messagew($userid,1);/
    // Execute query
    mysqli_query($db, $sql);
    // $compressed_img = "proimage/compress_" . $filename;
    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
         
        
    } else {
        $msg = "Failed to upload image";
    }
    }
    $_POST['upload']=0;
}
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
<style>
.grid-container1 {
  display: grid;
  grid-template-columns: auto auto;
  background-color: #2196F3;
  /*padding: 10px;*/
}

.grid-item2 {
  background-color: black;
  /*padding: 10px;*/
  font-size: 30px;
  text-align: center;
  height:auto;
  display:flex;
  justify-content:center;
  align-items:center;
}
.img29{
    width:50vw;
    height:auto;
}
#firstwr{
    display:none;
}
</style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styleu.css">
    <title>DIGI INSTA WELCOMES YOU</title>
</head>

<body>

        <div class="center">
            
           
        <div class="grid-container">
             <div class="imgclass" style="background:black;"><img class="logo" style="width:20vw" src="logo.png"></div>
            <a href = "index.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/68/86/49/240_F_268864992_LW8zrb4ptCVjRMN3h6zDLbDFVRd45JOH.jpg"></a>
            <a href = "chatting.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/04/07/59/77/240_F_407597763_ui4HZq5LnavX8Uv3hNNiDYhKYilAhkiR.jpg"></a>
            <a href="friends.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/68/87/07/240_F_268870763_IUgW17MNkw0rFQWfbplwdc0ZodfUVOCd.jpg"></a>
            <a href = "yourpro.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/48/55/79/240_F_248557937_JIRxzMX2NVPXxoHS9SijR1eYnKUXcxgl.jpg"></a>
            <a href = "logout.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/22/46/27/240_F_222462743_FAD151Nvec04PyUao7lcJiD3p9WrqpQv.jpg"></a>

        </div>
    </div>
    <div class="container">
        <!--<div class="pro">-->
        <!--    <img class="profilepic" src="<?php if($data['images']=="") $data['images']="the.jpg"; echo $data['images']; ?>" title="" width="200" height="200" class="img-responsive" />-->
        <!--</div>-->
        <div class="pro">
            <img class="profilepic" id="pro1" src="<?php if($data['images']=="") $data['images']="the.jpg"; echo $data['images']; ?>" alt="" title="" width="200" height="200" class="img-responsive" />
            <form id="form" method="POST" action="" enctype="multipart/form-data">
                                <input id="filetype" type="file" hidden/ name="uploadfile" value="" />

                                <div>
                                    <button id="submitbutton" type="submit" hidden/ name="upload">
                                        UPLOAD
                                    </button>
                                </div>
                            </form>
                            <!--<form id="form" method="POST" action="" enctype="multipart/form-data">-->
                            <!--    <input type="file" name="uploadfile" value="" />-->

                            <!--    <div>-->
                            <!--        <button type="submit" name="upload">-->
                            <!--            UPLOAD-->
                            <!--        </button>-->
                            <!--    </div>-->
                            <!--</form>-->


        </div>
        <hr>
        <h1><a><?php echo $data['name'] ?></a></h1>
        <h3><?php echo $data['bio']?></h3>
    </div>
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
    </div><br><br>
    <div id="content1" style="background-color:black;">
    <div class="buttons" style="display:flex;">
                    <div>
                        <button id="upload5" style="    
    margin-left: 10px;">
                            <a href="friends.php" style="color:white;">Followings</a>
                        </button>
                    </div>
                    <div>
                        <button id="upload5" class="unfollow" style="    
    margin-left: 10px;">
                            <a href="followers.php" style="color:white;">Followers</a>
                        </button>
                    </div>
                </div>
    </div>
    <section class="Post">
        <div class="first" id="firstwr">
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
                <div class="caption" data-aos="fade-right">' . $caption . '</div>
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
                $img_src = $img_data['images'];
                $comment = Emoji::Decode($comment_data['comment']);
                $response = '<div class="okkkkk"><div class="userphoto"><img class="small" src="' . $img_src . '" alt="" srcset=""></div><div class="useri">'.$comment_data['user'].'</div><div class="commenti"> '.$comment.'</div></div>
                ';
                echo $response;
            }
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
            ?>
            
            
         </div>   
    </section>
    <br> <br>
             <div class="grid-container1" id="grid-container14">
                 <?php $sql=$db->query("select * from photos where userid='$id'");
                 while($datag=$sql->fetch_assoc()){
                     $str = $datag['file'];
                $s = substr($str, -3);
                if ($s == "mp4")
                    echo '<div class="grid-item2"><video class="img29" controls><source src="' . $datag['file'] . '" type="video/mp4" data-aos="flip-left"></video></div>';
                else
                     echo '<div class="grid-item2"><img class="img29" src="' . $datag['file'] . '"></div>';
                 }
  ?></div>
</div>
</body>
 <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <hr>
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
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
    <script type="text/javascript">
        $(document).ready(function(){
               document.getElementById('pro1').addEventListener('click', openDialog);
                function openDialog() {
                    document.getElementById('filetype').click();
                }
                document.getElementById('filetype').addEventListener('change', submitForm);
                function submitForm() {
                    document.getElementById('submitbutton').click();
                }
                document.getElementById('grid-container14').addEventListener('click', openDialog5);
                function openDialog5() {
                    document.getElementById('firstwr').style.display='flex';
                    document.getElementById('grid-container14').style.display='none';
                    
                }
           $('.addCommentl').on('click' , function(){
                navigator.vibrate(1000);
               
               var commentl;
               var f='#mainCommentl'+photoID;
               var g='#mainCommentl'+photoID+"7";
               var newcomment = commentl;
               var newphoto = photoID;
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
            }); 
        });
    </script>
</html>