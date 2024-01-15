<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RateLimit {

    private $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->config('rate_limit', true);
        $this->CI->load->library('cache'); // If cache is enabled.
    }

    public function checkLimit($key) {
        $config = $this->CI->config->item('rate_limit');

        if ($config['enabled']) {
            $limit = $config['limit'];
            $timeWindow = $config['time_window'];

            $userKey = $key . '_' . $this->CI->input->ip_address(); // Create a unique key for each user/IP

            $requestCount = $this->CI->cache->get($userKey); // Get the current request count from the cache

            // If the request count is not set, initialize it to 1
            if ($requestCount === false) {
                $requestCount = 1;
            } else {
                $requestCount++;
            }

            // Set the new request count in the cache
            $this->CI->cache->save($userKey, $requestCount, $timeWindow);

            // Check if the request count exceeds the limit
            if ($requestCount > $limit) {
                log_message('error', 'Possible Crawler/Bot/Attacker: '.$this->CI->input->ip_address());
                show_error('Rate limit exceeded', 429);
            }
        }
    }
}
?>
