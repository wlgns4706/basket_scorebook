<?php
    session_start();
    include "db.php";
    
    $Account = $_POST['Account'];
    $Password = $_POST['Password'];


    $sql = "SELECT * FROM TeamList WHERE Account ='$Account'";
    
    $result = $conn->query($sql);
    
    $row = $result->fetch_object();
    
    $hash_pw = $row->Password;

    
    
    
    
    if(password_verify($Password, $hash_pw))
    {
        $_SESSION['TeamId'] = $row->TeamId;
        $_SESSION['TeamName'] = $row->TeamName;
        $_SESSION['Account'] = $row->Account;

        echo "<script>location.href='/';</script>";
        
        
    }else{

        echo "<script>alert('아이디 혹은 비밀번호를 확인하세요'); history.back();</script>";
    }


    
?>