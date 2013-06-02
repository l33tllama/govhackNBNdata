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

var last_visible = 'usage';

var desktop_size = 1000;
var mobile_size = 500;

function drawChart() 
{
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
					  'width':desktop_size,
					  'height':640,
					  vAxis :{maxValue:16},
					  tooltip: {isHtml: true},
					};
					//Set chart options
	var options_speeds = { 'title':"Australian Internet Speeds in 000's of connections by Speed",
					  'width':desktop_size,
					  'height':640,
					  vAxis :{maxValue:16},
					  tooltip: {isHtml: true},
					  trendlines: { 0: {} }
					};

	// Instantiate and draw our chart, passing in some options.
	usage_chart = new google.visualization.LineChart(document.getElementById('usage_chart'));
	usage_chart.draw(data_usage, options_usage);

	speeds_chart = new google.visualization.LineChart(document.getElementById('speeds_chart'));
	speeds_chart.draw(data_speeds, options_speeds);

	var access_options = { 'title':'Households and Small Businesses connected', 
						'width': desktop_size,
						'height': 577,
						region: 'AU',
						displayMode: 'regions',
						resolution: 'provinces',
						numberFormat:'.##',
						colorAxis: {colors: ['#9999FF', '#00AA00']}
						};
	access_chart = new google.visualization.GeoChart(document.getElementById('access_chart'));
	access_chart.draw(access_data, access_options);

	//add a title above the geochart
	var newEl = document.createElement("h3");
	newEl.innerHTML=access_options.title;
	var o =document.getElementById("access_chart")
	o.insertBefore(newEl,o.firstChild);
	
	//internet reliability
	jsonData = $.ajax({
		url: "./php/ajax/get_govhack_tas_netreliability.php",
		dataType:"json",
		async: false
	}).responseText;

	var rel_data = new google.visualization.DataTable(jsonData);
	
	var rel_options = { 'title':"GovHack Hobart Internet Reliability Graph for Saturday 1st June 2013",
					  'width':800,
					  'height':640,
					  vAxis :{maxValue:100},
					  hAxis: {title: 'Hour'},
					  tooltip: {isHtml: true},
					  trendlines: { 0: {} }
					};
	
	// Instantiate and draw our chart, passing in some options.
	rel_chart = new google.visualization.LineChart(document.getElementById('rel_chart'));
	rel_chart.draw(rel_data, rel_options);
}

function showChart(chart)
{
	fade_chart = "#" + last_visible + "_chart";
	switch(chart){
		case 'usage':
			$(fade_chart).fadeOut(400, function(){
													$("#usage_chart").fadeIn();
											});
			last_visible = 'usage';
			break;
		case 'speeds':
			$(fade_chart).fadeOut(400, function(){
													$("#speeds_chart").fadeIn();
											});
			last_visible = 'speeds';
			break;
		case 'access':
			$(fade_chart).fadeOut(400, function(){
													$("#access_chart").fadeIn();
											});
			last_visible = 'access';
			break;
		case 'rel':
			$(fade_chart).fadeOut(400, function(){
													$("#rel_chart").fadeIn();
											});
			last_visible = 'rel';
			break;
	}
}

		</script>
		<TITLE>GovHack</TITLE>
	</HEAD>
	<BODY>
		
		<div id="wrapper">
			<div id="heading">
				<h1 id="heading">Internet Stuff</h1>
			</div>
			<div id = "main">
				<?php
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
header('Location: http://detectmobilebrowser.com/mobile');
?>
				<!--<table>
					<tr>
						<td id="usage_chart"></td><td id="speeds_chart"></td><td id="access_chart"></td>
					</tr>
				</table> -->
				<center>
					<NOSCRIPT>Javascript is required for this page to function.</NOSCRIPT>
					<INPUT type="button" value="Usage" onClick="showChart('usage')"/>&nbsp;
					<INPUT type="button" value="Speeds" onClick="showChart('speeds')"/>&nbsp;
					<INPUT type="button" value="Access" onClick="showChart('access')"/>&nbsp;
					<INPUT type="button" value="GovHack Tas Reliability" onClick="showChart('rel')"/>
				
					<DIV id = "usage_chart"></DIV>
					<DIV id = "speeds_chart" style="display:none; position: relative;"></DIV>
					<DIV id = "access_chart" style="display:none; position: relative;"></DIV>
					<DIV id = "rel_chart" style="display:none"></DIV>
				</center>
			</div>
			<div id = "footer">
				Powered by Google Chart API.
			</div>
		</div>
	</BODY>
</HTML>
