<?php
    include "./db.php";
    
    $TeamId = $_POST['TeamId'];
    $MatchId = $_POST['MatchId'];
    $homeChk = $_POST['homeChk'];
    $awayChk = $_POST['awayChk'];
    $homeBacknum = $_POST['homeBacknum'];
    $awayBacknum = $_POST['awayBacknum'];
    $home_plusscore = $_POST['home_plusscore'];
    $away_plusscore = $_POST['away_plusscore'];
    
    

    for ($i=0;$i<count($homeChk);$i++){
      
      if(in_array($homeChk[$i], $home_plusscore))
      {
          $home_plusscore_insert = 1;
      }
      else
      {
        $home_plusscore_insert = 0;
      }
      
      
      
        $homeChked = $homeChked."($MatchId, $TeamId, 0, $homeChk[$i], $homeBacknum[$i], $home_plusscore_insert)";
        #쉼표로 구분하기 위함
        if ($i+1!=count($homeChk)){
          $homeChked = $homeChked.",";
        }
    }

    for ($i=0;$i<count($awayChk);$i++){

      if(in_array($awayChk[$i], $away_plusscore))
      {
          $away_plusscore_insert = 1;
      }
      else
      {
        $away_plusscore_insert = 0;
      }

      $awayChked = $awayChked."($MatchId, $TeamId, 1, $awayChk[$i], $awayBacknum[$i], $away_plusscore_insert)";
      #쉼표로 구분하기 위함
      if ($i+1!=count($awayChk)){
        $awayChked = $awayChked.",";
      }
    }
    
    
    $sql = "INSERT INTO `RecordData` (MatchId, TeamId, HomeAway, PlayerId, backNumber, PlusScore) VALUES $homeChked, $awayChked";

    
    

    #$sql = "INSERT INTO `RecordData` (MatchId, TeamId, PlayerId) VALUES ($MatchId, $TeamId,)";
    $sql_result = $conn->query($sql);
    
    #$Matchid = $conn->insert_id;



    
    echo "<script>location.href='/recording.php?MatchId=$MatchId'</script>";

?>