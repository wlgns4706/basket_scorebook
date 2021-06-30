<?php
    include "./db.php";
    
    $TeamId = $_POST['TeamId'];
    $mDate = $_POST['mDate'];
    $mName = $_POST['mName'];
    $mTime = $_POST['mTime'];
    $mType = $_POST['mType'];
    $mDivide = $_POST['mDivide'];
    $Home = $_POST['Home'];
    $Away = $_POST['Away'];
    $twoPoint = $_POST['twoPoint'];
    $threePoint = $_POST['threePoint'];



    $sql = "INSERT INTO `MatchList` (TeamId, mDate, mName, mTime, mType, mDivide, Home, Away, twoPoint, threePoint) VALUES ($TeamId, '$mDate', '$mName', '$mTime', $mType, $mDivide, '$Home', '$Away',$twoPoint, $threePoint)";
    $sql_result = $conn->query($sql);
    
    $Matchid = $conn->insert_id;

    

    
    echo "<script>location.href='/match/match_add_player.php?MatchId=$Matchid'</script>";

?>