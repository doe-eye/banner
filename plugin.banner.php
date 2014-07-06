<?php
/*****************************************************************************************
plugin.banner.php
->	shows one or more banner
	(if more than one, un-comment the corresponding lines in the ADAPT-section below)
->	needs a xml-file for each banner

@author aca (inspired by already existing plugins, sorry, don't remember which ones)
@version: 2.0
******************************************************************************************/ 

Aseco::registerEvent('onStartup', 'banner_startup');
Aseco::registerEvent('onPlayerConnect', 'banner_PlayerConnect');
Aseco::registerEvent('onEndMap', 'banner_endMap');
Aseco::registerEvent('onBeginMap', 'banner_beginMap');

global $bannerArray;

function banner_startup($aseco) {
	global $bannerArray;
	$bannerArray = array();
	
	
/***************************************************** ADAPT BELOW ****************************************************/	
	$banner = new Banner("banner.xml");
	array_push($bannerArray, $banner);
	
	//$banner2 = new Banner("banner2.xml");
	//array_push($bannerArray, $banner2);
	
	//$banner3 = new Banner("banner3.xml");
	//array_push($bannerArray, $banner3);

/***************************************************** ADAPT ABOVE ****************************************************/	


	foreach($bannerArray as $banner){
		$aseco->client->query('SendDisplayManialinkPage', $banner->getMLxml(true), 0, false);
	}
	
}



function banner_endMap($aseco, $map) {
	bannerShow($aseco, false);
}

function banner_PlayerConnect($aseco, $player) {
	bannerShow($aseco, true);
} 

function banner_beginMap($aseco, $map) {
	bannerShow($aseco, true);
} 

function bannerShow($aseco, $show){
	global $bannerArray;
	foreach($bannerArray as $banner){
		$aseco->client->query('SendDisplayManialinkPage', $banner->getMLxml($show), 0, false);
	}
}


class Banner {
	private $sett;
	private $instanceNo;
	private static $instanceCount = 0;

    function Banner($xmlFileName){
		Banner::$instanceCount++;
		$this->instanceNo = Banner::$instanceCount;
		
		$this->sett = simplexml_load_file($xmlFileName);
    }
	function getMLxml($show){
		if($show == true){
			$xml ='
				<manialink id="230178'.$this->instanceNo.'" version="1">			
					<frame 
						posn="'.$this->sett->picture_frame->posn.'" 
						scale="'.$this->sett->picture_frame->scale.'">
						
						<quad 
							sizen="'.$this->sett->picture_frame->picture_quad->sizen.'" 
							image="'.$this->sett->picture_frame->picture_quad->image.'"  
							halign="'.$this->sett->picture_frame->picture_quad->halign.'" 
							valign="'.$this->sett->picture_frame->picture_quad->valign.'" ';
							
							if($this->sett->picture_frame->picture_quad->imagefocus == ''){
								$xml .= "/>";
							}
							else{
								$xml .= ' 
								imagefocus="'.$this->sett->picture_frame->picture_quad->imagefocus.'" 
								url="'.$this->sett->picture_frame->hover_label->url.'" /> ';
							}
						$xml .= '
						<label 
							sizen="'.$this->sett->picture_frame->hover_label->sizen.'"  
							url="'.$this->sett->picture_frame->hover_label->url.'" 
							halign="'.$this->sett->picture_frame->hover_label->halign.'" 
							valign="'.$this->sett->picture_frame->hover_label->valign.'" 
							focusareacolor1="'.$this->sett->picture_frame->hover_label->focusareacolor1.'" 
							focusareacolor2="'.$this->sett->picture_frame->hover_label->focusareacolor2.'"
						/>
					</frame>
				</manialink>';			
		}
		else{
			$xml = '<manialink id="230178'.$this->instanceNo.'" version="1"></manialink>';
		}
		
		return $xml;
	}	
}



?>
