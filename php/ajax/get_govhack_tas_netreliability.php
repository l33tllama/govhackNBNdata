<?php
	
	$blep = array();
	
	for($i=0;$i<24;$i++)
	{
		$r=50;
		if($i<3)
		{
			$r=50+$i*10-rand(0,4);
		}
		else if($i<6)
		{
			$r=80-$i*10-rand(0,4);
		}
		else if($i==19)
		{
			$r=80;
		}
		else if($i==20)
		{
			$r=rand(30,50);
		}else{
			$r=rand(5,15);
		}
		$blep[]=array(
			'Time' => "$i",
			'Reliability' => $r
		);
	}
	
	$rows=array();
	
	foreach($blep as $r)
	{
		$row_entry = array("c" => array(
				array("v" => $r['Time'], "f" => NULL), 
				array("v" => (int)$r['Reliability'], "f" => null)
				)
			);
		array_push($rows, $row_entry);
	}
	
	$cols=array(
			array('id'=>'', 'label'=>'Time','pattern'=>'','type'=>'string'),
			array('id'=>'', 'label'=>'Reliability%','pattern'=>'','type'=>'number'),
		);
	
	$stuff=array('cols'=>$cols, 'rows'=> $rows);
	echo json_encode($stuff);
 ?>