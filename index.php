<?php
  //retrieve data from database...
require("opendb.php");
global $conn;

$query = "SELECT name,cop,rating,lng,lat,type FROM skatespot";
$result = $conn->query($query);
$locationInfo = array();
if ($result->num_rows > 0)
{
  while($row = $result->fetch_assoc())
  {
    array_push($locationInfo, $row);
  }
}
else
{
  echo("0 results from database");
}

?>

<!DOCTYPE html>
<head>
    <!-- <meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> -->
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="shortcut icon" type="image/png" href="images/wheel.png"/>

    <title>Skate Spots</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>



    <div id="map"></div>
    <div id="form" >
    <form id="theForm" action="data.php" method="post">
    <table>
        <tr><td>Name:</td> <td><input type='text' name = "name" id='name'/> </td> </tr>
      <tr><td>Cops:</td> <td><select name = "cop" id='cop'>
      <option value='Spots in the clear. No cops!' SELECTED>No Cops or Security</option>
      <option value='Occasional cops, keep an eye out!' >Occasional Cops</option>
      <option value='Watch out for the security here!' >Private Security</option>
      <option value='This spot has a lot of enforcement!' >Plenty of Cops</option>
      <option value='The cops are all over this spot!' >Cops Everywhere</option>
    </select></td></tr>
    <tr><td>Rating:</td> <td><select name = "rating" id='rating'>
    <option value='1 Star' SELECTED>1 Star</option>
    <option value='2 Stars' >2 Stars</option>
    <option value='3 Stars' >3 Stars</option>
    <option value='4 Stars' >4 Stars</option>
    <option value='5 Stars' >5 Stars</option>
  </select></td></tr>
        <tr><td>Type:</td> <td><select name = "type" id='type'>
        <option value='Rail' SELECTED>Rail</option>
        <option value='Ledge'>Ledge</option>
        <option value='Ramp' >Ramp</option>
        <option value='Stairs'>Stairs</option>
        <option value='Hill'>Hill</option>
        <option value='Bank'>Bank</option>
        <option value='Line'>Line</option>
        <option value='Park'>Park</option>
        <option value='Lot'>Lot</option>
        </select> </td></tr>
        <tr><td>Upload (placeholder)</td> <td><input type='text' id='upload'/> </td> </tr>
        <div id="feedbackMessage"></div>
        <tr><td></td><td><input type='submit' id="theSubmitButton" name = "submit" value='Save'/></td></tr>
    </table>
  </form>
  </div>




	<div id='info'>
    <img id="logo" src="images/logo/logoV2.png" alt="Skate Spots">


		<h1 id= 'info-name'> Welcome to Skate Spots!</h1><br><br>
		<h2 id= 'info-cop'> Click anywhere to drop a pin, or click on a pin to find out more!</h2><br><br>
    <h2 id= 'info-rating'> </h2><br><br>
    <h2 id= 'info-type'> </h2>
    <img id="image" src="http://placehold.it/250x250" alt="placeholder"  height="250" width="250">
  </div>

    <script>
      var locationsInfo = <?php echo(json_encode($locationInfo))?>;
    </script>
    <script type='text/javascript' src='js/javascript.js'>
    </script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB87_4rBxFWAxJQT-NQDAYyf-GJeA3ur7M&callback=initMap">
    </script>
    <script>

      $("#theForm").on("submit",function(event)
      {
        event.preventDefault();
        var name = $("#name").val();
        var cop = $("#cop").val();
        var rating = $("#rating").val();
        var type = $("#type").val();
        var lat = userSelectedMarker.getPosition().lat();
        var long = userSelectedMarker.getPosition().lng();
		var pic = $("#pic").val();
        var dataToSend = {};
        $.ajax
        ({
            type: "POST",
            url:"data.php",
            dataType:"text",
            data: {"name":name, "cop":cop, "rating":rating, "type":type,"lat":lat,"long":long,"pic":pic},
            success:function(feedback)
            {
              $("#feedbackMessage").html(feedback);
              location.reload();
            }
        });
      });
    </script>
  </body>
</html>
