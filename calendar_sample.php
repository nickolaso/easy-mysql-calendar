<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?
//This is your Db connect file.  You need this for access	
require('htdocs/db_connect.php');
//Here are the months
$monthNames = Array("January", "February", "March", "April", "May", "June", "July", 
"August", "September", "October", "November", "December");
?>
<?php
if (!isset($_REQUEST["month"])) $_REQUEST["month"] = date("n");
if (!isset($_REQUEST["year"])) $_REQUEST["year"] = date("Y");
?>
<?php
$cMonth = $_REQUEST["month"];
$cYear = $_REQUEST["year"];
$prev_year = $cYear;
$next_year = $cYear;
$prev_month = $cMonth-1;
$next_month = $cMonth+1;
if ($prev_month == 0 ) {
	$prev_month = 12;
	$prev_year = $cYear - 1;
}
if ($next_month == 13 ) {
	$next_month = 1;
	$next_year = $cYear + 1;
}
$link_date="month=". $cMonth . "&year=" . $cYear."&";
?>
<div id="calendarDiv">
<table width="100%" height="200px">
<tr align="center">
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="50%" align="left">  <a class="Previous" href="<?php echo "calendar_sample.php" . "?month=". $prev_month . "&year=" . $prev_year; ?>" style=""><img src='images/previous.png'> Previous</a></td>
<td width="50%" align="right"><a class="Next" href="<?php echo "calendar_sample.php" . "?month=". $next_month . "&year=" . $next_year; ?>" style="">Next <img src='images/next.png'></a>  </td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center">
<table width="100%" border="0" cellpadding="2" cellspacing="2">
<tr align="center">
<td colspan="7"><h1 class="monthLabel"><center><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></center></h1></td>
</tr>
<tr>
<td align="center" class="dayLabel"><strong>S</strong></td>
<td align="center" class="dayLabel"><strong>M</strong></td>
<td align="center" class="dayLabel"><strong>T</strong></td>
<td align="center" class="dayLabel"><strong>W</strong></td>
<td align="center" class="dayLabel"><strong>T</strong></td>
<td align="center" class="dayLabel"><strong>F</strong></td>
<td align="center" class="dayLabel"><strong>S</strong></td>
</tr>
<?php 

$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
for ($i=0; $i<($maxday+$startday); $i++) {
	
	if(($i % 7) == 0 ) {
		echo "<tr>\n";
	}
	if($i < $startday) {echo "<td class='calendarTd'><div id='dayNum'></div></td>\n";}
	
	else {
		
		echo "<td class='calendarTd'><div id='dayNum'>". ($i - $startday + 1)."</div>";
		$number=($i - $startday + 1);
		if ($cMonth<10){$padMonth="0".$cMonth;}
		elseif ($cMonth>10){$padMonth=$cMonth;}
		if ($number<10){$padnumber="0".$number;}
		elseif ($number>10){$padnumber=$number;}
		$full_date = $cYear."-".$padMonth."-".$padnumber;
		$next_number=$number+1;
		$next_date=$cYear."-".$cMonth."-".$next_number;
		echo "<div id ='dateInfo' style='font-size:11px;'>";
		$full_date=mysqli_real_escape_string($full_date);//Use this if you are getting the date from somewhere shady.
	 	$q=$mysqli->query("SELECT * FROM event_table WHERE event_date = '$full_date'");
		while($r=$q->fetch_assoc()) {
			$event_id=$r['event_id'];
			$event_title=$r['event_title'];
			//You can use the event id above to code in a link if you want to make a page to view only that event.
			//This is also where you could set an image variable to
			echo $event_title."<br />";
		}
	
}
		
	
		
		
		echo "</div>";
		echo "</td>\n";
	}
	if(($i % 7) == 6 ) echo "</tr>\n";
}
?>
</table>
</td>
</tr>
</table>
</div><!--calendarDiv--!>
</body>
</html>
