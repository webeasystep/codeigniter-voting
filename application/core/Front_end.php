<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * @property Tools $tools
 * @property CI_Config $config
 * @property CI_Language $lang
 * @property CI_Session $session
 */

class Front_end extends CI_Controller {

    /***
     * pages of site in menu
     */

    function __construct() {
        parent::__construct();        
    }


    /**
     * return module language file
     * @param String $moduleName
     */
    protected function load_lang($moduleName = '') {

        if ($this->uri->segment(1) == 'ar' ||
            $this->uri->segment(1) == 'en'
        ) {
            $this->session->set_userdata("lang", $this->uri->segment(1));
            redirect($this->session->flashdata('redirectToCurrent'));
        }

        if ($this->session->userdata('lang') == "ar") {

            $lang = "arabic";
            $this->config->set_item('language',$lang);

        } elseif ($this->session->userdata('lang') == "en") {
            $lang = "english";
            $this->config->set_item('language',$lang);

        }else {
            $lang = "arabic";
            $this->config->set_item('language',$lang);
            $this->session->set_userdata("lang",'ar');
        }

        //  $this->lang->load($moduleName, $lang);
    }


    /**
     * present master page includes header and footer
     * @param string $main_containt
     * @param array $data 
     */
     function view($main_containt, $data = null) {
        $this->load->view('theme/header');
        $this->load->view($main_containt, $data);
        $this->load->view('theme/footer');
    }

    /**
     * give it the right string and it will 
     * @param string $right
     * @return void
     */
    protected function check_right($right, $path = '') {
        if ($path) {
            $this->auth->check($right, $path);
        } else {
            $this->auth->check($right, 'site');
        }
    }

}