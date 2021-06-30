<?php
	include_once("demo_header.php");
?>

        <div class="container" style="font-size:14px">
            <img src="img/background_1.png" class="img-fluid"><br><br>
        
            <div class="row g-3 r-3">
                <!--공지사항 출력-->
                <div class="col-6">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr class="align-middle">
                                <th style="border-right:none">
                                    공지사항
                                </th>
                                <th style="border-left:none">
                                    <a href="#" class="btn btn-outline-secondary btn-sm" style="float:right; margin-left:3px">더보기</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">업데이트 예정입니다</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!--최근 경기 출력-->
                <div class="col-6">
                    <table class="table table-bordered table-hover align-middle ">
                        <thead class="table-light">
                        <tr class="align-middle">
                                <th style="border-right:none">
                                    최근 경기
                                </th>
                                <th style="border-left:none">
                                    <a href="/match/match_list.php" class="btn btn-outline-secondary btn-sm" style="float:right; margin-left:3px">더보기</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center">
                            <?php
                                include "./db/db.php";

                                $sql = "SELECT * FROM MatchList WHERE TeamId = $TeamId ORDER BY mDate desc";
                                $sql_result = $conn->query($sql);
                                #메인화면 최근 3경기만 출력하기 위한 변수
                                $recent_match = 0;

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
                            <tr style = 'cursor:pointer;' onClick = ","location.href='/match/record_list.php?MatchId=$row->MatchId'",">
                                <td colspan='2'>   
                                    <p style='font-size:12px'>$row->mDate</p>
                                    $row->Home($home_score) : $row->Away($away_score)
                                </td>
                            </tr>
                            ";
                                    if ($recent_match == 2){
                                        break;
                                    }else{
                                        $recent_match += 1;
                                    }
                            } 
                            ?>
                    
                        </tbody>
                    </table>
                </div><!--/최근 경기 출력-->
            </div> <!--//row-->

            <!--두번째 줄-->
            <div class="row g-3 r-3">
                <!--대관 정보-->
                <div class="col-6">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr class="align-middle">
                                <th style="border-right:none">
                                    대관 정보
                                </th>
                                <th style="border-left:none">
                                    <a href="#" class="btn btn-outline-secondary btn-sm" style="float:right; margin-left:3px">더보기</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">업데이트 예정입니다</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!--공지사항 출력-->
                <div class="col-6">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr class="align-middle">
                                <th style="border-right:none">
                                    게스트 구인
                                </th>
                                <th style="border-left:none">
                                    <a href="#" class="btn btn-outline-secondary btn-sm" style="float:right; margin-left:3px">더보기</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">업데이트 예정입니다</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><!--//row-->

        </div> <!--/container-->
  
<?php
    include_once("footer.php");
?>

    </div> <!--/wrap-->
</body>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    
</html>