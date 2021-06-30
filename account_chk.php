<?php

    include "db/db.php";

    if(!empty($_POST['InputAccount'])){
      
      $InputAccount = $_POST['InputAccount'];
      $sql = "SELECT Account from TeamList where Account = '$InputAccount'";
      
      $result = $conn->query($sql);

      $row = $result->fetch_object();

      $account_chk = $row->Account;
      
      if(!$account_chk){
        echo "<span class='fw-bold' style='color:blue'>사용 가능</span>";
      }else{
        echo "<span class='fw-bold' style='color:red'>중복된 아이디</span>";
        echo "<script>document.getElementById('InputAccount').value ='';
        document.getElementById('InputAccount').focus();</script>";
      }
    }


 


?>