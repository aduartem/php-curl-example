<?php
/**
* @author aduartem
*/
class Curl_client
{
    private $_url;
    private $_api_key;
    
    function __construct()
    {
        $config = file_get_contents("config/restful_api.json");
        $rest = json_decode($config);

        $this->_url     = $rest->url;
        $this->_api_key = $rest->api_key;
    }

    public function set_url($url)
    {
        $this->_url = $url;
    }

    public function get($id = NULL)
    {
        if($id !== NULL)
        {
            $this->_url = $this->_url . "{$id}";
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); 
        curl_setopt($curl, CURLOPT_URL, $this->_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'X-API-KEY: ' . $this->_api_key,
            'Accept: application/json'
        ));

        $response = curl_exec($curl); 

        if ( ! $response) return FALSE;

        curl_close($curl);

        return $response;
    }

    public function post($params)
    {
        $curl = curl_init($this->_url);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'X-API-KEY: ' . $this->_api_key,
            'Accept: application/json'
        ));

        $response = curl_exec($curl);

        if ( ! $response) return FALSE;

        curl_close($curl);

        return $response;
    }

    public function put($id, $params = array())
    {
        $curl = curl_init($this->_url . "{$id}");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'X-API-KEY: ' . $this->_api_key,
            'Accept: application/json'
        ));

        $response = curl_exec($curl);

        if ( ! $response) return FALSE;
        
        curl_close($curl);

        return $response;
    }

    public function delete($id)
    {
        $curl = curl_init($this->_url."{$id}");
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'X-API-KEY: ' . $this->_api_key,
            'Accept: application/json'
        ));

        $response = curl_exec($curl);

        if ( ! $response) return FALSE;

        curl_close($curl);
        
        return $response;
    }
}