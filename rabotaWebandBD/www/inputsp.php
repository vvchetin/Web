<?php_track_vars?><?php
include("connection.php");
		$connection = mysql_connect($host, $user, $password);
		mysql_select_db($database,$connection);
		mysql_query("SET character set utf8 "); 
		mysql_query("SET collation_connection=utf8_general_ci ");
	$idsport = $_POST["idsport"];
	if (!($_POST["idsport"])==" "){
		$query = mysql_query("SELECT `athlete`.id, `athlete`.name, `athlete`.gender, `athlete`.years, `athlete`.address, `athlete`.rank, `state`.Name, `sport`.name\n"
		. "FROM `athlete` , `state` , `sport`\n"
		. "WHERE athlete.state_id = state.id\n"
		. "AND athlete.sport_id = sport.id and state.name='".$idsport."')");
		}		
		else {
			echo "���������� �� �����. ��������� ��� ��� ���.";
		}
		if ($myrow1 = mysql_fetch_array($result1)) {
			echo "<table border=1 align=center>\n";
			echo "<tr>
				<td align=center><b>�����</b></td>
				<td align=center><b>���</b></td>
				<td align=center><b>���</b></td>
				<td align=center><b>���</b></td>
				<td align=center><b>�����</b></td>
				<td align=center><b>������</b></td>
				<td align=center><b>������</b></td>
				<td align=center><b>�����</b></td>
				</tr>\n";
			do {
			printf("<tr>
			<td align=center>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			</tr>\n", $myrow1[`athlete`.'id'], $myrow1[`athlete`.'Name'], $myrow1[`athlete`.'gender'], $myrow1[`athlete`.'years'], $myrow1[`athlete`.'address'], $myrow1[`athlete`.'rank'], $myrow1[`state`.'StName'], $myrow1[`sport`.'spname']);
			} while ($myrow1 = mysql_fetch_array($result1));
			echo "</table>\n";
			echo "<div align=center><a href='sp.php' ><input type='submit' name='SSS' value='������'></a></div>";
			} else {
				echo "Sorry, no records were found!";	
			}
header('Location: sp.php');
  exit;
	
	
?>