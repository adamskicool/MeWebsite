<?php
    include('connection.php');
    $postID = $_POST['postID'];
    $sql = "DELETE FROM Post WHERE postID = '".$postID."'";
    $conn -> query($sql);
?>