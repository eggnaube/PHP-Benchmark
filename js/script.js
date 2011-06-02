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
	
	/* --- Default settings --- */
	var settings = new Array();
	settings['TestsOnStart'] = 5;
	
	
	/* doTests(): Main function to do the tests
	--------------------------------------------- */
	
	function doTests(remainingTests) {
		
		stop = false;
		
		/* Change status message & progressbar */
		$("#status").html('Doing ' + settings['TestsOnStart'] + ' tests, ' + remainingTests + ' remaining.');
		var progress = (100 - (Math.round(remainingTests / (settings['TestsOnStart'] / 100))));
		updateProgressbar(progress);

		
		
		/* --- AJAX Request --- */
		
		$.ajax({
			url: 'ajax-tests.php',
			dataType: 'json',
			cache:false,
			timeout:15000,
			success: function(data, textStatus, jqXHR){
			  
			  	counttests++;
				remainingTests--;
				
				/* Parse result to html table markup */
					
					var html = '<tr><th>' + counttests + '</th>';
					
					// Calculate sum of all results
					var total = 0;
					$.each(data, function(index, value){
						html = html + '<td>' + Math.round(value) + '</td>';
						total = total + value;
					});
					
					// save total in totals array & begin at 0
					totals[(counttests - 1)] = total;
	
					html = html + '<td class="total">' + Math.round(total) + '</td>';
					
					html = html + '</tr>';
				
				
				/* add the parsed html to the table */
				$(html)
				    .hide()
				    .appendTo('#results-content')
				    .fadeIn('slow');
				
				/* Fill in the resultsByTestType array */
				$.each(data, function(index, value){
					
					if (typeof(resultsByTestType[index]) == "undefined") {
						resultsByTestType[index] = new Array();
					}
					
					resultsByTestType[index][(counttests -1)] = value; // start array at 0
					
				});
				
				/* Fill in the resultsByRequest array */
				resultsByRequest[counttests] = data;
				
				// only show averages if there are more than 1 tests
				if(counttests > 1) {
					computeAverages();
				}
				 
				/* if there are still tests to do start the function again */
				if (stop == false && remainingTests > 0) {
					doTests(remainingTests);
				} else {
					updateProgressbar(100);
					$('#status').html('Finished!');
				}
			  
		    }, /* SUCCESS callback END */
		    
		    error: function(jqXHR, textStatus, errorThrown){
//		    	alert('Request error: ' + textStatus);
		    }
		    
		});
    	
	}
	
	/* Average computing
	--------------------------------------------- */
	function computeAverages() {
		
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

		html = html + '<td class="totals">' + Math.round(TotalsSum / counttests) + '</td>';
		
		$("#averages").children().remove();
		$("#averages").append(html);
		
	}

	
	/* Startbutton
	--------------------------------------------- */
	$("#button-start").click(function(event){
		event.preventDefault();
		doTests(settings['TestsOnStart']);
	});
	
	/* Stopbutton
	--------------------------------------------- */
	$("#button-stop").click(function(event){
		event.preventDefault();
		stop = true;
	});
	
	
	
	/* Clearbutton(s)
	--------------------------------------------- */
	$("#button-clear").click(function(event){
		event.preventDefault();
		
		/* on click hide the normal buttons and show a confirmation button */
		$('#controls-run, #controls-etc').hide('slow');
		$('#controls-clear-verify').show('slow');

		$('#status').html('Do you really want to delete the results?');
	});
	
	$('#controls-clear-verify-yes').click(function(event) {
		event.preventDefault();
			
		/* reset variables */
		counttests = 0;
		resultsByTestType = new Array(); 
		resultsByRequest =  new Array();
		totals = new Array();
			
		$("#results-content").children().hide('slow').remove();
		$("#averages").children().hide('slow').remove();		
		$('#status').html('');
		$('#controls-clear-verify').hide('slow');
		$('#controls-run, #controls-etc').show('slow');
			
	});
		
	$('#controls-clear-verify-no').click(function(event) {
		event.preventDefault();
		$('#status').html('');
		$('#controls-clear-verify').hide('slow');
		$('#controls-run, #controls-etc').show('slow');
	});

	
	/* Settings
	--------------------------------------------- */
	$('#settings').dialog({
		autoOpen: false,
		modal:true,
		minWidth: 400,
		open:function(event,ui){
			 $('#settings-TestsOnStart').val(settings['TestsOnStart']);
		},
		show: 'blind',
		buttons: {
			'Cancel':function(){
				$(this).dialog( "close" );
			},
			'Save':function(){
				settings['TestsOnStart'] = $('#settings-TestsOnStart').val();
				$( this ).dialog( "close" );
			}
		},
		hide: 'blind'
	});
	
	$('#button-settings').click(function(event){
		event.preventDefault();
		$('#settings').dialog('open');
	});
	
	
	/* Sourcecode tabs
	--------------------------------------------- */
	$('#sourcecode').tabs();
	
	/* Progressbar
	--------------------------------------------- */
	$( "#progressbar" ).progressbar({
			value: 0.00001
	});
	
	function updateProgressbar(value) {		
		value += '%';
		$("#progressbar div.ui-progressbar-value").animate({'width': value}, 'slow');
	}
	
	updateProgressbar(0);
});

