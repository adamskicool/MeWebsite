<?php
    include('connection.php');
    $username = $_POST['username'];
    $query = "SELECT content FROM CV WHERE username = '".$username."';";
    $result = $conn -> query($query);
    #return the title and the content (description of the post).
    #echo $query;
    while($row = $result -> fetch_assoc()){
        echo $row['content'];
    }
?>