<?php
include_once './db_functions.php';
//Create Object for DB_Functions clas
$db = new DB_Functions();
//Get JSON posted by Android Application
$json = $_POST["UpdateEventsJSON"];
//Remove Slashes
if (get_magic_quotes_gpc()){
$json = stripslashes($json);
}
//Decode JSON into an Array
$data = json_decode($json);
//Util arrays to create response JSON
$a=array();
$b=array();
//Loop through an Array and insert data read from JSON into MySQL DB
for($i=0; $i<count($data) ; $i++)
{
    if($data[$i]->update_action == "add"){
        //Store User into MySQL DB
        $res = $db->storeWatchLaterEvent($data[$i]->user_id,$data[$i]->event_id);

        //Based on inserttion, create JSON response
        $b["user_id"] = $data[$i]->user_id;
        $b["event_id"] = $data[$i]->event_id;
        $b["update_action"] = $data[$i]->update_action;
        if($res){
            $b["update_status"] = 'yes';
            array_push($a,$b);
        }else{
            $b["update_status"] = 'no';
            array_push($a,$b);
        }
    }
    elseif ($data[$i]->update_action == "delete"){
        //Store User into MySQL DB
        $res = $db->deleteWatchLaterEvent($data[$i]->user_id,$data[$i]->event_id);
        //Based on inserttion, create JSON response
        $b["user_id"] = $data[$i]->user_id;
        $b["event_id"] = $data[$i]->event_id;
        $b["update_action"] = $data[$i]->update_action;
        if($res){
            $b["update_status"] = 'yes';
            array_push($a,$b);
        }else{
            $b["update_status"] = 'no';
            array_push($a,$b);
        }
    }
}

//Post JSON response back to Android Application
echo json_encode($a);
?>
