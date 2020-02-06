<table border="0" cellpadding="3" cellspacing="0" width="100%">
	<tr>
		<td><a href="http://www.launchpages.com"><img src="images/launchpages.png" height="45" width="270" border="0" alt="LaunchPages.com" /></a></td>
		<td align="right">
<!-- Search Google -->
<form method="get" action="http://www.google.com/custom" target="_top">
<input type="text" name="q" size="20" maxlength="255" value=""></input>
<input type="submit" name="sa" value="Google Search"></input>
<input type="hidden" name="client" value="pub-6169441487350658"></input>
<input type="hidden" name="forid" value="1"></input>
<input type="hidden" name="channel" value="8562823869"></input>
<input type="hidden" name="ie" value="ISO-8859-1"></input>
<input type="hidden" name="oe" value="ISO-8859-1"></input>
<input type="hidden" name="flav" value="0000"></input>
<input type="hidden" name="sig" value="1IoTN5iFucPNe5U7"></input>
<input type="hidden" name="cof" value="GALT:<?php echo $hlcolor ?>;GL:1;DIV:<?php echo $bgcolor ?>;VLC:<?php echo $fcolor ?>;AH:center;BGC:<?php echo $bgcolor ?>;LBGC:<?php echo $bgcolor ?>;ALC:<?php echo $fcolor ?>;LC:<?php echo $fcolor ?>;T:<?php echo $fcolor ?>;GFNT:<?php echo $fcolor ?>;GIMP:<?php echo $fcolor ?>;LH:45;LW:270;L:http://www.launchpages.com/images/launchpages.png;S:http://www.launchpages.com;FORID:1;"></input>
<input type="hidden" name="hl" value="en"></input>
</form>
<!-- Search Google -->
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<table border="0" cellpadding="3" cellspacing="0" width="100%">
				<tr>
<?php if ($_SERVER['PHP_SELF'] != '/index.php' && $_SERVER['PHP_SELF'] != '/launchpages.php') { ?>
					<td class="navbar"><a href="index.php">Home</a> | <a href="managelinks.php">Manage Links</a> | <a href="toplinks.php">Top Lists</a> | <a href="otherlaunchpages.php">Other LaunchPages</a> | <a href="manageaccount.php">Manage Account</a> <img src="images/launchpages16x10.png" height="10" width="16" border="0" hspace="2" align="absmiddle" alt="LaunchPages.com" /></td>
<?php } else if ($_GET['u']) { ?>
					<td class="navbar"><?php echo $ousername; ?>'s LaunchPage</td>
					<td class="navbar" align="right"><a href="loginform.php" class="smaller">Log into your account</a></td>
<?php } else if ($_COOKIE['username']) { ?>
					<td class="navbar"><?php echo $_COOKIE['username'] ?>'s LaunchPage</td>
					<td align="right" class="navbar"><a href="loginform.php" class="smaller">not <?php echo $_COOKIE['username'] ?>? click here!</a></td>
<?php } else { ?>
					<td align="center" class="navbar" width="33%"><a href="loginform.php" class="smaller">Log In</a> &nbsp; <a href="signup.php">Sign up today for a FREE account</a> &nbsp; <a href="otherlaunchpages.php">View Samples</a></td>
					<td align="center" class="navbar" width="34%"><a href="loginform.php" class="smaller">Log In</a> &nbsp; <a href="signup.php">Sign up today for a FREE account</a> &nbsp; <a href="otherlaunchpages.php">View Samples</a></td>
					<td align="center" class="navbar" width="33%"><a href="loginform.php" class="smaller">Log In</a> &nbsp; <a href="signup.php">Sign up today for a FREE account</a> &nbsp; <a href="otherlaunchpages.php">View Samples</a></td>
<?php } ?>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table border="0" cellpadding="3" cellspacing="0" width="100%">
	<tr valign="top">
		<td>