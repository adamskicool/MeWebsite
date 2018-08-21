<?php
    include('connection.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT username FROM User WHERE username = '".$username."' AND password = '".$password."';";
    $result = $conn -> query($sql);
    #gå igenom datan i result, ifall det finns ett resultat skicka tillbaka 1, 
    #ifall det inte finns någon resultat skicka tillbaka 0.
    if(($result -> num_rows) == 0) {
        echo "0";
    } else {
        echo "1";
    }
?>