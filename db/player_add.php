<?php
    include "./db.php";
    
    $TeamId = $_POST['TeamId'];
    $PlayerName = $_POST['PlayerName'];
    $playerBirthday = $_POST['playerBirthday'];
    $createDate = date('Y-m-d H:i:s');
    
    
    $sql = "INSERT INTO `PlayerList` (`PlayerName`,`TeamId`,`playerBirthday`,`createDate`) VALUES ('$PlayerName',$TeamId,'$playerBirthday','$createDate')";
    $sql_result = $conn->query($sql);
    
    echo "<script>alert('등록 완료');location.href='/player_add.php'</script>";

?>