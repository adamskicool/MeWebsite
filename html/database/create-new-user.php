<?php
    include('connection.php');
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_again = $_POST['password_again'];
    $sql = "SELECT * FROM User WHERE username = '".$username."';";
    $result = $conn -> query($sql);
    
    if(($result -> num_rows) > 0 || !($password === $password_again) || !(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        echo "Username already in use or passwords not matching.";
    }else{
        $query = "INSERT INTO User VALUES ('".$username."', '".$password."', '".$email."');";
        $query .= "INSERT INTO `MyWebsite`.`CV` (`username`) VALUES ('".$username."');";
        $conn -> multi_query($query);
        //$conn -> query($query_add_user);
        echo "New user ".$username." has been created.";
        #skapa en mapp där användarens uppladdade bilder mm. kommer att sparas.
        mkdir('../../Users/'.$username, 0755, true);
        mkdir('../../Users/'.$username.'/images', 0755, true);
    }
?>