<?php


class curl_handler{

    // Curl-to-PHP: http://incarnate.github.io/curl-to-php/
    protected $authcookie = "";

    function parse_exec($options, $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if($options[0] == "GET"){

        }
        elseif($options[0] == "POST"){
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        elseif($options[0] == "PUT"){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        }
        else{
            return "Unknown req_mode. Terminating statement.\n" . var_dump($options[0]);
        }

        if($options[1] === "FALSE"){
            curl_setopt($ch, CURLOPT_PROXY, ''); // Internal URL so don't use proxy
        }
        if($options[2] === "FALSE"){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Ignore SSL
        }
        if($options[3] === "FALSE"){
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // Ignore hostname in cert
        }
        if($options[4] === "SETUP"){
            $tmp_cookies = "cookies-tmp.txt";
            curl_setopt($ch, CURLOPT_COOKIEJAR, $tmp_cookies); // Cookiejar
        }
        elseif($options[4] === "USE"){
            $tmp_cookies = "cookies-tmp.txt";
            curl_setopt($ch, CURLOPT_COOKIEFILE, $tmp_cookies); // Cookiejar
        }
        if($options[5] !== "NONE"){
            curl_setopt($ch, CURLOPT_REFERER,  $options[5]);
        }
        if($options[6] !== array()){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $options[6]);
        }
        if($options[7] !== array()){
            # Must be json
            $json_data = json_encode($options[7]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        }

        # Finally, execute

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
//            var_dump(curl_getinfo($ch));
            return 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        if($options[8] === "TRUE") {
            return json_decode($result);
        }
        else{
            return $result;
        }
    }
}
