
        <?php
            
            include "./db.php";
            session_start();
            
            if (!$_SESSION['TeamId']){
                $TeamId = 12;
            }else{
                $TeamId = $_SESSION['TeamId'];
            }

            $PlayerId = $_GET['PlayerId'];
            $record_type = $_GET['record_type'];
                        
            switch ($record_type) {
                case '0':
                    $sumavg = 'sum';
                    break;
                
                case '1':
                    $sumavg = 'avg';
                    break;
            }

            #쿼리문 작성
            for($i=0;$i<11;$i++){

                

                switch ($i) {
                    case 0:
                        $rank_type = "득점";
                        $rank_type_query = "$sumavg(score)";
                        break;
                    case 1:
                        $rank_type = "2점슛 성공";
                        $rank_type_query = "$sumavg(twoPoint_m)";
                        break;                        
                    case 2: #예외처리 필요 (2점슛 확률 계산)
                        $rank_type = "2점슛 성공률";
                        $rank_type_query = "$sumavg(twoPoint_m)/$sumavg(twoPoint_a)*100";
                        break;
                    case 3:
                        $rank_type = "3점슛 성공";
                        $rank_type_query = "$sumavg(threePoint_m)";
                        break;  
                    case 4: #예외처리 필요 (3점슛 확률 계산) 
                        $rank_type = "3점슛 성공률";
                        $rank_type_query = "$sumavg(threePoint_m)/$sumavg(threePoint_a)*100";
                        break;  
                    case 5: #예외처리 필요 (필드골 합산 계산)
                        $rank_type = "필드골 성공";
                        $rank_type_query = "$sumavg(twoPoint_m)+$sumavg(threePoint_m)";
                        break;  
                    case 6: #예외처리 필요 (필드골 확률 계산) 
                        $rank_type = "필드골 성공률";
                        $rank_type_query = "($sumavg(twoPoint_m)+$sumavg(threePoint_m))/($sumavg(twoPoint_a)+$sumavg(threePoint_a))*100";
                        break;  
                    case 7:
                        $rank_type = "리바운드";
                        $rank_type_query = "$sumavg(Rebound)";
                        break;
                    case 8:
                        $rank_type = "어시스트";
                        $rank_type_query = "$sumavg(Assist)";
                        break;   
                    case 9:
                        $rank_type = "스틸";
                        $rank_type_query = "$sumavg(Steal)";
                        break;   
                    case 10:
                        $rank_type = "블록";
                        $rank_type_query = "$sumavg(Block)";
                        break;   
            }

            $query_copy =  "SELECT '$rank_type' AS rank_type ,(select $rank_type_query from RecordData  WHERE PlayerId = $PlayerId group by PlayerId) AS tot_point, count(*) AS 'rank' FROM (select $rank_type_query as tot_score,PlayerId from RecordData WHERE TeamId = $TeamId group by PlayerId) as ff WHERE tot_score >= (select $rank_type_query from RecordData  WHERE PlayerId = $PlayerId AND TeamId = $TeamId group by PlayerId)";


            
                if ($i==0){
                    $query_copys = $query_copy;
                }else{
                    $query_copys = $query_copys." union all ".$query_copy;
                }

            } #for문 끝
           



            $sql_result = $conn->query($query_copys);
           
            while($row = $sql_result->fetch_object()){
                echo "
                <tr>
                    <td>$row->rank_type</td>
                    <td>".round($row->tot_point)."</td>
                    <td>$row->rank</td>
                </tr>
                ";
            }
            


