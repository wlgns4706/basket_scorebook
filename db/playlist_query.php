
        <?php
            
            include "./db.php";
            session_start();
            
            #세션값 없을시 12(데모계정)으로 통일
            if (!$_SESSION['TeamId']){
                $TeamId = 12;
            }else{
                $TeamId = $_SESSION['TeamId'];
            }

            $rank_type = $_GET['rank_type'];
            $search_type = $_GET['search_type'];
                        
            switch ($search_type) {
                case '0':
                    $sumavg = 'sum';
                    break;
                
                case '1':
                    $sumavg = 'avg';
                    break;
            }
            
                    #누적 기록 
                    
                    $sql = "SELECT
                    PlayerName,
                    PlayerList.PlayerId AS PlayerId,
                    $sumavg(score) AS tot_score,
                    $sumavg(twoPoint_m) AS tot_twoPoint_m,
                    $sumavg(twoPoint_a) AS tot_twoPoint_a,
                    $sumavg(twoPoint_m)/$sumavg(twoPoint_a)*100 AS tot_twoPoint_p,
                    $sumavg(threePoint_m) AS tot_threePoint_m,
                    $sumavg(threePoint_a) AS tot_threePoint_a,
                    $sumavg(threePoint_m)/$sumavg(threePoint_a)*100 AS tot_threePoint_p,
                    $sumavg(twoPoint_m) + $sumavg(threePoint_m) AS tot_field_m,
                    $sumavg(twoPoint_a) + $sumavg(threePoint_a) AS tot_field_a,
                    ($sumavg(twoPoint_m) + $sumavg(threePoint_m))/($sumavg(twoPoint_a) + $sumavg(threePoint_a))*100 AS tot_field_p,
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


                    $sql_result = $conn->query($sql);

                    while($row = $sql_result->fetch_object()){                
                        #2,3점 슛 시도 기록이 없을시 '-' 로 표시 
                        if($row->tot_threePoint_a==0 && $row->tot_threePoint_m==0){
                            $tot_threePoint_p = "-";
                        }
                        if($row->tot_twoPoint_a==0 && $row->tot_twoPoint_m==0){
                            $tot_twoPoint_p = "-";
                        }
                        
                        #순위별 선택된 항목 표시되도록 하기 위한 변수
                        ${$rank_type.'_select'} = " class='bg-light fw-bold'";
                        
                        echo "
                        <tr style = 'cursor:pointer;' onClick = location.href='/player/player_record.php?PlayerId=$row->PlayerId'>
                            <th>$row->PlayerName</th>
                            <td>$row->tot_matchCount</td>
                            <td$tot_score_select>".round($row->tot_score)."</td>
                            <td$tot_twoPoint_m_select>".round($row->tot_twoPoint_m)." / ".round($row->tot_twoPoint_a)."</td>
                            <td$tot_twoPoint_p_select>".round($row->tot_twoPoint_p,1)."</td>
                            <td$tot_threePoint_m_select>".round($row->tot_threePoint_m)." / ".round($row->tot_threePoint_a)."</td>
                            <td$tot_threePoint_p_select>".round($row->tot_threePoint_p,1)."</td>
                            <td$tot_field_m_select>".round($row->tot_field_m)." / ".round($row->tot_field_a)."</td>
                            <td$tot_field_p_select>".round($row->tot_field_p,1)."</td>
                            <td$tot_Rebound_select>".round($row->tot_Rebound)."</td>
                            <td$tot_Assist_select>".round($row->tot_Assist)."</td>
                            <td$tot_Steal_select>".round($row->tot_Steal)."</td>
                            <td$tot_Block_select>".round($row->tot_Block)."</td>
                            <td>".round($row->tot_Foul)."</td>
                        <tr>";
                    }  

         
            
            
        ?>