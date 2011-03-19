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
?>
	<th scope="row"><?php if (isset($_POST['num'])) { echo(htmlspecialchars($_POST['num'])); } ?></th>
	<td><?php echo(round($results[1])); ?> ms</td>
	<td><?php echo(round($results[2])); ?> ms</td>
	<td><?php echo(round($results[3])); ?> ms</td>
	<td><?php echo(round($results[4])); ?> ms</td>
	<td><?php echo(round($results[5])); ?> ms</td>
	<td><?php echo(round($results[6])); ?> ms</td>
	<td><?php echo(round($results[7])); ?> ms</td>
