<?php
    include('connection.php');
    $postID = $_POST['postID'];
    $query = "SELECT title, description FROM Post WHERE postID = '".$postID."';";
    $result = $conn -> query($query);
    #return the title and the content (description of the post).
    
    while($row = $result -> fetch_assoc()){
        $respons->title = $row['title'];
        $respons->description = $row['description'];
        echo json_encode($respons);
    }
?>