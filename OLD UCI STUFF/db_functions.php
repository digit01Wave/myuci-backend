<?php
/**
 * DB operations functions
 */
class DB_Functions {

    private $db;
    private $con;

    //put extra code here

    // constructor
    function __construct() {
        include_once './db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->con = $this->db->connect();
    }

    // destructor
    function __destruct() {
        $this->con->close();
    }
    /*
################################################################################
uci_events methods
################################################################################
    */

    /**
     * Storing new event
     * returns event details
     */
    public function storeEvent($title, $hoster, $start_time, $end_time,
    $lat, $lon, $location, $description, $link, $image_link, $source_type, $source_subtype) {
        if($end_time == ''){
            $result = $this->con->query("INSERT INTO uci_events VALUES(
                null, \"$title\", \"$hoster\", '$start_time', null, \"$lat\",
                \"$lon\", \"$location\", \"$description\", \"$link\", \"$image_link\",
                \"$source_type\", \"$source_subtype\",null
            ) ON DUPLICATE KEY UPDATE hoster=VALUES(hoster), end_time=VALUES(end_time), lat=VALUES(lat), lon=VALUES(lon), description=VALUES(description), link=VALUES(link), image_link=VALUES(image_link), last_updated=NOW()");
        }
        else{
            $result = $this->con->query("INSERT INTO uci_events VALUES(
                null, \"$title\", \"$hoster\", '$start_time', '$end_time', \"$lat\",
                \"$lon\", \"$location\", \"$description\", \"$link\", \"$image_link\",
                \"$source_type\", \"$source_subtype\",null
            ) ON DUPLICATE KEY UPDATE hoster=VALUES(hoster), end_time=VALUES(end_time), lat=VALUES(lat), lon=VALUES(lon), description=VALUES(description), link=VALUES(link), image_link=VALUES(image_link), last_updated=NOW()");
        }


        if ($result) {
            return true;
        } else {
                // For other errors
                return false;
        }
    }

    /**
     * Storing new event
     * returns event details
     */
    public function updateEventLatLon($event_id, $lat, $lon) {
        // Insert user into database
        $result = $this->con->query("UPDATE uci_events SET lat = $lat, lon = $lon WHERE event_id = $event_id");

        if ($result) {
            return true;
        } else {
                // For other errors
                return false;
        }
    }

     /**
     * Getting all events
     */
    public function getAllEvents() {
        $result = $this->con->query("SELECT * FROM uci_events");
        return $result;
    }
    /*

    /**
    * Getting all new events (events that have been updated recently and happenen later)
    */
   public function getAllNewEvents($last_update) {
       $result = $this->con->query("SELECT * FROM uci_events WHERE (unix_timestamp(last_updated) > $last_update) AND ( (unix_timestamp(start_time) > unix_timestamp(NOW())) OR (end_time != null AND unix_timestamp(end_time) > unix_timestamp(now())) )");
       return $result;
   }
   /*


   /**
   * Getting all those going to a particular event
   */
  public function getAllGoing($event_id) {
      $result = $this->con->query("SELECT * FROM calendar_events WHERE event_id = $event_id");
      return $result;
  }
   /*
################################################################################
WATCH LATER
################################################################################

    */

    /**
    * Store Watch Later Event
    */
    public function storeWatchLaterEvent($user_id, $event_id) {
        // Insert item into database
        $result = $this->con->query("INSERT INTO watch_later_events VALUES(
            '$user_id', $event_id
        )");

        if ($result) {
            return true;
        } else {
            if( $this->con->errno == 1062) {
                // Duplicate key - Primary Key Violation
                return true;
            } else {
                // For other errors
                return false;
            }
        }
    }

    /**
    * Delete Watch Later Event
    */
    public function deleteWatchLaterEvent($user_id, $event_id){
        // delete item from database
        $result = $this->con->query("DELETE FROM watch_later_events
            WHERE user_id = '$user_id' AND event_id = $event_id");
        if($result){
            return true;
        }else{
            // some error
            return false;
        }
    }
     /**
     * Getting all watch later events
     */
    public function getAllWatchLaterEvents() {
        $result = $this->con->query("SELECT * FROM watch_later_events");
        return $result;
    }

    /*
################################################################################
Calendar Methods
################################################################################
    */

    /**
    * Getting all calendar events
    */
   public function getAllCalendarEvents() {
       $result = $this->con->query("SELECT * FROM calendar_events");
       return $result;
   }

   /**
   * Store Calendar Event
   */
   public function storeCalendarEvent($user_id, $event_id) {
       // Insert item into database
       $result = $this->con->query("INSERT INTO calendar_events VALUES(
           '$user_id', $event_id
       )");

       if ($result) {
           return true;
       } else {
           if( $this->con->errno == 1062) {
               // Duplicate key - Primary Key Violation
               return true;
           } else {
               // For other errors
               return false;
           }
       }
   }

   /**
   * Delete Calendar Event
   */
   public function deleteCalendarEvent($user_id, $event_id){
       // delete item from database
       $result = $this->con->query("DELETE FROM calendar_events
           WHERE user_id = '$user_id' AND event_id = $event_id");
       if($result){
           return true;
       }else{
           // some error
           return false;
       }
   }


}

?>
