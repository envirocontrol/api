<?php

$m = new MongoClient('mongodb://localhost/') ;

$db = $m->envirocontrol ;

$collection = $db->log_entries ;

if ( $_REQUEST["json"] != null )
{
	$json_data = json_decode($_REQUEST["json"]);
	$time = new MongoDate(strtotime($json_data->{"from"}));
	
	$result = $collection->find(array("time"=> array('$gt'=> $time))) ;
	foreach ( $result as $doc )
	{
		$log[] = $doc ;
	}
	$json = json_encode($log) ;
	echo $json . "\n" ;
}
else
{
	$json = json_encode ( array ( 'status' => 'invalid_params' ) ) ;
	echo $json ;
}


?>
