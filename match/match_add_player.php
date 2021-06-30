<?php
	include $_SERVER["DOCUMENT_ROOT"]."/header.php";
?>




        <div class="container" style="font-size:14px"><br>
            <?php
                $MatchId = $_GET['MatchId'];
            ?>
            
            <!-- 상단 brad-->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" aria-current="page">1. 경기 방식 설정</li>
                    <li class="breadcrumb-item active fw-bold text-decoration-underline" aria-current="page">2. 선수 선발</li>
                    <li class="breadcrumb-item" aria-current="page">3. 경기 기록</li>
                </ol>
            </nav>
        
            <!--각 팀 선수 선발-->
            <form class="row g-1 justify-content-center" action="/db/match_add_player.php" method="POST">
                <!--Home팀 구분-->

                    
                    <?php
                            include $_SERVER["DOCUMENT_ROOT"]."/db/db.php";

                            for ($i=0;$i<2;$i++){
                                #선수 리스트 쿼리
                                $sql = "SELECT * FROM PlayerList WHERE TeamId = $TeamId";
                                $sql_result = $conn->query($sql);
                                
                                #홈,어웨이 팀 이름
                                $teamName_sql = "SELECT Home,Away FROM MatchList WHERE MatchId = $MatchId";
                                $teamName_result = $conn->query($teamName_sql);
                                $teamName = $teamName_result->fetch_object();

                                switch ($i) {
                                    case 0:
                                        # $i = 0 -> Home
                                        $homeaway = "home";
                                        # btn-outline-color
                                        $btn_color = "primary";
                                        $teamName = $teamName->Home;
                                        break;
                                    
                                    case 1:
                                        # $i = 0 -> Away
                                        $homeaway = "away";
                                        $btn_color = "success";
                                        $teamName = $teamName->Away;
                                        break;
                                }

                                echo"
                <div class='col-6 col-lg-3'>
                    <table class='table table-bordered align-middle table-fixed text-nowrap ' style='text-align:center'>
                        <thead class='table-".$btn_color."'>
                            <tr>
                                <th colspan=3>$teamName($homeaway)</th>
                            </tr>
                            <tr> 
                                <th>점수+1</th>
                                <th>등번호</th>
                                <th>이름</th>
                            </tr>
                        </thead>
                        <tbody>
                                ";

                                while($row = $sql_result->fetch_object()){
                                    echo "
                            <tr id='tr_".$homeaway."_$row->PlayerId'>
                                <td style='width:10%'>
                                    <input type='checkbox' class='btn-check' name='".$homeaway."_plusscore[]' value='$row->PlayerId' id='plus_".$homeaway."_$row->PlayerId' autocomplete='off' disabled>
                                    <label class='btn btn-outline-".$btn_color." btn-sm' for='plus_".$homeaway."_$row->PlayerId'>+1</label>
                                </td>
                                <td style='width:30%'>   
                                    <input type='number' class='form-control form-control-sm' id='backnum_".$homeaway."_$row->PlayerId' name='".$homeaway."Backnum[]' aria-label='Text input with checkbox' min=0 disabled required autofocus>
                                </td>
                                <td>
                                    <input type='checkbox' class='btn-check col-1' id='".$homeaway."_$row->PlayerId' autocomplete='off' name='".$homeaway."Chk[]' value='$row->PlayerId' onClick='player_duple(this,$i)'>
                                    <label class='btn btn-outline-".$btn_color." btn-sm col-12 col-sm-8' for='".$homeaway."_$row->PlayerId'>$row->PlayerName</label><br>
                                </td>
                            </tr>
                                    ";
                                }  
                                echo "
                        </tbody>
                    </table>
                </div>
                ";
                                }
                    ?>

                <div class='row justify-content-center g-1'>
                    <div class='col-12 col-lg-6'>
                        <input type="hidden" name='TeamId' value=<?php echo $TeamId ?>>
                        <input type='hidden' name='MatchId' value='<?php echo $MatchId?>'>
                        <button type='submit' class='btn btn-secondary'>다음</button>
                    </div>
                </div>
                    
                
            </form><br>


        <!--/container-->
        </div>

<?php
    include $_SERVER["DOCUMENT_ROOT"]."/footer.php";
?>

    </div><!--/wrap-->
</body>


<script>
    function player_duple(box,hoaw){
        switch (hoaw) {
            case 0:
                hoaw = 'away';
                awho = 'home';
                break;
            case 1:
                hoaw = 'home';
                awho = 'away';
                break;
        }

        if(box.checked == true){
            //체크박스 클릭시 다른팀 동일한 플레이어의 tr테그 disaplay:none
            var x = document.getElementById("tr_"+hoaw+"_"+box.value);
            x.style.display = "none";    
            //체크박스 클릭시 +1 체크박스 enabled
            var y = document.getElementById("plus_"+awho+"_"+box.value);
            $(y).attr("disabled", false);
            //체크박스 클릭시 backnum input enabled
            var z = document.getElementById("backnum_"+awho+"_"+box.value);
            $(z).attr("disabled", false);

            } else {
                //체크박스 해제시 다시 원상 복귀
                var x = document.getElementById("tr_"+hoaw+"_"+box.value);
                x.style.display = "";   
                
                //체크박스 해제시 +1 체크박스 해제 후 disabled
                var y = document.getElementById("plus_"+awho+"_"+box.value);
                $(y).attr("checked", false);  
                $(y).attr("disabled", true);
                
                //체크박스 클릭시 backnum input enabled
                var z = document.getElementById("backnum_"+awho+"_"+box.value);
                document.getElementById("backnum_"+awho+"_"+box.value).value='';
                $(z).attr("disabled", true);
            }
        }
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    
</html>