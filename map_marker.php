<?php
	/* Database connection settings */
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db   = 'sila';
	$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

	// Select all the rows in the markers table
	$query = "SELECT * FROM `sma_driver` ";
	$result = $mysqli->query($query) or die('data selection for google map failed: ' . $mysqli->error);
 	while ($row = mysqli_fetch_array($result)) {
		$latitudes    []  = $row['latitude'];
		$longitudes   []  = $row['longitude'];
		$name         []  = $row['first_name'].' '.$row['last_name'];
		$id           []  = $row['id_card'];
		$phone        []  = $row['phone'];
		$active       []  = $row['driving'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Map | View</title>
	</head>
	<body>
    <div class="container">
		 <div class="row" id="map" style="width: 102.7%; height: 85vh; margin-top: -15px;"></div>
		<script>
			function initMap() {
				
			    var mapOptions = {
			    zoom: 13,
			    center: {<?php echo'lat:'. '11.559932370233096' .', lng:'. '104.92828520987392' ;?>}, //{lat: --- , lng: ....}
			    mapTypeId: google.maps.MapTypeId.SATELITE
			    };
			  var map = new google.maps.Map(document.getElementById('map'),mapOptions);
			  <?php 
			  $i=0;
			  foreach( $latitudes as  $latitudes1){
				if($latitudes1 != null){
				  ?>


			   <?php {
	         if($active[$i] != 1){
			   ?>
			  mark = 'img/red.png';
			  var active  = "<?php echo'Active  : '. 'BUSY';?>";

			  <?php 
			 }
              }?>
			   <?php {
	         if($active[$i] != 0){
			   ?>
			  mark = 'img/blue.png';
			  var active  = "<?php echo'Active  : '. 'FREE';?>";

			  <?php 
			 }
              }?>

			  var name   = "<?php echo'Name   : '. $name[$i];?>";
				var id     = "<?php echo'Id Card : '. $id[$i];?>";
				var phone  = "<?php echo'Phone  : '. $phone[$i];?>";
			  startPoint = {<?php echo 'lat:'. $latitudes1 .', lng:'. $longitudes[$i++];?>};
			
			  var marker = new google.maps.Marker({
			  position: startPoint,
			   map: map,
			   icon: mark,
			   title: name + "\n" + id + "\n" + phone+ "\n" + active,
			   animation: google.maps.Animation.DROP
			});
            <?php }} ?>

			}
    	</script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=xxxxxxxxxxxx&callback=initMap"></script>
    </div>
	</body>
</html>
