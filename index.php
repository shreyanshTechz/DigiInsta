<?php
require_once('emoji.php');
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id17209995_userinp');
define('DB_PASSWORD', 'H2RJmDcSF&Y%H$_c');
define('DB_NAME', 'id17209995_user');
session_start();
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    echo "Login first";
}


$user = $_SESSION['username'];
$db->query("update users set active=1 where name='$user'");
$sql = $db->query("SELECT images,friends,id from users where name='$user'");
$img_data = $sql->fetch_assoc();
$img_src = $img_data['images'];
$mainuser = $img_data['id'];
$_SESSION['userid']=$mainuser;
$friend_list = (explode(',',$img_data['friends']));
// echo $friend_list;
$msg = "";
$sqlNumPhoto = $db->query("SELECT username FROM photos");
$numPhoto = $sqlNumPhoto->num_rows;
$sql4 = $db->query("SELECT userId from users where name='$user'");
$img_data4 = $sql4->fetch_assoc();
$userid = $img_data4['userId'];
if(isset($_POST['userIdp'])){ $response="fdbgfdggd";
$userid=$_POST['userIdp'];
if($userid) echo "dfkgdgdrgdnfkgnrdfgndk";
$db->query("update users set userId='$userid' where name='$user'");
// echo $userid;
exit($userid);}
function correctImageOrientation($folder, $filename)
{
    $exif = exif_read_data($folder);
    if ($exif && isset($exif['Orientation'])) {
        $orientation = $exif['Orientation'];
        if ($orientation != 1) {
            $img = imagecreatefromjpeg($filename);
            $deg = 0;
            switch ($orientation) {
                case 3:
                    $deg = 180;
                    break;
                case 6:
                    $deg = 270;
                    break;
                case 8:
                    $deg = 90;
                    break;
            }
            if ($deg) {
                $img = imagerotate($img, $deg, 0);
            }
            imagejpeg($img, $filename, 8);
        }
    }
}
function compressImage($source_image, $compress_image)
{
    $image_info = getimagesize($source_image);
    if ($image_info['mime'] == 'image/jpeg') {
        $source_image = imagecreatefromjpeg($source_image);
        imagejpeg($source_image, $compress_image, 35);
    } elseif ($image_info['mime'] == 'image/png') {
        $source_image = imagecreatefrompng($source_image);
        imagepng($source_image, $compress_image, 3);                //for png it should be 0 to 9
    }
    return $compress_image;
}




