<html>
<head><title>View Watch Later List</title>
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
</style>
<script>
function refreshPage(){
location.reload();
}
</script>
</head>
<body>
<center>
<div class="header">
Android SQLite and MySQL Sync Results
</div>
</center>
<?php
    include_once 'db_functions.php';
    $db = new DB_Functions();
    $watch_later_events = $db->getAllWatchLaterEvents();
    if ($watch_later_events != false)
        $no_of_events = mysqli_num_rows($watch_later_events);
    else
        $no_of_events = 0;
?>
<?php
    if ($no_of_events > 0) {
        ?>
        <table>
        <tr id="header"><td>User Id</td><td>Event Id</td></tr>
        <?php
            while ($row = mysqli_fetch_array($watch_later_events)) {
        ?>
        <tr>
        <td><span><?php echo $row["user_id"] ?></span></td>
        <td><span><?php echo $row["event_id"] ?></span></td>
        </tr>
        <?php } ?>
        </table>
<?php }else{ ?>
<div id="norecord">
No records in MySQL DB
</div>
<?php } ?>
<div class="refresh">
<button onclick="refreshPage()">Refresh</button>
</div>
</body>
</html>
