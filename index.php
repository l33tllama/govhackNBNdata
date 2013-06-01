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
			var data_usage = new google.visualization.DataTable(jsonData);
			
			jsonData = $.ajax({
		    	url: "./php/ajax/get_biannual_internet_speeds.php",
		      	dataType:"json",
		      	async: false
		    }).responseText;
			
			var data_speeds = new google.visualization.DataTable(jsonData);
			
			//Set chart options
		  	var options_usage = { 'title':'Australian Internet Usage in TB by Service Type',
		    	              'width':800,
		        	          'height':640,
		            	      vAxis :{maxValue:16},
		                	  tooltip: {isHtml: true},
						  	};
						  	//Set chart options
		  	var options_speeds = { 'title':"Australian Internet Speeds in 000's of connections by Speed",
		    	              'width':800,
		        	          'height':640,
		            	      vAxis :{maxValue:16},
		                	  tooltip: {isHtml: true},
						  	};
		
		  // Instantiate and draw our chart, passing in some options.
		  	var usage_chart = new google.visualization.LineChart(document.getElementById('usage_chart'));
		  	usage_chart.draw(data_usage, options_usage);
		  	
		  	var speeds_chart = new google.visualization.LineChart(document.getElementById('speeds_chart'));
		  	speeds_chart.draw(data_speeds, options_speeds);
		}
		</script>
		<TITLE>GovHack</TITLE>
	</HEAD>
	<BODY>
		Hello World!
		<div id="usage_chart">Nope.php</div>
		<div id="speeds_chart">Nope.php</div>
	</BODY>
	
</HTML>