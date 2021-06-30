<?php
	include $_SERVER["DOCUMENT_ROOT"]."/header.php";
?>




<div class="container" style="font-size:12px">
<br>

<!--검색 옵션-->
<div class="row g-1">

    <div class="col-6 col-md-3">
        <select class="form-select" name="search_type" id="search_type" onchange="playlist_query()">
            <option value=0 selected>누적 기록</option>
            <option value=1>평균 기록</option>
        </select>
    </div>

    <div class="col-6 col-md-3">
        <select class="form-select" name="search_type" id="rank_type" onchange="playlist_query()">
            <option value='PlayerName' selected>항목별 순위</option>
            <option value='tot_score'>득점</option>
            <option value='tot_twoPoint_m'>2점 성공</option>
            <option value='tot_twoPoint_p'>2점 성공률</option>
            <option value='tot_threePoint_m'>3점 성공</option>
            <option value='tot_threePoint_p'>3점 성공률</option>
            <option value='tot_field_m'>필드골 성공</option>
            <option value='tot_field_p'>필드골 성공률</option>
            <option value='tot_Rebound'>리바운드</option>
            <option value='tot_Assist'>어시스트</option>
            <option value='tot_Steal'>스틸</option>
            <option value='tot_Block'>블락</option>
        </select>
    </div>
    

</div><!--//검색옵션 끝-->
<br>
<div class="table-responsive">
    <table class="table table-bordered table-hover align-center table-fixed text-nowrap" style="text-align:center">
        <thead class='table-light'>
                <tr class="align-middle">
                    <th rowspan="2">이름</th>
                    <th rowspan="2">경기수</th>
                    <th rowspan="2">score</th>
                    <th colspan="2">2점</th>
                    <th colspan="2">3점</th>
                    <th colspan="2">필드골</th>
                    <th rowspan="2">RE</td>
                    <th rowspan="2">AS</td>
                    <th rowspan="2">ST</td>
                    <th rowspan="2">BS</td>
                    <th rowspan="2">PF</td>
                </tr>
                <tr>
                    <th>M/A</th>
                    <th>%</th>
                    <th>M/A</th>
                    <th>%</th>
                    <th>M/A</th>
                    <th>%</th>
                </tr>
            </thead>
        <tbody id="playerlist_query_tbody">
        </tbody>
    </table>
    </div>
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
    var str = document.getElementById("playerlist_query_tbody");
    str.innerHTML = playlist_query();



    //검색 방법 설정
    
    function playlist_query() {
        
        var search_type = $("#search_type").val();
        var rank_type = $("#rank_type").val();

        
                jQuery.ajax({
                    url: "/db/playlist_query.php",
                    type: "GET",
                    dataType: "text",
                    //data:'search_type='+search_type,
                    data:{
                        'search_type' : $("#search_type").val(),
                        'rank_type' : $("#rank_type").val()
                    },                   
                    success:function(data){
                    $("#playerlist_query_tbody").html(data);
                    
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