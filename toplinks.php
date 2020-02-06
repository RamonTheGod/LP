<?php
	include "common/connect.php";
	include "common/headinfo.php";
	include "common/structuretop.php";
	
	if (!$_GET['page']) {
		$page = 1;
	} else {
		$page = $_GET['page'];
		// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
		$result = @mysqli_query($conn, $sql);
	}
?>
<table border="0" cellpadding="0" cellspacing="1" width="645" align="center">
	<tr>
		<td colspan="2">
<?php
	$sql = 'select distinct count(linkurl) as usercount from links where private = 0 and adult = 0';
	// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
	$result = @mysqli_query($conn, $sql);
	// while ($r = mysql_fetch_array($result)) {
	while ($r = mysqli_fetch_assoc($result)) {
		$usercount = $r[usercount];
	}
	
	$pagecount = 0;
		echo '<table border="0" cellpadding="3" cellspacing="0"><tr align="right">';
	while (($pagecount * 50) < $usercount) {
			$pagecount = $pagecount + 1;
			if ($pagecount != $page) {
				echo '<td><a href="?page='.$pagecount.'">'.$pagecount.'</a></td>';
			} else {
				echo '<td>['.$pagecount.']</td>';
			}
			
			if (is_int($pagecount / 20)) {
				echo '</tr><tr>';
			}
	}
		echo '</tr></table>';
?>
		</td>
	</tr>
	<tr valign="top">
		<td width="50%">
			<table border="0" cellpadding="3" cellspacing="0" width="100%">
				<tr>
					<td class="highlight" colspan="2">Top Links</td>
				</tr>
				<tr>
					<td>
<?php
	$pagetop = $page.'0';
	$pagebottom = (($page - 1) * 5).'0';
	
	$sql = "select linkurl, count(*) as repeats from links where private = 0 and adult = 0 group by linkurl order by repeats desc, linkurl limit $pagebottom, 50";
	// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
	$result = @mysqli_query($conn, $sql);
	
	echo '<table border="0" cellpadding="3" cellspacing="0">';
	
	// while ($r = mysql_fetch_array($result)) {
	while ($r = mysqli_fetch_assoc($result)) {
		echo '<tr><td align="right">' . $r['repeats'] . '</td><td><a href="' . stripslashes(urldecode($r['linkurl'])) . '" target="_blank">' . stripslashes(urldecode($r['linkurl'])) . '</a></td></tr>';
	}
	
	echo '</table>';
?>
					</td>
				</tr>
			</table>
		</td>
		<td width="50%">
			<table border="0" cellpadding="3" cellspacing="0" width="100%">
				<tr>
					<td class="highlight">Top Categories</td>
				</tr>
				<tr>
					<td>
<?php
	$sql = "select category, count(*) as repeats from categories group by category order by repeats desc, category  limit $pagebottom, 50";
	// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
	$result = @mysqli_query($conn, $sql);
	
	echo '<table border="0" cellpadding="3" cellspacing="0">';
	
	// while ($r = mysql_fetch_array($result)) {
	while ($r = mysqli_fetch_assoc($result)) {
		echo '<tr><td align="right">' . $r['repeats'] . '</td><td>' . stripslashes(urldecode($r['category'])) . "</td></tr>";
	}
	
	echo '</table>';
?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">
<?php
	$sql = 'select distinct count(linkurl) as usercount from links where private = 0 and adult = 0';
	// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
	$result = @mysqli_query($conn, $sql);
	// while ($r = mysql_fetch_array($result)) {
	while ($r = mysqli_fetch_assoc($result)) {
		$usercount = $r[usercount];
	}
	
	$pagecount = 0;
		echo '<table border="0" cellpadding="3" cellspacing="0"><tr align="right">';
	while (($pagecount * 50) < $usercount) {
			$pagecount = $pagecount + 1;
			if ($pagecount != $page) {
				echo '<td><a href="?page='.$pagecount.'">'.$pagecount.'</a></td>';
			} else {
				echo '<td>['.$pagecount.']</td>';
			}
			
			if (is_int($pagecount / 20)) {
				echo '</tr><tr>';
			}
	}
		echo '</tr></table>';
?>
		</td>
	</tr>
</table>
<?php	include "common/structurebottom.php"; ?>
