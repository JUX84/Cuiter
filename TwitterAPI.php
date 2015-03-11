<?php

class TwitterAPI {
    private $consumerKey;
    private $consumerSecret;
    private $accessToken;
    private $accessTokenSecret;

    public function __construct($APICredentials) {
        if($APICredentials == null || sizeof($APICredentials) != 4 || !isset($APICredentials["consumerKey"], $APICredentials["consumerSecret"], $APICredentials["accessToken"], $APICredentials["accessTokenSecret"]))
            return null;
        foreach($APICredentials as $key => $value) {
            $this->$key = $value;
        }
    }

    public function query($url, $method, $fields) {
        if(!isset($this->consumerKey, $this->consumerSecret, $this->accessToken, $this->accessTokenSecret))
            return json_encode("error", "API configuration failed");
        $oauth = array(
            'oauth_consumer_key' => $this->consumerKey,
            'oauth_nonce' => time(),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_token' => $this->accessToken,
            'oauth_timestamp' => time(),
            'oauth_version' => '1.0'
        );
        $explodedFields = explode('&', substr($fields, 1));
        $fieldsArray = array();
        foreach($explodedFields as $field) {
            $explodedField = explode('=', $field);
            $fieldsArray[$explodedField[0]] = $explodedField[1];
        }
        if($method == "GET")
            $oauth += $fieldsArray;
        ksort($oauth);
        $tmp = array();
        $values = array();
        foreach($oauth as $key => $value) {
            $tmp[] = "$key=$value";
            $values[] = $key.'="'.rawurlencode($value).'"';
        }
        $base = $method.'&'.rawurlencode($url).'&'.rawurlencode(implode('&', $tmp));
        $compositeKey = rawurlencode($this->consumerSecret).'&'.rawurlencode($this->accessTokenSecret);
        $values[] = 'oauth_signature="'.rawurlencode(base64_encode(hash_hmac('sha1', $base, $compositeKey, true))).'"';
        $header = array('Authorization: OAuth '.implode(', ', $values), 'Expect:');
        $options = array(
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_HEADER => false,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10
        );
        if($method == "GET")
            $options[CURLOPT_URL] .= $fields;
        else
            $options[CURLOPT_POSTFIELDS] = $fieldsArray;
        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $json = curl_exec($curl);
        curl_close($curl);

        return json_decode($json, true);
    }
}
?>