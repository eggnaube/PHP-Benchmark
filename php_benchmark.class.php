<?php
    /*
	 * PHP Benchmark Class
	 * 
	 * This class provides the core benchmarking functions for the PHP Benchmark Script.
	 * Run the doTests() method and this will execute some tests  to check your PHP server performance.
	 * Its easy, so use it in other apps!
	 * 
	 * @author Philipp Schroer
	 * 
	 * @package PHP Benchmark Script
	 * 
	 * @license GPL
	 * 
	 */ 
	 class PHP_Benchmark {
	 	
				
		/*
		 * Main function to run the tests
		 */
		public function doTests($ms = false) {
			$results = array();
			
			$results[1] = $this->test1();
			$results[2] = $this->test2();
			$results[3] = $this->test3();
			$results[4] = $this->test4();
			$results[5] = $this->test5();
			$results[6] = $this->test6();
			$results[7] = $this->test7();
			
			// if output should be in miliseconds instead of seconds multiply all values with 1000
			if ($ms == true) {
				foreach ($results as $key => $value) {
					$results[$key] = ($value * 1000);
				}
			}
			
			return $results;
		}
		
		/* 
		 * -----------------
		 *  BEGIN OF TESTS
		 * -----------------
		 */
		
		
		
		/*
		 * TEST 1 - STRINGS AND CALCULATING
		 * 
		 * This test uses several string functions an a string and calculates a little bit.
		 */
		public function test1() {
			/* start the clock */	
			$starttime = microtime(true);
			
			$string1= 'abcdefghij';
			for($i = 1; $i <= 30000; $i++) {
	       		$x=$i * 5;
	       		$x=$x + $x;
	       		$x=$x/10;
	       		$string3 = $string1 . strrev($string1);
	       		$string2 = substr($string1, 9, 1) . substr($string1, 0, 9);
	       		$string1 = strtoupper($string2);
			}
			
			/* stop the clock! */
			$endtime = microtime(true);
			
			$total_time = ($endtime - $starttime);
			return $total_time;
		}
		
		
		
		/*
		 * TEST 2 - ENCRYPTION AND HASHING
		 * 
		 * This test uses several encryptions and hashes on a string.
		 */
		 public function test2() {
		 	/* start the clock */	
			$starttime = microtime(true);	
			
		 	$string = "This is a test string to see how fast your web server can process PHP functions";
			for($i=0; $i < 150; $i++) {
	       		$md5 = md5($string);
	       		$sha1 = sha1($md5);
	       		$crc32 = crc32($sha1);
	       		$cryptDate = crypt($crc32);
			}
			
			/* stop the clock! */
			$endtime = microtime(true);
			
			$total_time = ($endtime - $starttime);
			return $total_time;
		 }
		
		
		
		/*
		 * TEST 3 - DATE FUNCTIONS
		 * 
		 * This tests handles with date functions and date calculations.
		 */
		public function test3() {
			/* start the clock */	
			$starttime = microtime(true);	
				
			for($i=0; $i < 1000; $i++) {
	       		$string3 = date("D M d Y"). ', News Years Day : ' .date("M-d-Y", mktime(0, 0, 0, 1, 1, 1998));
	       		$secNextWeek = time() + (7 * 24 * 60 * 60);
	       		date('Y-m-d', $secNextWeek);
			}
			
			/* stop the clock! */
			$endtime = microtime(true);
			
			$total_time = ($endtime - $starttime);
			return $total_time;
		}
		
		
		
		/*
		 * TEST 4 - IMAGE MANIPULATION
		 * 
		 * This tests manipulates images to measure the speed of GD.
		 */
		public function test4() {
			/* start the clock */	
			$starttime = microtime(true);
			
			for($i=0; $i < 1000; $i++) {
	       		$im = @imagecreatetruecolor(200, 200) or die("Cannot Initialize new GD image stream");
	       		$text_color = imagecolorallocate($im, 233, 14, 91);
	       		imagestring($im, 1, 5, 5,  "A Simple Text String", $text_color);
	       		imagedestroy($im);
	       		unset($im);
			}
			
			/* stop the clock! */
			$endtime = microtime(true);
			
			$total_time = ($endtime - $starttime);
			return $total_time;
		}
		
		
		
		/*
		 * TEST 5 - ARRAY MANAGMENT
		 * 
		 * This test gets system variables in $_SERVER and uses shuffle() and arsort() on them 1000 times.
		 */
		public function test5() {
			/* start the clock */	
			$starttime = microtime(true);
			
			for($i=0; $i < 1700; $i++) {
	       		$array = $_SERVER;
	       		shuffle($array);
	
	       		arsort($array);
			}
			
			/* stop the clock! */
			$endtime = microtime(true);
			
			$total_time = ($endtime - $starttime);
			return $total_time;
		}
		
		
		
		/*
		 * TEST 6 - FILE SYSTEM
		 * 
		 * ???
		 */
		 public function test6() {
		 	/* start the clock */	
			$starttime = microtime(true);
				
		 	for($i=0; $i < 200; $i++) {
	        		
				// Subtest 6.1 - reading files
	       		$dataFile = fopen( __FILE__, "r" ) ;
	       		if($dataFile) {
	               	while (!feof($dataFile)) {
	                       $buffer = fgets($dataFile, 4096);
	       			}
	          		fclose($dataFile);
	       		} else {
	          			die( "fopen failed for ".__FILE__) ;
	       		}
	
	       		// Subtest 6.2 - read file metadata
	       		$filesize = @filesize(__FILE__);
	   			$isreadable = @is_readable(__FILE__);
	       		$iswritable = @is_writable(__FILE__);
	       		$df = @disk_free_space("/");
	
	       		// Subtest 6.3 - copying and deleting files
	       		if($i < 7) {
	               	$file2 = "benchmark2.php";
	               	$copy = @copy(__FILE__, $file2);
	               	if(!$copy) {
	                      echo "failed to copy __FILE__...\n";
	               	} else {
						unlink($file2);
	               	}
	       		}
			}
			
			/* stop the clock! */
			$endtime = microtime(true);
			
			$total_time = ($endtime - $starttime);
			return $total_time;
		 }

		
		
		/*
		 * TEST 7 - OBJECTS
		 * 
		 * This test creates an instance of the PHP_Benchmark_Foo class and starts these functions 1000 times in a loop.
		 */
		 public function test7() {
		 	/* start the clock */	
			$starttime = microtime(true);
			
			
			for($i=0; $i < 20000; $i++) {
	       		$bar = new PHP_Benchmark_Foo("Hello world!");
	       		$_1 = $bar->do_foo();
	       		$_2 = $bar->multiply(72, 12);
			}
			
			
			/* stop the clock! */
			$endtime = microtime(true);
			
			$total_time = ($endtime - $starttime);
			return $total_time;
		 }
		
		
		/* 
		 * -----------------
		 *   END OF TESTS
		 * -----------------
		 */
		
		
		/*
		 * Compare Functions
		 * 
		 * With this function you can compare two or more functions with each other.
		 * 
		 * @param $functions = array(
		 * 1 => array("shortname" => "functionname"))
		 * 
		 */ 
		public function compareFunctions($functions = array(), $duration = 2) {
			
		}
		
		
	 } // End of class

	/*
	 * Helper class for PHP_Benchmark class. Its needed for test 7 (Objects)
	 * 
	 * @author Free-Webhosts.com and Nick Barrett
	 * 
	 * @package PHP Benchmark Script
	 * 
	 */ 
	class PHP_Benchmark_Foo {
			
		var $z;
		
		function Foo($var) {
			$this->z = $var;
		}
		
		function do_foo() {
			return $this->z;
		}
		
		function multiply($var1, $var2) {
			return ($var1 * $var2);
		}
}
?>