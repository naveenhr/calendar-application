<?php 
	include('functions.php');
	$year = date('Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Calender</title>
	<!-- google font -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Merriweather&family=Roboto&display=swap" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,700&family=Open+Sans:wght@600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<style>
		body{font-family: 'Merriweather', serif; font-family: 'Roboto', sans-serif;}
	</style>
	 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">	
</head>
<body>
<center> <h1 style="color:red; font-size:8em; padding:0px;"><?php echo $year;?></h1> </center>
<div class="" style="display:flex; margin:5px;">
	<div class="row">
		<?php
			$flag = 1;
			for($i=1; $i<=12;$i++)
			{
				echo "<div class='col-sm-8 col-md-6 col-lg-4 col-xl-3'>";
				echo "<center><h2 style='color:red;'>".date('F',mktime(0,0,0,$i,1,$year))."</h2></center>";
				echo draw_calendar($i,$year,$flag);
				echo "</div>";
			}
			
		?>
	</div>
</div>
</body>
</html>
