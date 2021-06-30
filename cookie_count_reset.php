<?php
	
 $fp = fopen("count.txt","w");
  
  fwrite($fp, "");
  fclose($fp) ;


  $fpp = fopen("visit_ip.txt","w");
  
  fwrite($fpp, "");
  fclose($fpp) ;

  $visit_ip = $_SERVER['REMOTE_ADDR'];
  SetCookie("ip", $visit_ip, time()-1) ;


?>



<div class="container">
<?php
echo '<meta charset="utf-8">';
echo "<font color='red'><strong>".$date."</strong></font> 의 방문자 수 : <font color='red'><strong>".$daycount."</strong></font><br>전체 방문자 수 :<font color='red'><strong> ".$counta."</strong></font><br>";
?>



<!--/container-->
</div>

<!--/wrap-->
</div>



</body>





        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</html>