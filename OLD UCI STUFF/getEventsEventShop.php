<?php
/**
 * Creates rows data as JSON
 */
header('Content-Type: application/json');
    include_once 'db_functions.php';
    $db = new DB_Functions();
    $events = $db->getAllEvents();
    $a = array();
    $b = array();
    $c = array();
    if ($events != false){
        while ($row = mysqli_fetch_array($events)) {
            $b["event_id"] = $row["event_id"];
            $b["title"] = $row["title"];
            $b["hoster"] = $row["hoster"];
            $b["start_time"] = $row["start_time"];
            $b["end_time"] = $row["end_time"];
            $b["lat"] = $row["lat"];
            $b["lon"] = $row["lon"];
            $b["location"] = $row["location"];
            $b["description"] = $row["description"];
            $b["link"] = $row["link"];
            $b["image_link"] = $row["image_link"];
            $b["source_type"] = $row["source_type"];
            $b["source_subtype"] = $row["source_subtype"];
            array_push($a,$b);
        }
        $c["list"] = $a;
        echo json_encode($c);
    }
?>
