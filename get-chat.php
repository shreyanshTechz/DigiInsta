<?php 
    session_start();
    if(isset($_SESSION['clicked'])){
        include_once "config.php";
        require_once('emoji.php');
        $incoming_id = $_SESSION['clicked'];
        $outgoing_id = $_SESSION['userid'];
        $output = "";
        $sql = "SELECT * FROM messages
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $msg=Emoji::Decode($row['msg']);
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $msg.'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                
                                <div class="details">
                                    <p>'. $msg.'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("vibra.php");
    }

?>