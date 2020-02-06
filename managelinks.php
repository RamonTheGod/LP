<?php
	include "common/connect.php";

	if (!$_COOKIE['sessid'] || !$_COOKIE['userid']) {
		$errors = "Please log in to manage your LaunchPage.";
	} else {
		if ($_GET['m'] == 1 && $_GET['l']) {
			$cuserid = str_replace(' ','',$_COOKIE['userid']);
			$gl = str_replace(' ','',$_GET['l']);
			$sql = "update links set user_id = 0 where user_id = $cuserid and link_id = $gl";
			// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
			$result = @mysqli_query($conn, $sql);
			
			$sql = "update users set links = links - 1 where user_id = $cuserid";
			// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
			$result = @mysqli_query($conn, $sql);
		} else if ($_GET['m'] == 2 && $_GET['c']) {
			$cuserid = str_replace(' ','',$_COOKIE['userid']);
			$gc = str_replace(' ','',$_GET['c']);
			$gp = str_replace(' ','',$_GET['p']);
			
			$sql = "select link_id from links where user_id = $cuserid and cat_id = $gc";
			// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
			$result = @mysqli_query($conn, $sql);
			$linksincat = 0;
			
			// while ($r = mysql_fetch_array($result)) {
			while ($r = mysqli_fetch_assoc($result)) {
				$linksincat = $linksincat + 1;
			}
			
			$sql = "update links set user_id = 0 where user_id = $cuserid and cat_id = $gc";
			// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
			$result = @mysqli_query($conn, $sql);
			
			$sql = "update users set links = links - $linksincat where user_id = $cuserid and links <= $linksincat";
			// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
			$result = @mysqli_query($conn, $sql);
			
			$sql = "update categories set user_id = 0 where user_id = $cuserid and cat_id = $gc";
			// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
			$result = @mysqli_query($conn, $sql);
		}
		
		if ($_POST['action'] == 1) {
			$cuserid = str_replace(' ','',$_COOKIE['userid']);
			$pcategory = urlencode($_POST['category']);
			$sql = "select cat_id from categories where user_id = $cuserid and category = '$pcategory'";
			// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
			$result = @mysqli_query($conn, $sql);
			
			// while ($r = mysql_fetch_array($result)) {
			while ($r = mysqli_fetch_assoc($result)) {
				$thiscat = $r['cat_id'];
			}
			
			if (!$thiscat) {
				$cuserid = str_replace(' ','',$_COOKIE['userid']);
				$pcategory = urlencode($_POST['category']);
				$sql = "insert into categories values (0, $cuserid, '$pcategory')";
				// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
				$result = @mysqli_query($conn, $sql);
			}
		} else if ($_POST['action'] == 2) {
			if ($_POST['newcat']) {
				$cuserid = str_replace(' ','',$_COOKIE['userid']);
				$pnewcat = urlencode($_POST['newcat']);
				$sql = "select cat_id from categories where user_id = $cuserid and category = '$pnewcat'";
				// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
				$result = @mysqli_query($conn, $sql);
				
				// while ($r = mysql_fetch_array($result)) {
				while ($r = mysqli_fetch_assoc($result)) {
					$thiscat = $r['cat_id'];
					
					$sql2 = "select place from categories where user_id = $cuserid order by place desc limit 1";
					// $result2 = @mysql_db_query("ramonlp_ramonlp", $sql2);
					$result2 = @mysqli_query($conn, $sql2);
					
					// while ($r2 = mysql_fetch_array($result2)) {
					while ($r2 = mysqli_fetch_assoc($result2)) {
						$nextplace = $r2['place'] + 1;
					}
				}
				
				if ($thiscat < 1) {
					$cuserid = str_replace(' ','',$_COOKIE['userid']);
					$pnewcat = urlencode($_POST['newcat']);
					
					$sql2 = "select place from categories where user_id = $cuserid order by -place limit 1";
					// $result2 = @mysql_db_query("ramonlp_ramonlp", $sql2);
					$result2 = @mysqli_query($conn, $sql2);
					
					// while ($r2 = mysql_fetch_array($result2)) {
					while ($r2 = mysqli_fetch_assoc($result2)) {
						$nextplace = $r2['place'] + 1;
					}
					
					if (!$nextplace) {
						$nextplace = 1;
					}
					
					$sql = "insert into categories values (0, $cuserid, '$pnewcat', $nextplace)";
					// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
					$result = @mysqli_query($conn, $sql);
					
					$cuserid = str_replace(' ','',$_COOKIE['userid']);
					$pnewcat = urlencode($_POST['newcat']);
					
					$sql = "select cat_id from categories where user_id = $cuserid and category = '$pnewcat'";
					// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
					$result = @mysqli_query($conn, $sql);
					
					// while ($r = mysql_fetch_array($result)) {
					while ($r = mysqli_fetch_assoc($result)) {
						$thiscat = $r['cat_id'];
					}
				}
			} else {
				$thiscat = str_replace(' ','',$_POST['category']);
			}
			
			if (strpos(substr($_POST['linkurl'], 0, 8),'://')) {
				$linkurl = urlencode($_POST['linkurl']);
			} else {
				$linkurl = "http://" . urlencode($_POST['linkurl']);
			}
			
			if ($_POST['private'] == 1) {
				$private = 1;
			} else {
				$private = 0;
			}
			
			if ($_POST['adult'] == 1) {
				$adult = 1;
			} else {
				$adult = 0;
			}
			
			$cuserid = str_replace(' ','',$_COOKIE['userid']);
			$plinktitle = urlencode($_POST['linktitle']);
			$sql = "insert into links values (0, $thiscat, $cuserid, '$linkurl', '$plinktitle', $private, $adult)";
			// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
			$result = @mysqli_query($conn, $sql);
			
			$cuserid = str_replace(' ','',$_COOKIE['userid']);
			$sql = "update users set links = links + 1 where user_id = $cuserid";
			// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
			$result = @mysqli_query($conn, $sql);
		} else if ($_POST['action'] == 3) {
			$pcategory = urlencode($_POST['category']);
			$cuserid = str_replace(' ','',$_COOKIE['userid']);
			$pcatid = str_replace(' ','',$_POST['catid']);
			$pplace = str_replace(' ','',$_POST['place']);
			$pcplace = str_replace(' ','',$_POST['curplace']);
			
			$sql = "select cat_id from categories where user_id = $cuserid and category = '$pcategory' and cat_id != $pcatid";
			// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
			$result = @mysqli_query($conn, $sql);
			
			// while ($r = mysql_fetch_array($result)) {
			while ($r = mysqli_fetch_assoc($result)) {
				$oops = $r['cat_id'];
			}
			
			if (!$oops) {
				$sql = "update categories set category = '$pcategory', place = $pplace where user_id = $cuserid and cat_id = $pcatid";
				// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
				$result = @mysqli_query($conn, $sql);
				
				if ($pcplace > 0) {
					if ($pcplace < $pplace) {
						$sql = "update categories set place = place - 1 where place > $pcplace and place <= $pplace and cat_id <> $pcatid and place != 0 and user_id = $cuserid";
						// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
						$result = @mysqli_query($conn, $sql);
					} else if ($pcplace > $pplace) {
						$sql = "update categories set place = place + 1 where place < $pcplace and place >= $pplace and cat_id <> $pcatid and place != 0 and user_id = $cuserid";
						// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
						$result = @mysqli_query($conn, $sql);
					}
				} else {
					$sql = "update categories set place = place + 1 where place >= $pplace and cat_id <> $pcatid and place != 0 and user_id = $cuserid";
					// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
					$result = @mysqli_query($conn, $sql);
				}
			} else {
				$errors = "Sorry that category already exists.";
			}
		} else if ($_POST['action'] == 4) {
			if ($_POST['newcat']) {
				$cuserid = str_replace(' ','',$_COOKIE['userid']);
				$pnewcat = urlencode($_POST['newcat']);
				$sql = "select cat_id from categories where user_id = $cuserid and category = '$pnewcat'";
				// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
				$result = @mysqli_query($conn, $sql);
				
				// while ($r = mysql_fetch_array($result)) {
				while ($r = mysqli_fetch_assoc($result)) {
					$thiscat = $r['cat_id'];
					
					$sql2 = "select place from categories where user_id = $cuserid order by place desc limit 1";
					// $result2 = @mysql_db_query("ramonlp_ramonlp", $sql2);
					$result2 = @mysqli_query($conn, $sql2);
					
					// while ($r2 = mysql_fetch_array($result2)) {
					while ($r2 = mysqli_fetch_assoc($result2)) {
						$nextplace = $r2['place'] + 1;
					}
				}
				
				if ($thiscat < 1) {
					$cuserid = str_replace(' ','',$_COOKIE['userid']);
					$pnewcat = urlencode($_POST['newcat']);
					
					$sql2 = "select place from categories where user_id = $cuserid order by place desc limit 1";
					// $result2 = @mysql_db_query("ramonlp_ramonlp", $sql2);
					$result2 = @mysqli_query($conn, $sql2);
					
					// while ($r2 = mysql_fetch_array($result2)) {
					while ($r2 = mysqli_fetch_assoc($result2)) {
						$nextplace = $r2['place'] + 1;
					}
					
					$sql = "insert into categories values (0, $cuserid, '$pnewcat', $nextplace)";
					// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
					$result = @mysqli_query($conn, $sql);
				
					$cuserid = str_replace(' ','',$_COOKIE['userid']);
					$pnewcat = urlencode($_POST['newcat']);
					$sql = "select cat_id from categories where user_id = $cuserid and category = '$pnewcat'";
					// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
					$result = @mysqli_query($conn, $sql);
					
					// while ($r = mysql_fetch_array($result)) {
					while ($r = mysqli_fetch_assoc($result)) {
						$thiscat = $r['cat_id'];
					}
				}
			} else {
				$thiscat = $_POST['category'];
			}
			
			if (strpos(substr($_POST['linkurl'], 0, 8),'://')) {
				$linkurl = $_POST['linkurl'];
			} else {
				$linkurl = "http://" . $_POST['linkurl'];
			}
			
			if ($_POST['private'] == 1) {
				$private = 1;
			} else {
				$private = 0;
			}
			
			if ($_POST['adult'] == 1) {
				$adult = 1;
			} else {
				$adult = 0;
			}
			
			$plinktitle = urlencode($_POST['linktitle']);
			$cuserid = str_replace(' ','',$_COOKIE['userid']);
			$plinkid = str_replace(' ','',$_POST['linkid']);
			$sql = "update links set cat_id = $thiscat, linkurl = '$linkurl', linktitle = '$plinktitle', private = $private, adult = $adult where user_id = $cuserid and link_id = $plinkid";
			// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
			$result = @mysqli_query($conn, $sql);
		}
		
		include "common/headinfo.php";
		include "common/structuretop.php";
		
		$catcount = 0;
		$linkcount = 0;
		
		$cuserid = str_replace(' ','',$_COOKIE['userid']);
		$sql = "select cat_id from categories where user_id = '$cuserid'";
		// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
		$result = @mysqli_query($conn, $sql);
		
		// while ($r = mysql_fetch_array($result)) {
		while ($r = mysqli_fetch_assoc($result)) {
			$catcount = $catcount + 1;
		}
		
		$cuserid = str_replace(' ','',$_COOKIE['userid']);
		$sql = "select link_id from links where user_id = '$cuserid'";
		// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
		$result = @mysqli_query($conn, $sql);
		
		// while ($r = mysql_fetch_array($result)) {
		while ($r = mysqli_fetch_assoc($result)) {
			$linkcount = $linkcount + 1;
		}
?>
<table border="0" cellpadding="3" cellspacing="0" width="645" align="center">
	<tr valign="top">
		<td>
			<table border="0" cellpadding="3" cellspacing="0" width="100%">
<?php if ($errors) { ?>
				<tr>
					<td colspan="2" class="highlight"><span class="red"><?php echo $errors; ?></span></td>
				</tr>
<?php } ?>
				<tr valign="top">
					<td rowspan="11" class="highlight"><img src="images/launchpages100x100.png" height="100" width="100" border="0" alt="LaunchPages.com" align="left" hspace="5" vspace="5" /></td>
<?php if ($_GET['s'] || $_POST['s']) { ?>
					<td class="highlight"><span class="headline">Step 2: Create Your LaunchPage</span></td>
<?php } else { ?>
					<td class="highlight"><span class="headline">Manage Links</span></td>
<?php } ?>
				</tr>
<?php
	if ($_GET['s'] || $_POST['s']) {
		if ($_POST['a'] == 2 || !$_POST['a']) {
?>
					<td class="highlight">
						<li>Enter a category for your sites, each link you make will be placed under a category of your choice.</li>
						<li>Then, choose a name for your link that would best describe it.</li>
						<li>Finally, enter the URL or location of your link (eg. http://www.google.com).</li>
						<li>Links marked as "Private" or "Adult" will not be displayed to other users.</li>
						<li>For a sample, view <a href="otherlaunchpages.php" target="_blank">other people's LaunchPages</a>.</li>
					</td>
<?php } else { ?>
					<td class="highlight">Congratulations, your launch pages are ready for use.  Now, it would be best if you add even more links.  Sure, it's a tiresome process, but remember, this may be the last time you EVER have to type those URL's again.  When you're done, try setting LaunchPages.com as your default home page.  That way, whenever you open your browser, you just have to click on the link you want to go to and never have to type another URL again.  Give it a shot!</td>
<?php
		}
	} else {
?>
				<tr valign="top">
					<td class="highlight">Your Categories:</td>
					<td align="right"class="highlight"><?php echo $catcount; ?></td>
				</tr>
				<tr valign="top">
					<td class="highlight">Your Links:</td>
					<td align="right" class="highlight"><?php echo $linkcount; ?></td>
				</tr>
<?php } ?>
			</table>
			<form method="post" action="managelinks.php" onsubmit="return validate2()" name="linkform">
<?php if ($_GET['s'] || $_POST['s']) { ?>
				<input type="hidden" name="s" value="2" />
<?php
		if ($_POST['a'] == 1) {
			echo '<input type="hidden" name="a" value="2" />';
		} else {
			echo '<input type="hidden" name="a" value="1" />';
		}
	}
?>
				<input type="hidden" name="action" value="2" />
				<table border="0" cellpadding="3" cellspacing="1" width="100%">
					<tr>
						<td colspan="2"><span class="headline">Add Link</span></td>
					</tr>
					<tr>
						<td class="highlight" valign="top">Category:</td>
						<td>
							<select name="category">
								<option value=""></option>
<?php
	$cuserid = str_replace(' ','',$_COOKIE['userid']);
	$sql = "select cat_id, category from categories where user_id = '$cuserid' order by category";
	// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
	$result = @mysqli_query($conn, $sql);
	
	// while ($r = mysql_fetch_array($result)) {
	while ($r = mysqli_fetch_assoc($result)) {
		echo '<option value="' . $r['cat_id'] . '">' . stripslashes(urldecode($r['category'])) . '</option>';
	}
?>
							</select>
							<br/>or<br/>
							<input type="text" name="newcat" value="" size="20" />
						</td>
					</tr>
					<tr>
						<td class="highlight">Link Name:</td>
						<td><input type="text" name="linktitle" size="20" /></td>
					</tr>
					<tr>
						<td class="highlight">Link URL:</td>
						<td><input type="text" name="linkurl" size="20" /></td>
					</tr>
					<tr>
						<td class="highlight">Private URL:</td>
						<td><input type="checkbox" value="1" name="private" /></td>
					</tr>
					<tr>
						<td class="highlight">Adult URL:</td>
						<td><input type="checkbox" value="1" name="adult" /></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" value="Add Link" /></td>
					</tr>
				</table>
			</form>
		</td>
		<td>
<?php
	if ($_GET['m'] == 3 && $_GET['c']) {
		$cuserid = str_replace(' ','',$_COOKIE['userid']);
		$gc = str_replace(' ','',$_GET['c']);
		$sql = "select category from categories where user_id = '$cuserid' and cat_id = $gc";
		// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
		$result = @mysqli_query($conn, $sql);
		
		// while ($r = mysql_fetch_array($result)) {
		while ($r = mysqli_fetch_assoc($result)) {
			$category = $r['category'];
		}
?>
			<form method="post" action="managelinks.php" onsubmit="return validate3()" name="editcatform">
<?php if ($_GET['s'] || $_POST['s']) { ?>
				<input type="hidden" name="s" value="2" />
<?php
	}
	
	$sql2 = "select place from categories where user_id = $cuserid order by place desc limit 1";
	// $result2 = @mysql_db_query("ramonlp_ramonlp", $sql2);
	$result2 = @mysqli_query($conn, $sql2);
	
	// while ($r2 = mysql_fetch_array($result2)) {
	while ($r2 = mysqli_fetch_assoc($result2)) {
		$lastplace = $r2['place'];
		echo '<input type="hidden" name="lastplace" value="' . $r2['place'] . '" />';
	}
?>
				<input type="hidden" name="action" value="3" />
				<input type="hidden" name="catid" value="<?php echo $_GET['c']; ?>" />
				<input type="hidden" name="curplace" value="<?php echo $_GET['p']; ?>" />
				<table border="0" cellpadding="3" cellspacing="1" width="100%">
					<tr>
						<td colspan="2"><span class="headline">Edit Category</span></td>
					</tr>
					<tr>
						<td class="order">Order:</td>
						<td>
							<select name="place">
<?php
	if ($lastplace == 0) {
		$lastplace = 1;
	}

	for ($i=1; $i <= $lastplace + 1; $i++) {
		echo '<option value="' . $i . '"';
		if ($i == $_GET['p']) {
			echo " selected";
		}
		echo '>' . $i . '</option>';
	}
?>
							</select>
						</td>
					</tr>
					<tr>
						<td class="highlight">Category Name:</td>
						<td><input type="text" name="category" size="20" value="<?php echo stripslashes(urldecode($category)); ?>" /></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" value="Edit Category" /></td>
					</tr>
				</table>
			</form>
<?php } else if ($_GET['m'] == 4 && $_GET['l']) {
		$cuserid = str_replace(' ','',$_COOKIE['userid']);
		$sql = "select linkurl,linktitle,private,adult,cat_id from links where user_id = '$cuserid' and link_id =".$_GET['l'];

		// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
		$result = @mysqli_query($conn, $sql);
		
		// while ($r = mysql_fetch_array($result)) {
		while ($r = mysqli_fetch_assoc($result)) {
			$linkurl = urldecode($r['linkurl']);
			$linktitle = urldecode($r['linktitle']);
			$private = $r['private'];
			$adult = $r['adult'];
			$catid = $r['cat_id'];
		}
?>
			<form method="post" action="managelinks.php" onsubmit="return validate4()" name="editlinkform">
<?php if ($_GET['s'] || $_POST['s']) { ?>
				<input type="hidden" name="s" value="2" />
<?php } ?>
				<input type="hidden" name="action" value="4" />
				<input type="hidden" name="linkid" value="<?php echo $_GET['l']; ?>" />
				<table border="0" cellpadding="3" cellspacing="1" width="100%">
					<tr>
						<td colspan="2"><span class="headline">Edit Link</span></td>
					</tr>
					<tr>
						<td class="highlight" valign="top">Category:</td>
						<td>
							<select name="category">
								<option value=""></option>
<?php
	$cuserid = str_replace(' ','',$_COOKIE['userid']);
	$sql = "select cat_id, category from categories where user_id = '$cuserid' order by category";
	// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
	$result = @mysqli_query($conn, $sql);
	
	// while ($r = mysql_fetch_array($result)) {
	while ($r = mysqli_fetch_assoc($result)) {
		echo '<option value="' . $r['cat_id'] . '"';
		if ($r['cat_id'] == $catid) {
			echo " selected";
		}
		echo '>' . stripslashes(urldecode($r['category'])) . '</option>';
	}
?>
							</select>
							<br/>or<br/>
							<input type="text" name="newcat" value="" size="20" />
						</td>
					</tr>
					<tr>
						<td class="highlight">Link Name:</td>
						<td><input type="text" name="linktitle" size="20" value="<?php echo stripslashes(urldecode($linktitle)); ?>" /></td>
					</tr>
					<tr>
						<td class="highlight">Link URL:</td>
						<td><input type="text" name="linkurl" size="20" value="<?php echo stripslashes(urldecode($linkurl)); ?>" /></td>
					</tr>
					<tr>
						<td class="highlight">Private URL:</td>
						<td><input type="checkbox" value="1" name="private" <?php if ($private == 1) { echo "checked "; } ?>/></td>
					</tr>
					<tr>
						<td class="highlight">Adult URL:</td>
						<td><input type="checkbox" value="1" name="adult" <?php if ($adult == 1) { echo "checked "; } ?>/></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" value="Edit Link" /></td>
					</tr>
				</table>
			</form>
<?php } ?>
			<table border="0" cellpadding="3" cellspacing="1" width="100%">
				<tr>
					<td colspan="4"><span class="headline">My Links</span></td>
				</tr>
<?php
	$cuserid = str_replace(' ','',$_COOKIE['userid']);
	$sql = "select c.cat_id as sikatid,c.category,l.linkurl,l.linktitle,l.link_id,l.user_id,c.place from categories c left join links l on (c.cat_id = l.cat_id) where c.user_id = $cuserid order by c.place, c.category, l.linktitle";
	// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
	$result = @mysqli_query($conn, $sql);
	$currentcat = '';
	
	if ($_GET['s'] || $_POST['s']) {
		$s = "&s=2";
	}
	
	// while ($r = mysql_fetch_array($result)) {
	while ($r = mysqli_fetch_assoc($result)) {
		if ($currentcat != stripslashes(urldecode($r['category']))) {
			$currentcat = stripslashes(urldecode($r['category']));
			echo '<tr><td class="highlight">' .$r['place'] . ". " . stripslashes(urldecode($r['category'])) . '</td><td class="highlight">&nbsp;</td><td align="center" class="highlight"><a href="managelinks.php?m=2&p=' . $r['place'] . '&c=' . $r['sikatid'] . $s . '">delete</a></td><td align="center" class="highlight"><a href="managelinks.php?m=3&p=' . $r['place'] . '&c=' . $r['sikatid'] . $s . '">edit</a></td></tr>';
		}
		
		if ($r['user_id'] == $_COOKIE['userid']) {
			echo '<tr><td>' . stripslashes(urldecode($r['linktitle'])) . '</td><td align="center"><a href="' . stripslashes(urldecode($r[linkurl])) . '" target="_blank">view</a></td><td align="center"><a href="managelinks.php?m=1&l=' . $r['link_id'] . $s . '">delete</a></td><td align="center"><a href="managelinks.php?m=4&l=' . $r['link_id'] . $s . '">edit</a></td></tr>';
		}
	}
?>
			</table>
		</td>
	</tr>
</table>
<script language="JavaScript">
	function validate() {
		if (document.catform.category.value==null || document.catform.category.value=="") {
			alert("Please enter the category name.");
			document.catform.category.focus();
			return false;
		}
	}
</script>
<script language="Javascript">
	function validate2() {
		if ((document.linkform.category.value==null || document.linkform.category.value=="") && (document.linkform.newcat.value==null || document.linkform.newcat.value=="")) {
			alert("Please select an existing category or enter a new one.");
			document.linkform.newcat.focus();
			return false;
		}
		
		if (document.linkform.linktitle.value==null || document.linkform.linktitle.value=="") {
			alert("Please enter a name for your link.");
			document.linkform.linktitle.focus();
			return false;
		}
		
		if (document.linkform.linkurl.value==null || document.linkform.linkurl.value=="") {
			alert("Please enter the URL for your link to forward to.");
			document.linkform.linkurl.focus();
			return false;
		}
	}
</script>
<?php if ($_GET['m'] == 3 && $_GET['c']) {	?>
<script language="JavaScript">
	function validate3() {
		if (document.editcatform.category.value==null || document.editcatform.category.value=="") {
			alert("Please enter the category name.");
			document.editcatform.category.focus();
			return false;
		}
	}
</script>
<?php } else if ($_GET['m'] == 3 && $_GET['c']) { ?>
<script language="Javascript">
	function validate4() {
		if ((document.editlinkform.category.value==null || document.editlinkform.category.value=="") && (document.editlinkform.newcat.value==null || document.editlinkform.newcat.value=="")) {
			alert("Please select an existing category or enter a new one.");
			document.editlinkform.newcat.focus();
			return false;
		}
		
		if (document.editlinkform.linktitle.value==null || document.editlinkform.linktitle.value=="") {
			alert("Please enter a name for your link.");
			document.editlinkform.linktitle.focus();
			return false;
		}
		
		if (document.editlinkform.linkurl.value==null || document.editlinkform.linkurl.value=="") {
			alert("Please enter the URL for your link to forward to.");
			document.editlinkform.linkurl.focus();
			return false;
		}
	}
</script>
<?php
	}
		include "common/structurebottom.php";
	}
?>