<?php
    if ( $_REQUEST['mod'] === 'edit') {
            require_once("../../includes/classes/minixml.inc.php");
             
            $username = $_POST['username'];
            $twittsMaxCount = $_POST['twittsMaxCount'];
            $twittWrapper = $_POST['twittWrapper'];
            $dateFormat = $_POST['dateFormat'];
            
            $settings = array(
                                'config' => array(
                                                       'username' => $username,
                                                       'twittsMaxCount' => $twittsMaxCount,
                                                       'twittWrapper' => $twittWrapper,
                                                       'dateFormat' => $dateFormat,
                                                    ),
                             );
            $xml = new MiniXMLDoc();
            $xml->fromArray($settings);
            $xml = $xml->toString();
            $xmlFile = fopen("config.xml","w");
            fwrite($xmlFile, $xml);
            fclose($xmlFile);
            
            $_POST['adminmode'] = true;
            header("Location: admin.php");
            die();
    }
    else if ( $_POST['adminmode'] === true) {
        $username = "";
        $twittsMaxCount = "";;
        $twittWrapper = "";
        $dateFormat = "";
        function loadSettings(){
            global $username;
            global $twittsMaxCount;
            global $twittWrapper;
            global $dateFormat;
            
            $xml = join('',file("../plugins/{$_POST['folder']}/config.xml"));
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
        }
        loadSettings();
	    require_once "../plugins/{$_POST['folder']}/admincp.php";
	}
	else {
		function controlPanel(){
		    echo "<tr><td>Twitter</td><td><a href=\"index.php?mod=apps&plugin=fl_twitter\"><img src=\"../plugins/twitter/imgs/manage.png\"></img></a></td></tr>";
	    }
	    if(isset($events)){
	        $events->register("fl_admin_apps","controlPanel");
	    }
	}
?>
