<?php
    include "./db.php";
    
    
    $MatchId = $_GET['MatchId'];
    echo $MatchId;


    for ($i=0;$i<2;$i++){
      switch ($i) {
        case 0:
          $Table = "RecordData";
          break;
        case 1:
          $Table = "MatchList";
          break;
      }

      $sql = "DELETE FROM $Table WHERE MatchId = $MatchId";
      $result = $conn->query($sql);
    }


    
    echo "<script>location.href='/match/match_list.php'</script>";

?>