<?php
print_r("Crawl Completed: ");
$JAR = 'C:\\Bitnami\\wampstack-5.5.31-0\\apache2\\myFiles\\crawler.jar';
$FILE = 'C:\\Bitnami\\wampstack-5.5.31-0\\apache2\\myFiles\\events.csv';
$CMD = 'java';
$full = $CMD.' -jar '.$JAR.' '.$FILE.' 2>&1';
// exec($full, $output);

$JAR2 = 'C:\\Bitnami\\wampstack-5.5.31-0\\apache2\\myFiles\\latLng.jar';
$FileOuput = 'C:\\Bitnami\\wampstack-5.5.31-0\\apache2\\myFiles\\events_updated.csv';
$CMD2 = 'java';
$full2 = $CMD2.' -jar '.$JAR2.' '.$FILE.' '.$FileOuput.' 2>&1';
exec($full2, $output2);
var_dump($full2, "SECOND", $output2)

?>
