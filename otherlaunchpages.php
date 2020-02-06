<?php
	include "common/connect.php";
	include "common/headinfo.php";
	include "common/structuretop.php";
	
	if (!$_GET['page']) {
		$page = 1;
	} else {
		$page = $_GET['page'];
	}
?>
<table border="0" cellpadding="3" cellspacing="1" width="645" align="center">
	<tr>
		<td class="highlight">View Active Members' LaunchPages</td>
	</tr>
	<tr>
		<td>
<?php
	$sql = 'select count(*) as usercount from users where links > 0';
	// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
	$result = @mysqli_query($conn, $sql);
	// while ($r = mysql_fetch_array($result)) {
	while ($r = mysqli_fetch_assoc($result)) {
		$usercount = $r[usercount];
	}
	
	$pagecount = 0;
		echo '<table border="0" cellpadding="3" cellspacing="0"><tr>';
	while (($pagecount * 10) < $usercount) {
			$pagecount = $pagecount + 1;
			if ($pagecount != $page) {
				echo '<td><a href="?page='.$pagecount.'">'.$pagecount.'</a></td>';
			} else {
				echo '<td>['.$pagecount.']</td>';
			}
	}
		echo '</tr></table>';
?>
		</td>
	</tr>
	<tr>
		<td>
<?php
	$pagetop = $page.'0';
	$pagebottom = ($page - 1).'0';
	
	$sql = "select username,user_id,links from users where links > 0 order by links desc, username limit $pagebottom, 10";
	// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
	$result = @mysqli_query($conn, $sql);
	
	$membercounter = 0;
	echo '<table border="0" cellpadding="3" cellspacing="0">';
	
	// while ($r = mysql_fetch_array($result)) {
	while ($r = mysqli_fetch_assoc($result)) {
		$membercounter = $membercounter + 1;
		echo '<tr><td align="right">' . $r['links'] . ' links</td><td><a href="launchpages.php?u=' . $r['user_id'] . '">' . $r['username'] . '</a></td></tr>';
	}
	echo '</table>';
?>
		</td>
	</tr>
	<tr>
		<td>
<?php
	$sql = 'select count(*) as usercount from users where links > 0';
	// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
	$result = @mysqli_query($conn, $sql);
	// while ($r = mysql_fetch_array($result)) {
	while ($r = mysqli_fetch_assoc($result)) {
		$usercount = $r[usercount];
	}
	
	$pagecount = 0;
		echo '<table border="0" cellpadding="3" cellspacing="0"><tr>';
	while (($pagecount * 10) < $usercount) {
			$pagecount = $pagecount + 1;
			if ($pagecount != $page) {
				echo '<td><a href="?page='.$pagecount.'">'.$pagecount.'</a></td>';
			} else {
				echo '<td>['.$pagecount.']</td>';
			}
	}
		echo '</tr></table>';
?>
		</td>
	</tr>
</table>
<?php	include "common/structurebottom.php"; ?>
