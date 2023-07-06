<?php
    require_once('emoji.php');
    //encode
    $text = '😅🤑';
    echo Emoji::Encode($text);
    //decode
    $text='\ud83d\ude04,hi';
    echo Emoji::Decode($text);
?>