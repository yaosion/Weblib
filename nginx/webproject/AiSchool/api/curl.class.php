<?php
#################################################
#Filename: curl.class.php
#author: sangning@megvii.com
#Last upate: 2016/10/07
#PHP Version: 5.5.1
#################################################
class curl
{
	var $host;
    var $port;
    var $path;
    var $method;
    var $postdata = '';
    var $cookiefile = "D:/web/htdocs/koala/HttpClient/cookie.txt";//服务器绝对路径
    var $referer;
    var $accept = 'text/xml,application/xml,application/xhtml+xml,text/html,text/plain,image/png,image/jpeg,image/gif,*/*';
	var $content_type = 'application/json';
    var $user_agent = "Koala Admin";
    var $timeout = 20;
    var $use_gzip = true;
    var $persist_cookies = true; 
	
	function curl($host) {
		$this->host = $host;       
    }
	function get($path, $data = false) {
        $this->path = $this->host.$path;
        if ($data) {
            $this->path .= '?'.$this->buildGetQuery($data);
        }
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $this->path);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); 
		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookiefile);  

		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
    }
	function put($path, $data) {
        $this->path = $this->host.$path;
        if ($data) {
            $this->postdata = $this->buildJsonQuery($data);
        }
		$ch = curl_init();
	  	curl_setopt($ch, CURLOPT_URL, $this->path);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS,$this->postdata); 
		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookiefile);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    		'Content-Type: application/json',
    		'Content-Length: ' . strlen($this->postdata))
			);  
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
    }
	function delete($path, $data=null) {
        $this->path = $this->host.$path;
        if ($data) {
            $this->postdata = $this->buildJsonQuery($data);
        }
        $ch = curl_init();
	  	curl_setopt($ch, CURLOPT_URL, $this->path);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_POSTFIELDS,$this->postdata); 
		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookiefile);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
    }
	function post($path,$data,$isfile=false) {
        $this->path = $this->host.$path;
        if ($data&&$isfile==true){
            $this->postdata = $data;
        }
		elseif($data&&$isfile==false)
		{
			$this->postdata = $this->buildJsonQuery($data);	
		}
		//echo $this->path;
		//echo $this->postdata;
		$ch = curl_init();
	  	curl_setopt($ch, CURLOPT_URL, $this->path);
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");	
		curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);	
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_COOKIEJAR,  $this->cookiefile);   
		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookiefile);
		if(!$isfile){
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    		'Content-Type:'.$this->content_type,
    		'Content-Length:'.strlen($this->postdata))
			);
		}
		curl_setopt($ch,CURLOPT_POSTFIELDS,$this->postdata);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
   }
	
	function buildGetQuery($data) {
        $querystring = '';
        if (is_array($data)) {
            
    		foreach ($data as $key => $val) {
    			if (is_array($val)) {
    				foreach ($val as $val2) {
    					$querystring .= urlencode($key).'='.urlencode($val2).'&';
    				}
    			} else {
    				$querystring .= urlencode($key).'='.urlencode($val).'&';
    			}
    		}
    		$querystring = substr($querystring, 0, -1); // Eliminate unnecessary &
    	} else {
    	    $querystring = $data;
    	}
		return $querystring;
    }
	function buildJsonQuery($data) {
        $querystring = '';
        if (is_array($data)) {
            $querystring=json_encode($data);
		  	}
		else echo "Parameters should be array.";
		return $querystring;
    }
	function object_array($array)
	{
  		
		if(is_object($array))
		{
    		$array = (array)$array;
  		}
  		if(is_array($array))
		{
    		foreach($array as $key=>$value)
			{
      			$array[$key] = $this->object_array($value);
    		}
  		}
  	return $array;
	} 
	function setUserAgent($string) {
        $this->user_agent = $string;
    }
	function setcookiefile($filepath)
	{
		$this->cookiefile = realpath($filepath);
	}
	function getcookie()
	{
		if(file_exists($this->cookiefile))
		{
			$content = file_get_contents($this->cookiefile);
			return $content;				
		}	
		else return null;
	}
}