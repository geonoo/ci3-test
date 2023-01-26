<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Errors extends CI_Controller {
    function notfound(){        
        $this->load->view('head');
        $this->load->view('errors/404');
        $this->load->view('footer');
    }
}
?>