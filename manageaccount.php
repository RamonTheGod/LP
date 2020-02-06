<?php
	include "common/connect.php";
	
	$cuserid = str_replace(' ','',$_COOKIE['userid']);
	$sql = "select * from users where user_id = '$cuserid'";
	// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
	$result = @mysqli_query($conn, $sql);

	// while ($r = mysql_fetch_array($result)) {
	while ($r = mysqli_fetch_assoc($result)) {
		$name = $r['name'];
		$surname = $r['surname'];
		$gender = $r['gender'];
		$country = $r['country'];
		$email = $r['email'];
	}
	
	if ($_POST['action'] == 1) {
		$pusername = str_replace(' ','',$_POST['username']);
		$cuserid = str_replace(' ','',$_COOKIE['userid']);
		$sql = "select username from users where username = '$pusername' and user_id != $cuserid";
		// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
		$result = @mysqli_query($conn, $sql);
		$prereg = 0;

		// while ($r = mysql_fetch_array($result)) {
		while ($r = mysqli_fetch_assoc($result)) {
			$prereg = 1;
		}
		
		if ($prereg == 0) {
			srand((double)microtime()*1000000);
			$valcode = md5(uniqid(rand()));
			$pname = str_replace(' ','',$_POST['name']);
			$psurname = str_replace(' ','',$_POST['surname']);
			$pgender = str_replace(' ','',$_POST['gender']);
			$pcountry = str_replace(' ','',$_POST['country']);
			$pemail = str_replace(' ','',$_POST['email']);
			$ppassword = str_replace(' ','',$_POST['password']);
			$cuserid = str_replace(' ','',$_COOKIE['userid']);
			$sql = "update users set name = '$pname', surname = '$psurname', gender = '$pgender', country = '$pcountry', email = '$pemail', password = '$ppassword' where user_id = $cuserid";
			// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
			$result = @mysqli_query($conn, $sql);
			
			$errors = "Information updated.";
		} else {
			$errors = "Sorry, that username is already registered in our database, please choose another username.";
		}
	} else if ($_POST['action'] == 2 && $_POST['sub1']) {
		$cuserid = str_replace(' ','',$_COOKIE['userid']);
		
		if (!$_POST['newwin']) {
			$newwin = 0;
		} else {
			$newwin = str_replace(' ','',$_POST['newwin']);
		}
		
		if (!$_POST['font']) {
			$font = 11;
		} else {
			$font = str_replace(' ','',$_POST['font']);
		}
		
		if (!$_POST['fcolor']) {
			$fcolor = '#000000';
		} else {
			$fcolor = str_replace(' ','',$_POST['fcolor']);
		}
		
		if (!$_POST['bgcolor']) {
			$bgcolor = '#FFFFFF';
		} else {
			$bgcolor = str_replace(' ','',$_POST['bgcolor']);
		}
		
		if (!$_POST['hlcolor']) {
			$hlcolor = '#C3C8CD';
		} else {
			$hlcolor = str_replace(' ','',$_POST['hlcolor']);
		}
		
		$sql = "update styles set newwin = '$newwin', font = '$font', fcolor = '$fcolor', bgcolor = '$bgcolor', hlcolor = '$hlcolor' where user_id = $cuserid";
		// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
		$result = @mysqli_query($conn, $sql);
	}  else if ($_POST['action'] == 2 && $_POST['sub2']) {
		$cuserid = str_replace(' ','',$_COOKIE['userid']);
		
		$sql = "update styles set newwin = 0, font = 11, fcolor = '#000000', bgcolor = '#FFFFFF', hlcolor = '#C3C8CD' where user_id = $cuserid";
		// $result = @mysql_db_query('ramonlp_ramonlp', $sql);
		$result = @mysqli_query($conn, $sql);
		
		$newwin = 0;
		$font = 11;
		$fcolor = '#000000';
		$bgcolor = '#FFFFFF';
		$hlcolor = '#C3C8CD';
	}
	
	include "common/headinfo.php";
	include "common/structuretop.php";
?>
<table border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onSubmit="return validate();" name="signupform">
				<input type="hidden" name="action" value="1" />
				<table border="0" class="highlight" cellpadding="3" cellspacing="0">
					<tr valign="top">
						<td rowspan="11" class="highlight"><img src="images/launchpages196x196.png" height="196" width="196" border="0" alt="LaunchPages.com" align="left" hspace="5" vspace="5" /></td>
						<td class="highlight" colspan="2"><span class="headline">Profile Settings</a></td>
					</tr>
