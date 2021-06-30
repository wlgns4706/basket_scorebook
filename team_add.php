<?php
	include $_SERVER["DOCUMENT_ROOT"]."/header.php";
?>
        <script>
            //아이디 중복 체크
            function checkAvailability() {

                var account = $("#InputAccount").val();

                if(account.length < 4 || account.length > 20){
                    $("#user-availability-status").html("4자리 ~ 15자리 이내로 입력해주세요.");
                    document.getElementById("InputAccount").value ='';
                    } else {
                        jQuery.ajax({
                            url: "account_chk.php",
                            data:'InputAccount='+$("#InputAccount").val(),
                            type: "POST",
                            success:function(data){
                            $("#user-availability-status").html(data);
                        },
                    error:function (){}
                    });
                }
            }

            //비밀번호 조합 조건
            function chkPW(){

                var pw = $("#input_pw").val();
                var num = pw.search(/[0-9]/g);
                var eng = pw.search(/[a-z]/ig);
                //var spe = pw.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

                if(pw.length < 8 || pw.length > 20){
                    $("#chk_pw_ok").html("8자리 ~ 20자리 이내로 입력해주세요.");
                    document.getElementById("input_pw").value =''; //에러시 값 초기화
                    return false;
                }else if(pw.search(/\s/) != -1){
                    $("#chk_pw_ok").html("비밀번호는 공백 없이 입력해주세요.");
                    document.getElementById("input_pw").value =''; //에러시 값 초기화
                    return false;
                }
                /*else if(num < 0 || eng < 0 || spe < 0 ){
                    alert("영문,숫자, 특수문자를 혼합하여 입력해주세요.");
                    return false;
                }*/
                else {
                    $("#chk_pw_ok").html("<span class='fw-bold' style='color:blue'>사용 가능</span>");
                    console.log("통과"); 
                    return true;
                }
            }


            //비밀번호 중복 체크
            function confirm_password(){
                var input_pw = $("#input_pw").val();
                var confirm_pw = $("#confirm_pw").val();

                if (input_pw != confirm_pw || confirm_pw==""){
                    $("#confirm_pw_ok").html("비밀번호를 다시 확인해주세요.");
                    return false;
                } else {
                    $("#confirm_pw_ok").html("<span class='fw-bold' style='color:blue'>확인 완료</span>");
                    console.log("통과"); 
                    return true;
                }
            }
            
            //관리자 번호 확인 후 팀 등록 가능
            function confirm_admin_number(){
                var input_admin_number = $("#input_admin_number").val();

                jQuery.ajax({
                    url: "confirm_admin_number.php",
                    data:'input_admin_number='+$("#input_admin_number").val(),
                    type: "POST",
                    success:function(data){
                    $("#confirm_admin_number_ok").html(data);
                    },
                    error:function (){}
                });
            }

            
        </script>

        <div class="container">
        <br>

            <form class="row g-1" style="font-size:14px" action="/db/team_add.php" method="POST">
                <div class="row justify-content-center g-1">
                    <div class="col-8 col-sm-4">
                        <label class="fw-bolder" style="font-size:16px">아이디</label>
                        <input type="text" placeholder="아이디" placeholder="아이디" class="form-control" name="Account" id="InputAccount" onBlur="checkAvailability()" required autofocus>
                        <label id="user-availability-status" class="fw-bold" style="color:red"></label>
                    </div>
                </div>
                <div class="row justify-content-center g-2">
                    <div class="col-8 col-sm-4">
                        <label class="fw-bolder" style="font-size:16px">비밀번호</label> 
                        <input type="password" placeholder="비밀번호" id="input_pw" class="form-control" name="Password" onBlur="chkPW()" required autofocus>
                        <label id="chk_pw_ok" class="fw-bold" style="color:red"></label>
                    </div>
                </div>
                <div class="row justify-content-center g-2">
                    <div class="col-8 col-sm-4">
                        <label class="fw-bolder" style="font-size:16px">비밀번호 재확인</label>
                        <input type="password"  class="form-control" id="confirm_pw" name="password-ok" onBlur="confirm_password()" required autofocus>
                        <label id="confirm_pw_ok" class="fw-bold" style="color:red"></label>
                    </div>
                </div>
                <div class="row justify-content-center g-2">
                    <div class="col-8 col-sm-4">
                        <label class="fw-bolder" style="font-size:16px">관리자 확인번호</label>
                        <input type="text" class="form-control" id="input_admin_number" onBlur="confirm_admin_number()" required autofocus>
                        <label id="confirm_admin_number_ok">※관리자에게 문의 바랍니다.</label>
                    </div>
                </div>
                <div class="row justify-content-center g-2">
                    <div class="col-8 col-sm-4">
                        <label class="fw-bold" style="font-size:16px">팀이름</label>
                        <input type="text" class="form-control" name="TeamName" required autofocus>
                        <label>※아이디 찾기시 필요합니다.</label>
                    </div>
                </div>

                <div class="row justify-content-center g-2">
                    <div class="col-8 col-sm-4">
                        <input type="hidden" name="CreateDate" value="<?php echo "date('Y-m-d H:i:s')"; ?>">
                        <button type="submit" class="btn btn-secondary col-12">등록</button>
                    </div>
                </div>
            </form>

            
        <!--/container-->
        </div>

<?php
    include $_SERVER["DOCUMENT_ROOT"]."/footer.php";
?>

    </div><!--/wrap-->
</body>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</html>