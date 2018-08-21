<?php
    include('connection.php');
    $username = $_POST['username'];
    $content = $_POST['content'];
    $query = "UPDATE `MyWebsite`.`CV` SET `content`='".$content."' WHERE `username`='".$username."';";
    $result = $conn -> query($query);
?>