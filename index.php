<?php
	include "common/connect.php";
		
	if (!$_COOKIE['username']) {
		header ("location: loginform.php");
	} else if (!$_COOKIE['userid']) {
		$cusername = str_replace(' ','',$_COOKIE['username']);
		$sql = "select user_id from users where username = '$cusername'";
		// $result = @mysql_db_query("ramonlp_ramonlp", $sql);
		$result = @mysqli_query($conn, $sql);
		
		// while ($r = mysql_fetch_array($result)) {
		while ($r = mysqli_fetch_assoc($result)) {
			// setcookie("userid", $r['user_id']);
			setcookie("userid", $r['user_id'], '/', time()+60*60*24*3000, '.launchpages.herokuapp.com');
			$sid=$PHP_SESSION;
			srand((double)microtime()*1000000);
			$session_id = md5(uniqid(rand()));
			session_id($session_id);
			session_name("sid");
			session_start();
			// setcookie("sessid", $session_id);
			setcookie("sessid", $session_id, '/', time()+60*60*24*3000, '.launchpages.herokuapp.com');

			// setcookie("userid", $r['user_id']);
			setcookie("userid", $r['user_id'], '/', time()+60*60*24*3000, '.launchpages.herokuapp.com');
			$cookieid = $r['user_id'];
		}
	} else {
		$cookieid = str_replace(' ','',$_COOKIE['userid']);
	}
	
	$noside = 1;
	
	include "common/headinfo.php";
	include "common/structuretop.php";
?>
<table border="0" cellpadding="0" cellspacing="1" width="100%">
<?php
	$slotcounter = 0;
	$rowcounter = 0;
	$sql = "select c.category,l.linkurl,l.linktitle,l.user_id from categories c left join links l on (c.cat_id = l.cat_id) where c.user_id = $cookieid order by c.place,c.category, l.linktitle, l.linkurl";
	// $result = @mysql_db_query("ramonlp_ramonlp", $sql);
	$result = @mysqli_query($conn, $sql);
	
	// while ($r = mysql_fetch_array($result)) {
	while ($r = mysqli_fetch_assoc($result)) {
		if (!$currentcat) {
			$slotcounter = $slotcounter + 1;
			echo '<tr valign="top"><td width="20%">';
			$currentcat = $r['category'];
			echo '<table border="0" cellpadding="3" cellspacing="0" width="100%"><tr><td class="highlight">' . stripslashes(urldecode($currentcat)) . '</td></tr><tr><td>';
		} else if ($currentcat != $r['category'] && $slotcounter < 5) {
			$slotcounter = $slotcounter + 1;
			echo '</td></tr></table></td><td width="20%">';
			$currentcat = $r['category'];
			echo '<table border="0" cellpadding="3" cellspacing="0" width="100%"><tr><td class="highlight">' . stripslashes(urldecode($currentcat)) . '</td></tr><tr><td>';
		} else if ($currentcat != $r['category']) {
			$slotcounter = 1;
			$rowcounter = $rowcounter + 1;
			
			echo '</td></tr></table></td></tr><tr valign="top"><td width="20%">';
			$currentcat = $r['category'];
			echo '<table border="0" cellpadding="3" cellspacing="0" width="100%"><tr><td class="highlight">' . stripslashes(urldecode($currentcat)) . '</td></tr><tr><td>';
		}
		
		if ($r['user_id'] == $cookieid) {
			echo '<a href="' . stripslashes(urldecode($r['linkurl'])) . '"' . $blanker . '>' . stripslashes(urldecode($r['linktitle'])) . "</a><br/>";
		}
	}
	
	//$launchpagesmenu = '<a href="loginform.php?m=2">Manage Links</a><br/><a href="toplinks.php">Top Lists</a><br/><a href="otherlaunchpages.php">Other LaunchPages</a><br/><a href="loginform.php?m=3">Options</a><br/>';
	$launchpagesmenu = '<a href="loginform.php?m=2">Manage Links</a><br/><a href="loginform.php?m=3">Options</a><br/><a href="wherepeoplelink.php">Other Links</a><br/>';
	
	switch ($slotcounter) {
		case 1:
			echo '</td></tr></table></td><td width="20%"class="highlight"><table border="0" cellpadding="3" cellspacing="0" width="100%"><tr><td class="highlight"><img src="images/launchpages16x10.png" height="10" width="10" border="0" hspace="2" alt="LaunchPages.com" />LaunchPages.com Menu</td></tr><tr><td class="highlight">' . $launchpagesmenu . '</td></tr></table></td><td class="highlight" colspan="3">&nbsp;';
			break;
		case 2:
			echo '</td></tr></table></td><td width="20%"class="highlight"><table border="0" cellpadding="3" cellspacing="0" width="100%"><tr><td class="highlight"><img src="images/launchpages16x10.png" height="10" width="10" border="0" hspace="2" alt="LaunchPages.com" />LaunchPages.com Menu</td></tr><tr><td class="highlight">' . $launchpagesmenu . '</td></tr></table></td><td class="highlight" colspan="2">&nbsp;';
			break;
		case 3:
			echo '</td></tr></table></td><td width="20%"class="highlight"><table border="0" cellpadding="3" cellspacing="0" width="100%"><tr><td class="highlight"><img src="images/launchpages16x10.png" height="10" width="10" border="0" hspace="2" alt="LaunchPages.com" />LaunchPages.com Menu</td></tr><tr><td class="highlight">' . $launchpagesmenu . '</td></tr></table></td><td class="highlight">&nbsp;';
			break;
		case 4:
			echo '</td></tr></table></td><td width="20%"class="highlight"><table border="0" cellpadding="3" cellspacing="0" width="100%"><tr><td class="highlight"><img src="images/launchpages16x10.png" height="10" width="10" border="0" hspace="2" alt="LaunchPages.com" />LaunchPages.com Menu</td></tr><tr><td class="highlight">' . $launchpagesmenu . '</td></tr></table>';
			break;
		case 5:
			echo '</td></tr></table></td></tr><tr><td colspan="5"><table border="0" cellpadding="3" cellspacing="0" width="100%"><tr><td class="highlight"><img src="images/launchpages16x10.png" height="10" width="10" border="0" hspace="2" alt="LaunchPages.com" />LaunchPages.com Menu</td></tr><tr><td class="highlight">' . $launchpagesmenu . '</td></tr></table>';
			break;
	}
	echo "</td></tr></table></td></tr>";
?>
</table>
<?php	include "common/structurebottom.php"; ?>