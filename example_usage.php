<?php

class api
{
    private $authtoken;
    protected $shell;

    function init(){
        $this->shell = new curl_handler();

        $header = array("Content-Type: application/x-www-form-urlencoded");
        $opts =array($req_mode="POST", $use_proxy="FALSE", $ssl="FALSE", $ignore_ssl_hostname="FALSE", $multiple_cookies="FALSE", $referrer="NONE",
            $headers=$header, $data=array(), $json_encode="TRUE");

        $url = "https://urlhere";

        $output = $this->shell->parse_exec($opts, $url);
    }
?>
