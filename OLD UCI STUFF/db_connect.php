<?php

class DB_Connect {

    // constructor
    function __construct() {

    }

    // destructor
    function __destruct() {
        //$this->close();
    }

    // Connecting to database
    public function connect() {
        require_once 'config.php';
        // connecting to mysql
        $con = new mysqli(DB_HOST,  DB_USER, DB_PASSWORD, DB_DATABASE);

        /*
         * This is the "official" OO way to do it,
         * BUT $connect_error was broken until PHP 5.2.9 and 5.3.0.
         */
        if ($con->connect_error) {
            die('Connect Error (' . $con->connect_errno . ') '
                    . $con->connect_error);
        }
        /*

                $con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
                // selecting database
                mysql_select_db(DB_DATABASE);*/
        // return database handler
        return $con;
    }

    // Closing database connection
    public function close() {
        mysqli_close();
    }

}
?>
