<?php
	include $_SERVER["DOCUMENT_ROOT"]."/header.php";
?>


<!--기록작성 페이지만 fluid-->
<div class="container" style='font-size:12px'><br>
    <table class="table table-hover align-center " id="match_list"  style="text-align:center">
        <thead>
            <tr>
                <th>일자</th>
                <th>경기명</th>
                <th>결과(홈팀:어웨이)</th>
            </tr>
        </thead>
        <tbody >
            <?php
                include $_SERVER["DOCUMENT_ROOT"]."/db/db.php";

                $sql = "SELECT * FROM MatchList WHERE TeamId = $TeamId ORDER BY mDate DESC";
                $sql_result = $conn->query($sql);
                
                while($row = $sql_result->fetch_object()){

                    #홈팀,어웨이팀 점수 합산 쿼리
                    for($i=0;$i<2;$i++){
                        $score_sql = "SELECT sum(score) AS sum_score from RecordData WHERE MatchId = $row->MatchId and HomeAway = $i";
                        $score_sql_result = $conn->query($score_sql);
                        $score_row = $score_sql_result->fetch_object();

                        switch ($i) {
                            case 0:
                                # Home팀
                                $home_score = $score_row->sum_score;
                                break;
                            
                            case 1:
                                # Away
                                $away_score = $score_row->sum_score;
                                break;
                        }
                    } 
                    
                    echo "
                    <tr style = 'cursor:pointer;' onClick = ","location.href='record_list.php?MatchId=$row->MatchId'",">                   
                        <td>$row->mDate</td>
                        <td>$row->mName</td>
                        <td>$row->Home($home_score) : $row->Away($away_score)</td>
                    </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
        
<!--/container-->
</div>

</body>

<?php
    include $_SERVER["DOCUMENT_ROOT"]."/footer.php";
?>
<!--/wrap-->
</div>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</html>