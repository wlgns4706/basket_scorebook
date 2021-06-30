<?php
	include "visit_count.php";
    session_start();
    if (!$_SESSION['TeamId']){
        $TeamId = 12;
    }else{
        $TeamId = $_SESSION['TeamId'];
    }
?>


<!DOCTYPE HTML>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    
    <!--jquery-->
    <script src="//code.jquery.com/jquery.min.js"></script>

    <!--Custom CSS-->
    <link href="/custom_css.css" rel="stylesheet" type="text/css">


</head>

<body>
    <div class="wrap">
        <!--메뉴바-->
        <nav class="navbar bg-dark navbar-dark navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand fst-italic" href="/">Basketball Scorebook</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/intro.php">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                선수단
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                
                                <li><a class="dropdown-item" href="/player_add.php">선수 등록</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                기록 확인
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/player/player_list.php">개인 기록</a></li>
                                <li><a class="dropdown-item" href="/match/match_list.php">경기 기록</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/match/match_add.php">기록 시작</a>
                        </li>
                    </ul>
                    <?php
                        if(!$_SESSION['TeamId']){
                            echo "<a class='navbar-text' style='text-decoration:none; color:white' href='/login/login.php'>로그인</a>&nbsp&nbsp<a class='navbar-text' style='text-decoration:none; color:white' href='/team_add.php'>팀등록</a>";
                        }else{
                            $TeamName = $_SESSION['TeamName'];
                            echo "<a class='navbar-text' style='text-decoration:none; color:white' href='#'>$TeamName</a>&nbsp;<a class='navbar-text' style='text-decoration:none' href='/db/logout.php'>[Logout]</a>";
                        }
                    ?>
                    
                </div>
            </div>
        </nav> <!--/메뉴바-->
