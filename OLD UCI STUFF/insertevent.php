<?php
/**
 * Insert Event into DB
 */ ?>
<style>
    body {
    font: normal medium/1.4 sans-serif;
    }
    div.header{
    padding: 10px;
    background: #e0ffc1;
    width:30%;
    color: #008000;
    margin:5px;
    }
    table {
    border-collapse: collapse;
    width: 25%;
    margin-left: auto;
    margin-right: auto;
    }
    form{
    width: 30%;
    margin-left: auto;
    margin-right: auto;
    padding: 10px;
    border: 2px solid #edd3ff;
    }
    div#msg{
    margin-top:10px;
    width: 30%;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    }
</style>
<center>
    <div class="header">
        Android SQLite and MySQL Sync - Add Events
    </div>
</center>
<form method="POST">
    <table>
        <tr>
            <td>Event Title:</td><td><input name="title" /></td>
        </tr>
        <tr>
            <td>Hoster:</td><td><input name="hoster" /></td>
        </tr>
        <tr>
            <td>Start Time (YYYY-MM-DD HH:MM:SS):</td><td><input name="start_time" /></td>
        </tr>
        <tr>
            <td>End Time (YYYY-MM-DD HH:MM:SS):</td><td><input name="end_time" /></td>
        </tr>
        <tr>
            <td>Latitude:</td><td><input name="lat"/></td>
        </tr>
        <tr>
            <td>Longitude:</td><td><input name="lon"/></td>
        </tr>
        <tr>
            <td>Location:</td><td><input name="location" /></td>
        </tr>
        <tr>
            <td>Description:</td><td><input name="description" /></td>
        </tr>
        <tr>
            <td>Link:</td><td><input name="link" /></td>
        </tr>
        <tr>
            <td>Image Link:</td><td><input name="image_link" /></td>
        </tr>
        <tr>
            <td>Source Type:</td><td><input name="source_type" /></td>
        </tr>
        <tr>
            <td>Source Subtype:</td><td><input name="source_subtype" /></td>
        </tr>

        <tr><td colspan="2" align="center"><input type="submit" value="Add Event"/></td></tr>
    </table>
</form>
<?php
    include_once './db_functions.php';
    //Create Object for DB_Functions class
    //need at least title, start_time, and location
    if(isset($_POST["title"]) && !empty($_POST["title"])
    && (isset($_POST["start_time"]) && !empty($_POST["start_time"]))
    && isset($_POST["location"]) && !empty($_POST["location"])){
        $db = new DB_Functions();
        //Store User into MySQL DB
        $title = $_POST["title"];
        $hoster = $_POST["hoster"];
        $start_time = $_POST["start_time"];
        $end_time = $_POST["end_time"];
        $lat = $_POST["lat"];
        $lon = $_POST["lon"];
        $location = $_POST["location"];
        $description = $_POST["description"];
        $link = $_POST["link"];
        $image_link = $_POST["image_link"];
        $source_type = $_POST["source_type"];
        $source_subtype = $_POST["source_subtype"];
        $res = $db->storeEvent($title, $hoster, $start_time, $end_time, $lat,
        $lon, $location, $description, $link, $image_link, $source_type, $source_subtype);
        //Based on inserttion, create JSON response
        if($res){ ?>
            <div id="msg">Insertion successful</div>
        <?php }else{ ?>
                <div id="msg">Insertion failed</div>

        <?php }
    } else{ ?>
        <div id="msg">Please enter event details and submit</div>
    <?php }
?>
