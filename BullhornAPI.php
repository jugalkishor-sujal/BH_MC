<?php
/*
    (c) Airson Technologies
    Created: 01/02/2015
    Author: Jugal Kishor
    jugal.k.choudhary@gmail.com
*/

class BullhornAPI
{
	private $access_token_url = "https://auth.bullhornstaffing.com/oauth/token";
	private $authorize_url    = "https://auth.bullhornstaffing.com/oauth/authorize";
	private $client_id        = "a52a23d3-24a5-42c9-8ff6-1b0b9ad2bff7";
	private $client_secret    = "oSOsTUaiUazm1uNflFs7oZO8oBiv9Boe";
	private $redirect_url     = "";
	private $scope            = "";
	private $code             = "";
	private $state			  = 107008;
	public function getAccessCode(){
		$url = $this->authorize_url;
        $args=array(  'client_id'=>$this->client_id, 
                      'redirect_uri'=>$this->redirect_url, 
                      'scope'=>$this->scope, 
					  'state'=>$this->state,
                      'response_type'=>'code');
		$url.='?';
		$url.='&'.$this->preparePostFields($args);
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        $result = curl_exec($ch);
		curl_close($ch);
        return $result;	
	}
	protected function preparePostFields($array) {
        if(is_array($array)){
            $params = array();
            foreach ($array as $key => $value) {
                $params[] = $key . '=' . urlencode($value);
            }
            return implode('&', $params);
        }else{
            return $array;
        }
    }
}

?>