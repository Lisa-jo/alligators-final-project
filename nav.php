<?php

//require('session_validation.php');
// Start session to store variables

if (!isset($_SESSION)) {

    session_start();

}

// Allows user to return 'back' to this page

//ini_set('session.cache_limiter', 'public');

//session_cache_limiter(false);

require 'db_configuration.php';


?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/main_style.css" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles/custom_nav.css" type="text/css">
    <title>SAFe explorer</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css"
          rel="stylesheet"/>
    <link rel="stylesheet" href="./mainStyleSheet.css">
	
</head>

<body class="body_background">
<div id="wrap">


    <div id="nav">
        <ul>
            <a href="index.php"><li class="horozontal-li-logo"><img src ="./images/image1.png"><br/>SAFe Explorer</li></a>
            <a href="trains_list.php"><li <?php if($nav_selected == "TRAINS"){ echo 'class="current-page"'; } ?>><img src="./images/image4.png"><br/>Trains</li></a>
            <a href="org_list.php"><li <?php if($nav_selected == "ORG"){ echo 'class="current-page"'; } ?>><img src="./images/image2.png"><br/>Org</li></a>
            <a href="capacity_active_pi.php"><li <?php if($nav_selected == "CAPACITY"){ echo 'class="current-page"'; } ?>><img src="./images/image6.png"><br/>Capacity</li></a>
            <a href=""><li <?php if($nav_selected == "TRAINING"){ echo 'class="current-page"'; } ?>><img src="./images/image10.png"><br/>Training</li></a>
            <a href=""><li <?php if($nav_selected == "REPORTS"){ echo 'class="current-page"'; } ?>><img src="./images/image5.png"><br/>Reports</li></a>
            <a href="import_csv.php"><li <?php if($nav_selected == "SETUP"){ echo 'class="current-page"'; } ?>><img src="./images/image3.png"><br/>Setup</li></a>
            <a href=""><li <?php if($nav_selected == "LOGIN"){ echo 'class="current-page"'; } ?>><img src="./images/image7.png"><br/>Login</li></a>
            <a href=""><li <?php if($nav_selected == "HELP"){ echo 'class="current-page"'; } ?>><img src="./images/image8.png"><br/>Help</li></a>
		<li class="horozontal-li-search" <?php if($nav_selected == "SEARCH"){ echo 'class="current-page"'; } ?>>     
			<div>
				<input type="text" id="search" name="search" style="height:40px; margin-top:10px;">
				<img src="./images/Search3.png" width=50 style="position:absolute; top:6px; right:-2px;">

			</div><br/>
		</li>
        </ul>
      <br />
    </div>

    <table style="width:1250px">
      <tr>
        <?php if($left_buttons == "YES"){ ?>
          <td style="width: 120px;" valign="top">
          <?php
          if ($nav_selected == "TRAINS") {
          include("./trains_left-menu.php");
        } elseif ($nav_selected == "ORG") {
          include("./org_left-menu.php");
		} elseif ($nav_selected == "CAPACITY") {
		  include("./capacity_left-menu.php");
        } else {
          include("./left-menu.php");
        }
          ?>
          </td>
        <td style="width: 1100px;" valign="top">
        <?php } else { ?>
        <td style="width: 100%;" valign="top">
        <?php } ?>
