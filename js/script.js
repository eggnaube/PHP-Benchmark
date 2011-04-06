/* Author: Philipp Schroer */


$(document).ready(function(){	
	
	
	/* Set up the important variables
	--------------------------------------------- */

	var counttests = 0;
	
	/* Divide the results array in two different sorted versions:
	 * The first is sorted by the test type, like test1, test2 and so on. 
	 * The second one is sorted by test type, a bit like the table rows are shown.
	 */ 
    var resultsByTestType = new Array(); 
	var resultsByRequest =  new Array();

	// saves totals of the requests
	var totals = new Array();
	
	var stop = false;
	
	
	/* doTests(): Main function to do the tests
	--------------------------------------------- */
	
	function doTests(numtests) {
		
		stop = false;
		
		/* Change status message */
		$("#status").html("Loading...");
		
		/* add one to the test counter variable */
		counttests++;
		
		
		/* --- AJAX Request --- */
		
		$.ajax({
			url: 'ajax-tests.php',
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
					
					// save total in totals array & begin at 0
					totals[(counttests -1)] = total;
	
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
				
				
				/* Fill in the resultsByTestType array */
				$.each(data, function(index, value){
					
					if (typeof(resultsByTestType[index]) == "undefined") {
						resultsByTestType[index] = new Array();
					}
					
					resultsByTestType[index][(counttests -1)] = value; // start array at 0
					
				});
				
				/* Fill in the resultsByRequest array */
				resultsByRequest[counttests] = data;
				
				numtests--;
				  
				averages();
				 
				/* if there are still tests to do start the function again */
				if (stop == false && numtests > 0) {
					doTests(numtests);
				}
			  
		    }, /* SUCCESS callback END */
		    
		    error: function(jqXHR, textStatus, errorThrown){
//		    	alert('Request error: ' + textStatus);
		    }
		    
		});
    	
	}
	
	/* Average computing
	--------------------------------------------- */
	function averages() {
		
		var html = '<th scope="row">Average</th>';
		
		for (var testType = 0; testType < resultsByTestType.length; testType++) {

			var execNum = 0;
			var sum = 0;
			while(execNum < resultsByTestType[testType].length) {
				sum = sum + resultsByTestType[testType][execNum];
				execNum++;
			}
			
			var average = Math.round(sum / execNum);
			
			html = html + '<td>' + average + '</td>';
		
		}
		
		// average of all totals
		var TotalsSum = 0;
		$.each(totals, function(index, value){
			TotalsSum = TotalsSum + value;
		});

		html = html + '<td>' + Math.round(TotalsSum / counttests) + '</td>';
		$("#averages").children().remove();
		$("#averages").append(html);
		
	}

	
	/* Startbutton
	--------------------------------------------- */
	$("#startbutton").click(function(event){
		event.preventDefault();
		doTests(10);
	});
	
	/* Stopbutton
	--------------------------------------------- */
	$("#stopbutton").click(function(event){
		event.preventDefault();
		stop = true;
	});
	
	
	
	/* Clearbutton
	--------------------------------------------- */
	$("#clearbutton").click(function(event){
		event.preventDefault();
		
		/* on click hide the normal buttons and show a confirmation button */
		$('#control-buttons').hide();
		$('#controls').prepend('<p id="suredelete"><a href="#" class="button big negative left" id="delete-yes"><span class="cross icon" style="width:100px;"></span>Do it!</a><a href="#" class="primary button big right" style="width:200px;" id="delete-no">No!</a></p>');	
		
		$('#delete-yes').click(function(event) {
			event.preventDefault();
			$("#results-content").children().hide('slow');
			$("#averages").children().hide('slow').remove();
			$('#suredelete').remove();
			$('#controls p:first').show('slow');
			counttests = 0;
			resultsByTestType = new Array(); 
			resultsByRequest =  new Array();
			totals = new Array();		
		});
		
		$('#delete-no').click(function(event) {
			event.preventDefault();
			$('#suredelete').remove();
			$('#controls p:first').show('slow');
		});
	});

	
	
	/* Sourcecode tabs
	--------------------------------------------- */
	$('#sourcecode').tabs();
	
});

