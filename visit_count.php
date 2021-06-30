<?php
	

  if ( !file_exists ( "count.txt") )
{
    $fp = fopen("count.txt", "w+") ;
    fclose($fp) ;
}

if ( !file_exists ( "visit_ip.txt") )
{
    $fp = fopen("visit_ip.txt", "w+") ;
    fclose($fp) ;
}

$count = file("count.txt");
$count[0] = chop($count[0]);
$countdata = explode("::", $count[0]);
$date = $countdata[0];
$daycount = (int)$countdata[1];
$counta = (int)$countdata[2];
$today = date("Y-m-d");


if ( !$_COOKIE["ip"] ){
  if($date == $today){
    $daycount++ ;
  } else {
    #다음 날짜로 넘어갈시 이전 날짜 데이터 백업
    $fpp = fopen("visit_ip.txt","a");
    fwrite($fpp, "$date::$daycount::$counta"."\n");
    fclose($fpp);

    $date = $today;
    $daycount = 1;
    }

  $counta++ ;
  $fp = fopen("count.txt","w");
  fwrite($fp, "$date::$daycount::$counta");
  fclose($fp) ;

  $visit_ip = $_SERVER['REMOTE_ADDR'];
  $visit_time = date("h:i", time());
  SetCookie("ip", $visit_ip, time()+7200) ;
  
  $fpp = fopen("visit_ip.txt","a");
  
  fwrite($fpp, "$counta/$visit_ip($visit_time)"."\n");
  fclose($fpp) ;

}

?>
