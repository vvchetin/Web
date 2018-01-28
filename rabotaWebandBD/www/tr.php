<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<table width=100% height=20% >
<tr>
<td align=left height=7%>
<a href="index.php" title="Домашняя страница"><img src="img\kol.jpg" width="300" height="150"></a>
</td>
<td align=center colspan="3"><p class=zag>ОЛИМПИЙСКИЕ ИГРЫ</p>
</td></tr>
<tr align=center >
<td width=20% height=3% bgcolor=#d1d1d1><P class=knop><a href="sp.php" title="Информация о спортсменах">СПОРТСМЕНЫ</a></p></td>
<td width=20% height=3% bgcolor=#d1d1d1><P class=knop><a href="st.php" title="Информация о странах участницах">СТРАНЫ</a></P></td>
<td width=20% height=3% bgcolor=#e8e8ea><P class=knop1>ТРЕНЕРЫ</P></td>
<td width=20% height=3% bgcolor=#d1d1d1><P class=knop><a href="ig.php" title="Данные о игре">ИГРЫ</a></P></td>
</tr>
<tr>


</table>
<p class=zag1> Выбирите критерий вывода</p>
<form method="post" action="">
	<table border="0" width="100%" align=left>
		<tr>
		<td width="5%"><p class=text1>По виду спорта </p></td>
		<td width="25%" align="left" >
			<select name="idsport" >
				<option value="0" class=search> </option>
					<?php
						include("connection.php");
						$connection = mysql_connect($host, $user, $password);
						mysql_select_db($database,$connection);
						mysql_query("SET character set utf8 "); 
						mysql_query("SET collation_connection=utf8_general_ci ");				
						$result1 = mysql_query("SELECT * FROM `sport`");
						if ($myrow1 = mysql_fetch_array($result1)) {
						do {
							echo "<option value='".$myrow1['id']."'>".$myrow1['SpName']."</option>";
						} while ($myrow1 = mysql_fetch_array($result1));
						}
					?>
			</select>		
			&nbsp;&nbsp;&nbsp;<input type="submit" name="spr" value="ПОКАЗАТЬ">
		</td>	
		</tr>
	</table>
</form>
<form action="" method="post">
	<div  class=zag1><input type="submit" class=search1 name="smb" value="ВСЕ ТРЕНЕРЫ УЧАСТНИКИ" ></div>
</form>
	<p class=zag2 >Тренеры участники олимпиады</p>
<table width=100% height=20% >
<tr>
<td>
	<?php
	if(isset($_POST['smb']))
{
		include("connection.php");
		$connection = mysql_connect($host, $user, $password);
		mysql_select_db($database,$connection);
		mysql_query("SET character set utf8 "); 
		mysql_query("SET collation_connection=utf8_general_ci ");
		$result=mysql_query("SELECT `coach`.id,`coach`.Name,`coach`.Gender, `Sport`.spname\n"
				. "FROM `coach`, `sport`\n"
				. "WHERE coach.Sport_id=Sport.id\n"
				. "ORDER BY `coach`.id ASC ");
		if (!$result) {
			die('Неверный запрос: ' . mysql_error());
		}
		if ($myrow = mysql_fetch_array($result)) {
			echo "<table border=1 align=center>\n";
			echo "<tr>
				<td align=center><b>НОМЕР</b></td>
				<td align=center><b>ФИО</b></td>
				<td align=center><b>ПОЛ</b></td>
				<td align=center><b>ВИД_СПОРТА</b></td>
				</tr>\n";
			do {
			printf("<tr>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			</tr>\n", $myrow[`coach`.'id'], $myrow[`coach`.'Name'], $myrow[`coach`.'Gender'], $myrow[`sport`.'spname']);
			} while ($myrow = mysql_fetch_array($result));
			echo "</table>\n";
			echo "<div align=center><a href='tr.php' ><input type='submit' name='SSS' value='СКРЫТЬ'></a></div>";
			} else {
				echo "Sorry, no records were found!";	
			}
}
	?>

<?php
if(isset($_POST['spr']))
{
	$idsport=$_POST['idsport'];

	if (isset($_POST['idsport']))
	{
$result1=mysql_query("SELECT `coach`.id,`coach`.Name,`coach`.Gender, `Sport`.spname\n"
				. "FROM `coach`, `sport`\n"
				. "WHERE coach.Sport_id=Sport.id and coach.Sport_id='".$idsport."'\n");
		if (!$result1) {
			die('Неверный запрос: ' . mysql_error());
		}
		if ($myrow1 = mysql_fetch_array($result1)) {
			echo "<table border=1 align=center>\n";
			echo "<tr>
				
				<td align=center><b>ФИО</b></td>
				<td align=center><b>ПОЛ</b></td>
				<td align=center><b>ВИД_СПОРТА</b></td>
				</tr>\n";
			do {
			printf("<tr>
			
			<td>%s</td>
			<td>%s</td>
			<td>%s</td>
			</tr>\n",  $myrow1[`coach`.'Name'], $myrow1[`coach`.'Gender'], $myrow1[`sport`.'spname']);
			} while ($myrow1 = mysql_fetch_array($result1));
			echo "</table>\n";
			echo "<div align=center><a href='tr.php' ><input type='submit' name='SSS' value='СКРЫТЬ'></a></div>";
			} else {
				echo "Sorry, no records were found!";	
			}
}
}
?>
<br>
</td>
</tr>
</table>
<table width=100% height=10% cellspacing="0">
<tr width=1% height=1% bgcolor=#d1d1d1  >
<td bgcolor=#d1d1d1 >
<a href="index.php" title="Работа с базой!!!"><img  src="img\shest.png" width="50" height="50" ></a>
</td>
<td colspan="3" border="0">
<p class=kol>  Курсовая работа <br> по дисциплине Базы Данных <br> Тема: Олимпиада.<br> Выполнил Четин В.В.</p>
</td>
</tr>
</table>
</body></html>