<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="mystyle.css">
	</head>
<body>
<table width=100% height=90% border="0">
	<tr>
		<td align=left height=7%>
			<a href="index.php" title="Домашняя страница"><img src="img\kol.jpg" width="300" height="150"></a>
		</td>
		<td align=center colspan="3">
			<p class=zag>ОЛИМПИЙСКИЕ ИГРЫ</p>
		</td>
	</tr>
	<tr align=center >
		<td width=20% height=3% bgcolor=#d1d1d1><P class=knop><a href="sp.php" title="Информация о спортсменах">СПОРТСМЕНЫ</a></p>
		</td>
		<td width=20% height=3% bgcolor=#d1d1d1><P class=knop><a href="st.php" title="Информация о странах участницах">СТРАНЫ</a></P>
		</td>
		<td width=20% height=3% bgcolor=#d1d1d1><P class=knop><a href="tr.php" title="Информация о тренерах команд участниц">ТРЕНЕРЫ</a></P>
		</td>
		<td width=20% height=3% bgcolor=#e8e8ea><P class=knop1 >ИГРЫ</P>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p class=zag1 >Результат игры</p>
			<form method="post" action="">
<table border="0" width="100%" align=left>
	<tr>
		<td width="25%"><p class=text1>По виду спорта</p>
		</td>
		<td width="25%" align="left">
			<select name="idsport" >
				<option value="0" class=search></option>
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
			&nbsp;&nbsp;&nbsp;<input type="submit" name="cnm" value="ПОКАЗАТЬ">
		</td>	
		</tr>
	</table>
