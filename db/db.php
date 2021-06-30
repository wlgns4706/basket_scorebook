<?php
    $password = 'Kjh014712!';

    $conn = new mysqli('localhost','web_admin',$password,'web');

    if(!$conn){
        echo "MySQL 접속 실패";
    }
?>