<?php
    include('connection.php');
    $username = $_POST['username'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $img_name = $_POST['img_name'];
    $sql = "INSERT INTO `MyWebsite`.`Post` (`username`, `title`, `description`, `image`) VALUES ('".$username."', '".$title."', '".$content."', '../Users/".$username."/images/".$img_name."');";
    $conn -> query($sql);
?>