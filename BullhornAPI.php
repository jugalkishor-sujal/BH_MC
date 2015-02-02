<?php
/*
    (c) Airson Technologies
    Created: 01/02/2015
    Author: Jugal Kishor
    jugal.k.choudhary@gmail.com
*/

/*
Here are the REST credentials:

username: 'api.mmcadam',
password: '781toronto',
client_id: 'a52a23d3-24a5-42c9-8ff6-1b0b9ad2bff7',
client_secret: 'oSOsTUaiUazm1uNflFs7oZO8oBiv9Boe'

You are welcome to log into Bullhorn with the user id and password to create additional test records - some are there already, but please mark them clearly as "Test".  While this account appears to be empty, it is just restricted, and any records created go into a live account.
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
/*
?client_id=a52a23d3-24a5-42c9-8ff6-1b0b9ad2bff7&scope=&state=107008&redirect_uri=&response_type=code

    public function __construct($access_token=''){
        $this->access_token_url = "https://auth.bullhornstaffing.com/oauth/token";
        $this->authorize_url = "https://auth.bullhornstaffing.com/oauth/authorize";
        parent::__construct($access_token);
        $this->access_token_name='oauth2_access_token';
    }
	public function getAccessToken($client_id="", $secret="", $redirect_url="", $code = ""){
		print_r($client_id.$secret.$redirect_url.$code);
        if($code==""){
            $code = isset($_REQUEST['code'])?$_REQUEST['code']:"";
        }
        $params=array();
        $params['url'] = $this->access_token_url;
        $params['method']='post';
        $params['args']=array(  'code'=>$code, 
                                'client_id'=>$client_id, 
                                'redirect_uri'=>$redirect_url, 
                                'client_secret'=>$secret, 
                                'grant_type'=>'authorization_code');
        $result = $this->makeRequest($params);
        return $result;
    }
	 protected function makeRequest($params=array()){
        $this->error = '';
        $method=isset($params['method'])?$params['method']:'get';
        $headers = isset($params['headers'])?$params['headers']:array();
        $args = isset($params['args'])?$params['args']:'';
        $url = $params['url'];

        $url.='?';
        if($this->access_token){
            $url .= $this->access_token_name.'='.$this->access_token;
        }

        if($method=='get'){
            $url.='&'.$this->preparePostFields($args); 
        }
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        if($method=='post'){
            curl_setopt($ch, CURLOPT_POST, TRUE); 
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->preparePostFields($args)); 
        }elseif($method=='delete'){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }elseif($method=='put'){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        }
        if(is_array($headers) && !empty($headers)){
            $headers_arr=array();
            foreach($headers as $k=>$v){
                $headers_arr[]=$k.': '.$v;
            }
            curl_setopt($ch,CURLOPT_HTTPHEADER,$headers_arr);
        }
        $result = curl_exec($ch);
		print_r($method);

        curl_close($ch);
        return $result;
    }

    
    public function getCode($client_id,$redirect_url,$scope=''){
        $additional_args = array();
        if($scope!=''){
            if(is_array($scope)){
                $additional_args['scope']=implode(' ',$scope);
                $additional_args['scope'] = urlencode($additional_args['scope']);
            }else{
                $additional_args['scope'] = urlencode($scope);
            }
        }
        $additional_args['state'] = md5(time());
        return parent::getAuthorizeUrl($client_id,$redirect_url,$additional_args);
    }

    public function getAccessToken($client_id="", $secret="", $redirect_url="", $code = ""){
        $result = parent::getAccessToken($client_id, $secret, $redirect_url, $code);
		
        $result = json_decode($result,true); 
        if(isset($result['error'])){
            $this->error = $result['error'].' '.$result['error_description'];
            return false;
        }else{
            $this->access_token = $result['access_token'];
            return $result['access_token'];
    }
	}
}*/
?>