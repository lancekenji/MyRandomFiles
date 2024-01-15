<?php

/**
**
*******************************************************
**    [+] enabled: This setting indicates wheter rate 
**        limiting is enabled or not (true or false).
**    [+] limit: This setting determines the maximum 
**        number of request allowed within a specific
**        time window.
**    [+] time_window: This setting defined the time 
**        window in seconds during which the specified
**        number of requests is allowed.
*******************************************************
**
**/

$config['rate_limit'] = [
    'enabled' => true,
    'limit' => 10,
    'time_window" => 60
];
?>
