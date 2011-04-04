/* Author: Philipp Schroer */


$(document).ready(function(){
	
	/* Set up the important variables
	--------------------------------------------- */

	var counttests = 0;
	
	var results = new Array();
	/* Divide the results array in two different sorted versions:
	 * The first is sorted by the test type, like test1, test2 and so on. 
	 * The second one is sorted by test type, a bit like the table rows are shown.
	 */ 
	results["byTestType"] = new Array(); 
	results["byRequest"] =  new Array();
	
	
	
	/* doTests(): Main function to do the tests
	--------------------------------------------- */
	
	function doTests(numtests) {
		
		/* Change status message */
		$("#status").html("Loading...");
		
		/* add one to the test counter variable */
		counttests++;
		
		
		/* --- AJAX Request --- */
		
		$.ajax({
			url: './ajax-tests.php',
			dataType: 'json',
			success: function(data, textStatus, jqXHR){
			  
				
				/* Parse result to html table markup */
					
					$("#results-content").append("<tr></tr>");
					
					var html = '<tr><th>' + counttests + '</th>';
					
					var total = 0;
					
					$.each(data, function(index, value){
						html = html + '<td>' + value + '</td>';
						total = total + value;
					});
	
					html = html + '<th>' + total + '</th>';
					
					html = html + '</tr>';
				
				/* END: Parse result to html table markup */
				
				
				/* add the parsed html to the table */
				$(html)
				    .hide()
				    .appendTo('#results-content')
				    .css({
				    	'opacity':'0',
				    	'display':'table-row'
				    	})
				    .animate({'opacity':'1'}, 'slow');
			  
				/* Change status message again */
				$("#status").html("Finished!");
				
				
				/* Fill in the results["byTestType"] array */
				$.each(data, function(index, value){
					
					if (typeof(results["byTestType"][index]) == "undefined") {
						results["byTestType"][index] = new Array();
					}
					
					results["byTestType"][index][counttests] = value;
					
				});
				
				/* Fill in the results["byRequest"] array */
				results["byRequest"][counttests] = data;
				
				numtests--;
				  
				/* if there are still tests to do start the function again */
				if (numtests > 0) {
					doTests(numtests);
				}
				
				averages();
			  
		    }, /* SUCCESS callback END */
		    
		    error: function(jqXHR, textStatus, errorThrown){
		    	alert('Request error: ' + textStatus);
		    }
		    
		});
    	
	}
	
	/* TODO: AVERAGES */
	function averages() {
		return '';
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

