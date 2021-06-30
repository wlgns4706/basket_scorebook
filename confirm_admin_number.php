<?php

  include "db/db.php";

  $confirm_admin_number = '6318';
  $input_admin_number = $_POST['input_admin_number'];

  if($confirm_admin_number == $input_admin_number){
    echo "<span class='fw-bold' style='color:blue'>확인 완료</span>";
  } else {
    echo "<span class='fw-bold' style='color:red'>틀렸습니다. 관리자에게 문의바랍니다.</span>";
    echo "<script>document.getElementById('input_admin_number').value =''</script>";
    
  }
?>