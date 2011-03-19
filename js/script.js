/* Author: Philipp Schroer */


$(document).ready(function(){
	
	var counttests = 0;
	
	
	function doTests(numtests) {
		
		/* Change status message */
		$("#status").html("Loading...");
		
		counttests++;
		$("#results-content").append("<tr></tr>");
		$('#results-content tr:last').load('./ajax-tests.php',{ num: counttests }, function(response, status, xhr) {
  			
  			/*
  			 * alert status message
  			 * 
  			 * TODO: display error in another, not so blocking way.
  			 */
  			if (status == "error") {
    			alert("Test error: " + xhr.status + " " + xhr.statusText);
    		}
    		
    		/* Change status message again */
    		$("#status").html("Finished!");	
    		
    		numtests--;
    		
    		/* if there are still tests to do start the function again */
    		if (numtests > 0) {
    			doTests(numtests);
    		}

    	});
    	
	}
	
	
	
	
	
	/* STARTBUTTON */
	$("#startbutton").click(function(event){
		event.preventDefault();
		doTests(5);
	});
	/* STARTBUTTON END */
	
	
	/* CLEARBUTTON */
	$("#clearbutton").click(function(event){
		event.preventDefault();
		
		/* on click hide the normal buttons and show a confirmation button */
		$('#control-buttons').hide();
		$('#controls').prepend('<p id="suredelete"><a href="#" class="button big negative left" id="delete-yes"><span class="cross icon" style="width:100px;"></span>Do it!</a><a href="#" class="primary button big right" style="width:200px;" id="delete-no">No!</a></p>');	
		
		$('#delete-yes').click(function(event) {
			event.preventDefault();
			$("#results-content").children().hide('slow');
			$('#suredelete').remove();
			$('#controls p:first').show('slow');
			counttests = 0;
		});
		
		$('#delete-no').click(function(event) {
			event.preventDefault();
			$('#suredelete').remove();
			$('#controls p:first').show('slow');
		});
	});
	/* CLEARBUTTON END */
	
	
	/* SOURCECODE TABS */
	$('#sourcecode').tabs();
	
});
