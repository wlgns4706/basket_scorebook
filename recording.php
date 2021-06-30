<?php
	include_once("header.php");
?>

<style>
  .nav-pills > .item_home > .nav-link {color:black;  font-weight:bold}
  .nav-pills > .item_home > .nav-link:hover {background-color:#0d6efd; color:white;}
  .nav-pills > .item_home > .active {background-color:#0d6efd; color:white;}
  
  .nav-pills > .item_away > .nav-link {color:black;  font-weight:bold}
  .nav-pills > .item_away > .nav-link:hover {background-color:#198754; color:white;}
  .nav-pills > .item_away > .active {background-color:#198754; color:white;}
</style>

<!--기록작성 페이지만 fluid-->
<div class="container-fluid" style="font-size:12px"><br>

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page">1. 경기 방식 설정</li>
            <li class="breadcrumb-item" aria-current="page">2. 선수 선발</li>
            <li class="breadcrumb-item  active fw-bold text-decoration-underline" aria-current="page">3. 경기 기록</li>
        </ol>
    </nav>

    <?php
        $MatchId = $_GET['MatchId'];
        
        include "./db/db.php";
        
            #선수 리스트 쿼리
            $sql = "SELECT * FROM PlayerList";
            $sql_result = $conn->query($sql);
            
            

            #홈,어웨이 팀 이름
            $teamName_sql = "SELECT Home,Away FROM MatchList WHERE MatchId = $MatchId";
            $teamName_result = $conn->query($teamName_sql);
            $row = $teamName_result->fetch_object();
    ?>

    <div class="row g-1 align-items-center">
    <form class="" action="db/recording.php" method="POST">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item item_home" role="presentation">
                <button class="nav-link active border" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                    <?php echo $row->Home ?> (Home)
                </button>
            </li>
            <li class="nav-item  item_away" role="presentation">
                <button class="nav-link border" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                <?php echo $row->Away ?> (Away)
                </button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            
            <!--Home Record-->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-center align-middle table-fixed text-nowrap" style="text-align:center">
                        <thead class="table-primary">
                            <tr class="align-middle">
                                <th rowspan="2">이름</th>
                                <th colspan="2">2점</th>
                                <th colspan="2">3점</th>
                                <th rowspan="2">RE</td>
                                <th rowspan="2">AS</td>
                                <th rowspan="2">ST</td>
                                <th rowspan="2">BS</td>
                                <th rowspan="2">PF</td>
                            </tr>
                            <tr>
                                <th>성공</th>
                                <th>실패</th>
                                <th>성공</th>
                                <th>실패</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include "./db/db.php";
                                
                                #2점, 3점 점수 쿼리
                                $sql_score = "SELECT twoPoint, threePoint FROM MatchList WHERE MatchId = $MatchId";
                                $sql_score_result = $conn->query($sql_score);
                                $row = $sql_score_result->fetch_object();
                                $twoPoint = $row->twoPoint;
                                $threePoint = $row->threePoint;
                                

                                $sql = "SELECT *
                                        FROM RecordData
                                        JOIN PlayerList ON PlayerList.PlayerId = RecordData.PlayerId
                                        WHERE MatchId = $MatchId and HomeAway = 0";

                                $sql_result = $conn->query($sql);

                                while($row = $sql_result->fetch_object()){
                                    echo "
                                    <tr>                           
                                        <td style='width:80px'>".$row->backNumber.".".$row->PlayerName."</td>
                                        <input type='hidden' name='home_PlusScore[]' value=$row->PlusScore>
                                        <input type='hidden' name='home_PlayerId[]' value=$row->PlayerId>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='home_twoPoint_m[]' type='number' value=$row->twoPoint_m min=0/>
                                        </td>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='home_twoPoint_a[]' type='number' value=$row->twoPoint_a min=0/>
                                        </td>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='home_threePoint_m[]' type='number' value=$row->threePoint_m min=0/>
                                        </td>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='home_threePoint_a[]' type='number' value=$row->threePoint_a min=0/>
                                        </td>
                                            <td class='record_table_td'>
                                        <input class='form-control-sm' name='home_Rebound[]' type='number' value=$row->Rebound min=0/>
                                        </td>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='home_Assist[]' type='number' value=$row->Assist min=0/>
                                        </td>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='home_Steal[]' type='number' value=$row->Steal min=0/>
                                        </td>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='home_Block[]' type='number' value=$row->Block min=0/>
                                        </td>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='home_Foul[]' type='number' value=$row->Foul min=0/>
                                        </td>
                                    </tr>
                                    ";
                                }  
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!--Away Record-->
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="table-responsive">
                    <table class="table table-bordered table-hover align-center align-middle" style="text-align:center">
                        <thead class="table-success">
                            <tr class="align-middle">
                                <th rowspan="2">이름</th>
                                <th colspan="2">2점</th>
                                <th colspan="2">3점</th>
                                <th rowspan="2">RE</td>
                                <th rowspan="2">AS</td>
                                <th rowspan="2">ST</td>
                                <th rowspan="2">BS</td>
                                <th rowspan="2">PF</td>
                            </tr>
                            <tr>
                                <th>성공</th>
                                <th>실패</th>
                                <th>성공</th>
                                <th>실패</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include "./db/db.php";

                                $sql = "SELECT *
                                        FROM RecordData
                                        JOIN PlayerList ON PlayerList.PlayerId = RecordData.PlayerId
                                        WHERE MatchId = $MatchId and HomeAway = 1";

                                $sql_result = $conn->query($sql);

                                while($row = $sql_result->fetch_object()){
                                    echo "
                                    <tr>
                                        <td style='width:80px'>".$row->backNumber.".".$row->PlayerName."</td>
                                        <input type='hidden' name='away_PlusScore[]' value=$row->PlusScore>
                                        <input type='hidden' name='away_PlayerId[]' value=$row->PlayerId>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='away_twoPoint_m[]' type='number' value=$row->twoPoint_m min=0/>
                                        </td>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='away_twoPoint_a[]' type='number' value=$row->twoPoint_a min=0/>
                                        </td>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='away_threePoint_m[]' type='number' value=$row->threePoint_m min=0/>
                                        </td>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='away_threePoint_a[]' type='number' value=$row->threePoint_a min=0/>
                                        </td>
                                            <td class='record_table_td'>
                                        <input class='form-control-sm' name='away_Rebound[]' type='number' value=$row->Rebound min=0/>
                                        </td>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='away_Assist[]' type='number' value=$row->Assist min=0/>
                                        </td>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='away_Steal[]' type='number' value=$row->Steal min=0/>
                                        </td>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='away_Block[]' type='number' value=$row->Block min=0/>
                                        </td>
                                        <td class='record_table_td'>
                                            <input class='form-control-sm' name='away_Foul[]' type='number' value=$row->Foul min=0/>
                                        </td>
                                    </tr>
                                    ";
                                }  
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--//tab-content-->

        <di class="row">
            <div class="col-auto">    
                <input type="hidden" name="MatchId" value=<?php echo $MatchId ?> >
                <input type="hidden" name="twoPoint" value=<?php echo $twoPoint ?> >
                <input type="hidden" name="threePoint" value=<?php echo $threePoint ?> >
                <button type="submit" class="btn btn-secondary btn-sm">저장</button>
                </form>
            </div>
            <!--수정으로 페이지 접속시 삭제 버튼 보이기-->
            <?php
                if($_GET['modify']==1){
                    echo "
            <form action='db/del_match.php' post='GET' class='col-auto'>
                <input type='hidden' name='MatchId' value=$MatchId>
                <button type='submit' class='btn btn-secondary btn-sm'>삭제</button>
            </form>
                    ";
                }
            ?>
        </div>

        <!--/container-->
        </div><br>

<?php
    include_once("footer.php");
?>

    </div><!--/wrap-->
</body>

<!--기록 페이지에만 필요한 javascript-->
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.4.min.js" ></script>
<script src="src/bootstrap-input-spinner.js" ></script>

<script>
    $("input[type='number']").inputSpinner()
</script>
<!--/기록 페이지에만 필요한 javascript-->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</html>

