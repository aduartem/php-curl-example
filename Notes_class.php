<?php
/**
* @author aduartem
*/
require "Curl_client.php";

class Notes
{
    private $curl;

    function __construct()
    {
        $this->curl = new Curl_client();
    }

    public function get($id = NULL)
    {       
        return $this->curl->get($id);
    }

    public function create($title, $body)
    {
        $params = array('title' => $title, 'body' => $body);

        return $this->curl->post($params);
    }

    public function update($id, $title, $body)
    {
        $params = array('title' => $title, 'body' => $body);

        return $this->curl->put($id, $params);
    }

    public function delete($id)
    {
        return $this->curl->delete($id);
    }
}