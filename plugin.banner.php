<?php
/*****************************************************************************************
plugin banner.php
shows one or more (up to 3) banner

@author doe-eye alias d4u alias aca78

******************************************************************************************/ 
Aseco::registerEvent('onStartup', 'banner_startup');
Aseco::registerEvent('onPlayerConnect', 'banner_PlayerConnect');
Aseco::registerEvent('onEndMap', 'banner_endMap');
Aseco::registerEvent('onBeginMap', 'banner_beginMap');


global $banner1;
global $banner2;
global $banner3;


function banner_startup($aseco, $command) {
    global $banner1;
	$banner1 = new Banner($aseco, "banner.xml");
	$banner1->show = true;
	$banner1->showWidget(1);
/*		
	global $banner2;
	$banner2 = new Banner($aseco, "banner2.xml");
	$banner2->show = true;
	$banner2->showWidget(2);
	
	global $banner3;
	$banner3 = new Banner($aseco, "banner3.xml");
	$banner3->show = true;
	$banner3->showWidget(3);
*/
}

function banner_PlayerConnect($aseco, $command) {
    global $banner1;
	$banner1->show = true;
    $banner1->showWidget(1);
/*		
	global $banner2;
	$banner2->show = true;
    $banner2->showWidget(2);

	global $banner3;
	$banner3->show = true;
    $banner3->showWidget(3);	
*/
} 
function banner_endMap($aseco, $command) {
    global $banner1;
    $banner1->show = false;
    $banner1->showWidget(1);
/*	
	global $banner2;
    $banner2->show = false;
    $banner2->showWidget(2);

	global $banner3;
    $banner3->show = false;
    $banner3->showWidget(3);
*/
}

function banner_beginMap($aseco, $command) {
    global $banner1;
    $banner1->show = true;
    $banner1->showWidget(1);
/*		
    global $banner2;
    $banner2->show = true;
    $banner2->showWidget(2);
	
    global $banner3;
    $banner3->show = true;
    $banner3->showWidget(3);
	*/
} 


class Banner {
	public $show = true;
	
	private $aseco;
	private $pf_posn = '';
	private $pf_scale = '';
	
	private $pf_pq_sizen = '';
	private $pf_pq_image = '';
	private $pf_pq_imageFocus = '';
	private $pf_pq_halign = '';
	private $pf_pq_valign = '';
	
	private $pf_hl_sizen = '';
	private $pf_hl_url = '';
	private $pf_hl_halign = '';
	private $pf_hl_valign = '';
	private $pf_hl_focusareacolor1 = '';
	private $pf_hl_focusareacolor2 = '';


    function Banner($aseco, $xmlFileName) {
		$this->aseco = $aseco;
        try {
            $xml_array = $aseco->xml_parser->parseXml($xmlFileName);			
					
			$this->pf_posn = $xml_array['SETTINGS']['PICTURE_FRAME'][0]['POSN'][0];
			$this->pf_scale = $xml_array['SETTINGS']['PICTURE_FRAME'][0]['SCALE'][0];
			
			$this->pf_pq_sizen = $xml_array['SETTINGS']['PICTURE_FRAME'][0]['PICTURE_QUAD'][0]['SIZEN'][0];
			$this->pf_pq_image = $xml_array['SETTINGS']['PICTURE_FRAME'][0]['PICTURE_QUAD'][0]['IMAGE'][0];
			$this->pf_pq_imageFocus = $xml_array['SETTINGS']['PICTURE_FRAME'][0]['PICTURE_QUAD'][0]['IMAGEFOCUS'][0];
			$this->pf_pq_halign = $xml_array['SETTINGS']['PICTURE_FRAME'][0]['PICTURE_QUAD'][0]['HALIGN'][0];
			$this->pf_pq_valign = $xml_array['SETTINGS']['PICTURE_FRAME'][0]['PICTURE_QUAD'][0]['VALIGN'][0];

			$this->pf_hl_sizen = $xml_array['SETTINGS']['PICTURE_FRAME'][0]['HOVER_LABEL'][0]['SIZEN'][0];
			$this->pf_hl_url = $xml_array['SETTINGS']['PICTURE_FRAME'][0]['HOVER_LABEL'][0]['URL'][0];
			$this->pf_hl_halign = $xml_array['SETTINGS']['PICTURE_FRAME'][0]['HOVER_LABEL'][0]['HALIGN'][0];
			$this->pf_hl_valign = $xml_array['SETTINGS']['PICTURE_FRAME'][0]['HOVER_LABEL'][0]['VALIGN'][0];
			$this->pf_hl_focusareacolor1 = $xml_array['SETTINGS']['PICTURE_FRAME'][0]['HOVER_LABEL'][0]['FOCUSAREACOLOR1'][0];
			$this->pf_hl_focusareacolor2 = $xml_array['SETTINGS']['PICTURE_FRAME'][0]['HOVER_LABEL'][0]['FOCUSAREACOLOR2'][0];
			
        } catch (\Exception $e) {
            $aseco->console("Error parsing: ". $e);
        }
    }

    function showWidget($no) {
        
		
		if($this->show){
			$xml ="
				<manialink id=\"9180$no\" version=\"1\">			
					<frame posn=\"$this->pf_posn\" scale=\"$this->pf_scale\">
						<quad sizen=\"$this->pf_pq_sizen\" image=\"$this->pf_pq_image\"  halign=\"$this->pf_pq_halign\" valign=\"$this->pf_pq_valign\" ";
							if($this->pf_pq_imageFocus == ''){
								$xml .= "/>";
							}
							else{
								$xml .= "imagefocus=\"$this->pf_pq_imageFocus\" url=\"$this->pf_hl_url\" /> ";
							}
						$xml .= "
						<label sizen=\"$this->pf_hl_sizen\"  url=\"$this->pf_hl_url\" halign=\"$this->pf_hl_halign\" valign=\"$this->pf_hl_valign\" focusareacolor1=\"$this->pf_hl_focusareacolor1\" focusareacolor2=\"$this->pf_hl_focusareacolor2\"/>
					</frame>
				</manialink>";			
		}
		else{
			$xml = <<<XML
				<manialink id="9180$no" version="1">			

				</manialink>			
XML;
		}
		
		$this->aseco->client->query('SendDisplayManialinkPage', $xml, 0, false);
    }


		
}
