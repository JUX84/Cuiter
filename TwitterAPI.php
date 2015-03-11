<?php

class TwitterAPI {
    private $consumerKey;
    private $consumerSecret;
    private $accessToken;
    private $accessTokenSecret;

    public function __construct($APICredentials) {
        if($APICredentials == null || sizeof($APICredentials) != 4 || !isset($APICredentials["consumerKey"], $APICredentials["consumerSecret"], $APICredentials["acessToken"], $APICredentials["accessTokenSecret"]))
            return null;
        foreach($APICredentials as $key => $value) {
            $$key = $value;
        }
    }

    private function query($url, $method, $fields) {
        $oauth = array(
            'oauth_consumer_key' => $this->consumerKey,
            'oauth_nonce' => time(),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_token' => $this->accessToken,
            'oauth_timestamp' => time(),
            'oauth_version' => '1.0'
        );
        $oauth += $fields;
        ksort($oauth);
        $tmp = array();
        $values = array();
        foreach($oauth as $key => $value) {
            $tmp[] = "$key=$value";
            $values[] = $key.'="'.rawurlencode($value).'"';
        }
        $base = $method.'&'.rawurlencode($url).'&'.rawurlencode(implode('&', $tmp));
        $compositeKey = rawurlencode($this->consumerSecret).'&'.rawurlencode($this->accessTokenSecret);
        $oauth['oauth_signature'] = base64_encode(hash_hmac('sha1', $base, $compositeKey, true));
        $header = array('Authorization: OAuth '.implode(', ', $values), 'Expect:');
        $options = array(
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_HEADER => false,
            CURLOPT_URL => $url.$fields,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10
        );
        $feed = curl_init();
        curl_setopt_array($feed, $options);
        $json = curl_exec($feed);
        curl_close($feed);

        return json_decode($json, true);
    }
}