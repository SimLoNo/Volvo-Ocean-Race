<?php
    session_start();
    include('process.php');
    session_destroy();
    header('location: index.php');
?>