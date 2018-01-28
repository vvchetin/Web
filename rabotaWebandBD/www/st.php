<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<table width=100% height=30% >
<tr>
<td align=left height=7%>
<a href="index.php" title="Домашняя страница"><img src="img\kol.jpg" width="300" height="150"></a>
</td>
<td align=center colspan="3"><p class=zag>ОЛИМПИЙСКИЕ ИГРЫ</p>
</td></tr>
<tr align=center >
<td width=20% height=3% bgcolor=#d1d1d1><P class=knop><a href="sp.php" title="Информация о спортсменах">СПОРТСМЕНЫ</a></p></td>
<td width=20% height=3% bgcolor=#e8e8ea><P class=knop1 >СТРАНЫ</a></P></td>
<td width=20% height=3% bgcolor=#d1d1d1><P class=knop><a href="tr.php" title="Информация о тренерах команд участниц">ТРЕНЕРЫ</a></P></td>
<td width=20% height=3% bgcolor=#d1d1d1><P class=knop><a href="ig.php" title="Данные о игре">ИГРЫ</a></P></td>
</tr>
<tr>


<table>
<tr>
<td colspan="5"><p class=zag2 >Все страны участницы</p>
	<?php
		include("connection.php");
		$connection = mysql_connect($host, $user, $password);
		mysql_select_db($database,$connection);
		mysql_query("SET character set utf8 "); 
		mysql_query("SET collation_connection=utf8_general_ci ");
		$result=mysql_query("SELECT StName \n"
			. "FROM  `state` \n");
		if (!$result) {
			die('Неверный запрос: ' . mysql_error());
		}
		if ($myrow = mysql_fetch_array($result)) {
			echo "<table border=1 align=center><tr>\n";
			do {
			printf("
			<td align=center class=text1>%s</td>\n", $myrow['StName']);
			} while ($myrow = mysql_fetch_array($result));
			echo "</tr></table>\n";
			} else {
				echo "Sorry, no records were found!";	
			}
			mysql_close($connection);
	?></td></tr>
	
		
	
<tr>
	<td><img src="img/brz.png" width=90% height=255px alt="lorem"></td>
<td><img src="img/fr.png" width=90% height=180px alt="lorem"></td>
<td><img src="img/gr.jpg" width=90%  height=160px alt="lorem"></td>
<td><img src="img/rss.png" width=90% height=160px alt="lorem"></td>
<td><img src="img/sh.png" width=90% height=160px alt="lorem"></td>
</td>
</tr>
</table>

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