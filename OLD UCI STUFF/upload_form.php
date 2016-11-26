<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Upload CSV</title>
</head>
<style>
    body {
    font: normal medium/1.4 sans-serif;
    }
    form{
    width: 50%;
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

<body>
    <form enctype="multipart/form-data" action="uploader.php" method="POST">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        Choose a file to upload: <input name="uploadedfile" type="file" />
        <br><input type="checkbox" id="translation_check" name="latlng" value="yes">
        <label for="translation_check">I need a UCI Lat/Lng translation.</label> </br>
        <input type="submit" value="Process File" />
    </form>
</body>

<?php
$return_arr = array ( //$return_arr[$return_id]
    1 => "File Successfully Processed",
    -1 => "File failed to process. Please check the format.",
    -2 => "Unable to perform LatLng conversion",
    2 => "LatLng Converted and Processed. You may view your processed csv in file myUCIFiles."
);

$return_id = isset($_GET['return_id']) ? (int)$_GET['return_id'] : 0;
if ($return_id != 0 && array_key_exists($return_id, $return_arr)) {?>
    <div id="msg"><?php echo $return_arr[$return_id]; ?></div>
<?php }
?>
</html>
