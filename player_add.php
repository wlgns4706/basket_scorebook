<?php
	include $_SERVER["DOCUMENT_ROOT"]."/header.php";
?>

<div class="container">
<br>

<form class="row g-3 align-items-center" action="db/player_add.php" method="POST">
    <div class="row g-1">
        <div class="col-2 col-sm-1">
            <label class="col-form-label fw-bold">팀이름</label>
        </div>
        <div class="col-6 col-sm-2">
            <fieldset disabled>
                <input type="text" id="disabledTextInput" class="form-control" placeholder='
                    <?php 
                        include "db/db.php";

                        $sql = "SELECT * FROM `TeamList` WHERE `TeamId` = $TeamId";
                        $sql_result = $conn->query($sql);

                        $row = $sql_result->fetch_object();
                        echo $row->TeamName;
                    ?>
                '>
            </fieldset> 
        </div>
    </div>
    
    <div class="row g-1">
        <div class="col-2 col-sm-1">
            <label class="col-form-label fw-bold">선수 이름</label>
        </div>
        <div class="col-6 col-sm-2">
            <input type="text" name="PlayerName" class="form-control">
        </div>
    </div>

    <div class="row g-1">
        <div class="col-2 col-sm-1">
            <label class="col-form-label fw-bold">생년 월일</label>
        </div>
        <div class="col-6 col-sm-2">
            <input type="date" name="playerBirthday" class="form-control"  required autofocus>

        </div>
    </div>

    <div class="row g-1">
        <div class="col-auto">
            <input type="hidden" name="TeamId" value=<?php echo $TeamId;?> >
            <button type="submit" class="btn btn-secondary">등록</button>
        </div>
    </div>
    
</form>


<div>
    <script>

    </script>
</div>
    
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