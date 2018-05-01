<?php 
class CURL
{
	public function __construct()
	{
		$this->ch = curl_init();
		curl_setopt ($this->ch, CURLOPT_CONNECTTIMEOUT, 20);
		curl_setopt ($this->ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt ($this->ch, CURLOPT_SSL_VERIFYPEER, false);
		//curl_setopt ($this->ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0");
		//curl_setopt ($this->ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Linux; Android 5.1.1; Nexus 5 Build/LMY48B; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/43.0.2357.65 Mobile Safari/537.36");
		curl_setopt ($this->ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36");
		curl_setopt ($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt ($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($this->ch, CURLOPT_FRESH_CONNECT, 1);
		curl_setopt ($this->ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt ($this->ch, CURLOPT_HEADER, 0);
		curl_setopt ($this->ch, CURLOPT_VERBOSE, 0);
		curl_setopt ($this->ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . "/" . "cookie.txt");
		curl_setopt ($this->ch, CURLOPT_COOKIEFILE, dirname(__FILE__) . "/" . "cookie.txt");
		
		// Add here every header you may need. Globaly. 
	}
	
	public function get($url=null)
	{
		if (empty($url)) return 0;
		curl_setopt($this->ch, CURLOPT_URL, $url);
		$result = curl_exec($this->ch);
		return $result;
	}
	
}



?>