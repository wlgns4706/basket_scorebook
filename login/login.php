<?php
	include $_SERVER["DOCUMENT_ROOT"]."/header.php";
?>

        <div class="container" style="font-size:14px"><br>

            <div class="row justify-content-md-center">
                <form class="col-12 col-md-4 align-center align-text-center" action="/db/login_ok.php" method="POST">
                    <p class="fs-4 fw-bold text-center">로그인</p>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="계정" name="Account">
                        <label for="floatingInput">아이디를 입력해주세요</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="Password" required>
                        <label for="floatingPassword">암호를 입력해주세요</label>
                    </div>
                        <button type="submit" class="btn btn-secondary col-12">로그인</button>
                </form>
            </div><!--row-->

        </div> <!--/container-->

<?php
    include $_SERVER["DOCUMENT_ROOT"]."/footer.php";
?>

    </div> <!--/wrap-->
</body>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    
</html>