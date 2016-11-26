Code Source: http://programmerguru.com/android-tutorial/how-to-sync-remote-mysql-db-to-sqlite-on-android/

OUTLINE:
-config.php: config variables like DB host, DB username, DB pw, etc
-db_connect.php: has methods to open or close connection to MySql DB
-db_functions.php: has methods to perform DB operations that are specific to Android application
-getevents.php: gets events from MySqlDb
-insertevents.php: add event to MySql DB
-viewusers.php: creates unsynced MySwl db rows count as JSON. JSON is consumed in Android App to check if new row is added or now
-updatesyncsts.php: update Sync status of Users in MySql DB
