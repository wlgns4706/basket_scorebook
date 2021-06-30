<?php
	include $_SERVER["DOCUMENT_ROOT"]."/header.php";

    $PlayerId = $_GET['PlayerId'];
?>




<div class="container" style="font-size:12px">
<br>
<br>

<div class="row">
    <!--좌측 사이드-->
    <div class="col-6">
        <div class="row">
            <div class="col-6">
                <?php
                    include $_SERVER["DOCUMENT_ROOT"]."/db/db.php";

                    $sql = "SELECT PlayerName FROM PlayerList WHERE PlayerId = $PlayerId";

                    $sql_result = $conn->query($sql);

                    echo "<h4>".$sql_result->fetch_object()->PlayerName."</h4>";
                ?>
            </div>

            <div class="col-6 col-md-3">
                <select class="form-select" name="search_type" id="player_record_type" onchange="play_record_query()">
                    <option value=0 selected>누적 기록</option>
                    <option value=1>평균 기록</option>
                </select>
            </div>
        </div> <!--row 끝-->
        <br>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-center table-fixed text-nowrap" style="text-align:center">
                <thead class='table-light'>
                        <tr class="align-middle">
                            <th>항목</th>
                            <th id="change_sumavg">기록</th>
                            <th>순위</th>
                        </tr>
                    </thead>
                <tbody id="player_record_tbody">
                </tbody>
            </table>
        </div>
    </div>

    <!--우측 사이드-->
    <div class="col-6">
    </div>

</div> <!--row테이블 끝-->


    <div class="alert alert-light" role="alert">
        M : 슛 성공 횟수 <br>
        A : 슛 실패 횟수<br>
        % : 슛 성공률<br>
        RE : 리바운드<br>
        AS : 어시스트<br>
        ST : 스틸<br>
        BS : 블락슛<br>
        PF : 개인 파울<br>
    </div>
    
<!--/container-->
</div>

<?php
    include $_SERVER["DOCUMENT_ROOT"]."/footer.php";
?>
<!--/wrap-->
</div>



</body>




<script>

    //첫 화면시 누적데이터 출력
    var str = document.getElementById("player_record_tbody");
    str.innerHTML = play_record_query();



    //검색 방법 설정
    
    function play_record_query() {
        
        //누적기록인지 평균 기록인지 테이블 th 구간 워딩 변경
        if ($("#player_record_type").val()==0) {
            $("#change_sumavg").html('누적 기록');
        }else{
            $("#change_sumavg").html('평균 기록');
        }
        
                jQuery.ajax({
                    url: "/db/player_record_query.php",
                    type: "GET",
                    dataType: "text",
                    data:{
                        'record_type' : $("#player_record_type").val(),
                        'PlayerId' : <?php echo $PlayerId;?>
                    },                   
                    success:function(data){
                    $("#player_record_tbody").html(data);
                    
                    },
                    error:function(jqXHR, textStatus, errorThrown){
                alert("에러 발생~~ \n" + textStatus + " : " + errorThrown);
                self.close();
                }
            }); 
    }

</script>




        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</html>