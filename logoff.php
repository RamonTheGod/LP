<?php
	setcookie("username", $r['username'], time()-(60*60*24*3000), '/', '.launchpages.herokuapp.com', false, true);
	setcookie("userid", $r['user_id'], time()-(60*60*24*3000), '/', '.launchpages.herokuapp.com', false, true);
	setcookie("sessid", $session_id, time()-(60*60*24*3000), '/', '.launchpages.herokuapp.com', false, true);
	
	header ("location: loginform.php");
	?>