/*



                    #누적 기록
                $sql = "SELECT result.tot_score, result.PlayerId, (@rank_num := @rank_num + 1) AS rank_num
                        FROM (SELECT @rank_num := 0) AS b, (SELECT PlayerId, $sumavg($type) as tot_score from RecordData group by PlayerId ORDER BY tot_score desc)
                        AS result WHERE PlayerId = $PlayerId";

                    for($i=0;$i<2;$i++){
                        switch ($i) {
                            case 0:
                                $type = "score";
                                break;
                            case 1:
                                $type = "twoPoint_m";
                                break;
                        }
                        $sql_result = $conn->query($sql);
                        $sql_result->fetch_object();
                        
                    }


                    $sql_asdasd = "SELECT
                    PlayerName,
                    PlayerList.PlayerId AS PlayerId,
                    $sumavg(score) AS tot_score,
                    $sumavg(twoPoint_m) AS tot_twoPoint_m,
                    $sumavg(twoPoint_a) AS tot_twoPoint_a,
                    $sumavg(threePoint_m) AS tot_threePoint_m,
                    $sumavg(threePoint_a) AS tot_threePoint_a,
                    $sumavg(Rebound) AS tot_Rebound,
                    $sumavg(Assist) AS tot_Assist,
                    $sumavg(Steal) AS tot_Steal,
                    $sumavg(Block) AS tot_Block,
                    $sumavg(Foul) AS tot_Foul,
                    count(*) AS tot_matchCount
                    FROM RecordData
                    JOIN PlayerList ON PlayerList.PlayerId = RecordData.PlayerId
                    WHERE RecordData.TeamId = $TeamId
                    GROUP BY PlayerList.PlayerId
                    ORDER BY $rank_type desc
                    ";


                    

                    while($row = $sql_result->fetch_object()){
                        $tot_twoPoint_p = round($row->tot_twoPoint_m/$row->tot_twoPoint_a*100,1);
                        $tot_threePoint_p = round($row->tot_threePoint_m/$row->tot_threePoint_a*100);
                        
                        #2,3점 슛 시도 기록이 없을시 '-' 로 표시
                        if($row->tot_threePoint_a==0 && $row->tot_threePoint_m==0){
                            $tot_threePoint_p = "-";
                        }
                        if($row->tot_twoPoint_a==0 && $row->tot_twoPoint_m==0){
                            $tot_twoPoint_p = "-";
                        }
                        
                        #필드골 계산 (2점+3점)
                            $tot_field_m = round($row->tot_twoPoint_m + $row->tot_threePoint_m);
                            $tot_field_a = round($row->tot_twoPoint_a + $row->tot_threePoint_a);
                            $tot_field_p = round($tot_field_m / $tot_field_a * 100,1);
                        

                        echo "
                        <tr style = 'cursor:pointer;' onClick = location.href='/player/player_record.php?PlayerId=$row->PlayerId'>
                            <td>$row->PlayerName</td>
                            <td>$row->tot_matchCount</td>
                            <td>".round($row->tot_score)."</td>
                            <td>".round($row->tot_twoPoint_m)." / ".round($row->tot_twoPoint_a)."</td>
                            <td>$tot_twoPoint_p</td>
                            <td>".round($row->tot_threePoint_m)." / ".round($row->tot_threePoint_a)."</td>
                            <td>".round($tot_threePoint_p)."</td>
                            <td>$tot_field_m / $tot_field_a</td>
                            <td>$tot_field_p</td>
                            <td>".round($row->tot_Rebound)."</td>
                            <td>".round($row->tot_Assist)."</td>
                            <td>".round($row->tot_Steal)."</td>
                            <td>".round($row->tot_Block)."</td>
                            <td>".round($row->tot_Foul)."</td>
                        <tr>";
                    }  

         
            */
            
    

