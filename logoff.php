<?php
setcookie("username", '', time()+60*60*24*3000, '/', '.launchpages.com');
	setcookie("userid", '', time()+60*60*24*3000, '/', '.launchpages.com');
	setcookie("sessid", '', time()+60*60*24*3000, '/', '.launchpages.com');
	
	header ("location: loginform.php");
	?>