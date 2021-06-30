<?php
	include $_SERVER["DOCUMENT_ROOT"]."/header.php";
?>

<div class="container"><br>
    
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active fw-bold text-decoration-underline" aria-current="page">1. 경기 방식 설정</li>
    <li class="breadcrumb-item" aria-current="page">2. 선수 선발</li>
    <li class="breadcrumb-item" aria-current="page">3. 경기 기록</li>
  </ol>
</nav>

    <form class="row g-1 align-items-center" action="/db/match_add.php" method="POST">
            <div class="col-6 col-sm-4">
                <label class="col-form-label fw-bold">경기명</label>
                <input class="form-control" name="mName" type="text">
            </div>

            <div class="col-6 col-sm-4">
                <label class="col-form-label fw-bold">경기 일자</label>
                <input class="form-control" name="mDate" type="date">
            </div>

            <div class="col-3 col-sm-1">        
                <label class="col-form-label fw-bold">경기시간(분)</label>
                <input class="form-control" name="mTime" type="number" value="10">
            </div>

            <div class="col-3 col-sm-1">
                <label class="col-form-label fw-bold">쿼터</label>
                <select class="form-select" name="mDivide">
                    <option value=0>4Q</option>
                    <option value=1>전후반</option>
                    <option value=2>단판</option>
                </select>
            </div>

            <div class="col-6 col-sm-2">        
                <label class="col-form-label fw-bold">경기 방식</label>
                <select class="form-select" name="mType">
                    <option value=0>3on3</option>
                    <option value=1>5on5</option>
                    <option value=2>원정</option>
                </select>
            </div>

            <div class="col-3 col-sm-1">        
                <label class="col-form-label fw-bold">2점슛 점수</label>
                <input class="form-control" name="twoPoint" type="number" value="2">
            </div>
            <div class="col-3 col-sm-1">        
                <label class="col-form-label fw-bold">3점슛 점수</label>
                <input class="form-control" name="threePoint" type="number" value="3">
            </div>

            <div class="col-6 col-sm-2">
                <label class="col-form-label fw-bold">홈 팀명</label>
                <input class="form-control" name="Home" type="text">
            </div>

            <div class="col-6 col-sm-2">
                <label class="col-form-label fw-bold">어웨이 팀명</label>
                <input class="form-control" name="Away" type="text">
            </div>

            <div class="row g-1">
                <div class="col-auto">
                    <input type="hidden" name="TeamId" value=<?php echo $TeamId; ?> >
                    <button type="submit" class="btn btn-secondary">다음</button>
                </div>
            </div>
        
    </form>

    
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