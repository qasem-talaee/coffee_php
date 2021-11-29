<?php
function get_ip(){
    if (!empty($_SERVER["HTTP_CLIENT_IP"])){
        //check for ip from share internet
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
        // Check for the Proxy User
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    else{
        $ip = $_SERVER["REMOTE_ADDR"];
    }
    // This will print user's real IP Address
    // does't matter if user using proxy or not.
    return $ip; 
}
