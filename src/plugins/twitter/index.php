<?php
	require_once("plugins/twitter/classes/twitt-reader.php");
	require_once("plugins/twitter/classes/xml.php");
	
	function echoTwitts(){
		$xml = join('',file("plugins/twitter/config.xml"));
		$data = new MiniXMLDoc();
		$data->fromString($xml);
		
		$username = $data->getElement("username");
		$username = $username->getValue();
		
		$twittsMaxCount = $data->getElement("twittsMaxCount");
		$twittsMaxCount = $twittsMaxCount->getValue();
		
		$twittWrapper = $data->getElement("twittWrapper");
		$twittWrapper = $twittWrapper->getValue();
		
		$dateFormat = $data->getElement("dateFormat");
		$dateFormat = $dateFormat->getValue();
		
		$tr->twittsMaxCount = $twittsMaxCount;
		$tr->twittWrapper = $twittWrapper;
		$tr->dateFormat = $dateFormat;
		
		$tr = new TwittReader("$username");
		echo '' . $tr->getTwitts() . '';
	}
	
	function controlPanel(){
		echo $_REQUEST['mpc'];
		echo '123';
	}
	
	$events->register("fl_sidebar_print","echoTwitts");
	$events->register("fl_admin_apps","controlPanel");
?>
