<?php
/**
 * Displays User information
 */
?>
<html>
<head><title>View Users</title>
<style>
    body {
      font: normal medium/1.4 sans-serif;
    }
    table {
      border-collapse: collapse;
      width: 20%;
      margin-left: auto;
      margin-right: auto;
    }
    tr > td {
      padding: 0.25rem;
      text-align: center;
      border: 1px solid #ccc;
    }
    tr:nth-child(even) {
      background: #FAE1EE;
    }
    tr:nth-child(odd) {
      background: #edd3ff;
    }
    tr#header{
    background: #c1e2ff;
    }
    td#sync{
    background: #fff;
    }
    div.header{
    padding: 10px;
    background: #e0ffc1;
    width:30%;
    color: #008000;
    margin:5px;
    }
    div.refresh{
    margin-top:10px;
    width: 5%;
    margin-left: auto;
    margin-right: auto;
    }
    div#norecord{
    margin-top:10px;
    width: 15%;
    margin-left: auto;
    margin-right: auto;
    }
    img{
    height: 32px;
    width: 32px;
    }
</style>
    <script>
        var val= setInterval(function(){
        location.reload();
        },2000);
    </script>
</head>
<body>
<center>
    <div class="header">
    Android SQLite and MySQL Sync - View Events
    </div>
</center>
<?php
    include_once 'db_functions.php';
    $db = new DB_Functions();
    $events = $db->getAllEvents();
    if ($events != false){
        $no_of_events = mysqli_num_rows($events);
    }
    else{
        $no_of_events = 0;
    }

?>
<?php
    if ($no_of_events > 0) {
?>
<table>
    <tr id="header"><td>Id</td><td>Event Title</td><td>Hoster</td><td>Start Time</td>
    <td>End Time</td><td>Latitude</td><td>Longitude</td><td>Location</td><td>
    Description</td><td>Link</td><td>Image Link</td><td>Source Type</td><td>Source Subtype</td><td>Last Updated</td></tr>
    <?php
        while ($row = mysqli_fetch_array($events)) {
    ?>
    <tr>
    <td><span><?php echo $row["event_id"] ?></span></td>
    <td><span><?php echo $row["title"] ?></span></td>
    <td><span><?php echo $row["hoster"] ?></span></td>
    <td><span><?php echo $row["start_time"] ?></span></td>
    <td><span><?php echo $row["end_time"] ?></span></td>
    <td><span><?php echo $row["lat"] ?></span></td>
    <td><span><?php echo $row["lon"] ?></span></td>
    <td><span><?php echo $row["location"] ?></span></td>
    <td><span><?php echo $row["description"] ?></span></td>
    <td><span><?php echo $row["link"] ?></span></td>
    <td><span><?php echo $row["image_link"] ?></span></td>
    <td><span><?php echo $row["source_type"] ?></span></td>
    <td><span><?php echo $row["source_subtype"] ?></span></td>
	<td><span><?php echo $row["last_updated"] ?></span></td>
    </tr>
    <?php } ?>
</table>
<?php }else{ ?>
<div id="norecord">
No records in MySQL DB
</div>
<?php } ?>
</body>
</html>
