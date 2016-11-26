<?php
/**
 * returns number of rows in our database
 */
header('Content-Type: application/json');
    include_once 'db_functions.php';
    $db = new DB_Functions();
    //Get JSON posted by Android Application
    $json = $_POST["GetCountJSON"];
    //Remove Slashes
    if (get_magic_quotes_gpc()){
    $json = stripslashes($json);
    }
    //Decode JSON into an Array
    $data = json_decode($json);

    $retrieved_id = $data->event_id;
    $people_attending = $db->getAllGoing($retrieved_id);

    $b = array();
    $b["event_id"] = $retrieved_id;
    if ($people_attending != false){
        $number_going = mysqli_num_rows($people_attending);
    }
    else{
        $number_going = 0;
    }
    $b["number_going"] = $number_going;
    echo json_encode($b);
?>
