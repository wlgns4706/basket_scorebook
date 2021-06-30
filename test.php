<?php
	include_once("header.php");
?>

        <div class="container" style="font-size:12px">
        <br>
   
<script>
            //비밀번호 중복 체크
            function btn_check(box){
                
                if(box.checked == true){
                    

                    var x = document.getElementById("tr_away_13");
                    x.style.display = "none";    

                } else {
                    var x = document.getElementById("tr_away_13");
                    x.style.display = "block";   
                }
                
            }


</script>



<div class="row">



<table class='table table-bordered align-middle  table-fixed text-nowrap ' style='text-align:center'>
    <thead>
    </thead>
    <tr>
        <th colspan=3>홈</th>
    </tr>
        <tr>
            <th class="h-100 bg-success">
                
                    <div class="col-4 bg-primary float-start">asd</div>
                    <div class="col-4 float-none">asd</div>
                    <div class="col-4   float-end">asd</div>
                
            </th>
            <th>등번호</th>
            <th>이름</th>
        </tr>
    <tbody>
        <tr>
            <td>11</td>
            <td>5</td>
            <td>8</td>
        </tr>
        <tr>
            <td>1</td>
            <td>2</td>
            <td>3</td>
        </tr>
        <tr>
            <td>4</td>
            <td>10</td>
            <td>8</td>
        </tr>
        <tr>
            <td>7</td>
            <td>3</td>
            <td>3</td>
        </tr>



    </tbody>
</table>

  </div>



</div>
        <!--/container-->
        </div>

</body>

<?php
    include_once("footer.php");
?>
<!--/wrap-->
</div>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</html>