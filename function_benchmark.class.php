<?php

	/* Function Benchmark
	 * 
	 * This class provides an easy API to compare one or more functions. 
	 * 
	 * You can use two modes: Benchmark on time or Benchmark on calls.
	 * 		* by time: the functions get run in a time frame.
	 * 		* by calls: the functions get run many times and the duration is measured.
	 * 
	 */
    class Function_Benchmark {
    	
		private $loadedFunctions = array();
		
		/*
		 * Add function to queue
		 * 
		 * @param (string $id) choose a short name or an abbreviation for your function you want to register. Warning: it must be one-of-a-kind.
		 * @param (string $callback) select a function that you want to add to the queue.
		 * 
		 */ 
		public function addFunction($id, $callback) {
				
			if (function_exists($callback)) {
				array_push($this->loadedFunctions, array('id' => $id, 'callback' => $callback));
			} else {
				die('Function '.$callback.' does not exist.');
			}
    	}
		
		/*
		 * Benchmark by time
		 * 
		 * This function loads your registered functions and executes them until the duration is over
		 * 
		 * @param ([$duration]) not required parameter for the duration.
		 * 
		 * @return array(ID => CALLS, ID2 => CALLS2, and so on...)
		 * 
		 */ 
		public function benchmarkTime($duration = 2) {
				
			$calls = array();
				
			foreach($this->loadedFunctions as $key => $function) {
					
				$starttime = microtime(true);
				$end = $starttime + $duration;
				
				$calls[$function['id']] = 0;
				
				while(microtime(true) < $end) {
					call_user_func($function['callback']);
					$calls[$function['id']]++;
				}	
			}
		
			return $calls;
		}
		
		
		/*
		 * Benchmark by calls
		 * 
		 * This function load your registered functions and executes them $calls times and checks how long they take.
		 * 
		 * @param ([$calls]) not required parameter, sets the calls.
		 * 
		 * @return array(ID => NEEDED TIME, ID2 => NEEDED TIME2, and so on...)
		 * 
		 */ 
		public function benchmarkCalls($calls = 1000) {
			
			$times = array();
				
			foreach($this->loadedFunctions as $key => $function) {
				/* start the clock */	
				$starttime = microtime(true);
				
				for($i = 0; $i < $calls; $i++){
					call_user_func($function["callback"]);
				}
				
				/* stop the clock! */
				$endtime = microtime(true);
			
				$total_times[$function["id"]] = ($endtime - $starttime);
			}
			
			return $total_times;
		}
		
	}
?>