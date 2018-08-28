<?php
    include('connection.php');
    $username = $_POST['username'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $img_name = $_POST['img_name'];
    $sql = "INSERT INTO `MyWebsite`.`Post` (`username`, `title`, `description`, `image`) VALUES ('".$username."', '".$title."', '".$content."', '../Users/".$username."/images/".$img_name."');";
    $result = $conn -> query($sql);
    #$result -> close();
    #$sql = "SELECT MAX(postID) as postID FROM Post;";
    #$result2 = $conn -> query($sql);
    #hile($row = $result2 -> fetch_assoc()){
    #    echo $row['postID'];
    #}
    
?>