<?php
	include_once("demo_header.php");
?>

        <div class="container" style="font-size:14px"><br>

            <div class="row justify-content-md-center">
                <form class="col-12 col-md-6 align-center align-text-center" action="db/login.php" method="POST">
                    <p class="fs-4 fw-bold text-center">Basketball Scordbook 로그인</p>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="계정">
                        <label for="floatingInput">아이디를 입력해주세요</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">암호를 입력해주세요</label>
                    </div>
                        <button type="button" class="btn btn-secondary col-12">로그인</button>
                </form>
            </div><!--row-->

<?php
            include "./db/db.php";
            $hashed_pw = password_hash("test",PASSWORD_DEFAULT);

            $sql = "UPDATE TeamList SET Password = '$hashed_pw' WHERE TeamId = 2";


            $sql_result = $conn->query($sql);

            echo $hashed_pw;

            
#session_destroy();
?>
        </div> <!--/container-->

<?php
    include_once("footer.php");
?>

    </div> <!--/wrap-->
</body>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    
</html>