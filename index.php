<?php
	//todo
 ?>
<HTML>
	<HEAD>
		<script type="text/javascript" src = "../js/jsapi.js"></script>
		<script type="text/javascript" src = "../js/jquery-1.9.1.min.js"></script>
		<script>
			// Load the Visualization API and the piechart package.
			google.load('visualization', '1.0', {'packages':['corechart']});
			
			// Set a callback to run when the Google Visualization API is loaded.
			google.setOnLoadCallback(drawChart);
			
			function drawChart() {
			//Continue to update chart if day is today
			
			// Create the data table.
		    var jsonData = $.ajax({
		    	url: "./php/ajax/get_biannual_usage_totals.php",
		      	dataType:"json",
		      	async: false
		    }).responseText;
			var data = new google.visualization.DataTable(jsonData);
			
			//Set chart options
		  	var options = { 'title':'Australian Internet Usage by Service Type ',
		    	              'width':800,
		        	          'height':640,
		            	      vAxis :{maxValue:16},
		                	  tooltip: {isHtml: true},
						  	};
		
		  // Instantiate and draw our chart, passing in some options.
		  	var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
		  	chart.draw(data, options);
		}
		</script>
		<TITLE>GovHack</TITLE>
	</HEAD>
	<BODY>
		Hello World!
		<div id="chart_div">Nope.php</div>
	</BODY>
	
</HTML>