</form>
<?php
	if(isset($_POST['cnm']))
	{
		$idsport=$_POST['idsport'];
	if (isset($_POST['idsport']))
	{
		$result7=mysql_query("SELECT `game`.Result, `game`.comname\n"
			. "FROM `game`, `sport`\n"
			. "WHERE game.sport_id=sport.id and sport.id='".$idsport."'");
		if (!$result7) {
			die('Неверный запрос: ' . mysql_error());
		}
		if ($myrow7 = mysql_fetch_array($result7)) {
			echo "<table border=1 align=center>\n";
			echo "<tr>
				<td align=center><b>МЕСТО</b></td>
				<td align=center><b>КОМАНДА</b></td>
				</tr>\n";
			do {
			printf("<tr>
			<td>%s</td>
			<td>%s</td>
			</tr>\n", $myrow7[`game`.'Result'], $myrow7[`game`.'comname']);
			} while ($myrow7 = mysql_fetch_array($result7));
			echo "</table>\n";
			echo "<div align=center><a href='ig.php' ><input type='submit' name='SSS' value='СКРЫТЬ'></a></div>";
			} else {
				echo "Sorry, no records were found!";	
			} 
	}
	}
?>	
	<p class=zag1 >Расписание игр</p>
<?php
		include("connection.php");
		$connection = mysql_connect($host, $user, $password);
		mysql_select_db($database,$connection);
		mysql_query("SET character set utf8 "); 
		mysql_query("SET collation_connection=utf8_general_ci ");
		$result=mysql_query("SELECT `sport`.spname, `game`.data_str, `game`.data_end,  `game`.result
				FROM `sport` , `game`, `command` 
				WHERE game.Sport_id = sport.id 
				group by sport.spname
				order by game.data_str ASC 
				");
		if (!$result) {
			die('Неверный запрос: ' . mysql_error());
		}
		if ($myrow = mysql_fetch_array($result)) {
			echo "<table border=1 align=center>\n";
			echo "<tr>
				<td align=center><b>ВИД_СПОРТА</b></td>
				<td align=center><b>ДАТА_НАЧАЛА</b></td>
				<td align=center><b>ДАТА_КОНЦА</b></td>				
				</tr>\n";
			do {
			printf("<tr><td>%s</td><td>%s</td><td>%s</td></tr>\n", $myrow[`sport`.'spname'], $myrow[`game`.'data_str'], $myrow[`game`.'data_end'] );
			} while ($myrow = mysql_fetch_array($result));
			echo "</table>\n";
			} else {
				echo "Sorry, no records were found!";	
		}
?>
		</td>
		<td colspan="2" >
			<p class=zag1> Медальный зачет</p>
<?php
$result2=mysql_query("SELECT `state`.stname, COUNT(*)\n"
    . "FROM `game` , `command`, `state`\n"
    . "where game.command_id=command.id and command.state_id=state.id and game.result <4 \n"
    . "\n"
    . "group by `state`.stname \n"
    . "order by COUNT(*) DESC");	
echo "<table border=1 align=center>\n";
	if ($myrow2 = mysql_fetch_array($result2)) {			
			echo "<tr>
				<td align=center><b>СТРАНА</b></td>
				<td align=center><b>ВСЕГО</b></td>
				</tr>\n";
					do {	
				printf("<tr><td>%s</td><td>%s</td></tr>\n", $myrow2[`state`.'stname'] , $myrow2['COUNT(*)']);
				$_POST[`state`.'stname']=$myrow2[`state`.'stname'];
				} while ( $myrow2 = mysql_fetch_array($result2));				
				} else {
				echo "Sorry, no records were found!";	
			}
		echo "</table>\n";
?>
<form action="" method="post">
<table>
	<tr>
		<td><div  class=zag1><input type="submit" class=search name="zol" value="Золото" ></div></td>
		<td><div  class=zag1><input type="submit" class=search name="ser" value="Серебро" ></div></td>
		<td><div  class=zag1><input type="submit" class=search name="brn" value="Бронза" ></div></td>
	</tr>
</table>
</form>
<?php
if(isset($_POST['zol']))
{
$result3=mysql_query("SELECT `state`.stname, COUNT(*)\n"
    . "FROM `game` , `command`, `state`\n"
    . "where game.command_id=command.id and command.state_id=state.id and game.result =1 \n"
    . "\n"
    . "group by `state`.stname \n"
    . "order by COUNT(*) DESC");	
echo "<table border=1 align=center>\n";
	if ($myrow3 = mysql_fetch_array($result3)) {			
			echo "<tr>
				<td align=center><b>СТРАНА</b></td>
				<td align=center><b>ВСЕГО</b></td>
				</tr>\n";
					do {	
				printf("<tr><td>%s</td><td>%s</td></tr>\n", $myrow3[`state`.'stname'], $myrow3['COUNT(*)']);
				$_POST[`state`.'stname']=$myrow3[`state`.'stname'];
				} while ( $myrow3 = mysql_fetch_array($result3));				
				} else {
				echo "Sorry, no records were found!";	
			}
		echo "</table>\n";
} else {
	if(isset($_POST['ser']))
	{
	$result4=mysql_query("SELECT `state`.stname, COUNT(*)\n"
    . "FROM `game` , `command`, `state`\n"
    . "where game.command_id=command.id and command.state_id=state.id and game.result =2 \n"
    . "\n"
    . "group by `state`.stname \n"
    . "order by COUNT(*) DESC");	
echo "<table border=1 align=center>\n";
	if ($myrow4 = mysql_fetch_array($result4)) {			
			echo "<tr>
				<td align=center><b>СТРАНА</b></td>
				<td align=center><b>ВСЕГО</b></td>
				</tr>\n";
					do {	
				printf("<tr><td>%s</td><td>%s</td></tr>\n", $myrow4[`state`.'stname'], $myrow4['COUNT(*)']);
				$_POST[`state`.'stname']=$myrow4[`state`.'stname'];
				} while ( $myrow4 = mysql_fetch_array($result4));				
				} else {
				echo "Sorry, no records were found!";	
			}
		echo "</table>\n";
	} else {
		if(isset($_POST['brn']))
	{
	$result5=mysql_query("SELECT `state`.stname, COUNT(*)\n"
    . "FROM `game` , `command`, `state`\n"
    . "where game.command_id=command.id and command.state_id=state.id and game.result =3 \n"
    . "\n"
    . "group by `state`.stname \n"
    . "order by COUNT(*) DESC");	
echo "<table border=1 align=center>\n";
	if ($myrow5 = mysql_fetch_array($result5)) {			
			echo "<tr>
				<td align=center><b>СТРАНА</b></td>
				<td align=center><b>ВСЕГО</b></td>
				</tr>\n";
					do {	
				printf("<tr><td>%s</td><td>%s</td></tr>\n", $myrow5[`state`.'stname'], $myrow5['COUNT(*)']);
				$_POST[`state`.'stname']=$myrow5[`state`.'stname'];
				} while ( $myrow5 = mysql_fetch_array($result5));				
				} else {
				echo "Sorry, no records were found!";	
			}
		echo "</table>\n";
	}
	}
}
?>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<a href="obr.html" title="Связаться с нами!"><p class=tex>ОБРАТНАЯ СВЯЗЬ</p> </a>
		</td>
	</tr>
</table>
<table width=100% height=10% cellspacing="0">
	<tr width=1% height=1% bgcolor=#d1d1d1  >
		<td bgcolor=#d1d1d1 >
			<a href="index.php" title="Работа с базой!!!"><img  src="img\shest.png" width="50" height="50" ></a>
		</td>
		<td colspan="3" border="0">
			<p class=kol>  Контрольная работа <br> по дисциплине WEB технологии <br> Тема: Олимпиада.<br> Выполнил Четин В.В.</p>
		</td>
	</tr>
</table>
</body>
</html>
