<?php
class YourController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('RateLimit');
    }

    public function index() {
        // Use a unique key for each user or IP address
        $key = 'user_id_' . $this->session->userdata('user_id'); // Change this to your preference

        // Check the rate limit
        $this->ratelimit->checkLimit($key);
    }
}
?>
