<?php
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
    header('Content-type: text/plain; charset=utf-8');
    header("Content-type:application/json; charset=utf-8");
    
    define('HOST', 'localhost');
    define('USER', 'root');
    define('PASS', '');
    define('DB', 'educat');

    $con = mysqli_connect(HOST, USER, PASS, DB);
    mysqli_set_charset($con, 'utf8');
    
    if(!$con){
        die("Error in connection ".mysqli_connect_error());
    }
?>