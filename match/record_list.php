<?php
	include $_SERVER["DOCUMENT_ROOT"]."/header.php";
?>

        <!--기록작성 페이지만 fluid-->
        <div class="container" style='font-size:12px'><br>

            <form action="record_list.php" method="GET">
                <?php                         
                    #2점, 3점 점수 쿼리
                    include $_SERVER["DOCUMENT_ROOT"]."/db/db.php";
                    
                    #첫페이지 로딩시 마지막 경기 결과 가져오기
                    $sql = "SELECT max(MatchId) AS max_MatchId FROM MatchList WHERE TeamId = $TeamId";
                    $sql_result = $conn->query($sql);
                    $row = $sql_result->fetch_object();
                    
                    $MatchId = $_GET['MatchId'];

                    if (!$MatchId){
                        $MatchId = $row->max_MatchId;
                    }

                    $sql_score = "SELECT twoPoint, threePoint, mName, mDate, max(MatchId) AS max_MatchId FROM MatchList WHERE MatchId = $MatchId AND TeamId = $TeamId";
                    $sql_score_result = $conn->query($sql_score);
                    $row = $sql_score_result->fetch_object();

                    echo "
                    <div class='col align-self-start'><h4>$row->mName</h4></div>
                    ";
                ?>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle table-fixed text-nowrap" style="text-align:center">
                    <thead class='table-light'>
                        <tr class="align-middle">
                            <th rowspan="2">번호</th>
                            <th rowspan="2">이름</th>
                            <th rowspan="2">score</th>
                            <th colspan="3">2점</th>
                            <th colspan="3">3점</th>
                            <th rowspan="2">RE</td>
                            <th rowspan="2">AS</td>
                            <th rowspan="2">ST</td>
                            <th rowspan="2">BS</td>
                            <th rowspan="2">PF</td>
                        </tr>
                        <tr>
                            <th>M</th>
                            <th>A</th>
                            <th>%</th>
                            <th>M</th>
                            <th>A</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                   
                            #2점, 3점 점수 쿼리
                            $sql_score = "SELECT twoPoint, threePoint FROM MatchList WHERE MatchId = $MatchId";
                            $sql_score_result = $conn->query($sql_score);
                            $row = $sql_score_result->fetch_object();
                            $twoPoint = $row->twoPoint;
                            $threePoint = $row->threePoint;

                            
                            #Home팀 결과 리스트 쿼리
                            for ($s=0;$s<2;$s++){
                                    $sql = "SELECT *
                                            FROM RecordData
                                            JOIN PlayerList ON PlayerList.PlayerId = RecordData.PlayerId
                                            WHERE MatchId = $MatchId and HomeAway = $s";

                                    $sql_result = $conn->query($sql);
                                    
                                    $tot_sql = "SELECT sum(score) AS sum_score,
                                                        sum(twoPoint_m) AS sum_twoPoint_m,
                                                        sum(twoPoint_a) AS sum_twoPoint_a,
                                                        sum(threePoint_m) AS sum_threePoint_m,
                                                        sum(threePoint_a) AS sum_threePoint_a,
                                                        sum(Rebound) AS sum_Rebound,
                                                    sum(Assist) AS sum_Assist,
                                                    sum(Steal) AS sum_Steal,
                                                    sum(Block) AS sum_Block,
                                                    sum(Foul) AS sum_Foul
                                                    FROM RecordData WHERE MatchId = $MatchId AND HomeAway = $s";


                                $tot_result = $conn->query($tot_sql);
                                $tot_row = $tot_result->fetch_object();


                                while($row = $sql_result->fetch_object()){
                                    $twoPoint_p = round($row->twoPoint_p*100);
                                    $threePoint_p = round($row->threePoint_p*100);

                                    if($row->PlusScore==1){$PlusScore_style = "(+1)";}else{$PlusScore_style="";}
                                    
                                    echo "
                        <tr>
                            <td class='col'>$row->backNumber</td>
                            <td class='col'>$row->PlayerName$PlusScore_style</td>
                            <td class='col'>$row->score</td>
                            <td class='col'>$row->twoPoint_m</td>
                            <td class='col'>$row->twoPoint_a</td>
                            <td class='col'>$twoPoint_p</td>
                            <td class='col'>$row->threePoint_m</td>
                            <td class='col'>$row->threePoint_a</td>
                            <td class='col'>$threePoint_p</td>
                            <td class='col'>$row->Rebound</td>
                            <td class='col'>$row->Assist</td>
                            <td class='col'>$row->Steal</td>
                            <td class='col'>$row->Block</td>
                            <td class='col'>$row->Foul</td>
                        </tr>
                                    ";
                                }
                                echo "
                        <tr class='table-light'>
                            <td colspan='2'>합계</td>
                            <td>$tot_row->sum_score</td>
                            <td>$tot_row->sum_twoPoint_m</td>
                            <td>$tot_row->sum_twoPoint_a</td>
                            <td></td>
                            <td>$tot_row->sum_threePoint_m</td>
                            <td>$tot_row->sum_threePoint_a</td>
                            <td></td>
                            <td>$tot_row->sum_Rebound</td>
                            <td>$tot_row->sum_Assist</td>
                            <td>$tot_row->sum_Steal</td>
                            <td>$tot_row->sum_Block</td>
                            <td>$tot_row->sum_Foul</td>
                        </tr>
                                ";
                            }
                            ?>
                        
                    </tbody>
                </table>
            </div>

            <div class="row g-1">
                <div class="col-6 alert alert-light" role="alert">
                    M : 슛 성공 횟수 <br>
                    A : 슛 시도 횟수<br>
                    % : 슛 성공률<br>
                    RE : 리바운드<br>
                    AS : 어시스트<br>
                    ST : 스틸<br>
                    BS : 블락슛<br>
                    PF : 개인 파울<br>
                </div>
            
                <div class="col-6">
                    <a href="/match/match_list.php" class="btn btn-secondary btn-sm" style="float:right; margin-left:3px">목록</a>
                    <a href='/recording.php?MatchId=<?php echo "$MatchId&modify=1"; ?>' class="btn btn-secondary btn-sm" style="float:right; margin-left:3px">수정/삭제</a>
                </div>
            </div>


        <!--/container-->
        </div>
<?php
    include $_SERVER["DOCUMENT_ROOT"]."/footer.php";
?>
    </div><!--/wrap-->
</body>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</html>