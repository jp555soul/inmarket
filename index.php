<?php 
  include 'service/haversineDistance.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.css">
	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.4.0/jquery.mobile-1.4.0.min.js"></script>
</head>
<body>
	<?php
		$latFrom = 33.99026;	
		$lonFrom = -118.420375;

		if(isset($_POST['submit'])){ 
			if(!is_numeric($_POST['latitude']) || !is_numeric($_POST['longitude'])){
				echo "<b>Not a coordinate</b></br>";
			}else{
				$lat = $_POST['latitude'];
				$lon = $_POST['longitude'];

				// echo "User Has submitted the form and entered these coordinates:";
		  //   	echo "<br>Latitude: $lat"; 
		  //   	echo "<br>Longitude: $lon"; 

		    	$search = new Distance();
		    	$search->submitted();
			} 
		}

	?>

  <form id="location-search" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <span>Lat</span><input type="text" name="latitude" value="33.99026" />
	<span>Lon</span><input type="text" name="longitude" value="-118.420375"/>
    <input type="submit" name="submit" value="Retrieve closest city" />
  </form>
  <script>
  	$(function() {
  		$("input[name='latitude']").val(position.coords.latitude);
  		$("input[name='longitude']").val(position.coords.longitude);
  	});
</script>
</body>
</html>