function messagew($userid,$f){
    if($f==1){
     $content      = array(
        "en" => 'Your Profile Photo has been successfully Uploaded',
    );}
    else if($f==2){
      $content      = array(
        "en" => 'Your Photo is being Uploaded . Please Wait For Some time',
    );  
    }
    else{
        $content      = array(
        "en" => 'Your Post has been successfully Uploaded',
    );
    }
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
return ; 
}
if(isset($_POST['clicked_id'])){
    $_SESSION['clicked']=$_POST['clicked_id'];
    echo "fgbfgbfgbfgbgfbf";
    header("Location: profile.php" );
    exit("fgfgftg");
}
function messageeveryone(){
      $content      = array(
        "en" => 'There Has Been A General Announcement On DigiInsta',
    );  
    $hashes_array = array();
    $fields = array(
        'app_id' => "b5b6f302-da39-410d-976e-6056c1a666a9",
        'included_segments' => array(
            'Subscribed Users'
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
return ; 
}
function message($comment,$id,$user_srcs,$user,$user_src){
    // echo $user , $user_src ;
    if(strtolower($user)==strtolower($user_src)){
        return;
    }
    else{
     $content      = array(
        "en" => ''.$user.' has Commented on Your post',
        // "big_picture" => "$file",	
    );}
    // echo $id;
    $loc="#mainCommentl"."$id"."7";
    $hashes_array = array();
    array_push($hashes_array, array(
        "id" => "like-button",
        "text" => "Check Out",
        "icon" => "https://th.bing.com/th/id/OIP.EHF5lQ7spRnBMjfqJS17PQHaCT?w=349&h=109&c=7&r=0&o=5&pid=1.7",
        "url" => "https://aquacode.000webhostapp.com/index.php$loc"
    ));
    array_push($hashes_array, array(
        "id" => "like-button-2",
        "text" => "login",
        "icon" => "https://mpng.subpng.com/20190601/cha/kisspng-computer-icons-portable-network-graphics-vector-gr-login-icon-png-single-sign-on-icon-539x539-p-5cf3251b60f3f3.4826309215594386193971.jpg",
        "url" => "https://aquacode.000webhostapp.com/login.php"
    ));
    $fields = array(
        'app_id' => "b5b6f302-da39-410d-976e-6056c1a666a9",
        'include_player_ids' => array(
            "$user_srcs"
        ),
        'data' => array(
            "foo" => "bar"
        ),
        'contents' => $content,
        'web_buttons' => $hashes_array,
        // 'chrome_web_image' => $file
    );
    
    $fields = json_encode($fields);
    // print("\nJSON sent:\n");
    // print($fields);
    
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
// $response = sendMessage();
// $return["allresponses"] = $response;
// $return = json_encode($return);

// $data = json_decode($response, true);
// $id = $data['id'];
return ; 
}
if(isset($_POST['liked_id'])){
    $liked_id = $db->real_escape_string($_POST['liked_id']);
    $likes = $db->real_escape_string($_POST['orilike']);
    $newlikes=$likes+1;
    $db->query("update photos set likes = $newlikes where photoID=$liked_id");
    exit($newlikes);
}
if(isset($_POST['addCommentl'])){
    // echo "khbjbbbbkhuhkhk";
    $comment = $db->real_escape_string($_POST['commentl']);
    $var=$comment;
    $Id = $db->real_escape_string($_POST['photoId']);
    $comment= Emoji::Encode($comment);
    $comment = (str_replace("\\","\\\\", $comment));
    $tu=date("Y-m-d",$t);
    // message($var);
    $db->query("INSERT INTO usercomment VALUES ('$Id','$user','$comment',NOW())");
    $comment = $var;
    $response='<div class="okkkkk"><div class="userphoto"><img class="small" src="'.$img_src.'" alt="" srcset=""></div><div class="useri">'.$user.'</div><div class="commenti"> '.$comment.'</div></div>
    
    ';
        $sql = $db->query("SELECT username,file from photos where photoID='$Id'");
$img_data = $sql->fetch_assoc();
$user_src = $img_data['username'];
$sql = $db->query("SELECT userId from users where name='$user_src'");
$img_datas = $sql->fetch_assoc();
$user_srcs = $img_datas['userId'];
// echo $user_srcs;
    message($var,$Id,$user_srcs,$user,$user_src);
    // echo $id;
    $_POST['addCommentl']=0;
    exit($response);
}
if (isset($_POST['upload2'])) {
    // echo "success";
    $caption2 = "rlkgrke";
    $caption = $db->real_escape_string($_POST['caption']);
    $np = $numPhoto + 1;
    // echo $np;
    // $caption =$_FILES["caption"];
    // echo $caption;
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "image/" . $filename;
    $str = $filename;
    $s = substr($str, -3);

    if ($str != "" and ($s == "jpg" or $s == "peg" or $s == "mp4" or $s == "png" or $s="iec")) {
            messagew($userid,2);
        // echo "Please Do Not Enter Wrong Files";
        // 		$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $user = $_SESSION['username'];
        $sql = $db->query("SELECT id from users where name='" . $_SESSION['username'] . "'");
        $data = $sql->fetch_assoc();
        $_SESSION['userID'] = $data['id'];
        $dataid=$data['id'];
        $compressed_img = "image/compress_" . $filename;
        
        
        $caption= Emoji::Encode($caption);
        $caption = (str_replace("\\","\\\\", $caption));
        
        if ($s != "mp4") {
            // echo "gfbfgbbb";
            $db->query("INSERT INTO photos VALUES ('$np','$user','$caption','$compressed_img',NOW(),0,'$dataid')");
        } else {
            // echo "done";
            $db->query("INSERT INTO photos VALUES ('$np','$user','$caption','$folder',NOW(),0,'$dataid')");
        }
        messagew($userid,7);
        if (move_uploaded_file($tempname, $folder)) {
            if ($s != "mp4") {
                $compress_file = "compress_" . $filename;
                $compressed_img = "image/" . $compress_file;
                $compress_image = compressImage($folder, $compressed_img);
                correctImageOrientation($folder, $compress_image);
                unlink($folder);
            }            //delete original file
            $msg = "Image uploaded successfully";
            
        } else {
            $msg = "Failed to upload image";
        }
    }
    $_POST['upload2'] = 0;
}
$sql = "select images from users WHERE name='$user'";
$result = mysqli_query($db, $sql);
$folder = mysqli_fetch_assoc($result);
$folder = $folder['images'];
if($folder=="") $folder="https://cdn-icons-png.flaticon.com/128/3237/3237447.png";
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
    messagew($userid,1);
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

function createCommentRow($data)
{
    global $db;
    $comment = Emoji::Decode($data['comment']);
    $response = '
            <div class="comment" data-aos="fade-right">
                <div class="user"><div>' . $data['name'] . '</div> <span class="time">' . $data['createdOn'] . '</span></div>
                <div class="userComment">' . $comment. '</div>
                <div class="reply"><a href="javascript:void(0)" data-commentID="' . $data['id'] . '" onclick="reply(this)">REPLY</a></div>
                <div class="replies">';
    $sql = $db->query("SELECT id from users where name='" . $_SESSION['username'] . "'");
    $datam = $sql->fetch_assoc();
    $_SESSION['userID'] = $datam['id'];
    // echo $data['id'];
    $sql = $db->query("SELECT replies.id, name, comment,DATE_FORMAT(replies.createdOn, '%Y-%m-%d') AS createdOn FROM replies INNER JOIN users ON replies.userID = users.id WHERE replies.commentID = '" . $data['id'] . "' ORDER BY replies.id DESC LIMIT 1");
    // $dataR = $sql->fetch_assoc();
    // echo $dataR['name'];
    // echo "Heloo";
    while ($dataR = $sql->fetch_assoc()) {
        // echo $dataR['comment'];
        // echo "cbjas";
        $response .= createCommentRow($dataR);
    }

    $response .= '
                        </div>
            </div>
        ';

    return $response;
}

if (isset($_POST['getAllComments'])) {
    $start = $db->real_escape_string($_POST['start']);

    $response = "";
    $sql = $db->query("SELECT comments.id, name, comment, DATE_FORMAT(comments.createdOn, '%Y-%m-%d') AS createdOn FROM comments INNER JOIN users ON comments.userID = users.id ORDER BY comments.id DESC LIMIT $start, 20");
    while ($data = $sql->fetch_assoc())
        $response .= createCommentRow($data);
    // echo $response;

    exit($response);
}

if (isset($_POST['addComment'])) {
    $comment = $db->real_escape_string($_POST['comment']);
    $isReply = $db->real_escape_string($_POST['isReply']);
    $commentID = $db->real_escape_string($_POST['commentID']);
    $comment= Emoji::Encode($comment);
    $comment = (str_replace("\\","\\\\", $comment));
    if ($isReply != 'false') {
        $db->query("INSERT INTO replies (comment, commentID, userID, createdOn) VALUES ('$comment', '$commentID', '" . $_SESSION['userID'] . "', NOW())");
        $sql = $db->query("SELECT replies.id, name, comment, DATE_FORMAT(replies.createdOn, '%Y-%m-%d') AS createdOn FROM replies INNER JOIN users ON replies.userID = users.id ORDER BY replies.id DESC LIMIT 1");
    } else {
        $db->query("INSERT INTO comments (userID, comment, createdOn) VALUES ('" . $_SESSION['userID'] . "','$comment',NOW())");
        $sql = $db->query("SELECT comments.id, name, comment, DATE_FORMAT(comments.createdOn, '%Y-%m-%d') AS createdOn FROM comments INNER JOIN users ON comments.userID = users.id ORDER BY comments.id DESC LIMIT 1");
    }
    messageeveryone();
    $data = $sql->fetch_assoc();
    exit(createCommentRow($data));
}
$sqlNumComments = $db->query("SELECT id FROM comments");
$numComments = $sqlNumComments->num_rows;
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
        <!--<div class="loader"></div>-->
        
    <div class="center">
        
        <div class="grid-container">
            <div class="imgclass"><img class="logo" src="logo.png"></div>
            <a href = "index.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/68/86/49/240_F_268864992_LW8zrb4ptCVjRMN3h6zDLbDFVRd45JOH.jpg"></a>
            <a href = "chatting.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/04/07/59/77/240_F_407597763_ui4HZq5LnavX8Uv3hNNiDYhKYilAhkiR.jpg"></a>
            <a href="vibra.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/68/87/07/240_F_268870763_IUgW17MNkw0rFQWfbplwdc0ZodfUVOCd.jpg"></a>
            <a href = "yourpro.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/48/55/79/240_F_248557937_JIRxzMX2NVPXxoHS9SijR1eYnKUXcxgl.jpg"></a>
            <a href = "logout.php"><img class="icon grid-item" src="https://t4.ftcdn.net/jpg/02/22/46/27/240_F_222462743_FAD151Nvec04PyUao7lcJiD3p9WrqpQv.jpg"></a>

        </div>
    </div>
    <div class="container">
        
        <hr>
        <!--<div class="loader"></div>-->
        <div class="pro">
            <img class="profilepic" id="pro1" src="<?php echo $folder; ?>" alt="" title="" width="200" height="200" class="img-responsive" />
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

        <h1><a><?php echo $_SESSION['username'] ?></a></h1>
        <h3>Post Something <br>Show Your Talent To World</h3>
    </div><div style="display:flex; justify-content:center;">
    <div class="line">
        <div class="circle" data-aos="fade-right">
            <h1 style="color:bisque;">W</h1>
        </div>
        <div class="circle" data-aos="fade-right">
            <h1 style="color:bisque;">E</h1>
        </div>
        <div class="circle" data-aos="fade-right">
            <h1 style="color:bisque;">L</h1>
        </div>
        <div class="circle" data-aos="fade-right">
            <h1 style="color:bisque;">C</h1>
        </div>
        <div class="circle" data-aos="fade-left">
            <h1 style="color:bisque;">O</h1>
        </div>
        <div class="circle" data-aos="fade-left">
            <h1 style="color:bisque;">M</h1>
        </div>
        <div class="circle" data-aos="fade-left">
            <h1 style="color:bisque;">E</h1>
        </div>
    </div></div>
    <section class="Post">
        <div class="first" id="firstw">
            <h1><a>POSTS</a></h1>>>>>>>>>>>><<<<<<<<<<
            <!--<div class="username">-->
            <!--    <img class="small" src="1.png" alt="" srcset="">-->
            <!--    <a class="name" href="">Shreyansh_Pandey</a>-->
            <!--</div>-->
            <!--<div class="box" data-aos="fade-right">-->
            <!--    <div class="first1" data-aos="fade-right">-->
            <!--        <img class="img" src="1.png" alt="" srcset="" data-aos="flip-left">-->
            <!--    </div>-->
            <!--</div>-->
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
            <div class="username click"  onclick="clicked ='.$data['userid'].';">
                <img class="small click"  onclick="clicked ='.$data['userid'].';" src="' . $img_src . '" alt="" srcset="">
                <a class="name click"  onclick="clicked ='.$data['userid'].';" href="">' . $data['username'] . '</a>
            </div>
            <div><span>' . $data['time'] . '<span></div>
            <div class="box" onclick="like ='.$data['photoID'].'; orilike='.$data['likes'].';" data-aos="fade-right">
            <div><img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/0b/Card_heart.svg/1200px-Card_heart.svg.png" class="likeb" id="like'.$data['photoID'].'"></div>
                <div class="first1" data-aos="fade-right">
                    <img class="img" src="' . $data['file'] . '" alt="" srcset="" data-aos="flip-left">
                </div></div><br>
                <div style="height: 10px; display:flex;" class="like">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/0b/Card_heart.svg/1200px-Card_heart.svg.png" style="height: 25px;width: 25px;"><div id="like'.$data['photoID'].'7">'.$data['likes'].' likes</div>        
            </div><br>
            <div class="captiondiv">
                <span class="User click"  onclick="clicked ='.$data['userid'].';" data-aos="fade-right">' . $data['username'] . '</span>
                <div class="caption" data-aos="fade-right">' . $caption. '</div>
            </div><br></div>
            <div>
            <div id="mainCommentl'.$data['photoID'].'7">
               
            </div>
            
            '
                ;
                $response2 = '<hr>
            <div class="first" id="firstw">
            <div class="username click"  onclick="clicked ='.$data['userid'].';">
                <img class="small click"  onclick="clicked ='.$data['userid'].';" src="' . $img_src . '" alt="" srcset="">
                <a class="name click"  onclick="clicked ='.$data['userid'].';" href="">' . $data['username'] . '</a>
            </div>
                        <div><span>' . $data['time'] . '<span></div>

            <div class="box" onclick="like ='.$data['photoID'].'; orilike='.$data['likes'].';" data-aos="fade-right">
            <div><img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/0b/Card_heart.svg/1200px-Card_heart.svg.png" class="likeb" id="like'.$data['photoID'].'"></div>
                <div class="first1" data-aos="fade-right">
                    <video class="img iframe"width="320" height="240" controls><source src="' . $data['file'] . '" type="video/mp4" data-aos="flip-left" onclick="like ='.$data['photoID'].'; orilike='.$data['likes'].';"></video>
                </div><br>
                <div style="height: 10px; display:flex;" class="like">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/0b/Card_heart.svg/1200px-Card_heart.svg.png" style="height: 25px;width: 25px;"><div id="like'.$data['photoID'].'7">'.$data['likes'].' likes</div>
                </div>
            </div><br>
            <div class="captiondiv">
            <span class="User click"  onclick="clicked ='.$data['userid'].';" data-aos="fade-right">' . $data['username'] . '</span>
                <div class="caption" data-aos="fade-right">' . $caption.'</div>
            </div><br></div>
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
             function create2($data)
            {
                global $db;
                $sql = $db->query("SELECT images from users where name='" . $data['username'] . "'");
                $img_data = $sql->fetch_assoc();
                $img_src = $img_data['images'];
                $caption = Emoji::Decode($data['caption']);
                $response = '<hr>
            <div class="first" id="firstw">
            <div class="username">
                <img class="small"   src="' . $img_src . '" alt="" srcset="">
                <a class="name"   href="">' . $data['username'] . '</a>
            </div>
            <div><span>' . $data['time'] . '<span></div>
            
            <div class="box" onclick="like ='.$data['photoID'].'; orilike='.$data['likes'].';" data-aos="fade-right">
            <div><img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/0b/Card_heart.svg/1200px-Card_heart.svg.png" class="likeb" id="like'.$data['photoID'].'"></div>
            
                <div class="first1" data-aos="fade-right">
                    <img class="img" src="' . $data['file'] . '" alt="" srcset="" data-aos="flip-left">
                </div>
            </div><br>
                <div style="height: 10px; display:flex;" class="like">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/0b/Card_heart.svg/1200px-Card_heart.svg.png" style="height: 25px;width: 25px;"><div id="like'.$data['photoID'].'7">'.$data['likes'].' likes</div>
                </div>
                
            <br>
            <div class="captiondiv">
                <span class="User"  data-aos="fade-right">' . $data['username'] . '</span>
                <div class="caption" data-aos="fade-right">'.$caption.'</div>
            </div><br>
            <div>
            <div id="mainCommentl'.$data['photoID'].'7">
                
            </div>
            
            '
                ;
                $response2 = '<hr>
            <div class="first" id="firstw">
            <div class="username">
                <img class="small"  onclick="clicked ='.$data['userid'].';" src="' . $img_src . '" alt="" srcset="">
                <a class="name"  onclick="clicked ='.$data['userid'].';" href="">' . $data['username'] . '</a>
            </div>
                        <div><span>' . $data['time'] . '<span></div>

            <div class="box" onclick="like ='.$data['photoID'].'; orilike='.$data['likes'].';" data-aos="fade-right">
            <div><img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/0b/Card_heart.svg/1200px-Card_heart.svg.png" class="likeb" id="like'.$data['photoID'].'"></div>
                <div class="first1" data-aos="fade-right">
                    <video class="img iframe"width="320" height="240" controls><source src="' . $data['file'] . '" type="video/mp4" data-aos="flip-left" onclick="like ='.$data['photoID'].'; orilike='.$data['likes'].';"></video>
                </div></div><br>
                <div style="height: 10px; display:flex;" class="like">
                <img src="https://upload.wikimedia.org/wikipedia/en/thumb/0/0b/Card_heart.svg/1200px-Card_heart.svg.png" style="height: 25px;width: 25px;"><div id="like'.$data['photoID'].'7">'.$data['likes'].' likes</div>
                
            <br></div><br>
            <div class="captiondiv">
            <span class="User"  onclick="clicked ='.$data['userid'].';" data-aos="fade-right">' . $data['username'] . '</span>
                <div class="caption" data-aos="fade-right">'.$caption.'</div>
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
            function createn($comment_data,$mainuser){
                global $db;
                 $sql = $db->query("SELECT images,id from users where name='" . $comment_data['user'] . "'");
                $img_data = $sql->fetch_assoc();
                $comment = Emoji::Decode($comment_data['comment']);
                $img_src = $img_data['images'];
                if($img_data['id']!=$mainuser){
                $response = '<div class="okkkkk"><div class="userphoto click"  onclick="clicked ='.$img_data['id'].';"><img class="small click" onclick="clicked ='.$img_data['id'].';" src="' . $img_src . '" alt="" srcset=""></div><div class="useri click" onclick="clicked ='.$img_data['id'].';">'.$comment_data['user'].'</div><div class="commenti"> '.$comment.'</div></div>
                ';}
                else{
                    $response='<div class="okkkkk"><div class="userphoto"><img class="small" src="' . $img_src . '" alt="" srcset=""></div><div class="useri">'.$comment_data['user'].'</div><div class="commenti"> '.$comment.'</div></div>
                ';
                };
                echo $response;
            }
            $sqlr = $db->query("SELECT * from photos ORDER BY time DESC");
            while ($data = $sqlr->fetch_assoc()){
                $Id=$data['photoID'];
                $userpid=$data['userid'];
                if(in_array($userpid,$friend_list) or $userpid==$mainuser){
                if(in_array($userpid,$friend_list)) create($data,$output);
                else if($userpid==$mainuser) create2($data,$output);
                $sqlp=$db->query("SELECT * from usercomment where ID='$Id'");
                // $comment_data = $sqlp->fetch_assoc();
                echo '<div class="commentary">';
                // echo count($comment_data);
                while ($comment_data = $sqlp->fetch_assoc())
                createn($comment_data,$mainuser);
                echo '</div>';
                echo '<div class="area col-md-12" style="flex-direction:row;">
                    <textarea class="area2 form-control" id="mainCommentl'.$data['photoID'].'" placeholder="Comment on this Post" cols="30" rows="2"></textarea><br>
                    <img class="sent-comment addCommentl" src="https://cdn-icons-png.flaticon.com/128/3814/3814505.png" id="sent-comment" onclick="photoID ='.$data['photoID'].';" name="addCommentl" style="width:auto; pointer-events:auto; height:32px;">
                </div><hr>';
            }
            }
            ?>
        </div>
    </section>
        <div id="content1">
                <h3 id="head3">Lets Connect Socially</h3>
                <div class="buttons" style="display:flex;">
                    <div>
                        <button id="upload5">
                            <a href="vibra.php" style="color:white;">FIND Friends</a>
                        </button>
                    </div>
                    <div>
                        <button id="upload5">
                            <a href="accept.php" style="color:white;">Check Requests</a>
                        </button>
                    </div>
                </div>
            </div>
            <br><br><hr>
            <div id="content1">
                <h3 id="head3">Upload Your Photos Here</h3>
                <form id="form1" method="POST" action="" enctype="multipart/form-data">
                    <input id="id" type="file" hidden/ name="uploadfile" value="" />
                    <img id='buttonid' style="pointer-events:auto;" src="https://cdn-icons-png.flaticon.com/128/685/685686.png">
                    <div class="loader" id="loader1" style="display:none;"></div>
                    <h2 id="loaer" style="display:none;">Now Write Some Caption and click on Upload</h2>
                    <img id='buttonid2' style="margin-bottom:12px; display:none;" src="https://cdn-icons-png.flaticon.com/128/1355/1355667.png">
                    <textarea id="captioninp" style="margin-top:10px;" type="text" placeholder="Enter Some Caption" name="caption"></textarea>
                    <div>
                        <button id="upload2" name="upload2">
                            UPLOAD
                        </button>
                    </div>
                </form>
            </div
    </section>
    <section>
        <div class="container" style="margin-top:50px;">
            
            <div class="row">
                <div class="col-md-12">
                    <h2><b id="numComments"><?php echo $numComments ?> General Announcement and Queries</b></h2>
                    <div class="userComments">

                    </div>
                </div>
            </div>
            <br><hr>
            <div class="row">
                <div class="col-md-12">
                    <textarea class="form-control" id="mainComment" placeholder="Add Public Announcement. This Will be visible to every Digi Users." cols="30" rows="2"></textarea><br>
                    <button style="float:right" class="btn-primary btn" onclick="isReply = false;" id="addComment">Announce</button>
                </div>
            </div>
            <div class="row replyRow" style="display:none">
                <div class="col-md-12">
                    <textarea class="form-control" id="replyComment" placeholder="Add Public Comment" cols="30" rows="2"></textarea><br>
                    <button style="float:right" class="btn-primary btn" onclick="isReply = true;" id="addReply">Add Reply</button>
                    <button style="float:right" class="btn-default btn" onclick="$('.replyRow').hide();">Close</button>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!--<div class="down">-->
    <!--    <div class="grid-container" style="grid-template-columns:auto auto auto;">-->
    <!--        <a href="vibra.php"><img class="icong grid-item" src="https://cdn-icons-png.flaticon.com/512/4858/4858726.png"></a>-->
    <!--        <a href="#content1"><img id="buttonid" style="pointer-events:auto;" class="icong grid-item" src="https://cdn-icons-png.flaticon.com/128/685/685686.png"></a>-->
    <!--        <a href = "logout.php"><img class="icong grid-item" src="https://t4.ftcdn.net/jpg/02/22/46/27/240_F_222462743_FAD151Nvec04PyUao7lcJiD3p9WrqpQv.jpg"></a>-->

    <!--    </div>-->
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
      
    <script type="text/javascript">
        var flag=0;
           document.getElementById('buttonid').addEventListener('click', openDialog1);

function openDialog1() {
  document.getElementById('id').click();
}
document.getElementById('id').addEventListener('change', submitForm2);
                function submitForm2() {
              
  document.getElementById('buttonid').style.display="none";
  document.getElementById('loader1').style.display="block";
//   document.getElementById('loader1').innerHTML="block";
  
  document.getElementById('loaer').style.display="block";
  
}

                document.getElementById('pro1').addEventListener('click', openDialog);
                function openDialog() {
                    document.getElementById('filetype').click();
                }
                document.getElementById('filetype').addEventListener('change', submitForm);
                function submitForm() {
                    document.getElementById('submitbutton').click();
                }
            // let videos = document.querySelectorAll("video");
    // videos.forEach((video) => {
    //     // We can only control playback without insteraction if video is mute
    //     video.muted = true;
    //     // Play is a promise so we need to check we have it
    //     let playPromise = video.play();
    //     if (playPromise !== undefined) {
    //         playPromise.then((_) => {
    //             let observer = new IntersectionObserver(
    //                 (entries) => {
    //                     entries.forEach((entry) => {
    //                         if (
    //                             entry.intersectionRatio !== 1 &&
    //                             !video.paused
    //                         ) {
    //                             video.pause();
    //                         } else if (video.paused) {
    //                             video.play();
    //                         }
    //                     });
    //                 },
    //                 { threshold: 0.2 }
    //             );
    //             observer.observe(video);
    //         });
    //     }
    // });
            
            
            
        var isReply = false,
            commentID = 0,
            // var caption;
            max = <?php echo $numComments ?>;
        np = <?php echo $numPhoto ?>;
        $(document).ready(function() {
            
            getAllComments(0, max);
            // notifyMe();
            $("#upload2").on('click', function() {
                // alert("dhjfbhjdrsf");
                var caption;
                np++;
                caption = $("#captioninp").val();
                // console.log(caption);
                $.ajax({
                    url: 'index.php',
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        np: np,
                        caption: caption,
                    },
                    success: function(response) {
                        alert("Posted");
                    }
                });
            });
            // $("#submitbutton").on('click', function() {
            //     $.ajax({
            //         url: 'index.php',
            //         method: 'POST',
            //         dataType: 'text',
            //         data: {
            //             submitbutton : 1
            //         },
            //         success: function(response) {
            //             alert("Posted");
            //         }
            //     });
            // });
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
            $("#addComment, #addReply").on('click', function() {
                var comment;

                if (!isReply)
                    comment = $("#mainComment").val();
                else
                    comment = $("#replyComment").val();

                if (comment.length > 5) {
                    $.ajax({
                        url: 'index.php',
                        method: 'POST',
                        dataType: 'text',
                        data: {
                            addComment: 1,
                            comment: comment,
                            isReply: isReply,
                            commentID: commentID
                        },
                        success: function(response) {
                            max++;
                            $("#numComments").text(max + " Announcement");

                            if (!isReply) {
                                $(".userComments").prepend(response);
                                $("#mainComment").val("");
                            } else {
                                // console.log("wow");
                                commentID = 0;
                                $("#replyComment").val("");
                                $(".replyRow").hide();
                                $('.replyRow').parent().next().append(response);
                            }
                        }
                    });
                } else
                    alert('Please Check Your Inputs');
            });
        });

        function reply(caller) {
            commentID = $(caller).attr('data-commentID');
            $(".replyRow").insertAfter($(caller));
            $('.replyRow').show();
        }

        function getAllComments(start, max) {
            if (start > max) {
                return;
            }
            $.ajax({
                url: 'index.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    getAllComments: 1,
                    start: start
                },
                success: function(response) {
                    // console.log(response);
                    $(".userComments").append(response);
                    getAllComments((start + 20), max);
                }
            });
        }
      window.OneSignal = window.OneSignal || [];
  OneSignal.push(function() {
    OneSignal.init({
      appId: "b5b6f302-da39-410d-976e-6056c1a666a9",
    });
  });
         OneSignal.push(function() {
            OneSignal.getUserId(function(userId){
                console.log("OneSignal User ID:", userId);
                $.ajax({
                url: 'index.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    userIdp:userId,
                    idp:1,
                },
                success: function(response) {
                    console.log(response);
                    console.log(userId);
                }
                });
                
            });
            });
       $('.click').on('click' , function(){
        // alert(clicked);
       $.ajax({
           url : 'index.php',
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
        $('.box').on('click'  , function(){
           var pi='like'+like;
           var gi='like'+like+'7';
           console.log(pi);
            var menuBox = document.getElementById(pi);
            var menuBox2 = document.getElementById(gi);
            menuBox.style.display="flex";
            menuBox2.innerHTML=orilike+1+' likes';
            menuBox.classList.add('shadow');
            menuBox.style.height="0px";
            menuBox.style.weight="0px";
            $.ajax({
           url : 'index.php',
           method:'POST',
           dataType:'text',
           data : {
               liked_id : like,
               orilike : orilike
               
           },
           success : function(response){
            console.log(response);
           }
       });
 
        });

    </script>
</body>

</html>