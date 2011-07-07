<?php
    /*
	 * ajax-tests.php
	 * 
	 * @package PHP Benchmark Script
	 * 
	 */
    
    require_once 'libs/php_server_benchmark.class.php';
	
	$benchmark = new PHP_Server_Benchmark;
	$results = $benchmark->doTests(true);


	/*
	 * Save results in CSV
	 */
	if($_GET['saveAs'] == 'csv')
	{
		$csv = fopen('results.csv', 'a');
		
		// add timestamp if activated
		if($_GET['csv-timestamp'] == true) {
			fwrite($csv, time());
			fwrite($csv, $_GET['csv-seperator']);
		}
		
		fwrite($csv, implode($_GET['csv-seperator'],$results));
		fwrite($csv, "\r\n");
		fclose($csv);
	}


	foreach ($results as $key => $value) {
		$json[($key - 1)] = $value;
	}

	$json = json_encode($json);
	
	echo $json;
?>