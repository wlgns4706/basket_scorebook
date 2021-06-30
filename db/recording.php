<?php
    include "db.php";
    
    
    $MatchId = $_POST['MatchId'];
    $twoPoint = $_POST['twoPoint'];
    $threePoint = $_POST['threePoint'];
    #Home
    $home_PlayerId = $_POST['home_PlayerId'];
    $home_twoPoint_m = $_POST['home_twoPoint_m'];
    $home_twoPoint_a = $_POST['home_twoPoint_a'];
    $home_threePoint_m = $_POST['home_threePoint_m'];
    $home_threePoint_a = $_POST['home_threePoint_a'];
    $home_Rebound = $_POST['home_Rebound'];
    $home_Assist = $_POST['home_Assist'];
    $home_Steal = $_POST['home_Steal'];
    $home_Block = $_POST['home_Block'];
    $home_Foul = $_POST['home_Foul'];
    $home_PlusScore = $_POST['home_PlusScore'];

    #Away
    $away_PlayerId = $_POST['away_PlayerId'];
    $away_twoPoint_m = $_POST['away_twoPoint_m'];
    $away_twoPoint_a = $_POST['away_twoPoint_a'];
    $away_threePoint_m = $_POST['away_threePoint_m'];
    $away_threePoint_a = $_POST['away_threePoint_a'];
    $away_Rebound = $_POST['away_Rebound'];
    $away_Assist = $_POST['away_Assist'];
    $away_Steal = $_POST['away_Steal'];
    $away_Block = $_POST['away_Block'];
    $away_Foul = $_POST['away_Foul'];
    $away_PlusScore = $_POST['away_PlusScore'];
    

    #home record query
    for ($i=0;$i<count($home_twoPoint_m);$i++){
        #2점, 3점 득점 없을시 예외처리 (0 나눗셈 오류뜸)
        if ($home_twoPoint_m[$i]==0){
            $home_twoPoint_p=0;
        }else{
            $home_twoPoint_p=$home_twoPoint_m[$i]/($home_twoPoint_a[$i]+$home_twoPoint_m[$i]);
        };
        
        if ($home_threePoint_m[$i]==0){
            $home_threePoint_p=0;
        }else{
            $home_threePoint_p=$home_threePoint_m[$i]/($home_threePoint_a[$i]+$home_threePoint_m[$i]);
        };
        #점수 계산
        $score=($twoPoint+$home_PlusScore[$i])*$home_twoPoint_m[$i] + ($threePoint+$home_PlusScore[$i])*$home_threePoint_m[$i];
        #슛시도 갯수 계산
        $home_tot_twoPoint_a = $home_twoPoint_a[$i]+$home_twoPoint_m[$i];
        $home_tot_threePoint_a = $home_threePoint_a[$i]+$home_threePoint_m[$i];

        $record_sql = "UPDATE RecordData SET
                        twoPoint_m = $home_twoPoint_m[$i],
                        twoPoint_a = $home_tot_twoPoint_a,
                        twoPoint_p = $home_twoPoint_p,
                        threePoint_m = $home_threePoint_m[$i],
                        threePoint_a = $home_tot_threePoint_a,
                        threePoint_p = $home_threePoint_p,
                        Rebound = $home_Rebound[$i],
                        Assist = $home_Assist[$i],
                        Steal = $home_Steal[$i],
                        Block = $home_Block[$i],
                        Foul = $home_Foul[$i],
                        score = $score
                        WHERE PlayerId = $home_PlayerId[$i] and MatchId = $MatchId";
        $conn->query($record_sql);
        }
  
        
    

    #away record query
    for ($i=0;$i<count($away_twoPoint_m);$i++){

        #2점, 3점 득점 없을시 예외처리 (0 나눗셈 오류뜸)
        if ($away_twoPoint_m[$i]==0){
            $away_twoPoint_p=0;
        }else{
            $away_twoPoint_p=$away_twoPoint_m[$i]/($away_twoPoint_a[$i]+$away_twoPoint_m[$i]);
        };
        
        if ($away_threePoint_m[$i]==0){
            $away_threePoint_p=0;
        }else{
            $away_threePoint_p=$away_threePoint_m[$i]/($away_threePoint_a[$i]+$away_threePoint_m[$i]);
        };

      #점수 계산
      $score=($twoPoint+$away_PlusScore[$i])*$away_twoPoint_m[$i] + ($threePoint+$away_PlusScore[$i])*$away_threePoint_m[$i];
      #슛시도 갯수 계산
      $away_tot_twoPoint_a = $away_twoPoint_a[$i]+$away_twoPoint_m[$i];
      $away_tot_threePoint_a = $away_threePoint_a[$i]+$away_threePoint_m[$i];

        $record_away_sql = "UPDATE RecordData SET
                        twoPoint_m = $away_twoPoint_m[$i],
                        twoPoint_a = $away_tot_twoPoint_a,
                        twoPoint_p = $away_twoPoint_p,
                        threePoint_m = $away_threePoint_m[$i],
                        threePoint_a = $away_tot_threePoint_a,
                        threePoint_p = $away_threePoint_p,
                        Rebound = $away_Rebound[$i],
                        Assist = $away_Assist[$i],
                        Steal = $away_Steal[$i],
                        Block = $away_Block[$i],
                        Foul = $away_Foul[$i],
                        score = $score
                        WHERE PlayerId = $away_PlayerId[$i] and MatchId = $MatchId";
        $conn->query($record_away_sql);
        }
    
        
    #echo $record_data;

    //for ($i=0;$i<count($awayChk);$i++){
    # $awayChked = $awayChked."($MatchId, $TeamId, 1, $awayChk[$i])";
    #  #쉼표로 구분하기 위함
    #  if ($i+1!=count($awayChk)){
    #    $awayChked = $awayChked.",";
    #  }
    #}
    
    
    #$sql = "INSERT INTO `RecordData` (MatchId, TeamId, HomeAway, PlayerId) VALUES $homeChked, $awayChked";

    
    

    #$sql = "INSERT INTO `RecordData` (MatchId, TeamId, PlayerId) VALUES ($MatchId, $TeamId,)";
    #$sql_result = $conn->query($sql);
    
    #$Matchid = $conn->insert_id;



    
    echo "<script>location.href='/match/record_list.php?MatchId=$MatchId'</script>";

?>