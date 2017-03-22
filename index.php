<?php
  //retrieve data from database...
require("opendb.php");
global $conn;

$query = "SELECT name,rating,lng,lat,type FROM skatespot";
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

<!DOCTYPE html >
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Skate Spots</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>

    <div id="logo"> <img src="images/logo/logoV1.png" alt="Skate Spots"  width="275"></div>

    <div id="map"></div>
    <div id="form" >
    <form id="theForm" action="data.php" method="post">
    <table>
        <tr><td>Name:</td> <td><input type='text' name = "name" id='name'/> </td> </tr>
        <tr><td>Rating:</td> <td><select name = "rating" id='rating'>
        <option value='1' SELECTED>1</option>
        <option value='2' SELECTED>2</option>
        <option value='3' SELECTED>3</option>
        <option value='4' SELECTED>4</option>
        <option value='5' SELECTED>5</option>
      </select></td></tr>
        <tr><td>Type:</td> <td><select name = "type" id='type'>
        <option value='rail' SELECTED>Rail</option>
        <option value='ledge'>Ledge</option>
        <option value='ramp' SELECTED>Ramp</option>
        <option value='stairs'>Stairs</option>
        <option value='bank'>Bank</option>
        <option value='line'>Line</option>
        <option value='park'>Park</option>
        <option value='lot'>Lot</option>
        </select> </td></tr>
        <tr><td>Upload (placeholder)</td> <td><input type='text' id='upload'/> </td> </tr>
        <div id="feedbackMessage"></div>
        <tr><td></td><td><input type='submit' id="theSubmitButton" name = "submit" value='Save'/></td></tr>
    </table>
  </form>
  </div>




	<div id='info'>
		<h1 id='info-name'> SAMPLE NAME (Stood) </h1>
		<h2 id= 'info-rating'> 0/5 Stars </h2>
		<h2 id='info-type'>Sample Type (Ledge) </h2>
    <br>
    <img id="image" src="images/test.png" alt="placeholder"  height="250" width="250">
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
        var rating = $("#rating").val();
        var type = $("#type").val();
        var lat = userSelectedMarker.getPosition().lat();
        var long = userSelectedMarker.getPosition().lng();
        var dataToSend = {};
        $.ajax
        ({
            type: "POST",
            url:"data.php",
            dataType:"text",
            data: {"name":name, "rating":rating,"type":type,"lat":lat,"long":long},
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
