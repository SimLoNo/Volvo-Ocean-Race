<?php
    session_start();
    include('process.php');
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $mysqli->query("SELECT * FROM user WHERE UserName='$username' AND Password ='$password'") or die($mysqli->error);

    $check = mysqli_num_rows($result);

    if($check > 0)
    {
        $_SESSION['user'] = $username;
        header('location: index.php');
    }
    else
    {
        echo "Username or password is wrong";
    }
?>