<?php if ($errors) { ?>
					<tr>
						<td colspan="3" class="highlight"><span class="red"><?php echo $errors; ?></span></td>
					</tr>
<?php } ?>
					<tr>
						<td class="highlight">Name:</td>
						<td class="highlight"><input type="text" name="name" value="<?php echo $name; ?>" size="20" /></td>
					</tr>
					<tr>
						<td class="highlight">Surname:</td>
						<td class="highlight"><input type="text" name="surname" value="<?php echo $surname; ?>" size="20" /></td>
					</tr>
					<tr>
						<td class="highlight">Gender:</td>
						<td class="highlight">
							<input type="radio" name="gender" value="M" <?php if ($gender == 'M') { echo "checked "; } ?>class="highlight" /> Male
							<input type="radio" name="gender" value="F" <?php if ($gender == 'F') { echo "checked "; } ?>class="highlight" /> Female
						</td>
					</tr>
					<tr>
						<td class="highlight">Country:</td>
						<td class="highlight">
							<select name="country">
								<option value=""></option>
								<option value="AF" <?php if ($_POST['country'] == "AF" || $country == "AF") { echo "selected"; } ?>>Afghanistan</option>
								<option value="AL" <?php if ($_POST['country'] == "AL" || $country == "AL") { echo "selected"; } ?>>Albania</option>
								<option value="DZ" <?php if ($_POST['country'] == "DZ" || $country == "DZ") { echo "selected"; } ?>>Algeria</option>
								<option value="AS" <?php if ($_POST['country'] == "AS" || $country == "AS") { echo "selected"; } ?>>American Samoa</option>
								<option value="AD" <?php if ($_POST['country'] == "AD" || $country == "AD") { echo "selected"; } ?>>Andorra</option>
								<option value="AO" <?php if ($_POST['country'] == "AO" || $country == "AO") { echo "selected"; } ?>>Angola</option>
								<option value="AI" <?php if ($_POST['country'] == "AI" || $country == "AI") { echo "selected"; } ?>>Anguilla</option>
								<option value="AQ" <?php if ($_POST['country'] == "AQ" || $country == "AQ") { echo "selected"; } ?>>Antarctica</option>
								<option value="AG" <?php if ($_POST['country'] == "AG" || $country == "AG") { echo "selected"; } ?>>Antigua and Barbuda</option>
								<option value="AR" <?php if ($_POST['country'] == "AR" || $country == "AR") { echo "selected"; } ?>>Argentina</option>
								<option value="AM" <?php if ($_POST['country'] == "AM" || $country == "AM") { echo "selected"; } ?>>Armenia</option>
								<option value="AW" <?php if ($_POST['country'] == "AW" || $country == "AW") { echo "selected"; } ?>>Aruba</option>
								<option value="AU" <?php if ($_POST['country'] == "AU" || $country == "AU") { echo "selected"; } ?>>Australia</option>
								<option value="AT" <?php if ($_POST['country'] == "AT" || $country == "AT") { echo "selected"; } ?>>Austria</option>
								<option value="AZ" <?php if ($_POST['country'] == "AZ" || $country == "AZ") { echo "selected"; } ?>>Azerbaijan</option>
								<option value="BS" <?php if ($_POST['country'] == "BS" || $country == "BS") { echo "selected"; } ?>>Bahamas</option>
								<option value="BH" <?php if ($_POST['country'] == "BH" || $country == "BH") { echo "selected"; } ?>>Bahrain</option>
								<option value="BD" <?php if ($_POST['country'] == "BD" || $country == "BD") { echo "selected"; } ?>>Bangladesh</option>
								<option value="BB" <?php if ($_POST['country'] == "BB" || $country == "BB") { echo "selected"; } ?>>Barbados</option>
								<option value="BY" <?php if ($_POST['country'] == "BY" || $country == "BY") { echo "selected"; } ?>>Belarus</option>
								<option value="BE" <?php if ($_POST['country'] == "BE" || $country == "BE") { echo "selected"; } ?>>Belgium</option>
								<option value="BZ" <?php if ($_POST['country'] == "BZ" || $country == "BZ") { echo "selected"; } ?>>Belize</option>
								<option value="BJ" <?php if ($_POST['country'] == "BJ" || $country == "BJ") { echo "selected"; } ?>>Benin</option>
								<option value="BM" <?php if ($_POST['country'] == "BM" || $country == "BM") { echo "selected"; } ?>>Bermuda</option>
								<option value="BT" <?php if ($_POST['country'] == "BT" || $country == "BT") { echo "selected"; } ?>>Bhutan</option>
								<option value="BO" <?php if ($_POST['country'] == "BO" || $country == "BO") { echo "selected"; } ?>>Bolivia</option>
								<option value="BA" <?php if ($_POST['country'] == "BA" || $country == "BA") { echo "selected"; } ?>>Bosnia-Herzegovina</option>
								<option value="BW" <?php if ($_POST['country'] == "BW" || $country == "BW") { echo "selected"; } ?>>Botswana</option>
								<option value="BV" <?php if ($_POST['country'] == "BV" || $country == "BV") { echo "selected"; } ?>>Bouvet Island</option>
								<option value="BR" <?php if ($_POST['country'] == "BR" || $country == "BR") { echo "selected"; } ?>>Brazil</option>
								<option value="IO" <?php if ($_POST['country'] == "IO" || $country == "IO") { echo "selected"; } ?>>British Indian Ocean Territory</option>
								<option value="BN" <?php if ($_POST['country'] == "BN" || $country == "BN") { echo "selected"; } ?>>Brunei Darussalam</option>
								<option value="BG" <?php if ($_POST['country'] == "BG" || $country == "BG") { echo "selected"; } ?>>Bulgaria</option>
								<option value="BF" <?php if ($_POST['country'] == "BF" || $country == "BF") { echo "selected"; } ?>>Burkina Faso</option>
								<option value="BI" <?php if ($_POST['country'] == "BI" || $country == "BI") { echo "selected"; } ?>>Burundi</option>
								<option value="KH" <?php if ($_POST['country'] == "KH" || $country == "KH") { echo "selected"; } ?>>Cambodia</option>
								<option value="CM" <?php if ($_POST['country'] == "CM" || $country == "CM") { echo "selected"; } ?>>Cameroon</option>
								<option value="CA" <?php if ($_POST['country'] == "CA" || $country == "CA") { echo "selected"; } ?>>Canada</option>
								<option value="CV" <?php if ($_POST['country'] == "CV" || $country == "CV") { echo "selected"; } ?>>Cape Verde</option>
								<option value="KY" <?php if ($_POST['country'] == "KY" || $country == "KY") { echo "selected"; } ?>>Cayman Islands</option>
								<option value="CF" <?php if ($_POST['country'] == "CF" || $country == "CF") { echo "selected"; } ?>>Central African Republic</option>
								<option value="TD" <?php if ($_POST['country'] == "TD" || $country == "TD") { echo "selected"; } ?>>Chad</option>
								<option value="CL" <?php if ($_POST['country'] == "CL" || $country == "CL") { echo "selected"; } ?>>Chile</option>
								<option value="CN" <?php if ($_POST['country'] == "CN" || $country == "CN") { echo "selected"; } ?>>China</option>
								<option value="CX" <?php if ($_POST['country'] == "CX" || $country == "CX") { echo "selected"; } ?>>Christmas Island</option>
								<option value="CC" <?php if ($_POST['country'] == "CC" || $country == "CC") { echo "selected"; } ?>>Cocos (Keeling) Islands</option>
								<option value="CO" <?php if ($_POST['country'] == "CO" || $country == "CO") { echo "selected"; } ?>>Colombia</option>
								<option value="KM" <?php if ($_POST['country'] == "KM" || $country == "KM") { echo "selected"; } ?>>Comoros</option>
								<option value="CG" <?php if ($_POST['country'] == "CG" || $country == "CG") { echo "selected"; } ?>>Congo</option>
								<option value="CD" <?php if ($_POST['country'] == "CD" || $country == "CD") { echo "selected"; } ?>>Congo (Democratic Republic)</option>
								<option value="CK" <?php if ($_POST['country'] == "CK" || $country == "CK") { echo "selected"; } ?>>Cook Islands</option>
								<option value="CR" <?php if ($_POST['country'] == "CR" || $country == "CR") { echo "selected"; } ?>>Costa Rica</option>
								<option value="HR" <?php if ($_POST['country'] == "HR" || $country == "HR") { echo "selected"; } ?>>Croatia</option>
								<option value="CU" <?php if ($_POST['country'] == "CU" || $country == "CU") { echo "selected"; } ?>>Cuba</option>
								<option value="CY" <?php if ($_POST['country'] == "CY" || $country == "CY") { echo "selected"; } ?>>Cyprus</option>
								<option value="CZ" <?php if ($_POST['country'] == "CZ" || $country == "CZ") { echo "selected"; } ?>>Czech Republic</option>
								<option value="DK" <?php if ($_POST['country'] == "DK" || $country == "DK") { echo "selected"; } ?>>Denmark</option>
								<option value="DJ" <?php if ($_POST['country'] == "DJ" || $country == "DJ") { echo "selected"; } ?>>Djibouti</option>
								<option value="DM" <?php if ($_POST['country'] == "DM" || $country == "DM") { echo "selected"; } ?>>Dominica</option>
								<option value="DO" <?php if ($_POST['country'] == "DO" || $country == "DO") { echo "selected"; } ?>>Dominican Republic</option>
								<option value="TP" <?php if ($_POST['country'] == "TP" || $country == "TP") { echo "selected"; } ?>>East Timor</option>
								<option value="EC" <?php if ($_POST['country'] == "EC" || $country == "EC") { echo "selected"; } ?>>Ecuador</option>
								<option value="EG" <?php if ($_POST['country'] == "EG" || $country == "EG") { echo "selected"; } ?>>Egypt</option>
								<option value="SV" <?php if ($_POST['country'] == "SV" || $country == "SV") { echo "selected"; } ?>>El Salvador</option>
								<option value="GQ" <?php if ($_POST['country'] == "GQ" || $country == "GQ") { echo "selected"; } ?>>Equatorial Guinea</option>
								<option value="ER" <?php if ($_POST['country'] == "ER" || $country == "ER") { echo "selected"; } ?>>Eritrea</option>
								<option value="EE" <?php if ($_POST['country'] == "EE" || $country == "EE") { echo "selected"; } ?>>Estonia</option>
								<option value="ET" <?php if ($_POST['country'] == "ET" || $country == "ET") { echo "selected"; } ?>>Ethiopia</option>
								<option value="FK" <?php if ($_POST['country'] == "FK" || $country == "FK") { echo "selected"; } ?>>Falkland Islands</option>
								<option value="FO" <?php if ($_POST['country'] == "FO" || $country == "FO") { echo "selected"; } ?>>Faroe Islands</option>
								<option value="FJ" <?php if ($_POST['country'] == "FJ" || $country == "FJ") { echo "selected"; } ?>>Fiji</option>
								<option value="FI" <?php if ($_POST['country'] == "FI" || $country == "FI") { echo "selected"; } ?>>Finland</option>
								<option value="FR" <?php if ($_POST['country'] == "FR" || $country == "FR") { echo "selected"; } ?>>France</option>
								<option value="FX" <?php if ($_POST['country'] == "FX" || $country == "FX") { echo "selected"; } ?>>France (European Territory)</option>
								<option value="GF" <?php if ($_POST['country'] == "GF" || $country == "GF") { echo "selected"; } ?>>French Guiana</option>
								<option value="TF" <?php if ($_POST['country'] == "TF" || $country == "TF") { echo "selected"; } ?>>French Southern Territories</option>
								<option value="GA" <?php if ($_POST['country'] == "GA" || $country == "GA") { echo "selected"; } ?>>Gabon</option>
								<option value="GM" <?php if ($_POST['country'] == "GM" || $country == "GM") { echo "selected"; } ?>>Gambia</option>
								<option value="GE" <?php if ($_POST['country'] == "GE" || $country == "GE") { echo "selected"; } ?>>Georgia</option>
								<option value="DE" <?php if ($_POST['country'] == "DE" || $country == "DE") { echo "selected"; } ?>>Germany</option>
								<option value="GH" <?php if ($_POST['country'] == "GH" || $country == "GH") { echo "selected"; } ?>>Ghana</option>
								<option value="GI" <?php if ($_POST['country'] == "GI" || $country == "GI") { echo "selected"; } ?>>Gibraltar</option>
								<option value="GR" <?php if ($_POST['country'] == "GR" || $country == "GR") { echo "selected"; } ?>>Greece</option>
								<option value="GL" <?php if ($_POST['country'] == "GL" || $country == "GL") { echo "selected"; } ?>>Greenland</option>
								<option value="GD" <?php if ($_POST['country'] == "GD" || $country == "GD") { echo "selected"; } ?>>Grenada</option>
								<option value="GP" <?php if ($_POST['country'] == "GP" || $country == "GP") { echo "selected"; } ?>>Guadeloupe</option>
								<option value="GU" <?php if ($_POST['country'] == "GU" || $country == "GU") { echo "selected"; } ?>>Guam</option>
								<option value="GT" <?php if ($_POST['country'] == "GT" || $country == "GT") { echo "selected"; } ?>>Guatemala</option>
								<option value="GN" <?php if ($_POST['country'] == "GN" || $country == "GN") { echo "selected"; } ?>>Guinea</option>
								<option value="GW" <?php if ($_POST['country'] == "GW" || $country == "GW") { echo "selected"; } ?>>Guinea Bissau</option>
								<option value="GY" <?php if ($_POST['country'] == "GY" || $country == "GY") { echo "selected"; } ?>>Guyana</option>
								<option value="HT" <?php if ($_POST['country'] == "HT" || $country == "HT") { echo "selected"; } ?>>Haiti</option>
								<option value="HM" <?php if ($_POST['country'] == "HM" || $country == "HM") { echo "selected"; } ?>>Heard and McDonald Islands</option>
								<option value="VA" <?php if ($_POST['country'] == "VA" || $country == "VA") { echo "selected"; } ?>>Holy See (Vatican)</option>
								<option value="HN" <?php if ($_POST['country'] == "HN" || $country == "HN") { echo "selected"; } ?>>Honduras</option>
								<option value="HK" <?php if ($_POST['country'] == "HK" || $country == "HK") { echo "selected"; } ?>>Hong Kong</option>
								<option value="HU" <?php if ($_POST['country'] == "HU" || $country == "HU") { echo "selected"; } ?>>Hungary</option>
								<option value="IS" <?php if ($_POST['country'] == "IS" || $country == "IS") { echo "selected"; } ?>>Iceland</option>
								<option value="IN" <?php if ($_POST['country'] == "IN" || $country == "IN") { echo "selected"; } ?>>India</option>
								<option value="ID" <?php if ($_POST['country'] == "ID" || $country == "ID") { echo "selected"; } ?>>Indonesia</option>
								<option value="IR" <?php if ($_POST['country'] == "IR" || $country == "IR") { echo "selected"; } ?>>Iran</option>
								<option value="IQ" <?php if ($_POST['country'] == "IQ" || $country == "IQ") { echo "selected"; } ?>>Iraq</option>
								<option value="IE" <?php if ($_POST['country'] == "IE" || $country == "IE") { echo "selected"; } ?>>Ireland</option>
								<option value="IL" <?php if ($_POST['country'] == "IL" || $country == "IL") { echo "selected"; } ?>>Israel</option>
								<option value="IT" <?php if ($_POST['country'] == "IT" || $country == "IT") { echo "selected"; } ?>>Italy</option>
								<option value="CI" <?php if ($_POST['country'] == "CI" || $country == "CI") { echo "selected"; } ?>>Ivory Coast (Cote D'Ivoire)</option>
								<option value="JM" <?php if ($_POST['country'] == "JM" || $country == "JM") { echo "selected"; } ?>>Jamaica</option>
								<option value="JP" <?php if ($_POST['country'] == "JP" || $country == "JP") { echo "selected"; } ?>>Japan</option>
								<option value="JO" <?php if ($_POST['country'] == "JO" || $country == "JO") { echo "selected"; } ?>>Jordan</option>
								<option value="KZ" <?php if ($_POST['country'] == "KZ" || $country == "KZ") { echo "selected"; } ?>>Kazakhstan</option>
								<option value="KE" <?php if ($_POST['country'] == "KE" || $country == "KE") { echo "selected"; } ?>>Kenya</option>
								<option value="KI" <?php if ($_POST['country'] == "KI" || $country == "KI") { echo "selected"; } ?>>Kiribati</option>
								<option value="KW" <?php if ($_POST['country'] == "KW" || $country == "KW") { echo "selected"; } ?>>Kuwait</option>
								<option value="KG" <?php if ($_POST['country'] == "KG" || $country == "KG") { echo "selected"; } ?>>Kyrgyzstan</option>
								<option value="LA" <?php if ($_POST['country'] == "LA" || $country == "LA") { echo "selected"; } ?>>Laos</option>
								<option value="LV" <?php if ($_POST['country'] == "LV" || $country == "LV") { echo "selected"; } ?>>Latvia</option>
								<option value="LB" <?php if ($_POST['country'] == "LB" || $country == "LB") { echo "selected"; } ?>>Lebanon</option>
								<option value="LS" <?php if ($_POST['country'] == "LS" || $country == "LS") { echo "selected"; } ?>>Lesotho</option>
								<option value="LR" <?php if ($_POST['country'] == "LR" || $country == "LR") { echo "selected"; } ?>>Liberia</option>
								<option value="LY" <?php if ($_POST['country'] == "LY" || $country == "LY") { echo "selected"; } ?>>Libya</option>
								<option value="LI" <?php if ($_POST['country'] == "LI" || $country == "LI") { echo "selected"; } ?>>Liechtenstein</option>
								<option value="LT" <?php if ($_POST['country'] == "LT" || $country == "LT") { echo "selected"; } ?>>Lithuania</option>
								<option value="LU" <?php if ($_POST['country'] == "LU" || $country == "LU") { echo "selected"; } ?>>Luxembourg</option>
								<option value="MO" <?php if ($_POST['country'] == "MO" || $country == "MO") { echo "selected"; } ?>>Macau</option>
								<option value="MK" <?php if ($_POST['country'] == "MK" || $country == "MK") { echo "selected"; } ?>>Macedonia</option>
								<option value="MG" <?php if ($_POST['country'] == "MG" || $country == "MG") { echo "selected"; } ?>>Madagascar</option>
								<option value="MW" <?php if ($_POST['country'] == "MW" || $country == "MW") { echo "selected"; } ?>>Malawi</option>
								<option value="MY" <?php if ($_POST['country'] == "MY" || $country == "MY") { echo "selected"; } ?>>Malaysia</option>
								<option value="MV" <?php if ($_POST['country'] == "MV" || $country == "MV") { echo "selected"; } ?>>Maldives</option>
								<option value="ML" <?php if ($_POST['country'] == "ML" || $country == "ML") { echo "selected"; } ?>>Mali</option>
								<option value="MT" <?php if ($_POST['country'] == "MT" || $country == "MT") { echo "selected"; } ?>>Malta</option>
								<option value="MH" <?php if ($_POST['country'] == "MH" || $country == "MH") { echo "selected"; } ?>>Marshall Islands</option>
								<option value="MQ" <?php if ($_POST['country'] == "MQ" || $country == "MQ") { echo "selected"; } ?>>Martinique</option>
								<option value="MR" <?php if ($_POST['country'] == "MR" || $country == "MR") { echo "selected"; } ?>>Mauritania</option>
								<option value="MU" <?php if ($_POST['country'] == "MU" || $country == "MU") { echo "selected"; } ?>>Mauritius</option>
								<option value="YT" <?php if ($_POST['country'] == "YT" || $country == "YT") { echo "selected"; } ?>>Mayotte</option>
								<option value="MX" <?php if ($_POST['country'] == "MX" || $country == "MX") { echo "selected"; } ?>>Mexico</option>
								<option value="FM" <?php if ($_POST['country'] == "FM" || $country == "FM") { echo "selected"; } ?>>Micronesia</option>
								<option value="MD" <?php if ($_POST['country'] == "MD" || $country == "MD") { echo "selected"; } ?>>Moldova</option>
								<option value="MC" <?php if ($_POST['country'] == "MC" || $country == "MC") { echo "selected"; } ?>>Monaco</option>
								<option value="MN" <?php if ($_POST['country'] == "MN" || $country == "MN") { echo "selected"; } ?>>Mongolia</option>
								<option value="MS" <?php if ($_POST['country'] == "MS" || $country == "MS") { echo "selected"; } ?>>Montserrat</option>
								<option value="MA" <?php if ($_POST['country'] == "MA" || $country == "MA") { echo "selected"; } ?>>Morocco</option>
								<option value="MZ" <?php if ($_POST['country'] == "MZ" || $country == "MZ") { echo "selected"; } ?>>Mozambique</option>
								<option value="MM" <?php if ($_POST['country'] == "MM" || $country == "MM") { echo "selected"; } ?>>Myanmar</option>
								<option value="NA" <?php if ($_POST['country'] == "NA" || $country == "NA") { echo "selected"; } ?>>Namibia</option>
								<option value="NR" <?php if ($_POST['country'] == "NR" || $country == "NR") { echo "selected"; } ?>>Nauru</option>
								<option value="NP" <?php if ($_POST['country'] == "NP" || $country == "NP") { echo "selected"; } ?>>Nepal</option>
								<option value="NL" <?php if ($_POST['country'] == "NL" || $country == "NL") { echo "selected"; } ?>>Netherlands</option>
								<option value="AN" <?php if ($_POST['country'] == "AN" || $country == "AN") { echo "selected"; } ?>>Netherlands Antilles</option>
								<option value="NC" <?php if ($_POST['country'] == "NC" || $country == "NC") { echo "selected"; } ?>>New Caledonia</option>
								<option value="NZ" <?php if ($_POST['country'] == "NZ" || $country == "NZ") { echo "selected"; } ?>>New Zealand</option>
								<option value="NI" <?php if ($_POST['country'] == "NI" || $country == "NI") { echo "selected"; } ?>>Nicaragua</option>
								<option value="NE" <?php if ($_POST['country'] == "NE" || $country == "NE") { echo "selected"; } ?>>Niger</option>
								<option value="NG" <?php if ($_POST['country'] == "NG" || $country == "NG") { echo "selected"; } ?>>Nigeria</option>
								<option value="NU" <?php if ($_POST['country'] == "NU" || $country == "NU") { echo "selected"; } ?>>Niue</option>
								<option value="NF" <?php if ($_POST['country'] == "NF" || $country == "NF") { echo "selected"; } ?>>Norfolk Island</option>
								<option value="KP" <?php if ($_POST['country'] == "KP" || $country == "KP") { echo "selected"; } ?>>North Korea</option>
								<option value="MP" <?php if ($_POST['country'] == "MP" || $country == "MP") { echo "selected"; } ?>>Northern Mariana Islands</option>
								<option value="NO" <?php if ($_POST['country'] == "NO" || $country == "NO") { echo "selected"; } ?>>Norway</option>
								<option value="OM" <?php if ($_POST['country'] == "OM" || $country == "OM") { echo "selected"; } ?>>Oman</option>
								<option value="PK" <?php if ($_POST['country'] == "PK" || $country == "PK") { echo "selected"; } ?>>Pakistan</option>
								<option value="PW" <?php if ($_POST['country'] == "PW" || $country == "PW") { echo "selected"; } ?>>Palau</option>
								<option value="PS" <?php if ($_POST['country'] == "PS" || $country == "PS") { echo "selected"; } ?>>Palestinian Territory</option>
								<option value="PA" <?php if ($_POST['country'] == "PA" || $country == "PA") { echo "selected"; } ?>>Panama</option>
								<option value="PG" <?php if ($_POST['country'] == "PG" || $country == "PG") { echo "selected"; } ?>>Papua New Guinea</option>
								<option value="PY" <?php if ($_POST['country'] == "PY" || $country == "PY") { echo "selected"; } ?>>Paraguay</option>
								<option value="PE" <?php if ($_POST['country'] == "PE" || $country == "PE") { echo "selected"; } ?>>Peru</option>
								<option value="PH" <?php if ($_POST['country'] == "PH" || $country == "PH") { echo "selected"; } ?>>Philippines</option>
								<option value="PN" <?php if ($_POST['country'] == "PN" || $country == "PN") { echo "selected"; } ?>>Pitcairn</option>
								<option value="PL" <?php if ($_POST['country'] == "PL" || $country == "PL") { echo "selected"; } ?>>Poland</option>
								<option value="PF" <?php if ($_POST['country'] == "PF" || $country == "PF") { echo "selected"; } ?>>Polynesia</option>
								<option value="PT" <?php if ($_POST['country'] == "PT" || $country == "PT") { echo "selected"; } ?>>Portugal</option>
								<option value="PR" <?php if ($_POST['country'] == "PR" || $country == "PR") { echo "selected"; } ?>>Puerto Rico</option>
								<option value="QA" <?php if ($_POST['country'] == "QA" || $country == "QA") { echo "selected"; } ?>>Qatar</option>
								<option value="RE" <?php if ($_POST['country'] == "RE" || $country == "RE") { echo "selected"; } ?>>Reunion</option>
								<option value="RO" <?php if ($_POST['country'] == "RO" || $country == "RO") { echo "selected"; } ?>>Romania</option>
								<option value="RU" <?php if ($_POST['country'] == "RU" || $country == "RU") { echo "selected"; } ?>>Russian Federation</option>
								<option value="RW" <?php if ($_POST['country'] == "RW" || $country == "RW") { echo "selected"; } ?>>Rwanda</option>
								<option value="GS" <?php if ($_POST['country'] == "GS" || $country == "GS") { echo "selected"; } ?>>S. Georgia &amp; S. Sandwich Isls.</option>
								<option value="SH" <?php if ($_POST['country'] == "SH" || $country == "SH") { echo "selected"; } ?>>Saint Helena</option>
								<option value="KN" <?php if ($_POST['country'] == "KN" || $country == "KN") { echo "selected"; } ?>>Saint Kitts &amp; Nevis Anguilla</option>
								<option value="LC" <?php if ($_POST['country'] == "LC" || $country == "LC") { echo "selected"; } ?>>Saint Lucia</option>
								<option value="PM" <?php if ($_POST['country'] == "PM" || $country == "PM") { echo "selected"; } ?>>Saint Pierre and Miquelon</option>
								<option value="VC" <?php if ($_POST['country'] == "VC" || $country == "VC") { echo "selected"; } ?>>Saint Vincent &amp; Grenadines</option>
								<option value="WS" <?php if ($_POST['country'] == "WS" || $country == "WS") { echo "selected"; } ?>>Samoa</option>
								<option value="SM" <?php if ($_POST['country'] == "SM" || $country == "SM") { echo "selected"; } ?>>San Marino</option>
								<option value="ST" <?php if ($_POST['country'] == "ST" || $country == "ST") { echo "selected"; } ?>>Sao Tome and Principe</option>
								<option value="SA" <?php if ($_POST['country'] == "SA" || $country == "SA") { echo "selected"; } ?>>Saudi Arabia</option>
								<option value="SN" <?php if ($_POST['country'] == "SN" || $country == "SN") { echo "selected"; } ?>>Senegal</option>
								<option value="SC" <?php if ($_POST['country'] == "SC" || $country == "SC") { echo "selected"; } ?>>Seychelles</option>
								<option value="SL" <?php if ($_POST['country'] == "SL" || $country == "SL") { echo "selected"; } ?>>Sierra Leone</option>
								<option value="SG" <?php if ($_POST['country'] == "SG" || $country == "SG") { echo "selected"; } ?>>Singapore</option>
								<option value="SK" <?php if ($_POST['country'] == "SK" || $country == "SK") { echo "selected"; } ?>>Slovakia</option>
								<option value="SI" <?php if ($_POST['country'] == "SI" || $country == "SI") { echo "selected"; } ?>>Slovenia</option>
								<option value="SB" <?php if ($_POST['country'] == "SB" || $country == "SB") { echo "selected"; } ?>>Solomon Islands</option>
								<option value="SO" <?php if ($_POST['country'] == "SO" || $country == "SO") { echo "selected"; } ?>>Somalia</option>
								<option value="ZA" <?php if ($_POST['country'] == "ZA" || $country == "ZA") { echo "selected"; } ?>>South Africa</option>
								<option value="KR" <?php if ($_POST['country'] == "KR" || $country == "KR") { echo "selected"; } ?>>South Korea</option>
								<option value="ES" <?php if ($_POST['country'] == "ES" || $country == "ES") { echo "selected"; } ?>>Spain</option>
								<option value="LK" <?php if ($_POST['country'] == "LK" || $country == "LK") { echo "selected"; } ?>>Sri Lanka</option>
								<option value="SD" <?php if ($_POST['country'] == "SD" || $country == "SD") { echo "selected"; } ?>>Sudan</option>
								<option value="SR" <?php if ($_POST['country'] == "SR" || $country == "SR") { echo "selected"; } ?>>Suriname</option>
								<option value="SZ" <?php if ($_POST['country'] == "SZ" || $country == "SZ") { echo "selected"; } ?>>Swaziland</option>
								<option value="SE" <?php if ($_POST['country'] == "SE" || $country == "SE") { echo "selected"; } ?>>Sweden</option>
								<option value="CH" <?php if ($_POST['country'] == "CH" || $country == "CH") { echo "selected"; } ?>>Switzerland</option>
								<option value="SY" <?php if ($_POST['country'] == "SY" || $country == "SY") { echo "selected"; } ?>>Syrian Arab Republic</option>
								<option value="TW" <?php if ($_POST['country'] == "TW" || $country == "TW") { echo "selected"; } ?>>Taiwan</option>
								<option value="TJ" <?php if ($_POST['country'] == "TJ" || $country == "TJ") { echo "selected"; } ?>>Tajikistan</option>
								<option value="TZ" <?php if ($_POST['country'] == "TZ" || $country == "TZ") { echo "selected"; } ?>>Tanzania</option>
								<option value="TH" <?php if ($_POST['country'] == "TH" || $country == "TH") { echo "selected"; } ?>>Thailand</option>
								<option value="TG" <?php if ($_POST['country'] == "TG" || $country == "TG") { echo "selected"; } ?>>Togo</option>
								<option value="TK" <?php if ($_POST['country'] == "TK" || $country == "TK") { echo "selected"; } ?>>Tokelau</option>
								<option value="TO" <?php if ($_POST['country'] == "TO" || $country == "TO") { echo "selected"; } ?>>Tonga</option>
								<option value="TT" <?php if ($_POST['country'] == "TT" || $country == "TT") { echo "selected"; } ?>>Trinidad and Tobago</option>
								<option value="TN" <?php if ($_POST['country'] == "TU" || $country == "TU") { echo "selected"; } ?>>Tunisia</option>
								<option value="TR" <?php if ($_POST['country'] == "TR" || $country == "TR") { echo "selected"; } ?>>Turkey</option>
								<option value="TM" <?php if ($_POST['country'] == "TM" || $country == "TM") { echo "selected"; } ?>>Turkmenistan</option>
								<option value="TC" <?php if ($_POST['country'] == "TC" || $country == "TC") { echo "selected"; } ?>>Turks and Caicos Islands</option>
								<option value="TV" <?php if ($_POST['country'] == "TV" || $country == "TV") { echo "selected"; } ?>>Tuvalu</option>
								<option value="UG" <?php if ($_POST['country'] == "UG" || $country == "UG") { echo "selected"; } ?>>Uganda</option>
								<option value="UA" <?php if ($_POST['country'] == "UA" || $country == "UA") { echo "selected"; } ?>>Ukraine</option>
								<option value="AE" <?php if ($_POST['country'] == "AE" || $country == "AE") { echo "selected"; } ?>>United Arab Emirates</option>
								<option value="GB" <?php if ($_POST['country'] == "GB" || $country == "GB") { echo "selected"; } ?>>United Kingdom</option>
								<option value="US" <?php if ($_POST['country'] == "US" || $country == "US") { echo "selected"; } ?>>United States</option>
								<option value="UY" <?php if ($_POST['country'] == "UY" || $country == "UY") { echo "selected"; } ?>>Uruguay</option>
								<option value="UM" <?php if ($_POST['country'] == "UM" || $country == "SY") { echo "selected"; } ?>>USA Minor Outlying Islands</option>
								<option value="UZ" <?php if ($_POST['country'] == "UZ" || $country == "UZ") { echo "selected"; } ?>>Uzbekistan</option>
								<option value="VU" <?php if ($_POST['country'] == "VU" || $country == "VU") { echo "selected"; } ?>>Vanuatu</option>
								<option value="VE" <?php if ($_POST['country'] == "VE" || $country == "VE") { echo "selected"; } ?>>Venezuela</option>
								<option value="VN" <?php if ($_POST['country'] == "VN" || $country == "VN") { echo "selected"; } ?>>Vietnam</option>
								<option value="VG" <?php if ($_POST['country'] == "VG" || $country == "VG") { echo "selected"; } ?>>Virgin Islands (British)</option>
								<option value="VI" <?php if ($_POST['country'] == "VI" || $country == "VI") { echo "selected"; } ?>>Virgin Islands (USA)</option>
								<option value="WF" <?php if ($_POST['country'] == "WF" || $country == "WF") { echo "selected"; } ?>>Wallis and Futuna Islands</option>
								<option value="EH" <?php if ($_POST['country'] == "EH" || $country == "EH") { echo "selected"; } ?>>Western Sahara</option>
								<option value="YE" <?php if ($_POST['country'] == "YE" || $country == "YE") { echo "selected"; } ?>>Yemen</option>
								<option value="YU" <?php if ($_POST['country'] == "YU" || $country == "YU") { echo "selected"; } ?>>Yugoslavia</option>
								<option value="ZR" <?php if ($_POST['country'] == "ZR" || $country == "ZR") { echo "selected"; } ?>>Zaire</option>
								<option value="ZM" <?php if ($_POST['country'] == "ZM" || $country == "ZM") { echo "selected"; } ?>>Zambia</option>
								<option value="ZW" <?php if ($_POST['country'] == "ZW" || $country == "ZW") { echo "selected"; } ?>>Zimbabwe</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="highlight">Email:</td>
						<td class="highlight"><input type="text" name="email" value="<?php echo $email; ?>" size="20" /></td>
					</tr>
					<tr>
						<td class="highlight">Password:</td>
						<td class="highlight"><input type="password" name="password" size="20" /></td>
					</tr>
					<tr>
						<td class="highlight">Reenter:</td>
						<td class="highlight"><input type="password" name="password2" size="20" /></td>
					</tr>
					<tr>
						<td align="center" colspan="2" class="highlight"><input type="submit" value="Update" /></td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
<br/>
<table border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="optionsform">
				<input type="hidden" name="action" value="2" />
				<table border="0" class="highlight" cellpadding="3" cellspacing="0">
					<tr valign="top">
						<td rowspan="11" class="highlight"><img src="images/launchpages196x196.png" height="196" width="196" border="0" alt="LaunchPages.com" align="left" hspace="5" vspace="5" /></td>
						<td class="highlight" colspan="2"><span class="headline">Options</a></td>
					</tr>
					<tr>
						<td class="highlight">Open links in new window:</td>
						<td class="highlight">
							<input type="radio" name="newwin" value="1" class="highlight" <?php if ($newwin == 1) { echo "checked "; } ?>/> Yes
							<input type="radio" name="newwin" value="0" class="highlight" <?php if ($newwin == 0 || !$newwin) { echo "checked "; } ?>/> No
						</td>
					</tr>
					<tr>
						<td class="highlight">Font Size:</td>
						<td class="highlight"><input type="text" name="font" value="<?php if ($bfont) { echo $font; } else { echo '11'; } ?>" maxlength="2" size="2" /></td>
					</tr>
					<tr>
						<td class="highlight">Font Color:</td>
						<td class="highlight"><input type="text" name="fcolor" maxlength="7" size="7" value="<?php if ($fcolor) { echo $fcolor; } else { echo "#000000"; } ?>" /><a href="javascript:TCP.popup(document.forms['optionsform'].elements['fcolor'])"><img width="15" height="13" border="0" alt="Click Here to Pick up the color" src="images/sel.gif"></a></td>
					</tr>
					<tr>
						<td class="highlight">Background Color:</td>
						<td class="highlight"><input type="text" name="bgcolor" maxlength="7" size="7" value="<?php if ($bgcolor) { echo $bgcolor; } else { echo "#FFFFFF"; } ?>" /><a href="javascript:TCP.popup(document.forms['optionsform'].elements['bgcolor'])"><img width="15" height="13" border="0" alt="Click Here to Pick up the color" src="images/sel.gif"></a></td>
					</tr>
					<tr>
						<td class="highlight">Highlight Color:</td>
						<td class="highlight"><input type="text" name="hlcolor" maxlength="7" size="7" value="<?php if ($hlcolor) { echo $hlcolor; } else { echo "#C3C8CD"; } ?>" /><a href="javascript:TCP.popup(document.forms['optionsform'].elements['hlcolor'])"><img width="15" height="13" border="0" alt="Click Here to Pick up the color" src="images/sel.gif"></a></td>
					</tr>
					<tr>
						<td align="center" colspan="2" class="highlight"><input type="submit" value="Default" name="sub2" /> <input type="submit" value="Update" name="sub1" /></td>
					</tr>
				</table>
			</form>
		</td>
	</tr>
</table>
<script language=JavaScript src="css/picker.js"></script>
<script language="JavaScript">
	function echeck(str) {
		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		
		if (str.indexOf(at)==-1){
			alert("Please enter a valid Email address.")
			return false
		}
		
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
     		alert("Please enter a valid Email address.")
			return false
		}
		
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
			alert("Please enter a valid Email address.")
			return false
		}
		
		if (str.indexOf(at,(lat+1))!=-1){
			alert("Please enter a valid Email address.")
			return false
		}
		
		if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
			alert("Please enter a valid Email address.")
			return false
		}
		
		if (str.indexOf(dot,(lat+2))==-1){
			alert("Please enter a valid Email address.")
			return false
		}
		
		if (str.indexOf(" ")!=-1){
			alert("Please enter a valid Email address.")
			return false
		}
		
		return true          
	}
	
	function validate() {
		if (document.signupform.name.value==null || document.signupform.name.value=="") {
			alert("Please enter your name.");
			document.signupform.name.focus();
			return false;
		}
		
		if (document.signupform.surname.value==null || document.signupform.surname.value=="") {
			alert("Please enter your surname.");
			document.signupform.surname.focus();
			return false;
		}
		
		if (document.signupform.country.value==null || document.signupform.country.value=="") {
			alert("Please indicate your country.");
			document.signupform.country.focus();
			return false;
		}
		
		var email=document.signupform.email
	
		if ((email.value==null)||(email.value=="")){
			alert("Please enter a valid Email address.")
			email.focus()
			return false
		}
		
		if (echeck(email.value)==false){
			email.value=""
			email.focus()
			return false
		}
		
		if (document.signupform.password.value==null || document.signupform.password.value=="") {
			alert("Please enter your password.");
			document.signupform.password.focus();
			return false;
		}
		
		if (document.signupform.password.value != document.signupform.password2.value) {
			alert("The passwords you entered must match.");
			document.signupform.password.focus();
			return false;
		}
	}
</script>
<?php	include "common/structurebottom.php"; ?>
