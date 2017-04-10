<?php 
  include 'service/pythagoreanDistance.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="InMarket PHP Location finder">
    <meta name="author" content="@jmpaul">
    <title>InMarket PHP Location finder</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/thumbnail-gallery.css" rel="stylesheet">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css">
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
	<script>
		$(function() {
			$("input[name='latitude']").val(position.coords.latitude);
	  		$("input[name='longitude']").val(position.coords.longitude);
	  	});
	</script>
</head>
<body>
    <div class="container">
    	<div class="logo"><img class="center-block" src="images/inmarket-logo.png" /></div>
    	<div class="row">
			<form id="location-search" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<span>Latitude:</span><input type="text" name="latitude" value="33.99026" />
				<span>Longitude:</span><input type="text" name="longitude" value="-118.420375"/>
				<input type="submit" name="submit" value="Retrieve closest city" />
			</form>
			<?php
				$latFrom = 33.99026;	
				$lonFrom = -118.420375;

				if(isset($_POST['submit'])){ 
					if(!is_numeric($_POST['latitude']) || !is_numeric($_POST['longitude'])){
						echo "<b>Not a coordinate</b></br>";
					}else{
						$lat = $_POST['latitude'];
						$lon = $_POST['longitude'];

						echo "You submitted these coordinates:";
				    	echo "<br>Latitude: $lat"; 
				    	echo "<br>Longitude: $lon"; 

				    	$search = new Distance();
				    	$search->submitted();
					} 
				}

			?>
		</div>
		<footer></footer>
	</div>
</body>
</html>

