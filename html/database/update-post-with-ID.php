<?php
    include('connection.php');
    $postID = $_POST['postID'];
    $content = $_POST['content'];
    $title = $_POST['title'];
    $query = "UPDATE `MyWebsite`.`Post` SET `title`='".$title."', `description`='".$content."' WHERE `postID`='".$postID."';";
    $result = $conn -> query($query);
?>