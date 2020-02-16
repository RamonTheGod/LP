<?php
	include "common/connect.php";
	
	$gemail = str_replace(' ','',$_GET['email']);
	$guserid = str_replace(' ','',$_GET['userid']);
	$gpass = str_replace(' ','',$_GET['pass']);
	$sql = "select user_id,username from users where email = '$gemail' and user_id = '$guserid' and confirmation = '$gpass'";
	// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
	$result = @mysqli_query($conn, $sql);

	// while ($r = mysql_fetch_array($result)) {
	while ($r = mysqli_fetch_assoc($result)) {
		$sid=$PHP_SESSION;
		srand((double)microtime()*1000000);
		$session_id = md5(uniqid(rand()));
		session_id($session_id);
		session_name("sid");
		session_start();
		setcookie("username", $r['username'], time()+60*60*24*3000);
		setcookie("userid", $r['user_id']);
		setcookie("sessid", $session_id);
		$loggedin = 1;
		
		$guserid = $_GET['userid'];
		$guserid = preg_replace(' ','',$guserid);
		$sql2 = "update users set confirmation = 1 where user_id = $guserid";
		$result2 = @mysql_db_query("ramonlp_ramonlp", $sql2);
		
		header ("location: managelinks.php");
	}
	
	if ($loggedin != 1) {
?>
<?php /// what happens when wrong val code ?>
<?php } ?>