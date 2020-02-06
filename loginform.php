<?php
	include "common/connect.php";
	
	if ($_POST['action']) {
		$pusername = str_replace(' ','',$_POST['username']);
		$ppassword = str_replace(' ','',$_POST['password']);
		$sql = "select user_id,username,confirmation,email,name,surname from users where username = '$pusername' and password = '$ppassword'";

		// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
		$result = @mysqli_query($conn, $sql);
	
		// while ($r = mysql_fetch_array($result)) {
		while ($r = mysqli_fetch_assoc($result)) {

			srand((double)microtime()*1000000);
			$session_id = md5(uniqid(rand()));
			session_id($session_id);
			session_name("sid");
			session_start();
			if ($_POST['remember'] == 1) {
				setcookie("username", $r['username'], '/', time()+60*60*24*3000, '.launchpages.herokuapp.com');
				setcookie("userid", $r['user_id'], '/', time()+60*60*24*3000, '.launchpages.herokuapp.com');
				setcookie("sessid", $session_id, '/', time()+60*60*24*3000, '.launchpages.herokuapp.com');

			} else {
				setcookie("username", $r['username'], '/', 0, '.launchpages.herokuapp.com');
				setcookie("userid", $r['user_id'], '/', 0, '.launchpages.herokuapp.com');
				setcookie("sessid", $session_id, '/', 0, '.launchpages.herokuapp.com');

			}
			
			if ($_POST['action'] == 1) {
				// header ("location: signup.php");
				header ("location: index.php");
			} else if ($_POST['action'] == 2) {
				header ("location: managelinks.php");
			} else {
				header ("location: manageaccount.php");
			}
		}
		
		if (!$loggedin) {
			$errors = "Invalid username/password combination.";
		}
	}
	
	include "common/headinfo.php";
	include "common/structuretop.php";
?>
<table border="0" cellpadding="3" cellspacing="0" width="645" align="center">
	<tr valign="top">
		<td>
			<table border="0" class="highlight" cellpadding="3" cellspacing="0">
<?php if ($errors) { ?>
				<tr>
					<td class="highlight" align="center" colspan="2"><span class="red"><?php echo $errors; ?></span></td>
				</tr>
<?php } ?>
				<tr valign="top">
					<td class="highlight"><img src="images/launchpages196x196.png" height="196" width="196" border="0" alt="LaunchPages.com" align="left" hspace="5" vspace="5" /></td>
					<td class="highlight">
						<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php if ($_GET['m']) { ?>
							<input type="hidden" name="action" value="<?php echo $_GET['m']; ?>" />
<?php } else { ?>
							<input type="hidden" name="action" value="1" />
<?php } ?>
							<span class="headline">Load My LaunchPage</span>
							<br/><br/>
							Username:
							<br/>
							<input type="text" name="username" size="20" value="<?php echo $_POST['username']; ?>" />
							<br/>
							Password:
							<br/>
							<input type="password" name="password" size="20" value="" />
							<br/><br/>
							Remember Me <input type="checkbox" name="remember" value="1" checked="checked" />
							<br/><br/>
							<input type="submit" value="Load" />
							<br/><br/>
							Not yet a member?
							<br/>
							<a href="signup.php">Sign Up Here!</a>
						</form>
					</td>
				</tr>
			</table>
		</td>
		<td>
			LaunchPages.com is an online database of your most visited links.
			<br/><br/>
			When you create a LaunchPage, you will never again lose your bookmarked pages, all you have to do is log into your LaunchPage page from anywhere in the world and at any time to view a categorized listing of your favorite websites.
			<br/><br/>
			LaunchPages are most efficient when used as your default home page.  As soon as you open your web browser, all the sites you would regularly visit are easily accessible at a click of your mouse.
		</td>
	</tr>
</table>
<?php	include "common/structurebottom.php"; ?>