<?php 
    session_start();
    if(isset($_SESSION['clicked'])){
        function messagew($userid,$message,$user){
        $content      = array(
        "en" => 'Message from '.$user.' : '.$message.' ');
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
        include_once "config.php";
        require_once('emoji.php');
        $outgoing_id = $_SESSION['userid'];
        // $conn->query("insert into messages(incoming_msg_id, outgoing_msg_id, msg) values (1,3,'rfgberjf')");
        $incoming_id = $_SESSION['clicked'];
        $sql ="SELECT userId from users where id={$incoming_id}";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        $userid = $row['userId'];
        $user = $_SESSION['username'];
        $message = $conn->real_escape_string($_POST['message']);
        messagew($userid , $message , $user);
        $message = Emoji::Encode($message);
        $message = (str_replace("\\","\\\\", $message));
        // echo $message;
        if(!empty($message)){
            $conn->query("INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')");
            exit();
        }
    }else{
        header("vibra.php");
    }


    
?>