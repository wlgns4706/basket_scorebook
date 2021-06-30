<?php
    include "db.php";
    
    $Account = $_POST['Account'];
    $InputPassword = $_POST['Password'];
    $TeamName = $_POST['TeamName'];
    $CreateDate = date('Y-m-d H:i');
    
    $hashed_pw = password_hash("$InputPassword",PASSWORD_DEFAULT); //password 암호화

    $sql = "INSERT INTO `TeamList` (Account, `Password`, TeamName, CreateDate) VALUES ('$Account', '$hashed_pw', '$TeamName', '$CreateDate')";

    $conn->query($sql);

    echo "<script>location.href='/login/login.php'</script>";

?>