/*
SELECT sum(score) as tot_score , (@rank_score := @rank_score + 1) AS rank_score From (SELECT @rank_score := 0) AS a, RecordData group by PlayerId ORDER BY tot_score desc) AS tot_score_rank

SELECT score, (@rank_score := @rank_score + 1) AS rank_score From (SELECT @rank_score := 0) AS a, (select sum(score) as score from RecordData) AS tot_score, RecordData group by PlayerId ORDER BY tot_score desc

(SELECT 'tot_twoPoint_p', tot_result_twoPoint_p.tot_twoPoint_p, (@rank_twoPoint_p := @rank_twoPoint_p + 1) AS rank_twoPoint_p FROM (SELECT @rank_twoPoint_p := 0) AS twoPoint_p, (SELECT PlayerId, sum(twoPoint_m)/sum(twoPoint_a) as tot_twoPoint_p from RecordData group by PlayerId ORDER BY tot_twoPoint_p desc) AS tot_result_twoPoint_p WHERE PlayerId = 1)union all(SELECT 'tot_threePoint_m', tot_result_threePoint_m.tot_threePoint_m, (@rank_threePoint_m := @rank_threePoint_m + 1) AS rank_threePoint_m FROM (SELECT @rank_threePoint_m := 0) AS threePoint_m, (SELECT PlayerId, sum(threePoint_m) as tot_threePoint_m from RecordData group by PlayerId ORDER BY tot_threePoint_m desc) AS tot_result_threePoint_m WHERE PlayerId = 1)




select (@rank_score := @rank_score + 1) AS rank_score, PlayerId, tot_score FROM (SELECT sum(score) AS tot_score, PlayerId FROM RecordData group by PlayerId order by sum(score) desc) AS B, (SELECT @rank_score := 0) AS a;



#중복 성공
select (@rank_score := @rank_score + 1) AS rank_score, (@real_rank := IF(@last>tot_score,@real_rank := @real_rank + 1, @real_rank)),(@last := tot_score),PlayerId, tot_score FROM (SELECT sum(score) AS tot_score, PlayerId FROM RecordData group by PlayerId order by sum(score) desc) AS B, (SELECT @rank_score := 0, @last := 0, @real_rank := 1) AS a ;

SELECT test.rank_score FROM(select (@rank_score := @rank_score + 1) AS rank_score, (@real_rank := IF(@last>tot_score,@real_rank := @real_rank + 1, @real_rank)),(@last := tot_score),PlayerId, tot_score FROM (SELECT sum(score) AS tot_score, PlayerId FROM RecordData group by PlayerId order by sum(score) desc) AS B, (SELECT @rank_score := 0, @last := 0, @real_rank := 1) AS a)as test WHERE PlayerId = 1;






select (@rank_score := @rank_score + 1) AS rank_score, PlayerId, tot_twoPoint_m FROM (SELECT sum(twoPoint_m) AS tot_twoPoint_m, PlayerId FROM RecordData group by PlayerId order by sum(twoPoint_m) desc) AS B, (SELECT @rank_score := 0) AS a;




#1차 성공
select sum(score) from RecordData  WHERE PlayerId = 1 group by PlayerId;


SELECT (select sum(score) from RecordData  WHERE PlayerId = 1 group by PlayerId), count(*) FROM (select sum(score) as tot_score,PlayerId from RecordData group by PlayerId) as ff WHERE tot_score >= (select sum(score) from RecordData  WHERE PlayerId = 1 group by PlayerId) union
SELECT (select sum(twoPoint_m) from RecordData  WHERE PlayerId = 1 group by PlayerId), count(*) FROM (select sum(twoPoint_m) as tot_twoPoint_m,PlayerId from RecordData group by PlayerId) as ff WHERE tot_twoPoint_m >= (select sum(twoPoint_m) from RecordData  WHERE PlayerId = 1 group by PlayerId);


SELECT count(*) FROM (select sum(twoPoint_m) as tot_twoPoint_m,PlayerId from RecordData group by PlayerId) as ff WHERE tot_twoPoint_m >=  15;
SELECT count(*) FROM (select sum(score) as tot_score,PlayerId from RecordData group by PlayerId) as ff WHERE tot_score >= t.sum(score)), (select sum(score) from RecordData  WHERE PlayerId = 1 group by PlayerId) AS t;

*/

?>