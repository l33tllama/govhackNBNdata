<!DOCTYPE HTML>
<HTML>
	<HEAD>
		<link rel="stylesheet" type="text/css" href="css/main.css"></link>
		<script type="text/javascript" src = "js/jsapi.js"></script>
		<script type="text/javascript" src = "js/jquery-1.9.1.min.js"></script>
		<script>
			// Load the Visualization API and the piechart package.
			google.load('visualization', '1.0', {'packages':['corechart', 'geochart']});
			
			// Set a callback to run when the Google Visualization API is loaded.
			google.setOnLoadCallback(drawChart);
			
			function drawChart() {
			//Continue to update chart if day is today
			/*
			 For an updater loop:
			 onload(timer(30sec));
			 timer
			 {
			  $.ajax(biannual_usage_totals.php?date=today)
			  timer(30sec);
			 }
			 
			 For a button bar to switch charts:
			 <ul>
			 <li><button></li>
			 </ul>
			 button.onClick
			 {
			 graph=my_chart;
			 graph.draw;
			 }
			 
			 For an info panel to monitor the cursor:
			 graph.onEnter{
			 selected=me;
			 sidebar.stats=mystats;
			 }
			*/
			
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
			
			jsonData = $.ajax({
		    	url: "./php/ajax/get_state_net_access_data.php",
		      	dataType:"json",
		      	async: false
		    }).responseText;
		    
		    var access_data = new google.visualization.DataTable(jsonData);
			
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
		                	  trendlines: { 0: {} }
						  	};
		
		  // Instantiate and draw our chart, passing in some options.
		  	var usage_chart = new google.visualization.LineChart(document.getElementById('usage_chart'));
		  	usage_chart.draw(data_usage, options_usage);
		  	
		  	var speeds_chart = new google.visualization.LineChart(document.getElementById('speeds_chart'));
		  	speeds_chart.draw(data_speeds, options_speeds);
		  	
		  	var access_options = { 'title':'Households and Small Businesses connected', 
		  						'width': 800,
		  						'height': 640,
		  						region: 'AU',
		  						displayMode: 'regions',
		  						resolution: 'provinces',
		  						numberFormat:'.##'
		  						};
		  	var access_chart = new google.visualization.GeoChart(document.getElementById('access_chart'));
        	access_chart.draw(access_data, access_options);
        	
        	//add a title above the geochart
        	var newEl = document.createElement("h3");
			newEl.innerHTML=access_options.title;
			var o =document.getElementById("access_chart")
			o.insertBefore(newEl,o.firstChild);
		}
		</script>
		<TITLE>GovHack</TITLE>
	</HEAD>
	<BODY>
		<div id="heading">
			<h1 id="heading">Internet Stuff</h1>
		</div>
		<div id="wrapper">
			<div id = "main">
				<table>
					<tr>
						<td id = "usage_chart"></td>
						<td id = "speeds_chart">Nope.php</td>
					</tr>
					<tr>
						<td id = "access_chart"></td>
					</tr>
				</table>
			</div>
		</div>
	</BODY>
</HTML>
