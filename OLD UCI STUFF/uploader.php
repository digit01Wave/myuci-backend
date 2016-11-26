<?php
//information from http://programmingtictac.blogspot.com/2012/10/import-csv-file-to-server-and-upload.html
require_once 'constants.php';
$mimes = array('application/vnd.ms-excel','text/csv','text/tsv');
//makes sure the user actually uploaded something
if(!empty($_FILES['uploadedfile']['tmp_name'])) {
    //makes sure is of type csv
    if(in_array($_FILES['uploadedfile']['type'],$mimes)){
        $target_path = $_FILES['uploadedfile']['tmp_name'];
        include_once './db_functions.php';
        $db = new DB_Functions();

        $latLng_converted = false;
        //if need latlng then should upload file instead and use that path
        if($_POST['latlng'] == "yes"){
            // Where the file is going to be placed
            $upload_path = BITNAMI_PATH."htdocs/myuci/myUCIFiles/" . basename( $_FILES['uploadedfile']['name']);
            $target_path = $upload_path."_latLng(1).csv";
            $file_index = 2;
            //changes name if there is a duplicate
            while(file_exists($target_path)) {
                $target_path = substr($target_path, 0, -6).$file_index.").csv";
                $file_index++;
            }
            //add new file to temporary place
            if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $upload_path)){
                //do actual conversion
                $output;
                $err;
                exec("java -jar ".BITNAMI_PATH."myFiles/uciLatLng.jar $upload_path $target_path 4 5 6", $output, $err);
                if($err != 0){
                    header('Location: http://'.IP.'/myuci/upload_form.php?return_id=-2');
                    exit;
                }
                $latLng_converted = true;
                unlink($upload_path);
            } else{
                header('Location: http://'.IP.'/myuci/upload_form.php?return_id=-2');
                exit;
            }
        }
        //read the CSV file to Stream
        $row = 1;
        if (($handle = fopen("$target_path", "r")) !== FALSE) {
            $data = fgetcsv($handle, 1000, ","); //ignore initial header file
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $row++;
                $title=$data[0];
                $hoster=$data[1];
                $start_time=$data[2];
                $end_time=$data[3];
                $lat=$data[4];
                $lng=$data[5];
                $location=$data[6];
                $description=$data[7];
                $link=$data[8];
                $image_link=$data[9];
                $source_type=$data[10];
                $source_subtype=$data[11];
                $res = $db->storeEvent($title, $hoster, $start_time, $end_time, $lat,
               $lng, $location, $description, $link, $image_link, $source_type, $source_subtype);
                if($res){
                    echo "Succcess with ".$data[0].PHP_EOL;
                }else{
                    echo "Failed to do ".$data[0].PHP_EOL;
                }
            }
            fclose($handle);
        }
        if($latLng_converted){
            header('Location: http://'.IP.'/myuci/upload_form.php?return_id=2');
            exit;
        }
        header('Location: http://'.IP.'/myuci/upload_form.php?return_id=1');
        exit;
    }else{
        header('Location: http://'.IP.'/myuci/upload_form.php?return_id=-1');
        exit;
    }
}else{
    header('Location: http://'.IP.'/myuci/upload_form.php');
    exit;
}
