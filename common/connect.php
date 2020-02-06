<?php

error_reporting(E_ERROR);
	// mysql_connect(localhost, "ramonlp_ramonlp", "passwordhere");


 $dbhost = "remotemysql.com";
 $dbuser = "Co705YwcXR";
 $dbpass = "pt7gluoYVG";
 $db 	 = "Co705YwcXR";

 $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

 // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

	
//  $sql_host = "localhost";
//  $sql_username = "root1";
//  $sql_password = "123456";
//  $sql_database 	 = "ramonlp_ramonlp";


// $mysqli = new mysqli($sql_host , $sql_username , $sql_password , $sql_database);

// if(empty($_GET['u'])){
	
// 	print_r("jeffrey");
// }
// print_r($_GET['u']);
// die();
	
	if ($_GET['u']) {
		$thisuser = str_replace(' ','',$_GET['u']);
	} else if ($_COOKIE['username']) {
		$cusername = str_replace(' ','',$_COOKIE['username']);
		
		$sql = "select user_id from users where username = '$cusername'";
		// $result = @mysql_db_query("ramonlp_ramonlp", $sql);
		$result = @mysqli_query($conn, $sql);
		
		// while ($r = mysql_fetch_array($result)) {
		while ($r = mysqli_fetch_assoc($result)) {
			$thisuser = $r['user_id'];
		}
	} else {
		$thisuser = '';
	}
	
	if ($thisuser != '') {
		$sql = "select * from styles where user_id = $thisuser";
		// $result = @mysql_db_query("ramonlp_ramonlp", $sql);
		$result = @mysqli_query($conn, $sql);

		// while ($r = mysql_fetch_array($result)) {
		while ($r = mysqli_fetch_assoc($result)) {
			$newwin = $r['newwin'];
			$font = $r['font'];
			$fcolor = $r['fcolor'];
			$bgcolor = $r['bgcolor'];
			$hlcolor = $r['hlcolor'];
			
			if ($r['newwin'] == 1) {
				$blanker = ' target="_blank"';
			} else {
				$blanker = '';
			}
		}
	} else {
		$newwin = 0;
		$font = 11;
		$fcolor = '#000000';
		$bgcolor = '#FFFFFF';
		$hlcolor = '#C3C8CD';
	}
?>
