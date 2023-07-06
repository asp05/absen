<?php

/**
 * summary
 */
class Absen
{
    /**
     * summary
     */
    public function __construct()
    {
        $this->CI = &get_instance();
    }
    function auth($content, $data = null)
    {
        $datas = array(
            'content'   => $this->CI->load->view($content, $data, TRUE),
        );

        $this->CI->load->view('template/auth', $datas);
    }
    function admin($content, $data = null)
    {
        $datas = array(
            'header'    => $this->CI->load->view('template/header', $data, TRUE),
            'sidebar'   => $this->CI->load->view('template/sidebar', $data, TRUE),
            'content'   => $this->CI->load->view($content, $data, TRUE),
            'footer'    => $this->CI->load->view('template/footer', $data, TRUE)
        );

        $this->CI->load->view('template/master', $datas);
    }
}
