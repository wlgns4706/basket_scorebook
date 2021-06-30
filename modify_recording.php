<?php
	include_once("header.php");
?>
<style>
  .nav-pills > .nav-item > .nav-link {color:black;}
  .nav-pills > .nav-item > .nav-link:hover {background-color:gray}
  .nav-pills > .nav-item > .active {background-color:gray; color:white; font-weight:bold}
  
</style>

<!--기록작성 페이지만 fluid-->
<div class="container-fluid" style="font-size:12px">
    <?php
        $MatchId = $_GET['MatchId'];
    ?>



    <!--홈,어웨이 팀 이름 쿼리-->
    <?php
        include "./db/db.php";
        
        #2점, 3점 점수 쿼리
        $sql_score = "SELECT twoPoint, threePoint, Home, Away FROM MatchList WHERE MatchId = $MatchId";
        $sql_score_result = $conn->query($sql_score);
        $row = $sql_score_result->fetch_object();
        $twoPoint = $row->twoPoint;
        $threePoint = $row->threePoint;
    ?>


    <br>
    <form class="row g-1 align-items-center" action="db/recording.php" method="POST">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home (<?php echo $row->Home;?>)</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Away (<?php echo $row->Away;?>)</button>
            </li>
        </ul>


        <div class="tab-content" id="pills-tabContent">
            
            <!--Home Record-->
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-center align-middle table-fixed text-nowrap table-light" style="text-align:center">
                        <thead>
                            <tr class="align-middle">
                                <th rowspan="2">번호</th>
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

                                $sql = "SELECT *
                                        FROM RecordData
                                        JOIN PlayerList ON PlayerList.PlayerId = RecordData.PlayerId
                                        WHERE MatchId = $MatchId and HomeAway = 0";

                                $sql_result = $conn->query($sql);

                                while($row = $sql_result->fetch_object()){
                                    echo "
                                    <tr>
                                        <td style='width:40px'>
                                            <input class='form-control form-control-sm' name='home_backNumber[]' type='text' value=$row->backNumber>
                                            <input type='hidden' name='home_PlayerId[]' value='$row->PlayerId'>
                                        </td>
                                        <td style='width:80px'>$row->PlayerName</td>
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
                    <table class="table table-bordered table-hover align-center align-middle table-light" style="text-align:center">
                        <thead>
                            <tr class="align-middle">
                                <th rowspan="2">번호</th>
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
                                        <td style='width:40px'>
                                            <input class='form-control form-control-sm' name='away_backNumber[]' type='text' value=$row->backNumber>
                                            <input type='hidden' name='away_PlayerId[]' value='$row->PlayerId'>
                                        </td>
                                        <td style='width:80px'>$row->PlayerName</td>
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
                       


                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">.asdasd..</div>
            </div>
        <div class="row g-1">
            <div class="col-auto">
                <input type="hidden" name="MatchId" value=<?php echo $MatchId ?> >
                <input type="hidden" name="twoPoint" value=<?php echo $twoPoint ?> >
                <input type="hidden" name="threePoint" value=<?php echo $threePoint ?> >
                <button type="submit" class="btn btn-secondary btn-sm">수정완료</button>
            </div>
    </form>


            <form action="db/del_match.php" post="GET" class="col-auto">
                <input type="hidden" name="MatchId" value=<?php echo $MatchId ?> >
                <button type="submit" class="btn btn-secondary btn-sm">삭제</button>
            </form>
        </div>





<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.12.4.min.js" ></script>
<script src="src/bootstrap-input-spinner.js" ></script>

<script>
    $("input[type='number']").inputSpinner()
</script>


 <!--/container-->
 </div><br>

<?php
    include_once("footer.php");
?>
<!--/wrap-->
</div>



</body>