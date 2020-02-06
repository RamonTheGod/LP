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
<table border="0" cellpadding="0" cellspacing="1" width="645" align="center">
	<tr valign="top">
		<td>
			<table border="0" cellpadding="3" cellspacing="0" width="100%">
				<tr>
					<td class="highlight" colspan="2">Links</td>
				</tr>
				<tr>
					<td style="text-align: justify;">
<?php
	$pagetop = $page.'0';
	$pagebottom = (($page - 1) * 5).'0';
	
	$sql = "select count(*) as repeats, linktitle from links where private = 0 and adult = 0 and user_id > 0 group by linktitle order by repeats desc, linktitle";
	// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
	$result = @mysqli_query($conn, $sql);
	// while ($r = mysql_fetch_array($result)) {
	while ($r = mysqli_fetch_assoc($result)) {
		echo stripslashes(urldecode($r['linktitle'])).' ('.$r['repeats'].')<br/>';
	}
?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php	include "common/structurebottom.php"; ?>
