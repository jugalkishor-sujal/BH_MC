<?php
/*
    (c) Airson Technologies
    Created: 01/02/2015
    Author: Jugal Kishor
    jugal.k.choudhary@gmail.com
	https://auth.bullhornstaffing.com/oauth/token?grant_type=authorization_code&code=5%3A1dbf825c-ca13-499e-9db1-b600118c21a0&
	client_id=a52a23d3-24a5-42c9-8ff6-1b0b9ad2bff7&client_secret=oSOsTUaiUazm1uNflFs7oZO8oBiv9Boe
	
	https://rest.bullhornstaffing.com/rest-services/login?version=*&access_token=5:043fd6ed-6522-449b-a2a9-8ffa5e1a42a8
*/

class BullhornAPI
{
	//GET ACCESS CODE
	private $authorize_url    = "https://auth.bullhornstaffing.com/oauth/authorize";
	private $client_id        = "a52a23d3-24a5-42c9-8ff6-1b0b9ad2bff7";
	private $redirect_url     = "http://localhost:801/paul/index.php";
	private $scope            = "";
	private $state			  = 107008;
	private $response_type    = "code";
	//GET ACCESS TOKEN
	private $access_token_url = "https://auth.bullhornstaffing.com/oauth/token";
	//private $client_id        = "a52a23d3-24a5-42c9-8ff6-1b0b9ad2bff7";
	private $client_secret    = "oSOsTUaiUazm1uNflFs7oZO8oBiv9Boe";
	//private $scope            = "";
	private $code             = "";
	private $grant_type    = "authorization_code";
		
	//REST LOGIN
	private $rest_login_url   = "https://rest.bullhornstaffing.com/rest-services/login";
	private $version		  = "*";
	private $access_token	  = "";
	
	public function getAccessCode(){
		$url = $this->authorize_url;
        $args=array(  'client_id'=>$this->client_id, 
                      'redirect_uri'=>$this->redirect_url, 
                      'scope'=>$this->scope, 
					  'state'=>$this->state,
                      'response_type'=>$this->response_type);
		$url.='?';
		$url.='&'.$this->preparePostFields($args);
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        curl_exec($ch);		
		$result = curl_getinfo($ch);
		return $result;	
		curl_close($ch);        
	}
	public function getAccessToken($access_token_url,$code){
		$url = $this->access_token_url;
        $args=array(  'client_id'=>$this->client_id, 
					  'client_secret'=>$this->client_secret,
					  'code' =>$this->code,
                      'scope'=>$this->scope, 
					  'state'=>$this->state,
                      'grant_type'=>'authorization_code');
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POST, TRUE); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->preparePostFields($args));
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