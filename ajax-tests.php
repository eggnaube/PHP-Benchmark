<?php
    /*
	 * ajax-tests.php
	 * 
	 * This file runs the tests and returns the results in a table snippet.
	 * 
	 * @package PHP Benchmark Script
	 * 
	 */
    
    require_once 'php_benchmark.class.php';
	
	$benchmark = new PHP_Benchmark;
	$results = $benchmark->doTests(true);

	foreach ($results as $key => $value) {
		$json[($key - 1)] = $value;
	}

	$json = json_encode($json);
	
	echo $json;
?>