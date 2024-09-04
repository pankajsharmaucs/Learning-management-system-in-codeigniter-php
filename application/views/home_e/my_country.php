<?php 

 function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

$ip = get_client_ip();

    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
    if($query && $query['status'] == 'success')
    {
       $user_country=$query['country'];
       //  echo '<br />';
       //  echo 'Your City is ' . $query['city'];
       //  echo '<br />';
       //  echo 'Your State is ' . $query['region'];
       //  echo '<br />';
       //  echo 'Your Zipcode is ' . $query['zip'];
       //  echo '<br />';
       //  echo 'Your Coordinates are ' . $query['lat'] . ', ' . $query['lon'];
    }else{       $user_country='India';    }


?>