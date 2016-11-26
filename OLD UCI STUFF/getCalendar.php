<?php
/**
 * Creates rows data as JSON
 */
header('Content-Type: application/json');
    include_once 'db_functions.php';
    $db = new DB_Functions();
    $items = $db->getAllCalendarEvents();
    $a = array();
    $b = array();
    if ($items != false){
        while ($row = mysqli_fetch_array($items)) {
            $b["user_id"] = $row["user_id"];
            $b["event_id"] = $row["event_id"];
            array_push($a,$b);
        }
        echo json_encode($a);
    }
?>
