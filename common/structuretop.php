<table border="0" cellpadding="3" cellspacing="0" width="100%">
	<tr>
		<td><a href="https://launchpages.herokuapp.com/"><img src="images/launchpages.png" height="45" width="270" border="0" alt="LaunchPages.com" /></a></td>
		<td align="right">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">
			<table border="0" cellpadding="3" cellspacing="0" width="100%">
				<tr>
<?php if ($_SERVER['PHP_SELF'] != '/index.php' && $_SERVER['PHP_SELF'] != '/launchpages.php') { ?>
					<td class="navbar"><a href="index.php">Home</a> | <a href="managelinks.php">Manage Links</a> | <a href="manageaccount.php">Manage Account</a> | <a href="wherepeoplelink.php">Where People Link</a> <img src="images/launchpages16x10.png" height="10" width="10" border="0" hspace="2" align="absmiddle" alt="LaunchPages.com" /></td>
<?php } else if ($_GET['u']) { ?>
					<td class="navbar"><?php echo $ousername; ?>'s LaunchPage</td>
					<td class="navbar" align="right"><a href="loginform.php" class="smaller">Log into your account</a></td>
<?php } else if ($_COOKIE['username']) { ?>
					<td class="navbar"><?php echo $_COOKIE['username'] ?>'s LaunchPage</td>
					<td align="right" class="navbar"><a href="logoff.php" class="smaller">not <?php echo $_COOKIE['username'] ?>? click here!</a></td>
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
